<?php

//error_reporting(E_ALL);

include_once dirname(__FILE__).'/../abstract/DataController.php';


class StockUpdateController extends DataController
{

	public function __construct()
	{
	 	$this->table = 'data_import';
		$this->className = 'StockUpdate';

		$this->fields_options = array(
			'general' => array(
				'title' =>	$this->l('Import výdajky'),
                'image' => _PS_ADMIN_IMG_.'../t/AdminImport.gif',                
                'description' => 'Uistite sa že ste pripojený k internetu pre stiahnutie výdajky.',
			'submit' => array(
				'title' => $this->l('Importovať'),
				'class' => 'button',
				'style' => 'display: block'
			)
			)
		);
		
		parent::__construct();
		$this->meta_title = $this->l('Import výdajky').' - '.$this->module->displayName;
		if (!$this->module->active)
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminHome'));
            
        if (!defined('_DROPBOX_BACKUP_DIR_')) {
            if(file_exists('C:\\Users\\Kower')){
                $dumppath = 'C:\\Users\\Kower\\Dropbox\\Backup\\';
            } else if(file_exists('C:\\Users\\admin')){
                $dumppath = 'C:\\Users\\admin\\Dropbox\\Backup\\';
            } else {                
                $dumppath = Configuration::get('DROPBOX_DIR');
                if(empty($dumppath) || !file_exists($dumppath)) {
                    $dumppath = $this->search( 'C:\\Users\\','Dropbox');
                    Configuration::updateValue('DROPBOX_DIR', $dumppath);                                          
                }
                $dumppath .= '\\Backup\\';
            }            
            define('_DROPBOX_BACKUP_DIR_', $dumppath);
        }        

        $lov = $this->getUpdateVersion();
        
        if(!empty($lov)){
            if(_ASTALED_UPDATE_)
                if($lov != $this->last_version)
                    Tools::redirectAdmin($this->context->link->getAdminLink('Update') . "&presmerovanie=1&ver=".$lov);
        } else {
            $this->warnings[] = Tools::displayError('Pravdepodobne nieste pripojený k internetu alebo nastala chyba pri komunikácii s online serverom');            
        }
			
            
	}

    public function xml($file)
    {
        return simplexml_load_string (file_get_contents(_PS_DOWNLOAD_DIR_.$file));             
    }
    
	
	public function postProcess() {
	   
        $field_name = 'zipfile';

		if (Tools::isSubmit('submitOptionsdata_import'))
		{            
            $id = Context::getContext()->employee->id;

            $fname = 'stock_update';        
            try {
                $request = curl_init(_PS_ONLINE_DOWNLOAD_XML_.$fname.'.php');
                curl_setopt($request, CURLOPT_POST, true);
                curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($request, CURLOPT_HEADER, 0); 
                curl_setopt($request, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.0; cs; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3");
                
                $ret = curl_exec($request);
//                var_dump($ret);
                curl_close($request);
            } catch (Exception $e) {
                $this->errors[] = Tools::displayError('Chyba pri sťahovaní informačného súboru o výdajkách zo serveru.');
                return;                                                                        
            }
            
//                var_dump($ret);

            
//            if(file_exists(_PS_DOWNLOAD_DIR_.$fname.'.xml')){
//                $xml = $this->xml($fname.'.xml');
                if(empty($ret)){
                    $this->errors[] = Tools::displayError('Prázdny informačný súbor.');
                    return;                                                    
                }
                
                $xml = simplexml_load_string ($ret);

                if(empty($xml)){
                    $this->errors[] = Tools::displayError('Chybný informačný súbor.');
                    return;                                                    
                }
                
//                var_dump($xml->asXML());
                
                $importujeme = false;
                $oz = 'oz_'.$id;
                $files = $xml->{$oz}->file;

                if(!$importujeme && !empty($files)) {
// ---------------------------------------- Backup DB ------------------------------------------------------------------
                            $dirr = 'mysql5.6.17';
                            $path =  'C:\\wamp\\bin\\mysql\\'.$dirr.'\\bin\\mysql.exe';
                            if(!file_exists($path)){
                                $dirs = scandir("C:\\wamp\\bin\\mysql");
                                foreach($dirs as $d){
                                    if((strpos($d, 'mysql') !== false) && is_dir($d)) {
                                        $dirr = $d;
                                    }
                                }                                    
                            }
                            $mysqldump =  'C:\\wamp\\bin\\mysql\\'.$dirr.'\\bin\\mysqldump.exe';
                            $id_employee = Context::getContext()->employee->id;
// ---------------------------------- Setup dirs in DropBox ------------------------------------------------------------
                            $dumppath = _DROPBOX_BACKUP_DIR_;
                            if(!file_exists($dumppath))
                                mkdir($dumppath);
                            $dbpath = 'Db\\';                                
                            if(!file_exists($dumppath.$dbpath))
                                mkdir($dumppath.$dbpath);
                            $syspath = 'System\\';
                            if(!file_exists($dumppath.$syspath))
                                mkdir($dumppath.$syspath);
                            $syspath = $syspath.'ver_'.$this->last_version.'\\';

                            $disabled = ini_get("disable_functions");
                            if((strpos($disabled,'exec') === false) && (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')){
                                $dumpfile = 'oz_'.$id_employee.'_import_z_'.$this->last_version.'.sql';
                                if(!file_exists($dumppath.$dbpath.$dumpfile)){
                                    $command = $mysqldump." --user="._DB_USER_." --databases "._DB_NAME_." --default-character-set=utf8 --add-drop-table --result-file=".$dumppath.$dbpath.$dumpfile;
                                    exec($command , $out, $return );
                                    $fs2 = filesize($dumppath.$dbpath.$dumpfile);
                                    if(file_exists($dumppath.$dbpath.$dumpfile) && !empty($fs2)){                                
                                        $this->confirmations[] = Tools::displayError('Databáza bola zálohovaná');
                                    } else {
                                        $this->errors[] = Tools::displayError('Databázu sa nepodarilo zálohovať. Import nebude vykonaný.');                                    
                                        $this->errors[] = Tools::displayError('Command: '.$command);                                    
                                        $this->errors[] = Tools::displayError('Out: '.$out);                                    
                                        $this->errors[] = Tools::displayError('Return: '.$return);                                    
                                        $this->unlinkall();
                                        return;                                                                            
                                    }                                    
                                }

                            }
                                
                } // if(!$importujeme) {
                
                
                if(!empty($files))
                    foreach($files as $file){
                        $cislo = $file->cislo;
                        $ver = (int)$file->subor;
                        if($ver > $this->last_version){                                                                                    
                            $importujeme = true;
                            $fname = $id.'_vydajka_'.$ver.'.xls';
                            $alldata = array();
                            $notimp = array();
                            $imported = array();
        
                            try {
                                $size = file_put_contents(_PS_DOWNLOAD_DIR_.$fname, fopen(_PS_ONLINE_DOWNLOAD_STOCK_UPDATES_.$fname, 'r'));
                            } catch (Exception $e) {
                                $this->errors[] = Tools::displayError('Chyba pri sťahovaní výdajky '.$cislo.' zo serveru. ('._PS_ONLINE_DOWNLOAD_STOCK_UPDATES_.$fname.')');
                                return;
                            }
                            if(empty($size)){
                                $this->errors[] = Tools::displayError('Chyba pri sťahovaní výdajky '.$cislo.' zo serveru. ('._PS_ONLINE_DOWNLOAD_STOCK_UPDATES_.$fname.') NULLSIZE');
                                return;                
                            }
        
                            if(file_exists(_PS_DOWNLOAD_DIR_.$fname)){
                                require_once _PS_MODULE_DIR_.$this->module->name.'/classes/excel_reader2.php';
                                $data = new Spreadsheet_Excel_Reader(_PS_DOWNLOAD_DIR_.$fname);
    
                                for($row=24; $row<=$data->rowcount(); $row++) {
            	                   $ean = $data->val($row, 'AB');  // T 
            	                   $ean = str_replace(" ", "", $ean);
                                   $ean = str_replace("'", "", $ean);
				                   $amnt = $data->val($row, 'AG'); // W
//                                   if($ean == '3014260316297')
//                                        var_dump($amnt);
                                   
                                   if(strpos($amnt,",") && strpos($amnt,".")){
            	                       $amnt = str_replace(",", "", $amnt);                                      
            	                       $amnt = str_replace(" ", "", $amnt);
            	                       $amnt = str_replace("'", "", $amnt);                                      
                                   } else {
            	                       $amnt = str_replace(",", ".", $amnt);  
            	                       $amnt = str_replace(" ", "", $amnt);
            	                       $amnt = str_replace("'", "", $amnt);                                      
                                   }

//                                   $amnt = substr($amnt,0,strlen($amnt) - 4);
//            	                   $amnt = str_replace(".000", "", $amnt);
//            	                   $amnt = str_replace(".", "", $amnt);  
//            	                   $amnt = str_replace(",", "", $amnt);  
                                   $amnt = (float)$amnt;
                                   $amnt = (int)$amnt;
                                   
				
				                   if (strlen($ean) > 0 && (int)$ean > 0) {
					                   $product = (int)Db::getInstance()->getValue("SELECT id_product FROM new_product WHERE ean13 = '".$ean."'");
                                       $sav = 0;
                                       $nav = 0;
                                       $prd = null;
					                   if ($product > 0) {
					                        $prd = new Product($product);
				                            $sav = StockAvailable::getQuantityAvailableByProduct($product);
                                            if(empty($sav)){
                                                Db::getInstance()->execute('REPLACE INTO new_stock_available ( id_product, id_product_attribute, id_shop, id_shop_group, quantity, depends_on_stock, out_of_stock)
	                                               SELECT id_product, 0 AS id_product_attribute, 1 AS id_shop, 0 AS id_shop_group, 0 AS quantity, 0 AS depends_on_stock, 2 AS out_of_stock
	                                               FROM new_product WHERE id_product = '.$product);
                                                Db::getInstance()->execute('REPLACE INTO new_warehouse_product_location ( id_product, id_product_attribute, id_warehouse, location)
	                                               SELECT id_product, 0 AS id_product_attribute, 1 AS id_warehouse, "" AS location
                                                   FROM new_product WHERE id_product = '.$product) ;                               
                                            }
                                            $this->context->controller->controller_myaction = 'Action_' . __METHOD__;
					                        $success = StockAvailable::updateQuantity($product,null,$amnt);
                                            unset($this->context->controller->controller_myaction);

                                            if($success === false){
                                              $notimp[] = $ean;
                                            } else {
		                                      $imported[] = $ean;                            
                                            }
                                            $nav = StockAvailable::getQuantityAvailableByProduct($product);                                            
					                   } else $notimp[] = $ean;
                                       
                                       if(empty($alldata[$ean])) {
                                            $alldata[$ean] = (array('amt' => $amnt, 'from' => $sav , 'to' => $nav));
                                            if(!empty($prd))
                                                $alldata[$ean]['name'] = trim($prd->name[$this->context->language->id]); 
                                       } else {                                        
                                            $alldata[$ean]['amt'] += $amnt;
                                            $alldata[$ean]['to'] = $nav;
                                       }
					                   
				                   }
                                }
                            } else {
                                $this->errors[] = Tools::displayError('Chyba pri sťahovaní výdajky '.$cislo.' zo serveru.');
                                return;                
                            }

                            $vydajka = '('.$ver.' - '.date('d. m. Y',$ver).')';
                            if(empty($notimp)){
                                if(!empty($imported)){
                                    $this->confirmations[] = Tools::displayError('Všetky produkty z výdajky '.$cislo.$vydajka.' boli úspešne importované.');
                                    $this->confirmations[] = Tools::displayError('Importované produkty (EAN) ('.count($imported).'ks):');
                                    foreach($imported as $i){
                                        $this->confirmations[] = Tools::displayError($i." - ".$alldata[$i]['name']." - importovaných ".$alldata[$i]['amt']."ks povodne skladom ".$alldata[$i]['from']."ks novy stav skladu ".$alldata[$i]['to']."ks\r\n");
                                    }

                                    $m = Tools::displayError('Oz: ' . Context::getContext()->employee->id . ' - ' . Context::getContext()->employee->lastname . ' ' . Context::getContext()->employee->firstname) . "\r\n";
                                    $m .= Tools::displayError('Všetky produkty z výdajky '.$cislo.$vydajka.' boli úspešne importované.') . "\r\n";
                                    $m .= Tools::displayError('Importované produkty (EAN) ('.count($imported).'ks):') . "\r\n";
                                    
                                    foreach($imported as $i){
                                        $m .= $i." - ".$alldata[$i]['name']." - importovaných ".$alldata[$i]['amt']."ks povodne skladom ".$alldata[$i]['from']."ks novy stav skladu ".$alldata[$i]['to']."ks\r\n";
                                    }
                    
                                    $this->email(_PS_ONLINE_MAIL_, 'Import výdajky '.$cislo.' OK', $m, Context::getContext()->employee->email);                                    
                                    $this->email(Context::getContext()->employee->email, 'Import výdajky '.$cislo.' OK', $m, _PS_ONLINE_MAIL_);                                    
                                                        
                                                                                                
                                } else {
                                    $this->errors[] = Tools::displayError('Výdajka '.$cislo.$vydajka.' bola prázdna alebo poškodená. Nebolo čo importovať.'); 

                                    $m = Tools::displayError('Oz: ' . Context::getContext()->employee->id . ' - ' . Context::getContext()->employee->lastname . ' ' . Context::getContext()->employee->firstname) . "\r\n";
                                    $m .= Tools::displayError('Výdajka '.$cislo.$vydajka.' bola prázdna alebo poškodená. Nebolo čo importovať.') . "\r\n";
                    
                                    $this->email(_PS_ONLINE_MAIL_, 'Neúspešný import výdajky '.$cislo.'', $m, Context::getContext()->employee->email);                    
                                    $this->email(Context::getContext()->employee->email, 'Neúspešný import výdajky '.$cislo.'', $m, _PS_ONLINE_MAIL_);                    
                                }                                        
                            } else {
                                $this->warnings[] = Tools::displayError('Niektoré produkty z výdajky '.$cislo.$vydajka.' neboli importované/nájdené.');
                                $this->warnings[] = Tools::displayError('Neimportované produkty (EAN) ('.count($notimp).'ks):');
                                $this->warnings[] = Tools::displayError(implode(' , ',$notimp));                                                            
                                if(!empty($imported)){
                                    $this->warnings[] = Tools::displayError('Importované produkty (EAN) ('.count($imported).'ks):');
                                    foreach($imported as $i){
                                        $this->warnings[] = Tools::displayError($i." - ".$alldata[$i]['name']." - importovaných ".$alldata[$i]['amt']."ks povodne skladom ".$alldata[$i]['from']."ks novy stav skladu ".$alldata[$i]['to']."ks\r\n");
                                    }
                                }

                    
                                $m = Tools::displayError('Oz: ' . Context::getContext()->employee->id . ' - ' . Context::getContext()->employee->lastname . ' ' . Context::getContext()->employee->firstname) . "\r\n";
                                $m .= Tools::displayError('Niektoré produkty z výdajky '.$cislo.$vydajka.' neboli importované/nájdené.') . "\r\n";
                                $m .= Tools::displayError('Neimportované produkty (EAN) ('.count($notimp).'ks):') . "\r\n";
                                $m .= Tools::displayError(implode(' , ',$notimp)) . "\r\n";
                                if(!empty($imported)){
                                    $m .= "\r\n";
                                    $m .= Tools::displayError('Importované produkty (EAN) ('.count($imported).'ks):');
                                    foreach($imported as $i){
                                        $m .= $i." - ".$alldata[$i]['name']." - importovaných ".$alldata[$i]['amt']."ks povodne skladom ".$alldata[$i]['from']."ks novy stav skladu ".$alldata[$i]['to']."ks\r\n";
                                    }
                                }
                    
                                $this->email(_PS_ONLINE_MAIL_, 'Import výdajky '.$cislo.' s chybami', $m, Context::getContext()->employee->email);                    
                                $this->email(Context::getContext()->employee->email, 'Import výdajky '.$cislo.' s chybami', $m, _PS_ONLINE_MAIL_);                    
                                                                                                                  
                            }
                            Configuration::updateValue('LAST_STOCK_UPDATE', ''.$ver);
                            $this->last_version = $ver;            

                            try {
                                $fname = $oz.'_'.$cislo.'_'.$ver.'.dat';
                                $file = _PS_DOWNLOAD_DIR_.$fname;
                                $data = serialize(array('alldata' => $alldata));
                                $handle = fopen($file,'wb');
                                fwrite($handle, $data); // osetrit error tj nezapisany cely retazec..
                                fclose($handle);                       
                                
                                $request = curl_init(_PS_ONLINE_DOWNLOAD_XML_.'imported_stock_update.php?time='.$ver.'&fname='.$fname);

                                $args = array();
                                $args['data'] = new CurlFile($file, 'application/octet-stream', 'data.dat');

                                // send a file
                                curl_setopt($request, CURLOPT_POST, true);
                                curl_setopt($request, CURLOPT_POSTFIELDS, $args);
                                curl_setopt($request, CURLOPT_HEADER, 0); 
                                curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
                                curl_setopt($request, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.0; cs; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3");
                                
                                
                                $ret = curl_exec($request);
                                curl_close($request);
                                
                                
                            } catch (Exception $e) {
                                $this->warnings[] = Tools::displayError('Chyba pri oznamovaní o importe výdajky.');

                                $m  = Tools::displayError('Import výdajky '.$cislo.' prebehol ale sa nezaznamenal na server.')."\r\n";
                                $m .= Tools::displayError('Na serveri bude figurovať ako nenaimportovaný.')."\r\n";
                    
                                $this->email(_PS_ONLINE_MAIL_, 'Import výdajky '.$cislo.' sa nezaznamenal na server', $m, Context::getContext()->employee->email);                    
                            }


                        } // if($ver > $this->last_version)
                        
                        
                    }                 
                
//                    $ver = (int)$xml->{$oz};
                    if(!$importujeme){
                        $this->errors[] = Tools::displayError('Nenašla sa pre Vás nová výdajka. Vaša posledná výdajka je s dátumom: '.date('d. m. Y',$this->last_version));
                        $this->errors[] = Tools::displayError('Pokus o stiahnutie výdajky z dátumu : '.date('d. m. Y',$ver));
                        return;                    
                    }
                                        
/*                    
            } else {
                    $this->errors[] = Tools::displayError('Chyba pri sťahovaní konfiguračného súboru výdajky zo serveru.');
                    return;                                
            }            
*/            
            
		}

 
    }


function search($where, $what) 
{
    $source = $where;
    $source = str_replace('\\', '/', realpath($source));

    if (is_dir($source) === true)
    {

        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file)
        {
            $file = str_replace('\\', '/', $file);

            // Ignore "." and ".." folders
            if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                continue;

            $file = realpath($file);

            if (is_dir($file) === true)
            {
                $dirs = explode('\\',$file,4);
                
                if($what == $dirs[3]) {
                    return $file;
                }
            }
        }
    }
}

	
}
