<?php
 /**
 * 
 *  2011-2013 OBSolutions S.C.P.  
 *  All Rights Reserved.
 * 
 * NOTICE:  All information contained herein is, and remains
 * the property of OBSolutions S.C.P. and its suppliers,
 * if any.  The intellectual and technical concepts contained
 * herein are proprietary to OBSolutions S.C.P.
 * and its suppliers and are protected by trade secret or copyright law.
 * Dissemination of this information or reproduction of this material
 * is strictly forbidden unless prior written permission is obtained
 * from OBSolutions S.C.P.
 */
class OBSEgoiSubscriber extends ObjectModel {
	
 	/** @var string fields */
	public $sub_customer_id;
	public $sub_is_subscribed;
	public $sub_egoi_uid;
	public $sub_list_id;
	public $sub_dateadd;
	
	public static $definition = array(
		'table' => 'obsegoi_subscribers',
		'primary' => 'sub_egoi_uid',
		'fields' => array(
			'sub_customer_id' => 	array('type' => self::TYPE_INT, 'required' => false, 'size' => 11),
			'sub_list_id' => 	array('type' => self::TYPE_INT, 'required' => false, 'size' => 11),
			'sub_egoi_uid' => 			array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'required' => true, 'size' => 32),
			'sub_is_subscribed' => 		array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'required' => true, 'size' => 1),
			'sub_dateadd' => 				array('type' => self::TYPE_DATE, 'validate' => 'isDateFormat'),
			
		),
	);
	
	static public function getCustomersByListId($psListId) {
		$dbQuery = new DbQuery();
		
		$dbQuery->from(self::$definition['table']);
		$dbQuery->innerJoin(Customer::$definition['table'], null, 'sub_customer_id = id_customer');
		$dbQuery->where("sub_list_id = '{$psListId}'");
		
		$query = $dbQuery->build();
		$result = DB::getInstance()->executeS($query);
		
		return $result;
	}
}