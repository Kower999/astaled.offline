<?php

class Tools extends ToolsCore
{
    public static function TotalProvisions($products){
        
		    $classFile = _PS_MODULE_DIR_.'data/classes/Provisions.php';            
		    include_once $classFile;
        
            $total_provisions = 0;
            $cmr = Context::getContext()->customer;
            if(empty($cmr->id)) {
                $cmr = new Customer((int)Customer::getByAddress((int)Tools::getValue('id_address')));
                Context::getContext()->customer = $cmr;                
            } 
            
            if($cmr->isVIP()){
                    $vipgrps = $cmr->getVIPgrps();
                    $vipgrp = array_shift($vipgrps);
            }        
            foreach($products as &$p) {
                if($cmr->isVIP()){
//var_dump($p);                    
                    if(isset($p['id_product'])) {
                        $id = $p['id_product'];
                    } else {
                        $p2 = Tools::getValue('add_product');
                        $id = $p2['product_id'];
                    }
                    if(VIPPrices::chk($id,$vipgrp)) {
                        $vpp = VIPPrices::get($id,$vipgrp);
//                        $p['price'] = (float)$vpp['z_cena'];
                        $p['cena_2'] = (float)$vpp['cena_2'];
                        $p['provizia'] = (float)$vpp['provizia'];
                    }
                }
//                var_dump($p['price']);
//                var_dump($p['cena_2']);
                $provizia = Provisions::calculate($p['cena_2'],$p['provizia'],$p['price'],$p['wholesale_price'],$p['cart_quantity']);                
                $total_provisions += $provizia;
            }
            return $total_provisions;        
    }
    
    
    public static function getTotalWT($total){
        return (float)$total * 1.2; // pozor DPH hardcodovane
    }

    public static function getPriceWT($price){
        return (float)$price * 1.2; // pozor DPH hardcodovane
    }
    
	/**
	 * returns the rounded value of $value to specified precision, according to your configuration;
	 *
	 * @note : PHP 5.3.0 introduce a 3rd parameter mode in round function
	 *
	 * @param float $value
	 * @param int $precision
	 * @return float
	 */
	public static function ps_round($value, $precision = 3)
	{
		static $method = null;
        $precision = 4;

		if ($method == null)
			$method = (int)Configuration::get('PS_PRICE_ROUND_MODE');

		if ($method == PS_ROUND_UP)
			return Tools::ceilf($value, $precision);
		elseif ($method == PS_ROUND_DOWN)
			return Tools::floorf($value, $precision);
		return round($value, $precision);
	}
    
}

