<?php

class OrderState extends OrderStateCore
{

	public static function getOrderStates($id_lang)
	{
        $ozstatusy = array('3','4','10');
        $status = array();
	   
		$ret =  Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
		SELECT *
		FROM `'._DB_PREFIX_.'order_state` os
		LEFT JOIN `'._DB_PREFIX_.'order_state_lang` osl ON (os.`id_order_state` = osl.`id_order_state` AND osl.`id_lang` = '.(int)$id_lang.')
		WHERE deleted = 0
		ORDER BY `name` ASC');
        
        if (Context::getContext()->employee->isLoggedBack() && (Context::getContext()->employee->id_profile == 5) ) {        	   
            foreach($ret as $status){
                if(in_array($status['id_order_state'], $ozstatusy))
                    $out[] = $status;
            }
        } else {
            $out = $ret;
        }
        
        return $out;
	}

}

