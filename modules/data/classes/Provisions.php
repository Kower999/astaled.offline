<?php

class Provisions extends ObjectModel {
	public $id_product;
	public $cena_2;
	public $provizia;
	
	public static $definition = array(
		'primary' => 'id_product_provisions',
		'table' => 'product_provisions',
		'fields' => array(
			'id_product' => 	     array('type' => self::TYPE_INT, 'required' => false, 'size' => 11),
			'cena_2' =>	             array('type' => self::TYPE_FLOAT, 'validate' => 'isFloat'),
			'provizia' =>	         array('type' => self::TYPE_FLOAT, 'validate' => 'isFloat'),			
		)        
	);
    
    static public function getProvisionByIdProduct($id_product){
        $sql = 'SELECT id_product_provisions FROM `'._DB_PREFIX_.'product_provisions` WHERE id_product = '.$id_product;
        $ret = Db::getInstance()->getValue($sql);
        return $ret;
    }

    static public function getByIdProduct($id_product){
        $sql = 'SELECT id_product_provisions, cena_2, provizia FROM `'._DB_PREFIX_.'product_provisions` WHERE id_product = '.$id_product;
        $ret = Db::getInstance()->getRow($sql);
        return $ret;
    }

    static public function calculate($cena2, $prov, $price, $wholesale_price, $cart_quantity){
//        $provizia = (!empty($cena2) && !empty($prov) && ($price >= $cena2)) ? ($price * $prov / 100) : (($price - $wholesale_price) / 2);
/*
Tools::fd($cena2);
Tools::fd($prov);
Tools::fd($price);
Tools::fd($wholesale_price);
Tools::fd($cart_quantity);
*/
        $provizia = (!empty($cena2) && !empty($prov) && ($price >= $cena2)) ? (($price ) * $prov / 100) : (($price - $wholesale_price) / 2);
//        $provizia = (!empty($cena2) && !empty($prov) && ($price >= $cena2)) ? (($price - $wholesale_price) * $prov / 100) : (($price - $wholesale_price) / 2);
        $provizia = $provizia * $cart_quantity;    
        if($provizia < 0) $provizia = $provizia * 2;   
//Tools::fd($provizia);                      
        return $provizia;
    }
    
}
