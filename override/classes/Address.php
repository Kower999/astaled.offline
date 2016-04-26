<?php

class Address extends AddressCore
{

	/** @var integer Category id which address belongs to */
	public $id_address_category = null;

	/** @var string Dic (optional) */
	public $dic;

	/** @var string Lat */
	public $lat;

	/** @var string Lng */
	public $lng;
    
	/**
	 * @see ObjectModel::$definition
	 */
	public static $definition = array(
		'table' => 'address',
		'primary' => 'id_address',
		'fields' => array(
			'id_customer' => 		array('type' => self::TYPE_INT, 'validate' => 'isNullOrUnsignedId', 'copy_post' => false),
			'id_manufacturer' => 	array('type' => self::TYPE_INT, 'validate' => 'isNullOrUnsignedId', 'copy_post' => false),
			'id_supplier' => 		array('type' => self::TYPE_INT, 'validate' => 'isNullOrUnsignedId', 'copy_post' => false),
			'id_warehouse' => 		array('type' => self::TYPE_INT, 'validate' => 'isNullOrUnsignedId', 'copy_post' => false),
			'id_country' => 		array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
			'id_state' => 			array('type' => self::TYPE_INT, 'validate' => 'isNullOrUnsignedId'),
			'alias' => 				array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'required' => true, 'size' => 32),
			'company' => 			array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'size' => 64),
			'lastname' => 			array('type' => self::TYPE_STRING, 'validate' => 'isName', 'required' => false, 'size' => 32),
			'firstname' => 			array('type' => self::TYPE_STRING, 'validate' => 'isName', 'required' => false, 'size' => 32),
			'vat_number' =>	 		array('type' => self::TYPE_STRING, 'validate' => 'isGenericName'),
			'address1' => 			array('type' => self::TYPE_STRING, 'validate' => 'isAddress', 'required' => true, 'size' => 128),
			'address2' => 			array('type' => self::TYPE_STRING, 'validate' => 'isAddress', 'size' => 128),
			'postcode' => 			array('type' => self::TYPE_STRING, 'validate' => 'isPostCode', 'size' => 12),
			'city' => 				array('type' => self::TYPE_STRING, 'validate' => 'isCityName', 'required' => true, 'size' => 64),
			'other' => 				array('type' => self::TYPE_STRING, 'validate' => 'isMessage', 'size' => 300),
			'phone' => 				array('type' => self::TYPE_STRING, 'validate' => 'isPhoneNumber', 'size' => 16),
			'phone_mobile' => 		array('type' => self::TYPE_STRING, 'validate' => 'isPhoneNumber', 'size' => 16),
			'dni' => 				array('type' => self::TYPE_STRING, 'validate' => 'isDniLite', 'size' => 16),
			'deleted' => 			array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'copy_post' => false),
			'date_add' => 			array('type' => self::TYPE_DATE, 'validate' => 'isDateFormat', 'copy_post' => false),
			'date_upd' => 			array('type' => self::TYPE_DATE, 'validate' => 'isDateFormat', 'copy_post' => false),
		),
	);
    
	protected $webserviceParameters = array(
		'objectsNodeName' => 'addresses',
/*		'associations' => array(
			'address_categories' => array('resource' => 'address_category'),
		)
*/        
	);
    
    

	public	function __construct($id_address = null, $id_lang = null)
	{
		parent::__construct($id_address);
        
        if($id_address) {
            $r = Db::getInstance()->getValue('SELECT id_address_category FROM '._DB_PREFIX_.'address_category WHERE id_address='.$id_address);
            if(!empty($r)) $this->id_address_category = (int)$r;
            $r = Db::getInstance()->getRow('SELECT dic, lat, lng FROM '._DB_PREFIX_.'address_moredata WHERE id_address='.$id_address);
            if(!empty($r)){
                foreach($r AS $k => $v){
                    if(!empty($v)) $this->{$k} = $v;
                }
            }
        }
	}        
    
    public static function getAddresses(){
            $sql = 'SELECT * FROM `'._DB_PREFIX_.'address`
				ORDER BY `id_address` ASC';                                    
            return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);            
    }  
    
}

