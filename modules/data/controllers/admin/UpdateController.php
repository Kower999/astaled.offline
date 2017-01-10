<?php
include_once dirname(__FILE__).'/../abstract/DataController.php';

class UpdateController extends DataController
{
    
    public $files = array('update_db.xml','update_files.zip','configs.zip', '../cache/class_index.php');
    
	public function __construct()
	{
		$this->display = '';
        $this->className = 'Update';

		// Options list
		$this->fields_options = array(
			'general' => array(
				'title' =>	$this->l('Aktualizácia systému'),
                'image' => _PS_ADMIN_IMG_.'../t/AdminTools.gif',                
                'description' => 'Uistite sa že ste pripojený k internetu pre stiahnutie aktualizácie systému.<br />Táto operácia je časovo náročná, preto prosím buďte trpezlivý a kým sa Vám neobjavý hlásenie o ukončení aktualizácie, so systémom nič nerobte.',
			'submit' => array(
				'title' => $this->l('Aktualizovať'),
				'class' => 'button',
				'style' => 'display: block'
			)
			)
		);
        
		parent::__construct();
        
		$this->meta_title = $this->l('Aktualizácia systému').' - '.$this->module->displayName;
		if (!$this->module->active)
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminHome'));
            
        DataController::defineDropbox();

//        if (Context::getContext()->employee->isLoggedBack() && (Context::getContext()->employee->id_profile != 5) ) {                            
        if (Context::getContext()->employee->isLoggedBack()) {                            
            if ($this->module->active){
                $this->module->installDatabase();
                $this->module->createMenu();
                $this->module->setMenuAccess();
//            $this->checkrequirements();
            }
        }            
        
        $new = sprintf("%01.2f", (float)Tools::getValue("ver"));
        if((int)Tools::getValue("presmerovanie") == 1)
            $this->warnings[] = Tools::displayError( 'Boli ste sem presmerovaný z dôvodu že bola vydaná aktualizácia systému. Bez tejto aktualizácie nieje možné pokračovať v operáciách ktoré nejakým spôsobom komunikujú s online serverom. Prosím aktualizujte si teda systém na verziu: ' . $new . ' Vaša aktuálna verzia je:' . $this->last_version );
//            $this->warnings[] = Tools::displayError('');
//            $this->warnings[] = Tools::displayError('');
//            $this->warnings[] = Tools::displayError();            
	}
    
    
    public function checkrequirements(){
    }
            
    public function unlinkall(){
        foreach($this->files as $fname) {
            if(file_exists(_PS_DOWNLOAD_DIR_.$fname)){
                unlink(_PS_DOWNLOAD_DIR_.$fname);
            }                    
        }        
    }

	public function postProcess() {
        if(Tools::isSubmit('submitOptions')){
            $this->unlinkall();
                
            $fname = 'update_db.xml';
            
            file_put_contents(_PS_DOWNLOAD_DIR_.$fname, fopen(_PS_ONLINE_DOWNLOAD_.'updates/'.$fname, 'r'));
            
            clearstatcache();
            $fs = filesize(_PS_DOWNLOAD_DIR_.$fname);
        
            if(file_exists(_PS_DOWNLOAD_DIR_.$fname) && !empty($fs)){
                $xml = DataController::readxmlfilefromdownloaddir($fname);

                if(!DataController::isThisOnline()) {
                    if($this->last_version == ''.$xml->queries->version){
                        $this->errors[] = Tools::displayError('Už máte nainštalovanú najaktuálnejšiu verziu systému. Nieje potrebná ďaľšia aktualizácia. Posledná verzia je: '.$this->last_version);
                        $this->unlinkall();
                        return;                                
                    }
                    $this->errors[] = Tools::displayError('Toto je developerská verzia. Nieje možné použiť automatickú aktualizáciu. Verzia sa zmení z: '.$this->last_version. ' na verziu: '.$xml->queries->version. ' ale súbory neboli aktualizované!!!');
                    Configuration::updateValue('LAST_UPDATE_VERSION', (empty($this->last_online_version) ? $this->getUpdateVersion() : $this->last_online_version ) );                                                                  
                    $this->unlinkall();
                    return;                    
                }

                if($this->last_version == ''.$xml->queries->version){
                    $this->errors[] = Tools::displayError('Už máte nainštalovanú najaktuálnejšiu verziu systému. Nieje potrebná ďaľšia aktualizácia. Posledná verzia je: '.$this->last_version);
                    $this->unlinkall();
                    return;                                
                }

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
                            $ver = time();
                            $id_employee = (int)Context::getContext()->employee->id;
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
// -------------------------------- Update DB ---------------------------------------------------------------------------                            
                
                if(!empty($xml->queries)){
                  if(!empty($xml->queries->query))
                    foreach($xml->queries->query as $sql) {
                        $res = Db::getInstance()->execute("".$sql);
                        if($res === false){
                            $this->errors[] = Tools::displayError('Chyba SQL príkazu: '.$sql);
                        }                    
                    }
                  if(!empty($xml->queries->queryfile)){                    
                        $disabled = ini_get("disable_functions");
                        if((strpos($disabled,'exec') === false) && (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')){
                            $dumpfile = 'v_'.$this->last_version.'_'.$xml->queries->version.'_oz_'.$id_employee.'_'.$ver.'.sql';
                            if(!file_exists($dumppath.$dbpath.$dumpfile) && $id_employee != 1){
                                $command = $mysqldump." --user="._DB_USER_." --databases "._DB_NAME_." --default-character-set=utf8 --add-drop-table --result-file=".$dumppath.$dbpath.$dumpfile;
                                exec($command , $out, $return );
                                $fs2 = filesize($dumppath.$dbpath.$dumpfile);
                                if(file_exists($dumppath.$dbpath.$dumpfile) && !empty($fs2)){                                
                                    $this->confirmations[] = Tools::displayError('Databáza bola zálohovaná');
                                } else {
                                    $this->errors[] = Tools::displayError('Databázu sa nepodarilo zálohovať. Aktualizácia nebude vykonaná.');                                    
                                    $this->errors[] = Tools::displayError('Command: '.$command);                                    
                                    $this->errors[] = Tools::displayError('Out: '.$out);                                    
                                    $this->errors[] = Tools::displayError('Return: '.$return);                                    
                                    $this->unlinkall();
                                    return;                                                                            
                                }                                    
                            }

                            $path =  'C:\\wamp\\bin\\mysql\\'.$dirr.'\\bin\\mysql.exe';
                            
                            
                            foreach($xml->queries->queryfile as $qf) {                                
                                if(((float)$qf->version > (float)$this->last_version)){
                                    if(empty($qf->oz) || ((int)$id_employee == (int)(''.$qf->oz))) {
                                        $file=''.$qf->file;                                
                                        if(!file_exists(_PS_DOWNLOAD_DIR_.$file)){                                        
                                            file_put_contents(_PS_DOWNLOAD_DIR_.$file, fopen(_PS_ONLINE_SQL_DOWNLOAD_.$file, 'r'));
                                            $fs = filesize(_PS_DOWNLOAD_DIR_.$file);        
                                                
                                            if(file_exists(_PS_DOWNLOAD_DIR_.$file) && !empty($fs)){
                                                $command = $path." -u "._DB_USER_." "._DB_NAME_." --default-character-set=utf8 < "._PS_DOWNLOAD_DIR_.$file;
                                                exec($command);   
                                                $this->confirmations[] = Tools::displayError('Spracovaný súbor SQL ('.$qf->version.'):'.$file.' - '.$qf->desc);                                                                         
                                            } else {
                                                $this->errors[] = Tools::displayError('Nepodarilo sa stiahnuť súbor SQL ('.$qf->version.'):'.$file);
                                                $this->unlinkall();
                                                return;                                                                            
                                            }
                                        } // ak subor uz existuje neaktualizujeme lebo uz sme raz aktualizovali                                                                                        
                                        
                                    }
                                }
                                
                            }
                            
                        } else {
                            $this->warnings[] = Tools::displayError('Nieje možné importovat sql súbor. Funkcia exec() je zakázaná z bezpečnostných dôvodov.');                                        
                        }                    
                    }
                } else {
                    $this->errors[] = Tools::displayError('Nepodarilo sa stiahnuť konfiguračný súbor aktualizácie. Skontrolujte prosím pripojenie k intenetu.');
                    $this->unlinkall();
                    return;                                
                } 
// ----------------------------------- Update Files -------------------------------------------------------
                $fname = 'update_files.zip';
                $uf = ''.$xml->queries->updatefiles;
                $bf = ''.$xml->queries->backupfiles;
            
                if(!empty($uf)) {
                    // ---------- Backup System Files if necessary ----------------
                    if(!file_exists($dumppath.$syspath) && !empty($bf)){
                        mkdir($dumppath.$syspath);                                
                        $succ = $this->Zip('C:\\wamp\\www\\',$dumppath.$syspath.'www_backup.zip');
                        if($succ) {
                            $this->confirmations[] = Tools::displayError('Súborový systém bol zálohovaný');                                    
                        } else {
                        }
                    }
                    // --------- end backup --------------------                    
            
                    file_put_contents(_PS_DOWNLOAD_DIR_.$fname, fopen(_PS_ONLINE_DOWNLOAD_.'updates/'.$fname, 'r'));
            
                    $fs = filesize(_PS_DOWNLOAD_DIR_.$fname);        
                    if(file_exists(_PS_DOWNLOAD_DIR_.$fname) && !empty($fs)){
                        $zip = new ZipArchive;
                        $res = $zip->open(_PS_DOWNLOAD_DIR_.$fname);
                        if ($res === TRUE) {
                            $zip->extractTo(_PS_ROOT_DIR_);
                            $zip->close();
                        } else {
                            $this->errors[] = Tools::displayError('Chyba pri otváraní zip súboru: "'._PS_DOWNLOAD_DIR_.$fname.'" ('.$res.')');
                            $this->unlinkall();
                            return;
                        }

                    } else {
                        $this->errors[] = Tools::displayError('Chyba pri sťahovaní zip súboru: "'.$fname.'"');                    
                        $this->unlinkall();
                        return;
                    }
                    
                } else {
                    $this->confirmations[] = Tools::displayError('Php súbory nebolo nutné aktualizovať.');                                                    
                }
// ---------------------------------------- Update configs ----------------------------------------------------------------------
                $fname = 'configs.zip';
                $uf = ''.$xml->queries->updateconfigs;
            
                if(!empty($uf)) {
                    
                    file_put_contents(_PS_DOWNLOAD_DIR_.$fname, fopen(_PS_ONLINE_DOWNLOAD_.'updates/'.$fname, 'r'));
            
                    $fs = filesize(_PS_DOWNLOAD_DIR_.$fname);        
                    if(file_exists(_PS_DOWNLOAD_DIR_.$fname) && !empty($fs)){
                        $zip = new ZipArchive;
                        $res = $zip->open(_PS_DOWNLOAD_DIR_.$fname);
                        if ($res === TRUE) {
                            $zip->extractTo(_PS_WAMP_DIR_);
                            $zip->close();
                        } else {
                            $this->errors[] = Tools::displayError('Chyba pri otváraní zip súboru: "'._PS_DOWNLOAD_DIR_.$fname.'" ('.$res.')');
                            $this->unlinkall();
                            return;
                        }

                    } else {
                        $this->errors[] = Tools::displayError('Chyba pri sťahovaní zip súboru: "'.$fname.'"');                    
                        $this->unlinkall();
                        return;
                    }
                    
                } else {
                    $this->confirmations[] = Tools::displayError('Konfiguračné súbory nebolo nutné aktualizovať.');                                                    
                }
// ------------------------------------ One Time executetion of PHP script -----------------------------------------------
                if(!empty($xml->queries->phpfile)){
                    foreach($xml->queries->phpfile as $qf) {                                
                        if(((float)$qf->version > (float)$this->last_version)){
                            if(empty($qf->oz) || ((int)$id_employee == (int)(''.$qf->oz))) {
                                $fname=''.$qf->file;
                                $funct=''.$qf->function;
                                file_put_contents(_PS_DOWNLOAD_DIR_.str_replace('txt','php',$fname), fopen(_PS_ONLINE_PHP_DOWNLOAD_.$fname, 'r'));
                                $fname = str_replace('txt','php',$fname);
                                $fs = filesize(_PS_DOWNLOAD_DIR_.$fname);        
                                if(file_exists(_PS_DOWNLOAD_DIR_.$fname) && !empty($fs)){
                                    require_once _PS_DOWNLOAD_DIR_.$fname;
                                    if(function_exists($funct)){
                                        if(!$funct()){
                                            $this->errors[] = Tools::displayError('Nepodarilo sa spustiť jednorázový php skript. (chyba v skripte)');                                            
                                        } 
                                    } else {
                                        $this->errors[] = Tools::displayError('Nepodarilo sa spustiť jednorázový php skript. (funkcia neexistuje)');                                                                                    
                                    }
                                } else {
                                    $this->errors[] = Tools::displayError('Nepodarilo sa spustiť jednorázový php skript. (súbor neexistuje alebo je prázdny) :'._PS_ONLINE_PHP_DOWNLOAD_.$fname);                                                                                                                        
                                }
                            }
                        }
                    }                
                }

                $this->unlinkall();

            } else {
                $this->errors[] = Tools::displayError('Nepodarilo sa stiahnuť konfiguračné súbori zo serveru skontrolujte pripojenie k internetu.');
                $this->unlinkall();                
                return;
            }            
            
            if(empty($this->errors)) {
                Configuration::updateValue('LAST_UPDATE_VERSION', ''.$xml->queries->version);  
                $this->confirmations[] = Tools::displayError('Aktualizácia prebehla úspešne');
                $this->confirmations[] = Tools::displayError('Nová verzia systému je :'.$xml->queries->version);
            }
        }
    }	


function Zip($source, $destination)
{
    if (!extension_loaded('zip') || !file_exists($source)) {
        return false;
    }
    $success = true;    
    
    $zip = new ZipArchive();
    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
        return false;
    }

    $source = str_replace('\\', '/', realpath($source));

    if (is_dir($source) === true)
    {

        $zip->addGlob($source.'\\*.*', GLOB_BRACE, array());

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
                $s = $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                if(!$s) {
                    $this->warnings[] = Tools::displayError('Chyba: Pri zálohe súb. syst. : vytvorenie adresára '.$file);                                                                                        
                }
                $success &= $s;
                $isempty =  $this->getDir($file);
                if(!empty($isempty)){
                    $s = $zip->addGlob($file.'\\*.*', GLOB_BRACE, array());
                    if(!$s) {
                        $this->warnings[] = Tools::displayError('Chyba: Pri zálohe súb. syst. : pri zálohovaní do '.$file);
                    }                    
                    $success &= $s;                                                                                    
                }
            }
        }
    }

    return $success &= $zip->close();
}

function getDir($dir){
    $files =  scandir($dir);
    $ret = array();
    foreach($files AS $f){
        if(!is_dir($f) && is_file($f) === true) $ret[] = $f;
    }    
    return $ret;
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