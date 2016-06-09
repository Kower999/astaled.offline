<?php

/**
 * @author Kower / VeGaSolutions - http://www.vegasolutions.sk
 * @copyright 2015
 */

include_once dirname(__FILE__).'/../abstract/DataController.php';

class ParovaniePlatiebController extends DataController
{
    
	public function __construct()
	{
//         $this->table = 'order_detail';
//         $this->className = 'Statistika1';
  
        $this->bulk_actions = null;
        $this->lang = false;
        $this->context = Context::getContext();   
        $this->context->link = new Link();                 				

        $this->fields_form = array(
            'legend' => array(       
                'title' => $this->l('Párovanie Platieb'),       
//                'image' => '../img/admin/icon_to_display.gif'   
            ),   
            'input' => array(       
                array(           
                'type' => 'file',
                'name' => 'vypis',
                ),
            ),
            'submit' => array(
                'title' => $this->l('Odoslať'),       
                'class' => 'button'   
            )
        );

        $this->toolbar_btn = null;

        parent::__construct();
                                                     
	}

	public function initContent()
	{
        parent::initContent();
        
        $this->content .= $this->renderForm();
		
		$this->assign('content', $this->content);	
	}

	public function postProcess() {
	   
        $field_name = 'vypis';

		if (!empty($_FILES[$field_name]['tmp_name']))
		{
			$tmp_name = tempnam(_PS_UPLOAD_DIR_, 'PS');
			if (!$tmp_name || !move_uploaded_file($_FILES[$field_name]['tmp_name'], $tmp_name))
				return false;

            $xml = $this->xml($tmp_name);
            

            $m = '';
            unlink($tmp_name);	
/*var_dump($xml);
die();*/
            foreach($xml->BkToCstmrStmt->Stmt->Ntry as $p) {
            	$pa = $p->NtryDtls->TxDtls;
                if(($p->CdtDbtInd == 'CRDT') && ($pa->AddtlTxInf == 'Prijata platba')){
                	$x = $pa->Refs->EndToEndId;
					$x = explode("/", $x);
//					var_dump($x);
//					die();
                    $t = (int)(str_replace("VS", "", $x[1]));
                    $res = Db::getInstance()->executeS('SELECT id_order FROM new_orders WHERE invoice_number = "'.$t.'"');
                    if(!empty($res)){
                        $o = $res[0];
//                        if($o['id_order'] == '525') {
                            $order = new Order($o['id_order']);
                            $suma = (float)(str_replace(',','.',$p->Amt));
                            
                            $order->total_paid_real += $suma;
                            $op = new OrderPayment();
                            $op->order_reference = $order->reference;
                            $op->id_currency = $this->context->currency->id;
                            $op->amount = $suma;
                            $op->payment_method = 'Platba prevodom na účet';
                            $op->conversion_rate = 1;
                            $op->transaction_id = $p->S28_POR_CISLO;
//error_reporting(E_ALL);                            
                            $op->add();
                            
                            if($order->total_paid_real < $order->total_paid_tax_incl){
                                $cs = $order->getCurrentOrderState();
                                switch ($cs->id) {
                                    case 10:
                                        $order->setCurrentState(16,1);
                                        break;
                                    case 4:
                                        $order->setCurrentState(15,1);
                                        break;
                                    case 3:
                                        $order->setCurrentState(14,1);
                                        break;
                                }
                            }

                            if($order->total_paid_real == $order->total_paid_tax_incl){
                                $cs = $order->getCurrentOrderState();
                                switch ($cs->id) {
                                    case 16:
                                    case 10:
                                        $order->setCurrentState(2,1);
                                        break;
                                    case 4:
                                    case 15:
                                        $order->setCurrentState(17,1);
                                        break;
                                    case 3:
                                    case 14:
                                        $order->setCurrentState(12,1);
                                        break;
                                }
                            }

                            $order->update();
                            
                            $this->confirmations[] = Tools::displayError('Spárovaná platba : VS: '.$t.' /  Suma:'.$suma);
                                
                            $m .= Tools::displayError('Spárovaná platba : VS: '.$t.' /  Suma:'.$suma);                                
//                            echo $o['id_order'];
//                            echo '<br />';                            
//                        }
                    } else {
                        $this->errors[] = Tools::displayError('Nespárovaná prijatá platba VS:'.$t);
                        $m .= Tools::displayError('Nespárovaná prijatá platba VS:'.$t);
                    }
                    
                }
            }
            
            
            $this->email(_PS_ONLINE_MAIL_, 'Výsledok párovania platieb', $m, Context::getContext()->employee->email);                    
            
        }

    }                           
 
     public function xml($file)
    {
        return simplexml_load_string (html_entity_decode(file_get_contents($file),ENT_XML1 , "UTF-8"));     
        
    }

            
}

?>
