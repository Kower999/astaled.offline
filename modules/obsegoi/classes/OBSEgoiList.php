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
class OBSEgoiList extends ObjectModel {
	
 	/** @var string fields */
	public $id_egoi;
	public $name;
	public $name_ref;
	public $group;
	public $iso_lang;
	public $subs_num;
	public $id_extra_newsletter_check;
	
	public static $definition = array(
		'table' => 'obsegoi_lists',
		'primary' => 'id_obsegoi_lists',
		'fields' => array(
			'id_egoi' => 	array('type' => self::TYPE_INT, 'required' => false, 'size' => 11),
			'id_extra_newsletter_check' => 	array('type' => self::TYPE_INT, 'required' => false, 'size' => 11),
			'name' => 		array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'required' => true, 'size' => 255),
			'name_ref' => 	array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'required' => false, 'size' => 255),
			'group' =>	 	array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'required' => false, 'size' => 255),
			'iso_lang' =>	array('type' => self::TYPE_STRING, 'validate' => 'isLanguageIsoCode', 'required' => true, 'size' => 2),
			'subs_num' => 	array('type' => self::TYPE_INT, 'required' => false, 'size' => 11),
		),
	);
	
	public function add($autodate = true, $null_values = false)
	{
		if(parent::add($autodate, $null_values))
		{
			if($this->id_egoi > 0)
				return true;
			else {
				//CREATE AT EGOI
				$api = new EgoiAPI();
				if($id = $api->createList($this->name)) {
					$this->id_egoi = $id;
					$this->id_extra_newsletter_check = $api->createExtraField($id, 'Newsletter checked', 'texto');
					
					$api->addCallbacks($id);
					
					return parent::save($null_values, $autodate);
				} else
					return false;
			}
		}
		return false;
	}
	
	public static function getLists($id_lang, $id_shop)
	{
		if(!$id_lang)
			$id_lang = Configuration::get('PS_LANG_DEFAULT');

		$iso_lang =	Language::getIsoById($id_lang);
			
		$sql = 'SELECT l.* FROM `'._DB_PREFIX_.'obsegoi_lists` l, `'._DB_PREFIX_.'obsegoi_lists_shop` ls
				WHERE l.`id_obsegoi_lists` = ls.`id_obsegoi_lists`
				AND l.`iso_lang` = \''.pSQL($iso_lang).'\' AND ls.`id_shop` = '.pSQL($id_shop);
		
		$rq = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
		
		return ($rq);
	}
	
	public static function getList($id_egoi)
	{
					
		$sql = 'SELECT l.* FROM `'._DB_PREFIX_.'obsegoi_lists` l
				WHERE l.`id_egoi` = '.pSQL($id_egoi);
		
		$rq = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
		
		return ($rq);
	}
	
	public static function getShopListIds($id_egoi){
		
		$sql = 'SELECT ls.* FROM `'._DB_PREFIX_.'obsegoi_lists` l, `'._DB_PREFIX_.'obsegoi_lists_shop` ls
				WHERE l.`id_obsegoi_lists` = ls.`id_obsegoi_lists` AND l.`id_egoi` = '.pSQL($id_egoi);
		
		$rq = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
		
		return ($rq);
		
	}
	
	
}