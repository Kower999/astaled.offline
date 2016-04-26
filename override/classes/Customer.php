<?php
class Customer extends CustomerCore
{
/*
	protected $webserviceParameters = array(
        'objectMethods' => array('add' => 'addWs'),
		'fields' => array(
			'id_default_group' => array('xlink_resource' => 'groups'),
			'newsletter_date_add' => array(),
			'ip_registration_newsletter' => array(),
			'last_passwd_gen' => array('setter' => null),
			'secure_key' => array('setter' => null),
			'deleted' => array(),
			'passwd' => array('setter' => 'setWsPasswd'),
		),
		'associations' => array(
			'groups' => array('resource' => 'group'),
		)
	);    
*/    
    public static $vipgrps;

    public function isVIP(){
        self::getAllVIPgrps();        
        $grps = $this->getGroups();
        $have = false;
        foreach($grps as $grp){
            if(in_array($grp,self::$vipgrps)) $have = true;
        }
        return $have;
    }
    
    public function getVIPgrps(){
        self::getAllVIPgrps();        
        $vipgrps = self::$vipgrps;
        $grps = $this->getGroups();
        return array_intersect($grps,$vipgrps);        
    }
    
    public static function getAllVIPgrps(){
		if (!isset(self::$vipgrps))
		{
			self::$vipgrps = array();            
            $vipgrps = Group::getVIPgroups();
			foreach ($vipgrps as $group)
				self::$vipgrps[] = (int)$group['id_group'];
		}        
    }
    
    public static function getByAddress($id_address){
        $sql = 'SELECT id_customer FROM `'._DB_PREFIX_.'address` WHERE id_address = '.$id_address;
        $ret = Db::getInstance()->getRow($sql);
        return $ret['id_customer'];        
    }

	public function add($autodate = true, $null_values = false)
	{
	   $this->genEmail();
       return parent::add($autodate, $null_values);
    }
    
    public function genEmail()
    {
        if(empty($this->email)){
            $email = strtolower(Tools::passwdGen()."@nomail.com");
            $test = Customer::getCustomersByEmail($email);
            if(empty($test)){
                $this->email = $email;
                return;
            }
            $this->genEmail();
        }
        
    }   
/*    
	public function addWs($autodate = true, $null_values = false)
	{
	   $this->genEmail();
       $this->firstname = 'test';

       $wsi = WebserviceRequestCore::getInstance();
       $objects = $wsi->;
       $thisobj = null;
       
       Validate::isLoadedObject($obj)
        
       $this->date_add = date('Y-m-d H:i:s');

	   $this->date_upd = date('Y-m-d H:i:s');
       
       return parent::add(false, $null_values);
    }
*/    
    
}
