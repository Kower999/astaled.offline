<?php 
require_once(dirname(__FILE__)."/../../classes/phpmailer/class.phpmailer.php");
require_once(dirname(__FILE__)."/../../classes/phpmailer/class.smtp.php");

abstract class DataController extends ModuleAdminController {

    public $last_version;

    public $last_online_version;
	
	protected $errorMessages = '';

    public $isadmin = false;    
	
	public function __construct() {
		parent::__construct();
        if(empty($this->context) && class_exists('Context'))
            $this->context = Context::getContext();   

        if(empty($this->context))
            $this->initContext();

            
        if(empty($this->context->link))
            $this->context->link = new Link();  
            
        $this->last_version = $this->getActualVersion();

        $this->isadmin = (Context::getContext()->employee->isLoggedBack() && !((Context::getContext()->employee->id_profile == 5) || (Context::getContext()->employee->id_profile == 6)));             
                           				
	}

    public static function readxmlfilefromdownloaddir($file)
    {
        return simplexml_load_string (file_get_contents(_PS_DOWNLOAD_DIR_.$file));             
    }
    
    public function getActualVersion()
    {
        $lastver = (float)Configuration::get('LAST_UPDATE_VERSION');
        $fname = 'update_db.xml';        
        if(file_exists(_PS_DOWNLOAD_DIR_.$fname)){
                $xml = DataController::readxmlfilefromdownloaddir($fname);

                if(($lastver < (float)(''.$xml->queries->version)) && ($_REQUEST['controller'] != 'Update')){
                    if(!DataController::isThisOnline()) {
                        die("1");
                        Tools::redirectAdmin($this->context->link->getAdminLink('Update') . "&presmerovanie=1&ver=".$lov);                        
                    } else {
                        die("2");
                        Configuration::updateValue('LAST_UPDATE_VERSION', (empty($this->last_online_version) ? $this->getUpdateVersion() : $this->last_online_version ) );                                                                  
                    }
                }            
        }
            
        return $lastver;                    
    }
    
    public static function isThisOnline()
    {
        return !file_exists(_PS_ROOT_DIR_."/.gitignore");        
    }    
    
    public static function defineDropbox()
    {
        if (!defined('_DROPBOX_BACKUP_DIR_')) {
            if(file_exists('C:\\Users\\Kower')){
                $dumppath = 'C:\\Users\\Kower\\Dropbox\\Backup\\';
            } else if(file_exists('C:\\backup')){
                $dumppath = 'C:\\backup\\Dropbox\\Backup\\';
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
    }
    
    public function needUpdate(){
        if(empty($this->last_online_version)) $this->getUpdateVersion();
    }

    public function getUpdateVersion(){
        $fname = 'update_db.xml';

        
        if(file_exists(_PS_DOWNLOAD_DIR_.$fname))
            unlink(_PS_DOWNLOAD_DIR_.$fname);
            
        file_put_contents(_PS_DOWNLOAD_DIR_.$fname, fopen(_ASTALED_ONLINE_ . '/download/updates/' . $fname, 'r'));
        $fs = filesize(_PS_DOWNLOAD_DIR_.$fname);
        
        if(file_exists(_PS_DOWNLOAD_DIR_.$fname) && !empty($fs)){
            $xml = simplexml_load_string (file_get_contents(_PS_DOWNLOAD_DIR_.$fname));
            $this->last_online_version = ''.$xml->queries->version;
        } else {
            $this->$last_online_version = "";
        }

        unlink(_PS_DOWNLOAD_DIR_.$fname);
        return( $this->last_online_version );
    }

// Retrocompatibility 1.4/1.5
    public function initContext()
    {
        if (class_exists('Context'))
            $this->context = Context::getContext();
        else
        {
            global $smarty, $cookie;
            $this->context = new StdClass();
            $this->context->smarty = $smarty;
            $this->context->cookie = $cookie;
        }
    }	


    public function email($target, $subject, $message, $from)
    {
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        //$mail->SMTPDebug = 2; 
        $mail->isSMTP(); // send via SMTP
        //IsSMTP(); // send via SMTP
        $mail->SMTPAuth = true; // turn on SMTP authentication
        $mail->Username = _ASTALED_SENDER_MAIL_; // SMTP username
        $mail->Password = _ASTALED_SENDER_MAIL_PWD_; // SMTP password
        $webmaster_email = $from; //Reply to this email ID

        $email=$target; // Recipients email ID
        $name="Admin"; // Recipient's name
        $mail->From = $webmaster_email;
        $mail->FromName = _ASTALED_OFFLINE_;
        $mail->AddAddress($email,$name);
        $mail->AddReplyTo($webmaster_email,"Webmaster");
        $mail->WordWrap = 50; // set word wrap
        //$mail->AddAttachment("/var/tmp/file.tar.gz"); // attachment
        //$mail->AddAttachment("/tmp/image.jpg", "new.jpg"); // attachment
        $mail->isHTML(true); // send as HTML
        $mail->Subject = $subject;
        $mail->Body = nl2br($message); //HTML Body
        $mail->AltBody = $message; //Text Body
        //$mail->Send();
        if(!$mail->Send())
        {
            $this->warnings[] = "Nepodarilo sa odoslať notifikačný email.";                                                            
        }    
    }
    
	
	public function fetch($template) {
		return $this->context->smarty->fetch($this->module->getTemplatePath('views/templates/admin/'.$template));
	}
	
	public function assign($key, $value) {
		$this->context->smarty->assign($key, $value);
	}
    
    public function resetquery(){
        $this->_select = '';
        $this->_join = '';
        $this->_filter = '';
        $this->_where = '';
        $this->_group = '';
        $this->_defaultOrderBy = '';                
    }

	/**
	 * @what  = filter
	 * @what2 = tabulka pre getlist
	 * @what3 = tabulka pre orderby a filtre
     * @lang  = viacjazicne nacitanie
     * @toolbar = toolbar button
	 */
    public function renderList2($what,$what2,$what3, $lang = true, $toolbar = null,$order_by = null, $order_way = null)
    {
        $tmp = $this->table;
        $this->table = $what; // 3

        
        // Adds an Edit button for each result
        $this->toolbar_btn = $toolbar;
        $this->lang = $lang;

  		if (!($this->fields_list && is_array($this->fields_list)))
			return false;
            
        if(empty($order_by)) {
            $orderBy = Tools::getValue($what.'Orderby');
        } else {
            $orderBy = $order_by;
        }
        if(empty($order_way)) {
            $orderWay  = Tools::getValue($what.'Orderway');
        } else {
            $orderWay = $order_way;            
        }        
        if(!Validate::isOrderBy($orderBy)) $orderBy = null;
        if(!Validate::isOrderWay($orderWay)) $orderWay = null;


			if (isset($this->context->cookie->{$this->table.'_pagination'}) && $this->context->cookie->{$this->table.'_pagination'})
				$limit = $this->context->cookie->{$this->table.'_pagination'};
			else
				$limit = $this->_pagination[1];

		$limit = (int)Tools::getValue('pagination', $limit);
		$this->context->cookie->{$this->table.'_pagination'} = $limit;
        
        $start = 0;
 		if ((isset($_POST['submitFilter'.$this->table]) ||
		isset($_POST['submitFilter'.$this->table.'_x']) ||
		isset($_POST['submitFilter'.$this->table.'_y'])) &&
		!empty($_POST['submitFilter'.$this->table]) &&
		is_numeric($_POST['submitFilter'.$this->table]))
			$start = ((int)$_POST['submitFilter'.$this->table] - 1) * $limit;

	    if(!Tools::isSubmit('submitReset'.$what) && Tools::isSubmit('submitFilter'.$what)){	       
            $this->processFilter2($what);
        } else {
            $this->unsetFilter($what);
        }

//        $this->table = $what3;

        $filters = $this->context->cookie->getFamily($this->table.'Filter_');

        $this->table = $what2;           
//        var_dump($this->table);    
//        var_dump( $start,$limit);    
		$this->getList($this->context->language->id,$orderBy,$orderWay,$start, $limit);

		// Empty list is ok
		if (!is_array($this->_list))
			return false;

        $this->table = $what;

		$helper = new HelperList();

		$this->setHelperDisplay($helper);
		$helper->tpl_vars = $this->tpl_list_vars;
		$helper->tpl_delete_link_vars = $this->tpl_delete_link_vars;

		// For compatibility reasons, we have to check standard actions in class attributes
		foreach ($this->actions_available as $action)
		{
			if (!in_array($action, $this->actions) && isset($this->$action) && $this->$action)
				$this->actions[] = $action;
		}
//Tools::fd($this->_listsql);
		$list = $helper->generateList($this->_list, $this->fields_list);
        $this->lang = false;

        $this->table = $tmp;      
		return $list;
    }

    public function unsetFilter($what){
        $tmp = $this->table;
        $this->table = $what;
            $this->context->cookie->unsetFamily($this->table.'Filter_');
            $this->context->cookie->unsetFamily('submitFilter'.$this->table);
            $this->context->cookie->unsetFamily($this->table.'Orderby');
            $this->context->cookie->unsetFamily($this->table.'Orderway');            
            if(isset($_POST['submitFilter'.$this->table])) unset($_POST['submitFilter'.$this->table]);
            foreach($this->fields_list as $key => $field){
                $k = empty($field['filter_key'])?$key:$field['filter_key'];
                if(isset($_POST[$this->table.'Filter_'.$k])) unset($_POST[$this->table.'Filter_'.$k]);
            }
        $this->table = $tmp;        
    }

    
	/**
	 * Set the filters used for the list display
	 */
	public function processFilter2($what)
	{

        $tmp = $this->table;
        $this->table = $what;
		// Filter memorization
		if (isset($_POST) && !empty($_POST) && isset($this->table))
			foreach ($_POST as $key => $value)
			{
				if (is_array($this->table))
				{
					foreach ($this->table as $table)
						if (stripos($key, $table.'Filter_') === 0 || stripos($key, 'submitFilter') === 0)
							$this->context->cookie->$key = !is_array($value) ? $value : serialize($value);
				}
				elseif (stripos($key, $this->table.'Filter_') === 0 || stripos($key, 'submitFilter') === 0)
					$this->context->cookie->$key = !is_array($value) ? $value : serialize($value);
			}

		if (isset($_GET) && !empty($_GET) && isset($this->table))
			foreach ($_GET as $key => $value)
			{
				if (is_array($this->table))
				{
					foreach ($this->table as $table)
						if (stripos($key, $table.'OrderBy') === 0 || stripos($key, $table.'Orderway') === 0)
							$this->context->cookie->$key = $value;
				}
				elseif (stripos($key, $this->table.'OrderBy') === 0 || stripos($key, $this->table.'Orderway') === 0)
					$this->context->cookie->$key = $value;
			}
			
		$filters = $this->context->cookie->getFamily($this->table.'Filter_');

		foreach ($filters as $key => $value)
		{
			/* Extracting filters from $_POST on key filter_ */
			if ($value != null && !strncmp($key, $this->table.'Filter_', 7 + Tools::strlen($this->table)))
			{
				$key = Tools::substr($key, 7 + Tools::strlen($this->table));
				/* Table alias could be specified using a ! eg. alias!field */
				$tmp_tab = explode('!', $key);
				$filter = count($tmp_tab) > 1 ? $tmp_tab[1] : $tmp_tab[0];

				if ($field = $this->filterToField($key, $filter))
				{
					$type = (array_key_exists('filter_type', $field) ? $field['filter_type'] : (array_key_exists('type', $field) ? $field['type'] : false));					if (($type == 'date' || $type == 'datetime') && is_string($value))
						$value = Tools::unSerialize($value);
					$key = isset($tmp_tab[1]) ? $tmp_tab[0].'.`'.$tmp_tab[1].'`' : '`'.$tmp_tab[0].'`';

					// Assignement by reference
					if (array_key_exists('tmpTableFilter', $field))
						$sql_filter = & $this->_tmpTableFilter;
					elseif (array_key_exists('havingFilter', $field))
						$sql_filter = & $this->_filterHaving;
					else
						$sql_filter = & $this->_filter;

					/* Only for date filtering (from, to) */
					if (is_array($value))
					{
						if (isset($value[0]) && !empty($value[0]))
						{
							if (!Validate::isDate($value[0]))
								$this->errors[] = Tools::displayError('\'From:\' date format is invalid (YYYY-MM-DD)');
							else
								$sql_filter .= ' AND '.pSQL($key).' >= \''.pSQL(Tools::dateFrom($value[0])).'\'';
						}

						if (isset($value[1]) && !empty($value[1]))
						{
							if (!Validate::isDate($value[1]))
								$this->errors[] = Tools::displayError('\'To:\' date format is invalid (YYYY-MM-DD)');
							else
								$sql_filter .= ' AND '.pSQL($key).' <= \''.pSQL(Tools::dateTo($value[1])).'\'';
						}
					}
					else
					{
						$sql_filter .= ' AND ';
						$check_key = ($key == $this->identifier || $key == '`'.$this->identifier.'`');

						if ($type == 'int' || $type == 'bool')
							$sql_filter .= (($check_key || $key == '`active`') ? 'a.' : '').pSQL($key).' = '.(int)$value.' ';
						elseif ($type == 'decimal')
							$sql_filter .= ($check_key ? 'a.' : '').pSQL($key).' = '.(float)$value.' ';
						elseif ($type == 'select')
							$sql_filter .= ($check_key ? 'a.' : '').pSQL($key).' = \''.pSQL($value).'\' ';
						else
							$sql_filter .= ($check_key ? 'a.' : '').pSQL($key).' LIKE \'%'.pSQL($value).'%\' ';
					}
				}
			}
		}
        $this->table = $tmp;        
	}
    
    
	/**
	 * Set the filters used for the list display
	 */
/*     
	public function processFilter()
	{
		// Filter memorization
		if (isset($_POST) && !empty($_POST) && isset($this->table))
			foreach ($_POST as $key => $value)
			{
				if (is_array($this->table))
				{
					foreach ($this->table as $table)
						if (stripos($key, $table.'Filter_') === 0 || stripos($key, 'submitFilter') === 0)
							$this->context->cookie->$key = !is_array($value) ? $value : serialize($value);
				}
				elseif (stripos($key, $this->table.'Filter_') === 0 || stripos($key, 'submitFilter') === 0)
					$this->context->cookie->$key = !is_array($value) ? $value : serialize($value);
			}

		if (isset($_GET) && !empty($_GET) && isset($this->table))
			foreach ($_GET as $key => $value)
			{
				if (is_array($this->table))
				{
					foreach ($this->table as $table)
						if (stripos($key, $table.'OrderBy') === 0 || stripos($key, $table.'Orderway') === 0)
							$this->context->cookie->$key = $value;
				}
				elseif (stripos($key, $this->table.'OrderBy') === 0 || stripos($key, $this->table.'Orderway') === 0)
					$this->context->cookie->$key = $value;
			}
			
		$filters = $this->context->cookie->getFamily($this->table.'Filter_');

		foreach ($filters as $key => $value)
		{
			// Extracting filters from $_POST on key filter_ 
			if ($value != null && !strncmp($key, $this->table.'Filter_', 7 + Tools::strlen($this->table)))
			{
				$key = Tools::substr($key, 7 + Tools::strlen($this->table));
				// Table alias could be specified using a ! eg. alias!field 
				$tmp_tab = explode('!', $key);
				$filter = count($tmp_tab) > 1 ? $tmp_tab[1] : $tmp_tab[0];

				if ($field = $this->filterToField($key, $filter))
				{
					$type = (array_key_exists('filter_type', $field) ? $field['filter_type'] : (array_key_exists('type', $field) ? $field['type'] : false));					if (($type == 'date' || $type == 'datetime') && is_string($value))
						$value = Tools::unSerialize($value);
					$key = isset($tmp_tab[1]) ? $tmp_tab[0].'.`'.$tmp_tab[1].'`' : '`'.$tmp_tab[0].'`';

					// Assignement by reference
					if (array_key_exists('tmpTableFilter', $field))
						$sql_filter = & $this->_tmpTableFilter;
					elseif (array_key_exists('havingFilter', $field))
						$sql_filter = & $this->_filterHaving;
					else
						$sql_filter = & $this->_filter;

					// Only for date filtering (from, to) 
					if (is_array($value))
					{
						if (isset($value[0]) && !empty($value[0]))
						{
							if (!Validate::isDate($value[0]))
								$this->errors[] = Tools::displayError('\'From:\' date format is invalid (YYYY-MM-DD)');
							else
								$sql_filter .= ' AND '.pSQL($key).' >= \''.pSQL(Tools::dateFrom($value[0])).'\'';
						}

						if (isset($value[1]) && !empty($value[1]))
						{
							if (!Validate::isDate($value[1]))
								$this->errors[] = Tools::displayError('\'To:\' date format is invalid (YYYY-MM-DD)');
							else
								$sql_filter .= ' AND '.pSQL($key).' <= \''.pSQL(Tools::dateTo($value[1])).'\'';
						}
					}
					else
					{
						$sql_filter .= ' AND ';
						$check_key = ($key == $this->identifier || $key == '`'.$this->identifier.'`');

						if ($type == 'int' || $type == 'bool')
							$sql_filter .= (($check_key || $key == '`active`') ? 'a.' : '').pSQL($key).' = '.(int)$value.' ';
						elseif ($type == 'decimal')
							$sql_filter .= ($check_key ? 'a.' : '').pSQL($key).' = '.(float)$value.' ';
						elseif ($type == 'select')
							$sql_filter .= ($check_key ? 'a.' : '').pSQL($key).' = \''.pSQL($value).'\' ';
						else
							$sql_filter .= ($check_key ? 'a.' : '').pSQL($key).' LIKE \'%'.pSQL($value).'%\' ';
					}
				}
			}
		}
	}
    
*/    
}