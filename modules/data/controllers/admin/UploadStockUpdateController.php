<?php
include_once dirname(__FILE__).'/../abstract/DataController.php';

class UploadStockUpdateController extends DataController
{
	public function __construct()
	{
	 	$this->table = 'data_import';
		$this->className = 'UploadStockUpdate';
		
		parent::__construct();
		$this->meta_title = $this->l('Import Objednávok').' - '.$this->module->displayName;
		if (!$this->module->active)
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminHome'));
            
        if (!defined('_PS_STOCK_UPDATES_DIR_'))
            define('_PS_STOCK_UPDATES_DIR_',            _PS_DOWNLOAD_DIR_.'updates/stock_updates/');
        
        if(!file_exists(_PS_STOCK_UPDATES_DIR_))
            mkdir(_PS_STOCK_UPDATES_DIR_,0755,true);                        
                    
            
        if(ENT_XML1 != 16) {
	       define('ENT_XML1', 16);            
        }

	}

    public function xml($file)
    {
        return simplexml_load_string (html_entity_decode(file_get_contents(_PS_STOCK_UPDATES_DIR_.$file),ENT_XML1 , "UTF-8"));     
    }    
	
	public function postProcess() {
	   
        $field_name = 'zipfile';

		if (Tools::isSubmit('submitAdddata_import') && isset($_FILES[$field_name]['tmp_name']) && $_FILES[$field_name]['tmp_name'])
		{
            $id_oz = (int)Tools::getValue('id_oz');
            $time = time();
            if(!empty($id_oz)) {
                $tmp_name = _PS_STOCK_UPDATES_DIR_.$id_oz.'_vydajka_'.$time.'.xls';
                if (!$tmp_name || !move_uploaded_file($_FILES[$field_name]['tmp_name'], $tmp_name)){
                    $this->errors[] = Tools::displayError('Chyba pri uploade výdajky na server.');
                    return;                                                    
                }
                
                $test = simplexml_load_string (file_get_contents($tmp_name));
                if($test){
                    $this->errors[] = Tools::displayError('Nesprávny formát výdajky. Správny formát je "excel ole".');
                    unlink($tmp_name);
                    return;                                                                        
                }

                require_once _PS_MODULE_DIR_.$this->module->name.'/classes/excel_reader2.php';
                try {
                    $data = new Spreadsheet_Excel_Reader($tmp_name);
                    $cislo = $data->val(4, 'S');
                    if(strpos($cislo,'Výdajka č. ') === false) {
                        throw new Exception('Použitá nesprávna šablóna výdajky.');
                    } else {
                        $cislo = str_replace('Výdajka č. ','',$cislo);
                    }
                } catch (Exception $e) {
                    $this->errors[] = Tools::displayError('Použitá nesprávna šablóna výdajky.');
                    return;                                                                        
                }
                                
                
                $upd = new StockUpdate();
                $upd->id_employee = $id_oz;
                $upd->subor = $time;//basename($tmp_name);
                
                $upd->cislo = $cislo;
                $upd->imported = 0;
                $upd->add();
                
/*                
                $fname = 'stock_update.xml';
                if(!file_exists(_PS_STOCK_UPDATES_DIR_.$fname)){
                    $xml = new SimpleXmlElement("<xml version=\"1.0\" encoding=\"utf-8\" />");
                    $field = $xml->addChild('oz_'.$id_oz);
                    $sub = $field->addChild('file',''.$time);
                } else {
                    $xml = $this->xml($fname);
                    if(!empty($xml->{'oz_'.$id_oz})) {
                        $sub = $xml->{'oz_'.$id_oz}->addChild('file',''.$time);                                                
                    } else {                        
                        $field = $xml->addChild('oz_'.$id_oz);
                        $sub = $field->addChild('file',''.$time);
//                        $field = $xml->addChild('oz_'.$id_oz,''.$time);
                    }
                }
*/                
    
                $employee = new Employee($id_oz);
                if(!empty($employee)){
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
                    $headers .= 'From: ASTALED <info@astaled.sk>' . "\r\n";
                    
                    $m = 'Dobrý deň.'. "\r\n";
                    $m .= 'Je pre Vás pripravená nová výdajka č.: '.$cislo.' s dátumom: '.date('d. m. Y',$time) . '(' . $id_oz . '_vydajka_' . $time . '.xls)' . "\r\n"; 
                    
                    mail($employee->email, 'Nová výdajka '.date('d. m. Y',$time), $m, $headers);                    
                }
                
//                file_put_contents(_PS_STOCK_UPDATES_DIR_.$fname, $xml->asXML());
            }
		}
    }
	
	public function initContent()
	{
        parent::initContent();
        
        $this->content .= $this->initForm();
		
		$this->assign('content', $this->content);	
	}

    public function initForm()
    {
        $options = Employee::getEmployees();

        $this->fields_form = array(
        'legend' => array(
            'title' => $this->l('Upload výdajky pre OZ'),
            'image' => _PS_ADMIN_IMG_.'../t/AdminStockManagement.gif'
        ),
        
        'input' => array(
            array(
                'type' => 'select',                              // This is a <select> tag.
                'label' => $this->l('Obchodný zástupca:'),
                'name' => 'id_oz',                     // The content of the 'id' attribute of the <select> tag.
                'required' => true,                              // If set to true, this option must be set.
                'options' => array(
                    'query' => $options,                           // $options contains the data itself.
                    'id' => 'id_employee',                           // The value of the 'id' key must be the same as the key for 'value' attribute of the <option> tag in each $options sub-array.
                    'name' => 'lastname'                               // The value of the 'name' key must be the same as the key for the text content of the <option> tag in each $options sub-array.
                )
            ),
            array(
                'type' => 'file',
                'label' => $this->l('Súbor:'),
                'name' => 'zipfile',
                'display_image' => FALSE,
                'required' => TRUE,                
                'desc' => $this->l('Zvoľte súbor výdajky.<br/>Názov súboru nieje dôležitý.<br/>Systém si ho premenuje podľa potreby.')
            ),
            
        ),
    );

    $this->fields_form['submit'] = array(
        'title' => $this->l('Upload'),
        'class' => 'button',
        'icon' => 'process-icon-download-alt'
    );
    $this->toolbar_btn = null;

    return $this->renderForm();
    }

	
}