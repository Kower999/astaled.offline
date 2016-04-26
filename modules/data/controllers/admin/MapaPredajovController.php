<?php

/**
 * @author Kower / VeGaSolutions - http://www.vegasolutions.sk
 * @copyright 2015
 */

include_once dirname(__FILE__).'/../abstract/DataController.php';

class MapaPredajovController extends DataController
{
    
    private $icons = array(
        'blue' => array(
            'file' => "http://maps.google.com/mapfiles/kml/paddle/blu-circle-lv.png",
            'OZ' => 2,
        ),
        'green' => array(
            'file' => "http://maps.google.com/mapfiles/kml/paddle/grn-circle-lv.png",
            'OZ' => 12,
        ),
        'purple' => array(
            'file' => "http://maps.google.com/mapfiles/kml/paddle/purple-circle-lv.png",
            'OZ' => 7,
        ),
        'red' => array(
            'file' => "http://maps.google.com/mapfiles/kml/paddle/red-circle-lv.png",
            'OZ' => 19,
        ),
        'white' => array(
            'file' => "http://maps.google.com/mapfiles/kml/paddle/wht-circle-lv.png",
            'OZ' => 8,
        ),
        'yellow' => array(
            'file' => "http://maps.google.com/mapfiles/kml/paddle/ylw-circle-lv.png",
            'OZ' => 14,
        ),

        'blue2' => array(
            'file' => "http://maps.google.com/mapfiles/kml/paddle/blu-blank-lv.png",
            'OZ' => 20,
        ),
        'green2' => array(
            'file' => "http://maps.google.com/mapfiles/kml/paddle/grn-blank-lv.png",
            'OZ' => 18,
        ),
/*        'white2' => array(
            'file' => "http://maps.google.com/mapfiles/kml/paddle/wht-blank-lv.png",
            'OZ' => null,
        ),
        'yellow2' => array(
            'file' => "http://maps.google.com/mapfiles/kml/paddle/ylw-blank-lv.png",
            'OZ' => null,
        ),
*/        
    );
    
    private $ozcollor = array( 
        2 =>'blue',
        12 =>'green',
        7 =>'purple',
        19 =>'red',
        8 =>'white',
        14 =>'yellow',
        20 =>'blue2',
        18 =>'green2',
    );
        
    
	public function __construct()
	{
        $this->bulk_actions = null;
        $this->lang = false;
        $this->context = Context::getContext();   
        $this->context->link = new Link();                 				
        parent::__construct();                             
	}

    public function setMedia()
    {
        parent::setMedia();
        $this->addJqueryUI('ui.datepicker','base',true);
    }

	public function initContent()
	{

        $where = '';

        $od = Tools::getValue('from');
        $do = Tools::getValue('to');
        
        $predaje = true;
        $navstevy = true;        
        $notfound = array();
        $nf2 = array();
        $positions = array();      
        $empty = array();      	   
        $urls = array();

        $submit = Tools::isSubmit('submit_filter');

        if(Tools::isSubmit('do_adresy')) {
            $rows = Db::getInstance()->executeS('SELECT DISTINCT am.id_address, c.id_employee, am.lat, am.lng, a.company, a.address1, a.city, a.vat_number, a.dni, a.postcode FROM `'._DB_PREFIX_.'orders` o LEFT JOIN `'._DB_PREFIX_.'address_moredata` am ON o.id_address_delivery = am.id_address LEFT JOIN `'._DB_PREFIX_.'customer` c ON o.id_customer = c.id_customer LEFT JOIN `'._DB_PREFIX_.'address` a ON o.id_address_delivery = a.id_address  WHERE am.lat = 0 OR am.lng = 0 OR am.lat = NULL OR am.lng = NULL ');
            $rows2 = Db::getInstance()->executeS('SELECT DISTINCT am.id_address, c.id_employee, am.lat, am.lng, a.company, a.address1, a.city, a.vat_number, a.dni, a.postcode FROM `'._DB_PREFIX_.'address_visit` av LEFT JOIN `'._DB_PREFIX_.'address_moredata` am ON av.id_address = am.id_address LEFT JOIN `'._DB_PREFIX_.'address` a ON av.id_address = a.id_address LEFT JOIN `'._DB_PREFIX_.'customer` c ON a.id_customer = c.id_customer  WHERE am.lat = 0 OR am.lng = 0 OR am.lat = NULL OR am.lng = NULL  ');
            $adds = array();
            foreach($rows as $r) 
                    $adds[$r['id_address']] = $r;

            foreach($rows2 as $r)
                    if(! key_exists($r['id_address'],$adds))
                        $adds[$r['id_address']] = $r;
            
            
$first = true;
$counter=0;
            if(!empty($adds))
                foreach($adds as $r){
                    if(!$first) continue;
                    if($counter>9) $first = false;
                    $region = "Slovakia"; 
                    $address = $r['address1'].',+'.$r['postcode'].'+'.$r['city'].',+'.$region;
                    $address = str_replace(' ','+',$address);
                    $url = "https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$region&key=AIzaSyDegmZOHh6GwFBlemlYk_vJhGHiNduMVew";
                    $urls[] = $url;
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($ch, CURLOPT_VERBOSE, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    $response = curl_exec($ch);
                    
                    $err = curl_error($ch);
                    
                    curl_close($ch);
                    
                    $response_a = json_decode($response);
                    
                    if($response_a->status == 'OK'){
                        $lat = $response_a->results[0]->geometry->location->lat;
                        $lng = $response_a->results[0]->geometry->location->lng;
                        Db::getInstance()->execute('UPDATE '._DB_PREFIX_.'address_moredata SET `lat` = '.$lat.', `lng` = '.$lng.' WHERE `id_address` = '.$r['id_address']);                    
                    } else {
                        if(! in_array($r['id_address'], $notfound))
                            $notfound[] = $r['id_address'];
                        
                        if(!key_exists($r['id_address'], $nf2)){
                            $nf2[$r['id_address']] = array(
                                'search' => $address,
                                'curl_error' => $err,
                                'status' => $response_a->status,
                                'response' => $response_a,
                                
                             );
                        }
                        
                    }
                                                             
                }
            
        }
        if(Tools::isSubmit('submit_filter')) {
            $predaje = (bool)Tools::getValue('sells');
            $navstevy = (bool)Tools::getValue('visits');
            if(!empty($od)) {
                $where .= ' AND o.date_add >= "'.$od.'"';            
                $where2 .= ' AND av.visit >= "'.$od.'"';            
            }	   
            if(!empty($do)) {
                $where .= ' AND o.date_add <= "'.$do.'"';            
                $where2 .= ' AND av.visit <= "'.$do.'"';            
            }	   
        }

       
        $rows = Db::getInstance()->executeS('SELECT DISTINCT am.id_address, c.id_employee, am.lat, am.lng, a.company, a.address1, a.city, a.vat_number, a.dni, a.postcode, a.phone_mobile, a.phone, c.email FROM `'._DB_PREFIX_.'orders` o LEFT JOIN `'._DB_PREFIX_.'address_moredata` am ON o.id_address_delivery = am.id_address LEFT JOIN `'._DB_PREFIX_.'customer` c ON o.id_customer = c.id_customer LEFT JOIN `'._DB_PREFIX_.'address` a ON o.id_address_delivery = a.id_address  WHERE 1 '.$where.' ORDER BY c.id_customer');

        $adds = array();
        if($predaje)
            foreach($rows as $r) 
                $adds[$r['id_address']] = $r;

        $rows = Db::getInstance()->executeS('SELECT DISTINCT am.id_address, c.id_employee, am.lat, am.lng, a.company, a.address1, a.city, a.vat_number, a.dni, a.postcode, a.phone_mobile, a.phone, c.email FROM `'._DB_PREFIX_.'address_visit` av LEFT JOIN `'._DB_PREFIX_.'address_moredata` am ON av.id_address = am.id_address LEFT JOIN `'._DB_PREFIX_.'address` a ON av.id_address = a.id_address LEFT JOIN `'._DB_PREFIX_.'customer` c ON a.id_customer = c.id_customer  WHERE 1 '.$where2.' ORDER BY c.id_customer');

        if($navstevy)
            foreach($rows as $r)
                if(! key_exists($r['id_address'],$adds))
                    $adds[$r['id_address']] = $r;

        if(!empty($adds))
            foreach($adds as $r)
            {
                if(! key_exists($r['id_address'],$positions)) {
                    $obj = new stdClass();
                    $obj->lat = (float)$r['lat'];
                    $obj->lng = (float)$r['lng'];  
                    $obj->oz = (int)$r['id_employee'];
                    $obj->id = $r['id_address'];


                    $region = "Slovakia"; 
                    $address = $r['address1'].',+'.$r['postcode'].'+'.$r['city'].',+'.$region;
                    $address = str_replace(' ','+',$address);
                    $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$region";
                      
                    $obj->search = $address;
                    if($obj->lat == 0 || $obj->lng == 0){
                        if(!empty($r['id_address']))
                            $empty[$r['id_address']] = $obj;
                    } else {
                        if(! key_exists($obj->oz,$this->ozcollor)) {
                            $done = false;
                            foreach($this->icons as $key => $icon){
                                if($icon['OZ'] == null && !$done) {
                                    $this->icons[$key]['OZ'] = $obj->oz;
                                    $this->ozcollor[$obj->oz] = $key;
                                    $done = true;
                                } 
                            }
                        }
                        $obj->color = $this->icons[$this->ozcollor[$obj->oz]]['file'];
                        $obj->text = $r['company'] . '<br />' . $r['address1'] . '<br />' . $r['city'] . '<br />' . $r['vat_number'] . '<br />' . $r['dni'] . '<br />' . $r['email'] . '<br />' . (empty($r['phone_mobile']) ? $r['phone'] : $r['phone_mobile'] ) ;                         
                        $obj->firma = $r['company'];                         
                        $positions[$r['id_address']] = $obj;                                                        
                    }
                } 
            }            
        ob_start();

//echo 'SELECT DISTINCT am.id_address, c.id_employee, am.lat, am.lng, a.company, a.address1, a.city, a.vat_number, a.dni FROM `'._DB_PREFIX_.'orders` o LEFT JOIN `'._DB_PREFIX_.'address_moredata` am ON o.id_address_delivery = am.id_address LEFT JOIN `'._DB_PREFIX_.'customer` c ON o.id_customer = c.id_customer LEFT JOIN `'._DB_PREFIX_.'address` a ON o.id_address_delivery = a.id_address  WHERE 1 '.$where;                
?>
<script type="text/javascript">
    var adds = <?php echo json_encode($adds); ?>;
    var empty = <?php echo json_encode($empty); ?>;
    var positions = <?php echo json_encode($positions); ?>;
    var icons = <?php echo json_encode($this->icons); ?>;
    var ozcollors = <?php echo json_encode($this->ozcollor); ?>;
</script>
<style type="text/css">
    #map { width: 100%; height: 600px; border: 0px; padding: 0px; }
    .row { width: 100%; display: table; background: none; }
    .col20 { width: 20%; float: left; }
    .col40 { width: 40%; float: left; }
    .col60 { width: 60%; float: left; }
    .col80 { width: 80%; float: left; }
    .col100 { width: 100%; float: none; }
    .row label { width: 125px; }
    .viss { font-weight: bold; }
</style>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3"></script>
<script type="text/javascript" src="/modules/data/js/script.js"></script>

<form method="POST">

<div class="row">
    <div class="col20">
<?php
    $ret = Db::getInstance()->executeS('SELECT * FROM `'._DB_PREFIX_.'employee`');

    $ozs = array();

    foreach($ret as $oz)
        $ozs[$oz['id_employee']] = $oz;
    
    foreach($this->icons as $icon){
?>
        <p><img src="<?php echo $icon['file'];?>" />&nbsp;<span class="viss" style="cursor: pointer;" id="<?php echo $icon['OZ']; ?>" onclick="toggleoz(this);"><?php if(!empty($icon['OZ'])) echo $ozs[$icon['OZ']]['firstname'].' '.$ozs[$icon['OZ']]['lastname'];?></span></p>
<?php        
    }
    
    
$month_ini = new DateTime("first day of last month");
$month_end = new DateTime("last day of last month");

$from = $month_ini->format('Y-m-d'); // 2012-02-01
$to = $month_end->format('Y-m-d'); // 2012-02-29
    
?>
    </div>
    <div class="col20">
        <p>
            <label for="od">Od:</label>
            <input type="text" size="20" class="datepicker" name="from" value="<?php echo (empty($od)) ? $from : $od ?>" id="od" />
        </p>
        <p>
            <label for="do">Do:</label>
            <input type="text" size="20" class="datepicker" name="to" value="<?php echo (empty($do)) ? $to : $do ?>" id="do" />
        </p>
        <p>
            <label for="sells">Predaje:</label>
            <input type="checkbox" name="sells" value="1" <?php echo ($submit) ? (($predaje)? 'checked="checked"' : '') : 'checked="checked"'; ?> id="sells" />
        </p>
        <p>
            <label for="visits">Návštevy:</label>
            <input type="checkbox" name="visits" value="1" <?php echo ($submit) ? (($navstevy)? 'checked="checked"' : '') : 'checked="checked"'; ?> id="visits" />
        </p>

        <p><label>&nbsp;</label><input type="submit" name="submit_filter" value="Filtrovať" /></p>
        <p><label>Ok adresy:</label><?php echo count($positions); ?></p>
        <p><label>Adresy bez suradnic:</label><?php echo count($empty); ?></p>
        <p><label>&nbsp;</label><input type="submit" name="do_adresy" value="Dohľadať adresy" /></p>
        <?php if(!empty($notfound)) { ?>
        <p><label>Nenájdené adresy:</label><?php echo count($notfound); ?></p>        
        <p><label>Id adries::</label><?php echo implode(', ',$notfound); ?></p>
<?php
        }
Tools::fd($empty);         
Tools::fd($nf2);         

                        if(!empty($nf2)){
//                        if($response_a->status == 'OVER_QUERY_LIMIT'){
                            $this->errors[] = Tools::displayError('Limit pre vyhľadávanie adries bol prekročený skúste to prosím neskôr.');
                            $this->display = 'edit';
                        }

?>
        
    </div>
</div>
<div class="row">
    <div class="col100">
        <p>&nbsp;</p>
    </div>
</div>
</form>
<div id="map"></div>
<?php                
        $this->content = ob_get_clean();
        ob_end_clean();

		$this->context->smarty->assign(array(
			'content' => $this->content,
		));        
	}       
            
}


?>