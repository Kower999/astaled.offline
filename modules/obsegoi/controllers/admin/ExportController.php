<?php

include_once dirname(__FILE__).'/../abstract/DataController.php';

class DataController extends DataController
{
	public function __construct()
	{
		$this->display = 'view';
		parent::__construct();
		$this->meta_title = $this->l('Export').' - '.$this->module->displayName;
		if (!$this->module->active)
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminHome'));
	}
	
	public function initContent()
	{
		$error_msg = '';
		
		parent::initContent();
		
		
//		$this->assign('obs_egoi_error_message', $error_msg);
//		$this->assign('obs_egoi_has_error', $error_msg?true:false);
		
		$this->content .= $this->fetch('myAccount.tpl');
		
		$this->assign('content', $this->content);
		
	}
	
}