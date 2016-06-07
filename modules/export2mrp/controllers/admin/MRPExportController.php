<?php
/*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class MRPExportController extends ModuleAdminController
{
    public function __construct()
	{
		parent::__construct();
	   
		$this->table = 'export';
        $this->tpl_folder = 'export/';
		$this->bootstrap = true;
	}

	public function initContent()
	{
        include_once dirname(__FILE__).'/../../style.php';
	   
		$this->display = 'edit';
		$this->table = 'export';
		$this->content .= $this->initFormExport();
        $this->initToolbar();

		$this->context->smarty->assign(array(
			'content' => $this->content,
			'url_post' => self::$currentIndex.'&token='.$this->token,			
		));
	}

    public function initFormExport()
    {
		$this->fields_form = array(
			'legend' => array(
				'title' => $this->l('Export faktúr pre MRP'),
				'icon' => 'icon-download'
			),
			'input' => array(
				array(
					'type' => 'date',
					'label' => $this->l('From'),
					'name' => 'date_from',
					'maxlength' => 10,
					'required' => true,
					'hint' => $this->l('Format: 2011-12-31 (inclusive).')
				),
				array(
					'type' => 'date',
					'label' => $this->l('To'),
					'name' => 'date_to',
					'maxlength' => 10,
					'required' => true,
					'hint' => $this->l('Format: 2012-12-31 (inclusive).')
				),
				array(
					'type' => 'checkboxStatuses',
					'label' => $this->l('Statuses:'),
					'name' => 'id_order_state',
					'values' => array(
						'query' => OrderState::getOrderStates($this->context->language->id),
						'id' => 'id_order_state',
						'name' => 'name'
					),
				)
			),
			'submit' => array(
				'title' => $this->l('Export'),
				'id' => 'submitPrint',
                'class' => 'button',
				'icon' => 'process-icon-download-alt'
			)
		);

		$this->fields_value = array(
			'date_from' => date('Y-m-d'),
			'date_to' => date('Y-m-d')
		);

		$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT COUNT( o.id_order ) AS nbOrders, o.current_state as id_order_state
			FROM `'._DB_PREFIX_.'order_invoice` oi
			LEFT JOIN `'._DB_PREFIX_.'orders` o ON  oi.id_order = o.id_order 
			WHERE o.id_shop IN('.implode(', ', Shop::getContextListShopID()).')
			GROUP BY o.current_state
		 ');

		$status_stats = array();
		foreach ($result as $row)
			$status_stats[$row['id_order_state']] = $row['nbOrders'];

		$this->tpl_form_vars = array(
			'statusStats' => $status_stats,
			'style' => ''
		);

		$this->show_toolbar = true;
		$this->show_form_cancel_button = false;
		$this->toolbar_title = $this->l('Export dát pre MRP');
		return parent::renderForm();
                        
    }
  
	public function postProcess()
	{
	   if (Tools::isSubmit('submitAddexport'))
		{	   
        $zip = new ZipArchive();
        $zip_name = _PS_DOWNLOAD_DIR_."Export".time().".zip"; // Zip name
        $r = $zip->open($zip_name,  ZipArchive::CREATE);
        if($r !== true) {
            die('zip error');
            exit();
        }
        $x = 1;
        
        $files = array('adres.txt','FvImp.txt','FvPolImp.txt');
        
        $fhs = array();
        $filles = array('','','');
        foreach($files as $f){
            $fhs[] = fopen(_PS_DOWNLOAD_DIR_.$f,'w');         
        }
        
        
        $dfrom = Tools::getValue('date_from');
        $dto = Tools::getValue('date_to');
        $states = Tools::getValue('id_order_state');

        $orders = Order::getOrdersIdByDate($dfrom,$dto);

		$id_lang = Context::getContext()->language->id;
        
//        var_dump($orders);
        $result = array();
        if(!empty($orders) && !empty($states)){
            foreach($orders as $id_order){
                $o = new Order($id_order);
                if(in_array($o->current_state, $states)){
                    $result[] = $o;
                }
            }
        } elseif (!empty($orders)){
            foreach($orders as $id_order){
                $o = new Order($id_order);
                $result[] = $o;
            }            
        }
        
        $f = true;

        if(!empty($result)){
            foreach($result as $order){
                
/* ------------------- PRODUKTY FAKTURY ----------------------- */                
                $products = $order->getProducts();
                $order->real_invoice_number = sprintf('%-10s',Configuration::get('PS_INVOICE_PREFIX', $id_lang, null, (int)$order->id_shop).sprintf('%06d', $order->invoice_number));
                if(!empty($products)){

                    if($f){
//                        var_dump($order);
//                        echo ($order->invoice_number);
//                        echo '<br/>'.count($products).'<br/>';                        
                    }

                    $pc = 0;
                    foreach($products as $p){

                        $x = (float)$p['unit_price_tax_incl'] - (float)$p['unit_price_tax_excl'];
                        $pc++;
                         
                        $row = $order->real_invoice_number;                 // cislo faktury
                        $row.= stf(50,$p['product_name']);                  // nazov produktu
                                                $row.= 'ks ';                                       // merna jednotka
                        $row.= mfl(10,3,$p['product_quantity']);            // pocet jednotiek polozky faktury
                        $row.= mfl(12,4,$p['product_price']);               // cena za jednotku
                        $row.= mfl(2,0,$p['tax_rate']);                     // sadzba dph
                        $row.= mfl(12,4,$x);                                // hodnota dph za jednotku
                        $row.= mfl(6,2,$p['reduction_percent']);            // percentualna zlava na polozku faktury
                        $row.= mfl(3,0,$pc);                                // poradove cislo riadku poloziek vo fakture
                        $row.= mfl(10,2,0);                                 // cislo karty (ak je tovar ako karta zo skladu)
                        $row.= mfl(10,3,$p['product_weight']);              // hmotnost polozky faktury
                        $row.= stf(2,'T');                                  // kodove oznacenie typu polozky (T-tovar, S-sluzby)
                        fputs($fhs[2],$row."\r\n");
                        $filles[2].=$row."\r\n";
                        $f = false;
                    }

/* postovne a balne */
                    if((float)$order->total_shipping_tax_incl > 0) {
                        $dopravca = new Carrier($order->id_carrier,$id_lang);
                      
                        $x = (float)$order->total_shipping_tax_incl - (float)$order->total_shipping_tax_excl;
                        $pc++;
                         
                        $row = $order->real_invoice_number;                 // cislo faktury
                        $row.= stf(50,'Doprava: '.$dopravca->name);         // nazov produktu
                        $row.= 'ks ';                                       // merna jednotka
                        $row.= mfl(10,3,1);                                 // pocet jednotiek polozky faktury
                        $row.= mfl(12,4,$order->total_shipping_tax_excl);   // cena za jednotku
                        $row.= mfl(2,0,$order->carrier_tax_rate);           // sadzba dph
                        $row.= mfl(12,4,$x);                                // hodnota dph za jednotku
                        $row.= mfl(6,2,0);                                  // percentualna zlava na polozku faktury
                        $row.= mfl(3,0,$pc);                                // poradove cislo riadku poloziek vo fakture
                        $row.= mfl(10,2,0);                                 // cislo karty (ak je tovar ako karta zo skladu)
                        $row.= mfl(10,3,0);                                 // hmotnost polozky faktury
                        $row.= stf(2,'S');                                  // kodove oznacenie typu polozky (T-tovar, S-sluzby)
                        fputs($fhs[2],$row."\r\n");
                        $filles[2].=$row."\r\n";
                        
                    }
                    
                    if((float)$order->total_wrapping_tax_incl > 0){
                      
                        $x = (float)$order->total_wrapping_tax_incl - (float)$order->total_wrapping_tax_excl;
                        $pc++;
                         
                        $row = $order->real_invoice_number;                 // cislo faktury
                        $row.= stf(50,'Balné');         // nazov produktu
                        $row.= 'ks ';                                       // merna jednotka
                        $row.= mfl(10,3,1);                                 // pocet jednotiek polozky faktury
                        $row.= mfl(12,4,$order->total_wrapping_tax_excl);   // cena za jednotku
                        $row.= mfl(2,0,$order->carrier_tax_rate);           // sadzba dph
                        $row.= mfl(12,4,$x);                                // hodnota dph za jednotku
                        $row.= mfl(6,2,0);                                  // percentualna zlava na polozku faktury
                        $row.= mfl(3,0,$pc);                                // poradove cislo riadku poloziek vo fakture
                        $row.= mfl(10,2,0);                                 // cislo karty (ak je tovar ako karta zo skladu)
                        $row.= mfl(10,3,0);                                 // hmotnost polozky faktury
                        $row.= stf(2,'S');                                  // kodove oznacenie typu polozky (T-tovar, S-sluzby)
                        fputs($fhs[2],$row."\r\n");
                        $filles[2].=$row."\r\n";
                                                
                    }

/* ------------------ platby --------------*/
                    $payments = OrderPayment::getByOrderId($order->id);                    

                    
                }
/* koniec produkty faktury */
/* ----------- Adresa fakturacna ------------- */

                $address = new Address($order->id_address_invoice);
                if(empty( $address->id)) $address = new Address($order->id_address_delivery);
                if(!empty($address->id)){
                        $customer = new Customer($address->id_customer);
                        if(empty($address->dni)) {
                            $address->dni = 'Z'.crc32(md5($address->id_customer.$address->firstname.$address->lastname));
//                            var_dump($address->dni);
                        }
//var_dump($customer);
                        if(!empty($address->company))
                            $row = stf(50,$address->company);                           
                        else    
                            $row = stf(50,$address->firstname.' '.$address->lastname);  // nazov firmy 1
                        $row.= stf(12,$address->dni);                                   // ICO
                        $row.= stf(30,$address->firstname.' '.$address->lastname);      // meno majitela firmy (kontaktna osoba)
                        $row.= stf(30,$address->address1);                              // nazov ulice sidla firmy
                        $row.= stf(30,$address->city);                                  // nazov mesta sidla firmy
                        $row.= stf(30,$address->country);                               // nazov statu sidla firmy
                        $row.= stf(30,$address->address2);                              // pouzitie pre poznamku 1
                        $row.= stf(15,$address->postcode);                              // postove smerovacie cislo
                        $row.= stf(17,dic($address->vat_number));                       // cislo DIC
                        $row.= stf(30,$address->phone_mobile);                          // cislo telefonu 1
                        $row.= stf(30,$address->phone);                                 // cislo telefonu 2
                        $row.= stf(30,' ');                                             // cislo telefonu 3
                        $row.= stf(30,' ');                                             // cislo faxu
                        $row.= stf(50,$customer->email);                                // email
                        $row.= stf(30,' ');                                             // nazov (oznacenie) banky	
                        $row.= stf(18,' ');                                             // cislo uctu	
                        $row.= stf(12,' ');                                             // kod banky
                        $row.= stf(1,(empty($address->company)? 'T':'F'));              // priznak ci je fyzicka, alebo pravnicka osoba (F - False T - True)
                        $row.= stf(50,' ');                                             // nazov firmy 2
                        $row.= stf(10,date("d.m.Y", strtotime($customer->date_add)));   // datum zaradenia	
                        $row.= stf(5,' ');                                              // cislo danoveho uradu
                        $row.= stf(34,' ');                                             // cislo danoveho uradu
                        $row.= stf(14,$address->vat_number);                            // cislo IC DPH
                        $row.= mfl(3,0,0);                                              // pocet dni splatnosti faktur
                        $row.= stf(2,'SK');                                             // kodu statu (napr. SK, CZ, BG, DE)
                        $row.= stf(30,' ');                                             // pouzitie pre poznamku 2		
                        $row.= stf(11,' ');                                             // cislo SWIFT kod banky		
                        $row.= stf(17,' ');                                             // cislo EAN kod (sluzi pre EDI komunikaciu)
//                        echo mb_strlen($row,'UTF-8');		
                        fputs($fhs[0],$row."\r\n");   
                        $filles[0].=$row."\r\n";
                                             
                    
/* koniec fakturacnej adresy */
/* ---------------- Faktury --------------- */
                $curr = Currency::getCurrency($order->id_currency);

                $row = stf(1,'F');                                  // oznacovanie druhu (F-faktura, X-predfaktura)                           
                $row.= $order->real_invoice_number;                 // cislo faktury
                $row.= stf(12,$address->dni);                       // ICO odberatela
                $row.= mfl(2,0,10);                                 // typy DPH
                $row.= mfl(12,2,0);                                 // suma zakladu oslobodena od dane
                $row.= mfl(12,2,0);                                 // suma zakladu v znizenej danovej sadzbe
                $row.= mfl(12,2,(float)$order->total_paid_tax_excl);// suma zakladu v zakladnej danovej sadzbe
                $row.= mfl(12,2,0);                                 // suma zakladu mimo dane
                $row.= mfl(12,2,0);                                 // suma dane zo zakladu v znizenej danovej sadzbe
                $row.= mfl(12,2,(float)$order->total_paid_tax_incl
                    - (float)$order->total_paid_tax_excl);          // suma dane zo zakladu v zakladnej danovej sadzbe
                $row.= mfl(12,2,0);                                 // suma zakladu v znizenej danovej sadzbe (pre krajiny mimo EU)
                $row.= mfl(12,2,0);                                 // suma zakladu v zakladnej danovej sadzbe (pre krajiny mimo EU)
                $row.= mfl(12,2,0);                                 // suma dane zo zakladu v znizenej danovej sadzbe (pre krajiny mimo EU)
                $row.= mfl(12,2,0);                                 // suma dane zo zakladu v zakladnej danovej sadzbe (pre krajiny mimo EU)
                $row.= mfl(12,2,(float)$order->total_paid_real);    // suma uhrad
                $row.= stf(10,Configuration::get('PS_DELIVERY_PREFIX', Context::getContext()->language->id).
                    sprintf('%06d', $order->delivery_number));      // cislo dodacieho listu
                $row.= stf(10,date("d.m.Y", strtotime($order->invoice_date)));   // datum vystavenia
                $row.= stf(10,date("d.m.Y", strtotime($order->invoice_date)));   // datum zdanitelneho plnenia
                $row.= stf(10,date("d.m.Y", strtotime($order->date_pay)));       // datum splatnosti
                $row.= stf(10, $order->real_invoice_number);        // variabilny symbol
                $row.= stf(8, Configuration::get('PS_SHOP_KS'));    // konstantny symbol
                $row.= stf(6,' ');                                  // cislo strediska
                $row.= stf(10, $order->payment);                    // slovne vyjadrenie formy uhrady
                $row.= stf(10,' ');                                 // slovne vyjadrenie sposobu uhrady
                $row.= stf(20, $order->reference);                  // cislo objednavky (vystavovanie faktury z objednavky)
                $row.= stf(10,date("d.m.Y", strtotime($order->invoice_date)));   // datum objednavky
                $row.= mfl(1,0,0);                                  // priznak zaradenia na prikaz na uhradu
                $row.= stf(3,$curr['iso_code']);                   // oznacovanie meny (SKK, CZK,...)
                $row.= mfl(6,0,0);                                  // zahranicny kurz
                $row.= mfl(11,4,0);                                 // domaci kurz
                $row.= mfl(3,0,0);                                  // kod platobnej karty
                $row.= stf(20,' ');                                 // cislo platobnej karty
                $row.= stf(2,' ');                                   // (""-Bežný danový doklad;"D"-Daňový dobropis;"T"-Daňový ťarchopis;"UZ"-Uzávierka ERP;"ZF"-Zjednodušená faktúra)
                $row.= stf(10,' ');                                  // cislo predfaktury (ak je faktura vystavovana z predfaktury)
                $row.= stf(15,'  ');                                  // cislo zakazky
                $row.= mfl(12,2,0);                                 // suma celkom v zahranicnej mene
                $row.= mfl(1,0,0);                                  // priznak zauctovania v Uctovnom
                $row.= stf(12,'');                                  // ICO konecneho prijemcu
                $row.= mfl(10,0,0);                                 // identifikacne cislo faktury (prepojenie na automaticke zauctovanie bankovych vypisov)
                $row.= mfl(12,2,0);                                 // suma uhrad v zahranicnej mene
                $row.= mfl(10,3,0);                                 // hmotnost fakturovaneho materialu
                $row.= stf(10,date("d.m.Y", strtotime($order->invoice_date)));   // datum daňovej povinnosti
                $row.= stf(30,' ');                                  // pomocny text v hlavicke faktury
                $row.= stf(30,' ');                                  // pomocny text v hlavicke faktury
                $row.= mfl(12,2,0);                                 // suma zakladu oslobodena od dane prepocitany kurzom DKURZ_ZAHR (vypocet dph pre faktury z EU)
                $row.= mfl(12,2,0);                                 // suma zakladu v znizenej danovej sadzbe prepocitany kurzom DKURZ_ZAHR (vypocet dph pre faktury z EU)
                $row.= mfl(12,2,0);                                 // suma zakladu v zakladnej danovej sadzbe prepocitany kurzom DKURZ_ZAHR (vypocet dph pre faktury z EU)
                $row.= mfl(12,2,0);                                 // suma dane zo zakladu v znizenej danovej sadzbe prepocitany kurzom DKURZ_ZAHR (vypocet dph pre faktury z EU)
                $row.= mfl(12,2,0);                                 // suma dane zo zakladu v zakladnej danovej sadzbe prepocitany kurzom DKURZ_ZAHR (vypocet dph pre faktury z EU)
                $row.= mfl(12,2,0);                                 // suma zakladu mimo dane prepocitany kurzom DKURZ_ZAHR (vypocet dph pre faktury z EU)
                $row.= mfl(6,0,0);                                  // zahranicny kurz (vypocet dph pre faktury z EU)
                $row.= mfl(11,4,0);                                 // domaci kurz (vypocet dph pre faktury z EU)
                $row.= mfl(9,2,0);                                  // hodnota recyklacneho poplatku 

//                echo mb_strlen($row,'UTF-8');


                fputs($fhs[1],$row."\r\n");
                $filles[1].=$row."\r\n";
                                        

/* koniec faktury */
                                
                }                
            }
        }
            
        
        foreach($fhs as $f){
            fclose($f);
        }

        foreach ($files as $key => $file) {            
            $path = _PS_DOWNLOAD_DIR_.$file;
            
            $handle = @fopen($path, "r");
            if ($handle) {
                $x = 0;
                $str = ''; 
                while (($buffer = fgets($handle)) !== false) {
                    $str.= $buffer;
                    $x++;
                }
                $zip->addFromString(basename($path),$filles[$key]/*  $str*/);
//                var_dump($x);
                if (!feof($handle)) {
                    echo "Error: unexpected fgets() fail\n";
                }
                fclose($handle);
            }            
        }
        $zip->close();

        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename='.basename($zip_name));
        header('Content-Length: ' . filesize($zip_name));
        readfile($zip_name);
//        unlink($zip_name);        	   
        }	   
    }
}

function dic($ret){
    return trim(str_replace('sk','',str_replace('SK','',$ret)));
}

function stf($c,$s){
    $str = mb_substr($s, 0, $c);
//    return sprintf("%-$c"."s", iconv("UTF-8", "ISO-8859-2", $str));// ($str,'UTF-8','CP1252'));/*.str_repeat(' ',$c-(mb_strlen(sprintf("%-$c"."s",$str),'UTF-8')))*/;
    $ret = sprintf("%-$c"."s", iconv("UTF-8", "CP1250", $str));// ($str,'UTF-8','CP1252'));/*.str_repeat(' ',$c-(mb_strlen(sprintf("%-$c"."s",$str),'UTF-8')))*/;
    return $ret;
}

function mfl($c,$d,$co){
    return sprintf("%$c"."s",str_replace('.',',',sprintf("%1.$d"."f",$co)));
}

function utf2iso($tekst)
{
        $nowytekst = str_replace("%u0104","\xA1",$tekst);    //Ą
        $nowytekst = str_replace("%u0106","\xC6",$nowytekst);    //Ć
        $nowytekst = str_replace("%u0118","\xCA",$nowytekst);    //Ę
        $nowytekst = str_replace("%u0141","\xA3",$nowytekst);    //Ł
        $nowytekst = str_replace("%u0143","\xD1",$nowytekst);    //Ń
        $nowytekst = str_replace("%u00D3","\xD3",$nowytekst);    //Ó
        $nowytekst = str_replace("%u015A","\xA6",$nowytekst);    //Ś
        $nowytekst = str_replace("%u0179","\xAC",$nowytekst);    //Ź
        $nowytekst = str_replace("%u017B","\xAF",$nowytekst);    //Ż
        
        $nowytekst = str_replace("%u0105","\xB1",$nowytekst);    //ą
        $nowytekst = str_replace("%u0107","\xE6",$nowytekst);    //ć
        $nowytekst = str_replace("%u0119","\xEA",$nowytekst);    //ę
        $nowytekst = str_replace("%u0142","\xB3",$nowytekst);    //ł
        $nowytekst = str_replace("%u0144","\xF1",$nowytekst);    //ń
        $nowytekst = str_replace("%u00D4","\xF3",$nowytekst);    //ó
        $nowytekst = str_replace("%u015B","\xB6",$nowytekst);    //ś
        $nowytekst = str_replace("%u017A","\xBC",$nowytekst);    //ź
        $nowytekst = str_replace("%u017C","\xBF",$nowytekst);    //ż
        
    return ($nowytekst);
}


