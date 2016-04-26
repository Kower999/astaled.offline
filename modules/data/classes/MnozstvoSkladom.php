<?php

class MnozstvoSkladom extends ObjectModel {
	public $id_product;
	public $id_product_attribute;
	public $id_employee;
	public $quantity;
	
	public static $definition = array(
		'primary' => 'id_mnozstvo_skladom',
		'table' => 'mnozstvo_skladom',
		'fields' => array(
			'id_employee' => 	     array('type' => self::TYPE_INT, 'required' => true, 'size' => 11),
			'id_product' => 	     array('type' => self::TYPE_INT, 'required' => true, 'size' => 11),
			'id_product_attribute'=> array('type' => self::TYPE_INT, 'required' => true, 'size' => 11),
			'quantity' =>     	     array('type' => self::TYPE_INT, 'required' => false, 'size' => 11),
		)        
	);
    
    public static function setQuantity($employee, $id_product, $id_product_attribute, $quantity){
  		$query = '
			         SELECT id_mnozstvo_skladom
			         FROM `'._DB_PREFIX_.'mnozstvo_skladom` 
                     WHERE id_product = '.(int)$id_product.' AND id_product_attribute = '.(int)$id_product_attribute.' AND id_employee = '.$employee;
        $ims = (int)Db::getInstance()->getValue($query);
        if(!empty($ims)){
  		    $query = '
			         UPDATE `'._DB_PREFIX_.'mnozstvo_skladom` SET quantity = '.(int)$quantity.'			           
                     WHERE id_mnozstvo_skladom = '.(int)$ims;
            Db::getInstance()->execute($query);            
        } else {
  		    $query = 'INSERT INTO `'._DB_PREFIX_.'mnozstvo_skladom` (`id_employee`,`id_product`,`id_product_attribute`, `quantity`) VALUES ('.(int)$employee.','.(int)$id_product.','.(int)$id_product_attribute.','.(int)$quantity.')';			           
            Db::getInstance()->execute($query);            
            
        }
        
    }
/*
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
*/    
}
