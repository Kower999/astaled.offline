<?php

class Cart extends CartCore
{

	protected $webserviceParameters = array(
		'fields' => array(
		'id_address_delivery' => array('required' => false),
		'id_address_invoice' => array('required' => false),
		'id_currency' => array('required' => false),
		'id_customer' => array('required' => false),
		'id_guest' => array('required' => false),
		'id_lang' => array('required' => false),
		),
		'associations' => array(
			'cart_rows' => array('resource' => 'cart_row', 'virtual_entity' => true, 'fields' => array(
				'id_product' => array('required' => true),
				'id_product_attribute' => array('required' => true),
				'quantity' => array('required' => true),
				)
			),
		),
	);

	public function getSummaryDetails($id_lang = null, $refresh = false)
	{
        $return = parent::getSummaryDetails($id_lang,$refresh);
        
		$products = $this->getProducts($refresh);
//		$total_products = $this->getOrderTotal(false, Cart::ONLY_PRODUCTS);
        $total_provisions = 0;
        
        $products = $return['products'];
        
        $cmr = Context::getContext()->customer;
        if(empty($cmr->id)) {
            $cmr = new Customer((int)Customer::getByAddress((int)Tools::getValue('id_address')));
            Context::getContext()->customer = $cmr;                
        } 
        $disabled = array();
        if($cmr->isVIP()){
            $vipgrps = $cmr->getVIPgrps();
            $vipgrp = array_shift($vipgrps);
                            
            foreach ($products as &$product){
                    if(VIPPrices::chk($product['id_product'],$vipgrp)) {
                        $vpp = VIPPrices::get($product['id_product'],$vipgrp);
                        $product['cena_2'] = (float)$vpp['cena_2'];
//                        $product['price'] = (float)$vpp['z_cena'];
                        $product['z_cena'] = (float)$vpp['z_cena'];
                        $product['provizia'] = (float)$vpp['provizia'];                        
                    } else {
                        $disabled[] = $product['id_product'];
                    }                    
            }                
        } else {
            foreach ($products as &$product){
                $product['z_cena'] = $product['price'];
            }                
        }
//        Tools::fd($products);
        

// -------------------------- kower        
        if(!empty($products))
            $total_provisions = Tools::TotalProvisions($products);
// ------------------------------------		
        $return['total_provisions'] = $total_provisions;

        
        $return['products'] = $products;
        $return['total_products_wt'] = Tools::getPriceWT($return['total_products']);
        $return['total_price'] = Tools::getPriceWT($return['total_price_without_tax']);

        return $return;
    }


	/**
	 * Return cart products
	 *
	 * @result array Products
	 */
	public function getProducts($refresh = false, $id_product = false, $id_country = null)
	{
		if (!$this->id)
			return array();
		// Product cache must be strictly compared to NULL, or else an empty cart will add dozens of queries
		if ($this->_products !== null && !$refresh)
		{
			// Return product row with specified ID if it exists
			if (is_int($id_product))
			{
				foreach ($this->_products as $product)
					if ($product['id_product'] == $id_product)
						return array($product);
				return array();
			}
			return $this->_products;
		}

		// Build query
		$sql = new DbQuery();

		// Build SELECT
		$sql->select('cp.`id_product_attribute`, cp.`id_product`, cp.`quantity` AS cart_quantity, cp.id_shop, pl.`name`, p.`is_virtual`,
						pl.`description_short`, pl.`available_now`, pl.`available_later`, p.`id_product`, product_shop.`id_category_default`, p.`id_supplier`,
						p.`id_manufacturer`, product_shop.`on_sale`, product_shop.`ecotax`, product_shop.`additional_shipping_cost`, product_shop.`available_for_order`, product_shop.`price`, p.`weight`,
						stock.`quantity` quantity_available, p.`width`, p.`height`, p.`depth`, stock.`out_of_stock`, product_shop.`active`, p.`date_add`,
						p.`date_upd`, IFNULL(stock.quantity, 0) as quantity, pl.`link_rewrite`, cl.`link_rewrite` AS category,
						CONCAT(cp.`id_product`, cp.`id_product_attribute`, cp.`id_address_delivery`) AS unique_id, cp.id_address_delivery,
						product_shop.`wholesale_price`, product_shop.advanced_stock_management');

		// Build FROM
		$sql->from('cart_product', 'cp');

		// Build JOIN
		$sql->leftJoin('product', 'p', 'p.`id_product` = cp.`id_product`');
		$sql->innerJoin('product_shop', 'product_shop', '(product_shop.id_shop=cp.id_shop AND product_shop.id_product = p.id_product)');
		$sql->leftJoin('product_lang', 'pl', '
			p.`id_product` = pl.`id_product`
			AND pl.`id_lang` = '.(int)$this->id_lang.Shop::addSqlRestrictionOnLang('pl', 'cp.id_shop')
		);
		

		$sql->leftJoin('category_lang', 'cl', '
			product_shop.`id_category_default` = cl.`id_category`
			AND cl.`id_lang` = '.(int)$this->id_lang.Shop::addSqlRestrictionOnLang('cl', 'cp.id_shop')
		);

		// @todo test if everything is ok, then refactorise call of this method
		$sql->join(Product::sqlStock('cp', 'cp'));

		// Build WHERE clauses
		$sql->where('cp.`id_cart` = '.(int)$this->id);
		if ($id_product)
			$sql->where('cp.`id_product` = '.(int)$id_product);
		$sql->where('p.`id_product` IS NOT NULL');

		// Build GROUP BY
		$sql->groupBy('unique_id');

		// Build ORDER BY
		$sql->orderBy('p.id_product, cp.id_product_attribute, cp.date_add ASC');

		if (Customization::isFeatureActive())
		{
			$sql->select('cu.`id_customization`, cu.`quantity` AS customization_quantity');
			$sql->leftJoin('customization', 'cu',
				'p.`id_product` = cu.`id_product` AND cp.`id_product_attribute` = cu.id_product_attribute AND cu.id_cart='.(int)$this->id);
		}
		else
			$sql->select('NULL AS customization_quantity, NULL AS id_customization');

		if (Combination::isFeatureActive())
		{
			$sql->select('
				product_attribute_shop.`price` AS price_attribute, product_attribute_shop.`ecotax` AS ecotax_attr,
				IF (IFNULL(pa.`reference`, \'\') = \'\', p.`reference`, pa.`reference`) AS reference,
				IF (IFNULL(pa.`supplier_reference`, \'\') = \'\', p.`supplier_reference`, pa.`supplier_reference`) AS supplier_reference,
				(p.`weight`+ pa.`weight`) weight_attribute,
				IF (IFNULL(pa.`ean13`, \'\') = \'\', p.`ean13`, pa.`ean13`) AS ean13,
				IF (IFNULL(pa.`upc`, \'\') = \'\', p.`upc`, pa.`upc`) AS upc,
				pai.`id_image` as pai_id_image, il.`legend` as pai_legend,
				IFNULL(product_attribute_shop.`minimal_quantity`, product_shop.`minimal_quantity`) as minimal_quantity
			');

			$sql->leftJoin('product_attribute', 'pa', 'pa.`id_product_attribute` = cp.`id_product_attribute`');
			$sql->leftJoin('product_attribute_shop', 'product_attribute_shop', '(product_attribute_shop.id_shop=cp.id_shop AND product_attribute_shop.id_product_attribute = pa.id_product_attribute)');
			$sql->leftJoin('product_attribute_image', 'pai', 'pai.`id_product_attribute` = pa.`id_product_attribute`');
			$sql->leftJoin('image_lang', 'il', 'il.id_image = pai.id_image AND il.id_lang = '.(int)$this->id_lang);
		}
		else
			$sql->select(
				'p.`reference` AS reference, p.`supplier_reference` AS supplier_reference, p.`ean13`,
				p.`upc` AS upc, product_shop.`minimal_quantity` AS minimal_quantity'
			);
		
        $sql->leftJoin('product_provisions', 'pp', 'pp.`id_product` = cp.`id_product`');
		$sql->select('pp.`cena_2`, pp.`provizia`');
        


		$result = Db::getInstance()->executeS($sql);

		// Reset the cache before the following return, or else an empty cart will add dozens of queries
		$products_ids = array();
		$pa_ids = array();
		if ($result)
			foreach ($result as $row)
			{
				$products_ids[] = $row['id_product'];
				$pa_ids[] = $row['id_product_attribute'];
			}
		// Thus you can avoid one query per product, because there will be only one query for all the products of the cart
		Product::cacheProductsFeatures($products_ids);
		Cart::cacheSomeAttributesLists($pa_ids, $this->id_lang);

		$this->_products = array();
		if (empty($result))
			return array();

		$cart_shop_context = Context::getContext()->cloneContext();
		foreach ($result as &$row)
		{
			if (isset($row['ecotax_attr']) && $row['ecotax_attr'] > 0)
				$row['ecotax'] = (float)$row['ecotax_attr'];

			$row['stock_quantity'] = (int)$row['quantity'];
			// for compatibility with 1.2 themes
			$row['quantity'] = (int)$row['cart_quantity'];

			if (isset($row['id_product_attribute']) && (int)$row['id_product_attribute'] && isset($row['weight_attribute']))
				$row['weight'] = (float)$row['weight_attribute'];

			if (Configuration::get('PS_TAX_ADDRESS_TYPE') == 'id_address_invoice')
				$address_id = (int)$this->id_address_invoice;
			else
				$address_id = (int)$row['id_address_delivery'];
			if (!Address::addressExists($address_id))
				$address_id = null;

			if ($cart_shop_context->shop->id != $row['id_shop'])
				$cart_shop_context->shop = new Shop((int)$row['id_shop']);

			if ($this->_taxCalculationMethod == PS_TAX_EXC)
			{
				$row['price'] = Product::getPriceStatic(
					(int)$row['id_product'],
					false,
					isset($row['id_product_attribute']) ? (int)$row['id_product_attribute'] : null,
					2,
					null,
					false,
					true,
					(int)$row['cart_quantity'],
					false,
					((int)$this->id_customer ? (int)$this->id_customer : null),
					(int)$this->id,
					((int)$address_id ? (int)$address_id : null),
					$specific_price_output,
					true,
					true,
					$cart_shop_context
				); // Here taxes are computed only once the quantity has been applied to the product price

				$row['price_wt'] = Product::getPriceStatic(
					(int)$row['id_product'],
					true,
					isset($row['id_product_attribute']) ? (int)$row['id_product_attribute'] : null,
					2,
					null,
					false,
					true,
					(int)$row['cart_quantity'],
					false,
					((int)$this->id_customer ? (int)$this->id_customer : null),
					(int)$this->id,
					((int)$address_id ? (int)$address_id : null),
					$null,
					true,
					true,
					$cart_shop_context
				);

				$tax_rate = Tax::getProductTaxRate((int)$row['id_product'], (int)$address_id);

				$row['total_wt'] = Tools::ps_round($row['price'] * (float)$row['cart_quantity'] * (1 + (float)$tax_rate / 100), 2);
				$row['total'] = $row['price'] * (int)$row['cart_quantity'];
			}
			else
			{
				$row['price'] = Product::getPriceStatic(
					(int)$row['id_product'],
					false,
					(int)$row['id_product_attribute'],
					2,
					null,
					false,
					true,
					$row['cart_quantity'],
					false,
					((int)$this->id_customer ? (int)$this->id_customer : null),
					(int)$this->id,
					((int)$address_id ? (int)$address_id : null),
					$specific_price_output,
					true,
					true,
					$cart_shop_context
				);

				$row['price_wt'] = Product::getPriceStatic(
					(int)$row['id_product'],
					true,
					(int)$row['id_product_attribute'],
					2,
					null,
					false,
					true,
					$row['cart_quantity'],
					false,
					((int)$this->id_customer ? (int)$this->id_customer : null),
					(int)$this->id,
					((int)$address_id ? (int)$address_id : null),
					$null,
					true,
					true,
					$cart_shop_context
				);
				
				// In case when you use QuantityDiscount, getPriceStatic() can be return more of 2 decimals
				$row['price_wt'] = Tools::ps_round($row['price_wt'], 2);
				$row['total_wt'] = $row['price_wt'] * (int)$row['cart_quantity'];
				$row['total'] = Tools::ps_round($row['price'] * (int)$row['cart_quantity'], 2);
			}

			if (!isset($row['pai_id_image']) || $row['pai_id_image'] == 0)
			{
				$row2 = Db::getInstance()->getRow('
					SELECT image_shop.`id_image` id_image, il.`legend`
					FROM `'._DB_PREFIX_.'image` i'.
					Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1').'
					LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (image_shop.`id_image` = il.`id_image` AND il.`id_lang` = '.(int)$this->id_lang.')
					WHERE i.`id_product` = '.(int)$row['id_product'].' AND image_shop.`cover` = 1'
				);

				if (!$row2)
					$row2 = array('id_image' => false, 'legend' => false);
				else
					$row = array_merge($row, $row2);
			}
			else
			{
				$row['id_image'] = $row['pai_id_image'];
				$row['legend'] = $row['pai_legend'];
			}

			$row['reduction_applies'] = ($specific_price_output && (float)$specific_price_output['reduction']);
			$row['quantity_discount_applies'] = ($specific_price_output && $row['cart_quantity'] >= (int)$specific_price_output['from_quantity']);
			$row['id_image'] = Product::defineProductImage($row, $this->id_lang);
			$row['allow_oosp'] = Product::isAvailableWhenOutOfStock($row['out_of_stock']);
			$row['features'] = Product::getFeaturesStatic((int)$row['id_product']);

			$row['cena_2'] = (float)$row['cena_2'];
			$row['provizia'] = (float)$row['provizia'];


			if (array_key_exists($row['id_product_attribute'].'-'.$this->id_lang, self::$_attributesLists))
				$row = array_merge($row, self::$_attributesLists[$row['id_product_attribute'].'-'.$this->id_lang]);

			$row = Product::getTaxesInformations($row, $cart_shop_context);

			$this->_products[] = $row;
		}

		return $this->_products;
	}

    public static function getCarts($date_from, $date_to, $id_customer = null, $type = null){
		$sql = 'SELECT `id_cart`
				FROM `'._DB_PREFIX_.'cart`
				WHERE DATE_ADD(date_add, INTERVAL -1 DAY) <= \''.pSQL($date_to).'\' AND date_add >= \''.pSQL($date_from).'\'
					'.Shop::addSqlRestriction()
					.($type ? ' AND '.pSQL(strval($type)).'_number != 0' : '')
					.($id_customer ? ' AND id_customer = '.(int)($id_customer) : '');
		return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

/*		$orders = array();
		foreach ($result as $order)
			$orders[] = (int)($order['id_cart']);
		return $orders;
        return Db::getInstance()->executeS("SELECT id_cart FROM `"._DB_PREFIX_."cart`");
*/                
    }       
    
	/**
	* This function returns the total cart amount
	*
	* Possible values for $type:
	* Cart::ONLY_PRODUCTS
	* Cart::ONLY_DISCOUNTS
	* Cart::BOTH
	* Cart::BOTH_WITHOUT_SHIPPING
	* Cart::ONLY_SHIPPING
	* Cart::ONLY_WRAPPING
	* Cart::ONLY_PRODUCTS_WITHOUT_SHIPPING
	* Cart::ONLY_PHYSICAL_PRODUCTS_WITHOUT_SHIPPING
	*
	* @param boolean $withTaxes With or without taxes
	* @param integer $type Total type
	* @param boolean $use_cache Allow using cache of the method CartRule::getContextualValue
	* @return float Order total
	*/
	public function getOrderTotal($with_taxes = true, $type = Cart::BOTH, $products = null, $id_carrier = null, $use_cache = true)
	{
		if (!$this->id)
			return 0;
        
        $order_total = parent::getOrderTotal(false, $type, $products,$id_carrier,$use_cache);
        if($with_taxes){
            $order_total = Tools::getPriceWT($order_total);                                    
        }
//var_dump($order_total);
		return Tools::ps_round((float)$order_total, 2);
	}

	public function getWsCartRows2($id_order)
	{
		$query = '
			SELECT product_id AS id_product, product_attribute_id AS id_product_attribute, product_quantity AS quantity
			FROM `'._DB_PREFIX_.'order_detail`
			WHERE id_order = '.(int)$id_order;
		$result = Db::getInstance()->executeS($query);
		return $result;
	}

        
}

