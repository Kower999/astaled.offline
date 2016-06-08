<?php

require_once(_PS_MODULE_DIR_.'data/classes/VIPPrices.php');

class Product extends ProductCore
{
    
	public $cena_2;
	public $provizia;
    

	public function __construct($id_product = null, $full = false, $id_lang = null, $id_shop = null, Context $context = null)
	{
		parent::__construct($id_product, $id_lang, $id_shop);

        require_once(_PS_MODULE_DIR_.'data/classes/Provisions.php');		  
		if (!empty($this->id))
		{
		  $pr = Provisions::getByIdProduct($this->id);
          if(!empty($pr)){
            if(!empty($pr['cena_2']))
                $this->cena_2 = (float)$pr['cena_2'];
            if(!empty($pr['provizia']))
                $this->provizia = (float)$pr['provizia'];
          }
		}
	}
    
	public function add($autodate = true, $null_values = false)
	{
		if (!parent::add($autodate, $null_values))
			return false;

        $p = new Provisions();
        $p->id_product = $this->id;
        $p->cena_2 = $this->cena_2;			
        $p->provizia = $this->provizia;
        $p->add();        			
		return true;
	}

	public function update($null_values = false)
	{
		$return = parent::update($null_values);

        $idp = Provisions::getProvisionByIdProduct($this->id);
        if(!empty($idp)) {
            $p = new Provisions((int)$idp);
            $p->cena_2 = $this->cena_2;			
            $p->provizia = $this->provizia;
            $p->update();        			            
        } else {
            $p = new Provisions();
            $p->id_product = $this->id;
            $p->cena_2 = $this->cena_2;			
            $p->provizia = $this->provizia;
            $p->add();        			            
        }

		return $return;
	}    


	/**
	* Price calculation / Get product price
	*
	* @param integer $id_shop Shop id
	* @param integer $id_product Product id
	* @param integer $id_product_attribute Product attribute id
	* @param integer $id_country Country id
	* @param integer $id_state State id
	* @param integer $id_currency Currency id
	* @param integer $id_group Group id
	* @param integer $quantity Quantity Required for Specific prices : quantity discount application
	* @param boolean $use_tax with (1) or without (0) tax
	* @param integer $decimals Number of decimals returned
	* @param boolean $only_reduc Returns only the reduction amount
	* @param boolean $use_reduc Set if the returned amount will include reduction
	* @param boolean $with_ecotax insert ecotax in price output.
	* @param variable_reference $specific_price_output
	* 	If a specific price applies regarding the previous parameters, this variable is filled with the corresponding SpecificPrice object
	* @return float Product price
	**/
	public static function priceCalculation($id_shop, $id_product, $id_product_attribute, $id_country, $id_state, $zipcode, $id_currency,
		$id_group, $quantity, $use_tax, $decimals, $only_reduc, $use_reduc, $with_ecotax, &$specific_price, $use_group_reduction,
		$id_customer = 0, $use_customer_price = true, $id_cart = 0, $real_quantity = 0)
	{
		static $address = null;
		static $context = null;

		if ($address === null)
			$address = new Address();
		
		if ($context == null)
			$context = Context::getContext()->cloneContext();

		if ($id_shop !== null && $context->shop->id != (int)$id_shop)
			$context->shop = new Shop((int)$id_shop);
		
		if (!$use_customer_price)
			$id_customer = 0;

		$cache_id = $id_product.'-'.$id_shop.'-'.$id_currency.'-'.$id_country.'-'.$id_state.'-'.$zipcode.'-'.$id_group.
			'-'.$quantity.'-'.(int)$id_product_attribute.'-'.($use_tax?'1':'0').'-'.$decimals.'-'.($only_reduc?'1':'0').
			'-'.($use_reduc?'1':'0').'-'.$with_ecotax.'-'.$id_customer;
	
		// reference parameter is filled before any returns
		$specific_price = SpecificPrice::getSpecificPrice(
			(int)$id_product,
			$id_shop,
			$id_currency,
			$id_country,
			$id_group,
			$quantity,
			$id_product_attribute,
			$id_customer,
			$id_cart,
			$real_quantity
		);

		if (isset(self::$_prices[$cache_id]))
			return self::$_prices[$cache_id];

		// fetch price & attribute price
		$cache_id_2 = $id_product.'-'.$id_shop;
		if (!isset(self::$_pricesLevel2[$cache_id_2]))
		{
			$sql = new DbQuery();
			$sql->select('product_shop.`price`, product_shop.`ecotax`');
			$sql->from('product', 'p');
			$sql->innerJoin('product_shop', 'product_shop', '(product_shop.id_product=p.id_product AND product_shop.id_shop = '.(int)$id_shop.')');
			$sql->where('p.`id_product` = '.(int)$id_product);
			if (Combination::isFeatureActive())
			{
				$sql->select('product_attribute_shop.id_product_attribute, product_attribute_shop.`price` AS attribute_price, product_attribute_shop.default_on');
				$sql->leftJoin('product_attribute', 'pa', 'pa.`id_product` = p.`id_product`');
				$sql->leftJoin('product_attribute_shop', 'product_attribute_shop', '(product_attribute_shop.id_product_attribute = pa.id_product_attribute AND product_attribute_shop.id_shop = '.(int)$id_shop.')');
			}
			else
				$sql->select('0 as id_product_attribute');

			$res = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
			
			foreach ($res as $row)
			{
				$array_tmp = array(
					'price' => $row['price'], 
					'ecotax' => $row['ecotax'],
					'attribute_price' => (isset($row['attribute_price']) ? $row['attribute_price'] : null)
				);
				self::$_pricesLevel2[$cache_id_2][(int)$row['id_product_attribute']] = $array_tmp;
				
				if (isset($row['default_on']) && $row['default_on'] == 1)
					self::$_pricesLevel2[$cache_id_2][0] = $array_tmp;
			}
		}
		if (!isset(self::$_pricesLevel2[$cache_id_2][(int)$id_product_attribute]))
			return;

		$result = self::$_pricesLevel2[$cache_id_2][(int)$id_product_attribute];

		if (!$specific_price || $specific_price['price'] < 0) {
            $cmr = $context->customer;
            if(empty($cmr->id)) {
                $cmr = new Customer((int)Customer::getByAddress((int)Tools::getValue('id_address')));
                Context::getContext()->customer = $cmr;
                $context->customer = $cmr;                
            } 
            
            
            if($cmr->isVIP())
            {
                $vipgrps = $cmr->getVIPgrps();
                $vipgrp = array_shift($vipgrps);
                if(VIPPrices::chk($id_product,$vipgrp)) {
                    $vpp = VIPPrices::get($id_product,$vipgrp);
                    $price = (float)$vpp['z_cena'];
                } else {
                    $price = (float)$result['price'];		                      
                }                    
            } else {
                $price = (float)$result['price'];		                                      
            }
		} else
			$price = (float)$specific_price['price'];
            
		// convert only if the specific price is in the default currency (id_currency = 0)
		if (!$specific_price || !($specific_price['price'] >= 0 && $specific_price['id_currency']))
			$price = Tools::convertPrice($price, $id_currency);

		// Attribute price
		if (is_array($result) && (!$specific_price || !$specific_price['id_product_attribute'] || $specific_price['price'] < 0))
		{
			$attribute_price = Tools::convertPrice($result['attribute_price'] !== null ? (float)$result['attribute_price'] : 0, $id_currency);
			// If you want the default combination, please use NULL value instead
			if ($id_product_attribute !== false)
				$price += $attribute_price;
		}

		// Tax
		$address->id_country = $id_country;
		$address->id_state = $id_state;
		$address->postcode = $zipcode;

		$tax_manager = TaxManagerFactory::getManager($address, Product::getIdTaxRulesGroupByIdProduct((int)$id_product, $context));
		$product_tax_calculator = $tax_manager->getTaxCalculator();        

		// Add Tax
		if ($use_tax)
			$price = $product_tax_calculator->addTaxes($price);
		$price = Tools::ps_round($price, $decimals);

		// Reduction
		$reduc = 0;
		if (($only_reduc || $use_reduc) && $specific_price)
		{
			if ($specific_price['reduction_type'] == 'amount')
			{
				$reduction_amount = $specific_price['reduction'];

				if (!$specific_price['id_currency'])
					$reduction_amount = Tools::convertPrice($reduction_amount, $id_currency);
				$reduc = Tools::ps_round(!$use_tax ? $product_tax_calculator->removeTaxes($reduction_amount) : $reduction_amount, $decimals);
			}
			else
				$reduc = Tools::ps_round($price * $specific_price['reduction'], $decimals);
		}

		if ($only_reduc)
			return $reduc;
		if ($use_reduc)
			$price -= $reduc;

		// Group reduction
		if ($use_group_reduction)
		{
			if ($reduction_from_category = (float)GroupReduction::getValueForProduct($id_product, $id_group))
				$price -= $price * $reduction_from_category;
			else // apply group reduction if there is no group reduction for this category
				$price *= ((100 - Group::getReductionByIdGroup($id_group)) / 100);
		}

		$price = Tools::ps_round($price, $decimals);
		// Eco Tax
		if (($result['ecotax'] || isset($result['attribute_ecotax'])) && $with_ecotax)
		{
			$ecotax = $result['ecotax'];
			if (isset($result['attribute_ecotax']) && $result['attribute_ecotax'] > 0)
				$ecotax = $result['attribute_ecotax'];

			if ($id_currency)
				$ecotax = Tools::convertPrice($ecotax, $id_currency);
			if ($use_tax)
			{
				// reinit the tax manager for ecotax handling
				$tax_manager = TaxManagerFactory::getManager(
					$address,
					(int)Configuration::get('PS_ECOTAX_TAX_RULES_GROUP_ID')
				);
                $tax_manager->test = 1;
				$ecotax_tax_calculator = $tax_manager->getTaxCalculator(1);
				$price += $ecotax_tax_calculator->addTaxes($ecotax);
			}
			else
				$price += $ecotax;
		}
		$price = Tools::ps_round($price, $decimals);
		if ($price < 0)
			$price = 0;

		self::$_prices[$cache_id] = $price;
		return self::$_prices[$cache_id];
	}
    
	/**
	* Admin panel product search
	*
	* @param integer $id_lang Language id
	* @param string $query Search query
	* @return array Matching products
	*/
	public static function searchByName($id_lang, $query, Context $context = null)
	{
		if (!$context)
			$context = Context::getContext();
if(!empty($query)) {
   		$sql = new DbQuery();
		$sql->select('p.`id_product`, pps.`cena_2`, p.`ean13`, p.`price`, p.`wholesale_price`, pl.`name`, p.`active`, p.`reference`, m.`name` AS manufacturer_name, stock.`quantity`, product_shop.advanced_stock_management, p.`customizable`');
		$sql->from('category_product', 'cp');
		$sql->leftJoin('product', 'p', 'p.`id_product` = cp.`id_product`');
		$sql->leftJoin('product_provisions', 'pps', 'p.`id_product` = pps.`id_product`');
		$sql->join(Shop::addSqlAssociation('product', 'p'));
		$sql->leftJoin('product_lang', 'pl', '
			p.`id_product` = pl.`id_product`
			AND pl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang('pl')
		);
		$sql->leftJoin('manufacturer', 'm', 'm.`id_manufacturer` = p.`id_manufacturer`');

		$where = 'pl.`name` LIKE \'%'.pSQL($query).'%\'
		OR p.`reference` LIKE \'%'.pSQL($query).'%\'
		OR p.`ean13` LIKE \'%'.pSQL($query).'%\'
		OR p.`supplier_reference` LIKE \'%'.pSQL($query).'%\'
		OR  p.`id_product` IN (SELECT id_product FROM '._DB_PREFIX_.'product_supplier sp WHERE `product_supplier_reference` LIKE \'%'.pSQL($query).'%\')';
		$sql->groupBy('`id_product`');
		$sql->orderBy('pl.`name` ASC');

		if (Combination::isFeatureActive())
		{
			$sql->leftJoin('product_attribute', 'pa', 'pa.`id_product` = p.`id_product`');
			$sql->join(Shop::addSqlAssociation('product_attribute', 'pa', false));
			$where .= ' OR pa.`reference` LIKE \'%'.pSQL($query).'%\'';
		}
		$sql->where($where);
		$sql->join(Product::sqlStock('p', 'pa', false, $context->shop));

		$result = Db::getInstance()->executeS($sql);
//Tools::fd($result);
		if (!$result)
			return false;

		$results_array = array();
		foreach ($result as $row)
		{
			$row['price_tax_incl'] = Product::getPriceStatic($row['id_product'], true, null, 2);
			$row['price_tax_excl'] = Product::getPriceStatic($row['id_product'], false, null, 2);
			$results_array[] = $row;
		}
		return $results_array;
} else {
   		$sql = new DbQuery();
		$sql->select('p.`id_product`, p.`ean13`, p.`price`, p.`wholesale_price`, pl.`name`, p.`active`, p.`reference`, m.`name` AS manufacturer_name, stock.`quantity`, product_shop.advanced_stock_management, p.`customizable`');
		$sql->from('category_product', 'cp');
		$sql->leftJoin('product', 'p', 'p.`id_product` = cp.`id_product`');
		$sql->join(Shop::addSqlAssociation('product', 'p'));
		$sql->leftJoin('product_lang', 'pl', '
			p.`id_product` = pl.`id_product`
			AND pl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang('pl')
		);
		$sql->leftJoin('manufacturer', 'm', 'm.`id_manufacturer` = p.`id_manufacturer`');

		$where = '';
		$sql->groupBy('`id_product`');
		$sql->orderBy('pl.`name` ASC');

		if (Combination::isFeatureActive())
		{
			$sql->leftJoin('product_attribute', 'pa', 'pa.`id_product` = p.`id_product`');
			$sql->join(Shop::addSqlAssociation('product_attribute', 'pa', false));
//			$where .= ' OR pa.`reference` LIKE \'%'.pSQL($query).'%\'';
		}
		$sql->where($where);
		$sql->join(Product::sqlStock('p', 'pa', false, $context->shop));

		$result = Db::getInstance()->executeS($sql);
//Tools::fd($result);
		if (!$result)
			return false;

		$results_array = array();
		foreach ($result as $row)
		{
			$row['price_tax_incl'] = Product::getPriceStatic($row['id_product'], true, null, 2);
			$row['price_tax_excl'] = Product::getPriceStatic($row['id_product'], false, null, 2);
			$results_array[] = $row;
		}
		return $results_array;
    
}
        
	}
    


}

