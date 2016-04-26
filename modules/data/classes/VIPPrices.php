<?php

class VIPPrices extends ObjectModel {
	public $id_product;
	public $id_group;
	public $cena_2;
	public $provizia;
    public $z_cena;
	
	public static $definition = array(
		'primary' => 'id_product_vip_prices',
		'table' => 'product_vip_prices',
		'fields' => array(
			'id_product' => 	     array('type' => self::TYPE_INT, 'required' => true, 'size' => 11),
			'id_group' => 	         array('type' => self::TYPE_INT, 'required' => true, 'size' => 11),
			'z_cena' =>	             array('type' => self::TYPE_FLOAT, 'validate' => 'isFloat'),
			'cena_2' =>	             array('type' => self::TYPE_FLOAT, 'validate' => 'isFloat'),
			'provizia' =>	         array('type' => self::TYPE_FLOAT, 'validate' => 'isFloat'),			
		)        
	);

    public function check(){
        if(!empty($this->id_product) && !empty($this->id_group)) {
            $sql = 'SELECT * FROM `'._DB_PREFIX_.'product_vip_prices` WHERE id_product = '.$this->id_product.' AND id_group = '.$this->id_group;
            $ret = Db::getInstance()->getRow($sql);
            return $ret;            
        } else return array('id_product'=>0,'id_group'=>0,'z_cena'=>0,'cena_2'=>0,'provizia'=>0);
    }    

    public static function chk($id_product, $id_group){
        if(!empty($id_product) && !empty($id_group)) {
            $sql = 'SELECT * FROM `'._DB_PREFIX_.'product_vip_prices` WHERE id_product = '.$id_product.' AND id_group = '.$id_group;
            $ret = Db::getInstance()->getRow($sql);
            return !empty($ret);
        } else return array('id_product'=>0,'id_group'=>0,'z_cena'=>0,'cena_2'=>0,'provizia'=>0);
    }    
    
    public static function get($id_product, $id_group){
        if(!empty($id_product) && !empty($id_group)) {
            $sql = 'SELECT * FROM `'._DB_PREFIX_.'product_vip_prices` WHERE id_product = '.$id_product.' AND id_group = '.$id_group;
            $ret = Db::getInstance()->getRow($sql);
            return $ret;
        } else return array('id_product'=>0,'id_group'=>0,'z_cena'=>0,'cena_2'=>0,'provizia'=>0);        
    }

    public static function getProductsVIPPrices($products, $id_group){
        $out = false;
        $ids = array();
        if(!empty($products)){
            foreach($products as $product){
                if(!empty($product['id_product']))
                    $ids[] = $product['id_product'];
            }            
            $sql = 'SELECT * FROM `'._DB_PREFIX_.'product_vip_prices` WHERE id_product IN (' . implode(',',$ids) . ') AND id_group = '.$id_group;
            $ret = Db::getInstance()->executeS($sql);
            if(!empty($ret)){
                $out = array();
                foreach($ret as $r)
                    $out[$r['id_product']] = $r;
            }
        }
        return $out;
        
    }
    
}
