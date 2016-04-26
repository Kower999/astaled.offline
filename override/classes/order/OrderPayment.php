<?php

class OrderPayment extends OrderPaymentCore
{
	public function add($autodate = true, $nullValues = false)
	{
	   
		if (parent::add($autodate, $nullValues))
		{
//		  Tools::displayAsDeprecated('OrderPayment(override) add.');
		    $ref = $this->order_reference;
            $orders = Order::getByReference($ref);
            if(!empty($orders))
                foreach($orders as $order){
                    $total_paid_real = (float)$order->total_paid_real;
                    $total = (float)$this->amount + $total_paid_real;
                    $tp = (float)$order->total_paid;
                    $cs = (int)$order->getCurrentState();
//                    echo 'cs=';
//                    var_dump($cs);
//                    echo '<br />';
//                    var_dump($tp);
//                    var_dump($total);
//                    var_dump($order);
                    $ns = 0;
                    if($total < $tp) {
                        switch ($cs) {
                            case 3:
                                $ns = 14;
                                break;
                            case 4:
                                $ns = 15;
                                break;
                            case 10:
                                $ns = 16;
                                break;
                            default: 
                                break;
                        } 
                    } elseif ($total >= $tp) {
                        switch ($cs) {
                            case 3:
                                $ns = 12;
                                break;
                            case 4:
                                $ns = 17;
                                break;
                            case 10:
                                $ns = 2;
                                break;
                            case 14:
                                $ns = 12;
                                break;
                            case 15:
                                $ns = 17;
                                break;
                            case 16:
                                $ns = 2;                                
                                break;
                            default:
                                break;
                        } 
                    }
                    if(!empty($ns))
                        $this->setState($order, $ns);
//                    if(!empty($ns)){
//                        $sql = 'UPDATE `'._DB_PREFIX_.'orders` SET `current_state` = '.$ns.' WHERE id_order = '.$order->id;
//                  		$ret =  Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($sql);
//                        var_dump($order);
//                        var_dump($sql);
//                        var_dump($ret);
//                    }
//                    $cs = (int)$order->getCurrentState();
//                    echo 'ns=';
//                    var_dump($ns);
//                    echo '<br />';
                    
//                    Tools::fd($order);
                } 
			return true;
		}
		return false;
	}
    
    public function setState($order, $ns){
//		  Tools::displayAsDeprecated('OrderPayment(override) setstate.');
        
        $cs = $order->getCurrentOrderState();
        if((int)$cs->id != (int)$ns && (int)$ns > 0)
            $order->setCurrentState($ns,Context::getContext()->employee->id);        
    }

}

