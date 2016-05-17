<?php
header('Content-Type: text/xml');

require(dirname(__FILE__).'/config/config.inc.php');

//error_reporting(E_ALL);

if (!class_exists('StockUpdate')) {
    require_once(_PS_MODULE_DIR_.'data/classes/StockUpdate.php');
}

if (!class_exists('ImportovaneVydajky')) {
    require_once(_PS_MODULE_DIR_.'data/classes/ImportovaneVydajky.php');
}

$time = (int)strip_tags(stripslashes($_REQUEST['time']));

if(!empty($time)) {
    $sql = 'UPDATE new_stock_update SET imported = 1 WHERE subor = '.$time;
    Db::getInstance()->execute($sql);        
    
    if(!empty($_FILES)) {
        $file = _PS_DOWNLOAD_DIR_.$_GET['fname'];
        move_uploaded_file($_FILES['data']['tmp_name'], $file);

        $handle = fopen($file,'r');
        if(!empty($handle)) {
            $data = fread($handle, filesize($file));        
            fclose($handle);
            $data = unserialize($data);
            if(is_array($data))
                if(is_array($data['alldata']))
                    $isu = StockUpdate::getBySubor($time);
                    foreach($data['alldata'] as $ean => $item) {
                        
                        $product = (int)Db::getInstance()->getValue("SELECT id_product FROM new_product WHERE ean13 = '".$ean."'");
                        if(!empty($product)) {
                            $iv = new ImportovaneVydajky(); 
                            $iv->id_stock_update = $isu;
                            $iv->ean = $ean;
                            $iv->imported = (int)$item['amt'];
                            $iv->from = (int)$item['from'];
                            $iv->to = (int)$item['to'];
                            $iv->add();                            
                        }
                    }
        }
    }
}

die();
