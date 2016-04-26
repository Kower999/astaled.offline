<?php

/**
 * @author Kower / VeGaSolutions - http://www.vegasolutions.sk
 * @copyright 2015
 */

include_once dirname(__FILE__).'/../abstract/DataController.php';

class OdrobeneController extends DataController
{
    
	public function __construct()
	{
//         $this->table = 'order_detail';
//         $this->className = 'Statistika1';
  
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
        $from = Tools::getValue('od');
        $to = Tools::getValue('do');
        $visits = Tools::getValue('visits');
	   

        $ozlist = Db::getInstance()->executeS("SELECT id_employee FROM new_employee WHERE id_profile = 5");
        if(empty($ozlist)) {
            $this->content .= '<b>Žiadny OZ nenájdený</b>';
		    $this->context->smarty->assign(array(
                'content' => $this->content,
            ));
            return;
        }

        $year = (Tools::isSubmit('rok')) ? Tools::getValue('rok') : date('Y');
        $month = (Tools::isSubmit('mes')) ? Tools::getValue('mes') : date('m');                
        
        $dni = array();
        $lastday = date("t", strtotime(date('Y-m-d')));//'30';
        $od = $year.$month.'01';
        $do = $year.$month.$lastday;
        if(!empty($from)) $od = date("Ymd", strtotime(date($from)));
        if(!empty($to)) $do = date("Ymd", strtotime(date($to)));
        
        foreach($ozlist as $oz){
            $idoz = $oz['id_employee'];
            $faktury = Db::getInstance()->executeS("
                        SELECT DISTINCT CAST(a.invoice_date AS DATE)
                        FROM new_orders a
                        LEFT JOIN new_customer b ON a.id_customer = b.id_customer
                        WHERE b.id_employee = $idoz AND a.invoice_date >= '$od' AND a.invoice_date < '$do'
                        ORDER BY a.invoice_date");
/*            if(!empty($visits))                        
                $navstevy = Db::getInstance()->executeS("
                        SELECT DISTINCT CAST(a.visit AS DATE)
                        FROM new_address_visit a
                        LEFT JOIN new_address b ON b.id_address = a.id_address
                        LEFT JOIN new_customer c ON b.id_customer = c.id_customer
                        WHERE c.id_employee = $idoz AND a.visit >= '$do' AND a.visit < '$do'
                        ORDER BY a.visit");                        
*/                                    
            $dni[$idoz] = count($faktury);
/*
            if(!empty($visits))                        
                if(!empty($navstevy))
                    foreach($navstevy as $n){
                        if(! in_array($n,$faktury)) $dni[$idoz]++; 
                    }
*/                    
        }

        $od = $year.'-'.$month.'-01';
        $do = $year.'-'.$month.'-'.$lastday;

        
        ob_start();     
        
//        var_dump($this->context->link);   
        
?>
<script type="text/javascript" src="/modules/data/js/script.js"></script>

<form>
<input type="hidden" name="controller" value="Odrobene" />
<input type="hidden" name="token" value="<?=Tools::getAdminTokenLite('Odrobene')?>"/>

<p>
    <label for="od">Od:</label>
    <input type="text" name="od" id="od" onchange="$(this).parent().parent().submit();" value="<?php echo (empty($from)) ? $od : $from ?>" class="datepicker"/>
</p>

<p>
    <label for="do">Do:</label>
    <input type="text" name="do" id="do" onchange="$(this).parent().parent().submit();" value="<?php echo (empty($to)) ? $do : $to ?>" class="datepicker"/>
</p>

<!--
<p>
    <label for="visits">Zarátať návštevy:</label>
    <input value="1" type="checkbox" name="visits" id="visits" onchange="$(this).parent().parent().submit();" <?php echo (empty($visits)) ? '' : 'checked="checked"' ?> />
</p>
<p>
    <label for="rok">Rok:</label>
    <input type="text" name="rok" id="rok" onchange="$(this).parent().parent().submit();" value="<?=$year?>"/>
</p>
<p>
    <label for="mes">Mesiac:</label>    
    <select name="mes" id="mes" onchange="$(this).parent().parent().submit();">
        <option value="01"<?=($month=='01')?' selected':''?>>Január</option>
        <option value="02"<?=($month=='02')?' selected':''?>>Február</option>
        <option value="03"<?=($month=='03')?' selected':''?>>Marec</option>
        <option value="04"<?=($month=='04')?' selected':''?>>Apríl</option>
        <option value="05"<?=($month=='05')?' selected':''?>>Máj</option>
        <option value="06"<?=($month=='06')?' selected':''?>>Jún</option>
        <option value="07"<?=($month=='07')?' selected':''?>>Júl</option>
        <option value="08"<?=($month=='08')?' selected':''?>>August</option>
        <option value="09"<?=($month=='09')?' selected':''?>>September</option>
        <option value="10"<?=($month=='10')?' selected':''?>>Október</option>
        <option value="11"<?=($month=='11')?' selected':''?>>November</option>
        <option value="12"<?=($month=='12')?' selected':''?>>December</option>
    </select>
</p>
-->
</form>

<p>&nbsp;</p>

<table>
    <thead>
        <tr>
            <td style="width: 50px;text-align: center;"><b>OZ</b></td>
            <td style="width: 50px;text-align: center;"><b>Dni</b></td>
        </tr>
    </thead>
    <tbody>
<?php
        if(!empty($dni))
            foreach($dni as $oz => $days){
?>
        <tr>
            <td style="text-align: center;"><?=$oz?></td>
            <td style="text-align: center;"><?=$days?></td>
        </tr>
<?php                
            }
?>                
    </tbody>
</table>
<?php                        
        $this->content .= ob_get_contents();
        ob_end_clean();

		$this->context->smarty->assign(array(
			'content' => $this->content,
		));
        
	}
                           
            
}

?>
