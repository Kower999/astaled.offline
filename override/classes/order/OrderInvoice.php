<?php

class OrderInvoice extends OrderInvoiceCore
{
	/**
	 * Get order products
	 *
	 * @return array Products with price, quantity (with taxe and without)
	 */
	public function getProducts($products = false, $selectedProducts = false, $selectedQty = false)
	{
		if (!$products)
			$products = $this->getProductsDetail();

		$order = new Order($this->id_order);
		$customized_datas = Product::getAllCustomizedDatas($order->id_cart);

		$resultArray = array();
		foreach ($products as $key => $row)
		{
			// Change qty if selected
			if ($selectedQty)
			{
				$row['product_quantity'] = 0;
				foreach ($selectedProducts as $key => $id_product)
					if ($row['id_order_detail'] == $id_product)
						$row['product_quantity'] = (int)($selectedQty[$key]);
				if (!$row['product_quantity'])
					continue;
			}

			$this->setProductImageInformations($row);
			$this->setProductCurrentStock($row);
			$this->setProductCustomizedDatas($row, $customized_datas);

			// Add information for virtual product
			if ($row['download_hash'] && !empty($row['download_hash']))
			{
				$row['filename'] = ProductDownload::getFilenameFromIdProduct((int)$row['product_id']);
				// Get the display filename
				$row['display_filename'] = ProductDownload::getFilenameFromFilename($row['filename']);
			}
			
			$row['id_address_delivery'] = $order->id_address_delivery;
			$row['tax_rate'] = Tax::getProductTaxRate($row['product_id'],$order->id_address_invoice);
            
            $address = new Address($order->id_address_invoice);
			$tax_manager = TaxManagerFactory::getManager(
					$address,
					(int)Configuration::get('PS_ECOTAX_TAX_RULES_GROUP_ID')
				);
			$ecotax_tax_calculator = $tax_manager->getTaxCalculator();
            $row['ecotax_wt'] = $ecotax_tax_calculator->addTaxes($row['ecotax']);
            $row['ecotax_total'] = $row['product_quantity'] * $ecotax_tax_calculator->addTaxes($row['ecotax']);
            $row['ecotax_tax'] = $row['ecotax_wt'] - $row['ecotax'];
			/* Stock product */
            $p = new Product((int)$row['product_id']);
            $row['ecotax2'] = $p->ecotax2;
			$resultArray[(int)$row['id_order_detail']] = $row;
		}

		if ($customized_datas)
			Product::addCustomizationPrice($resultArray, $customized_datas);

		return $resultArray;
	}
    
    public function calculate_totals() // toto je iba nacitanie z objednavky prepocitavanie nerobime (zatial)
    {
		$order = new Order($this->id_order);

        $this->total_products = $order->total_products;
        $this->total_products_wt = $order->total_products_wt;

        $this->total_paid_tax_excl = $order->total_paid_tax_excl;
        $this->total_paid_tax_incl = $order->total_paid_tax_incl;        
    }

	public function getEcoTaxTaxesBreakdown()
	{
		$res = Db::getInstance()->executeS('
		SELECT 20.0 as `rate`, SUM(`ecotax` * `product_quantity`) as `ecotax_tax_excl`, SUM(`ecotax` * `product_quantity`) as `ecotax_tax_incl`
		FROM `'._DB_PREFIX_.'order_detail`
		WHERE `id_order` = '.(int)$this->id_order.'
		AND `id_order_invoice` = '.(int)$this->id.'
		GROUP BY `ecotax_tax_rate`'
		);

		if ($res)
			foreach ($res as &$row)
			{
				$row['ecotax_tax_incl'] = Tools::ps_round($row['ecotax_tax_excl'] + ($row['ecotax_tax_excl'] * $row['rate'] / 100), 2);
				$row['ecotax_tax_excl'] = Tools::ps_round($row['ecotax_tax_excl'], 2);
			}
		return $res;
	}

}

