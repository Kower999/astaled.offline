<?php

class AdminPdfController extends AdminPdfControllerCore
{

    public function processGenerateDeliverySlipPDF()
	{
	   
		if (Tools::isSubmit('id_order')) {
		    $id = (int)Tools::getValue('id_order');
            $order = new Order($id);
            $order->setInvoice(true);
            $order->setDelivery();
			$this->generateDeliverySlipPDFByIdOrder($id);
		  
		}
		elseif (Tools::isSubmit('id_order_invoice'))
			$this->generateDeliverySlipPDFByIdOrderInvoice((int)Tools::getValue('id_order_invoice'));
		elseif (Tools::isSubmit('id_delivery'))
		{
			$order = Order::getByDelivery((int)Tools::getValue('id_delivery'));
			$this->generateDeliverySlipPDFByIdOrder((int)$order->id);
		}
		else
			die (Tools::displayError('Missing order ID or invoice order ID'));
	}


}

