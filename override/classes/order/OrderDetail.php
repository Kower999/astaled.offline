<?php

class OrderDetail extends OrderDetailCore
{
	protected $webserviceParameters = array(
		'fields' => array (
			'id_order' => array(),
			'product_id' => array(),
			'product_attribute_id' => array(),
			'product_quantity_reinjected' => array(),
			'group_reduction' => array(),
			'discount_quantity_applied' => array(),
			'download_hash' => array(),
			'download_deadline' => array()
		),
		'hidden_fields' => array('tax_rate', 'tax_name'),
		'associations' => array(
			'taxes'  => array('resource' => 'tax', 'getter' => 'getWsTaxes', 'setter' => false,
				'fields' => array('id' =>  array(), ),
			),
		));
    
    
    public static function getWsDetails($id_order)
    {
		$query = 'SELECT *
		FROM `'._DB_PREFIX_.'order_detail`
		WHERE id_order = '.(int)$id_order;
		$result = Db::getInstance()->executeS($query);
		return $result;        
    }

    
    public function calculate_totals()
    {
        $this->unit_price_tax_incl = Tools::getPriceWT($this->unit_price_tax_excl);
        $this->total_price_tax_excl = $this->unit_price_tax_excl * $this->product_quantity;         
        $this->total_price_tax_incl = Tools::getPriceWT($this->total_price_tax_excl);
    }
	/**
	 * Set detailed product price to the order detail
	 * @param object $order
	 * @param object $cart
	 * @param array $product
	 */
	public function setDetailPrice($price)
	{
		$this->unit_price_tax_excl = (float)$price;
        $this->calculate_totals();
	}
    
    
/*
    public function delete()
	{
        $order = new Order($this->id_order);
        $ret = parent::delete();
        $order->update();
        return $ret;
    }
*/
}

