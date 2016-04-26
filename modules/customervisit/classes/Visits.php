<?php

if (!class_exists('Visits')) {
    class Visits extends ObjectModel {
        public $id_address;
        public $visit;
        public $dovod;
	
        public static $definition = array(
            'primary' => 'id_address_visit',
            'table' => 'address_visit',
            'fields' => array(
                'id_address' => 	     array('type' => self::TYPE_INT, 'required' => true, 'size' => 11),
                'visit' =>	             array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
                'dovod' =>	             array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            )        
        );

        protected $webserviceParameters = array(
            'objectsNodeName' => 'visits',
        );      
        
        public static function getAddressVisits($id_address){
            $sql = 'SELECT `id_address_visit`, `id_address`, `visit`, `dovod`
				FROM `'._DB_PREFIX_.'address_visit`
				WHERE id_address = '.$id_address.'
				ORDER BY `id_address_visit` ASC';                        
            
            return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
            
        }  
    }
}