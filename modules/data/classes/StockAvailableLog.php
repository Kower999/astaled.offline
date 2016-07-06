<?php

class StockAvailableLog extends ObjectModel {
	public $id_employee;
	public $action_name;
    public $action_done_by_id_employee;
    public $action_date;
    public $sa_from;
    public $sa_to;
    public $sa_change;
	public $id_product;
	public $id_product_attribute;
	
	public static $definition = array(
		'primary' => 'id_stock_available_log',
		'table' => 'stock_available_log',
		'fields' => array(
			'id_stock_available_log' =>      array('type' => self::TYPE_INT, 'required' => false, 'size' => 11),
			'id_employee' =>     	         array('type' => self::TYPE_INT, 'required' => false, 'size' => 11),
			'action_name' =>	             array('type' => self::TYPE_STRING, 'required' => false, 'size' => 255),
			'action_done_by_id_employee' =>  array('type' => self::TYPE_INT, 'required' => false, 'size' => 11),
            'action_date' =>                 array('type' => self::TYPE_DATE, 'required' => false),
			'sa_from' =>     	             array('type' => self::TYPE_INT, 'required' => false, 'size' => 11),
			'sa_to' =>     	                 array('type' => self::TYPE_INT, 'required' => false, 'size' => 11),
			'sa_change' =>     	             array('type' => self::TYPE_INT, 'required' => false, 'size' => 11),
			'id_product' =>     	         array('type' => self::TYPE_INT, 'required' => false, 'size' => 11),
			'id_product_attribute' =>     	 array('type' => self::TYPE_INT, 'required' => false, 'size' => 11),
		)        
	);
     
}
