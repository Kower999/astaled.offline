<?php
function test(){
    $orders = Db::getInstance()->executeS('SELECT id_order FROM new_orders');
    if(!empty($orders))
        foreach($orders as $o){
            $order = new Order($o['id_order']);
            $order->checkOrderDetails();
            $order->calctulate_totals();
            $pc = $order->getOrderPaymentCollection();
            if(!empty($pc))
                foreach($pc as $payment){
                    $payment->delete();
                }
            $order->total_paid_real = 0;                
            $order->update();
            if($order->hasInvoice()){
                $ic = $order->getInvoicesCollection();
                if(!empty($ic))
                    foreach($ic as $order_invoice) {
                        $order_invoice->total_paid_tax_excl = $order->total_paid_tax_excl;
                        $order_invoice->total_paid_tax_incl = $order->total_paid_tax_incl;
                        $order_invoice->total_products = $order->total_products;
                        $order_invoice->total_products_wt = $order->total_products_wt;
                        $order_invoice->update();                                                        
                    }
            }
        }                
    $orders = Db::getInstance()->executeS('TRUNCATE new_order_invoice_payment');
    return true;
}