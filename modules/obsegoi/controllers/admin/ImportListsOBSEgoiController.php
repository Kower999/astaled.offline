<?php
 /**
 * 
 *  2011-2013 OBSolutions S.C.P.  
 *  All Rights Reserved.
 * 
 * NOTICE:  All information contained herein is, and remains
 * the property of OBSolutions S.C.P. and its suppliers,
 * if any.  The intellectual and technical concepts contained
 * herein are proprietary to OBSolutions S.C.P.
 * and its suppliers and are protected by trade secret or copyright law.
 * Dissemination of this information or reproduction of this material
 * is strictly forbidden unless prior written permission is obtained
 * from OBSolutions S.C.P.
 */
include_once dirname(__FILE__).'/../abstract/OBSEgoiController.php';

class ImportListsOBSEgoiController extends OBSEgoiController
{
	public function __construct()
	{
	 	$this->table = 'obsegoi_lists';
		$this->className = 'OBSEgoiList';
		Shop::addTableAssociation('obsegoi_lists', array('type' => 'shop'));
		
		parent::__construct();
		$this->meta_title = $this->l('Import Lists').' - '.$this->module->displayName;
		if (!$this->module->active)
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminHome'));
	}
	
	public function initToolbar() {
		//NO TOOLBAR
		$this->toolbar_btn = array();
	}
	
	public function postProcess() {
		if(Tools::isSubmit('submitBulkimport'.$this->table)) {
			$listToImport = Tools::getValue('obsegoi_listsBox');
			
			$result = false;
			if(is_array($listToImport) AND count($listToImport) > 0) {
				$listToImportTmp = array();
				//CONVERT VALUE TO KEY
				foreach($listToImport as $key => $value)
					$listToImportTmp[$value] = $value;
				$listToImport = $listToImportTmp;
				$api = new EgoiAPI();
				$allLists = $api->getLists();
				
				if($allLists)
				foreach($allLists as $egoiList) {
					if(array_key_exists($egoiList['listnum'], $listToImport)) {
						$list = new OBSEgoiList();
						$list->id_egoi = $egoiList['listnum'];
						$list->name = $egoiList['title'];
						$list->name_ref = $egoiList['title_ref'];
						$list->group = $egoiList['grupo'];
						$list->iso_lang = $egoiList['idioma'];
						
						$extraFields = $egoiList['extra_fields'];
						
						if($extraFields AND count($extraFields) >0)
						{
							foreach($extraFields as $extraField)
							{
								if(strtolower($extraField['ref']) == strtolower('Newsletter checked'))
									$list->id_extra_newsletter_check = $extraField['id'];
							}
						}
						
						if(!$list->id_extra_newsletter_check)
							$list->id_extra_newsletter_check = $api->createExtraField($egoiList['listnum'], 'Newsletter checked', 'texto');
						
						$result = $list->save();
					}
				}
				 
			}
			if($result)
				Tools::redirectAdmin(self::$currentIndex.'&token='.$this->token.'&conf=3');
			else
				$this->content=Tools::displayError('An error has ocurred');
		}
	}
	
	public function initContent()
	{
		$error_msg = '';
		
		if(!$this->hasApiKey)
			$this->content = $this->fetch('noApiKeyWarn.tpl');
		else
			parent::initContent();
		
		$this->assign('content', $this->content);	
	}
	
	public function renderList() {
		
		$this->list_simple_header = false;
		$this->bulk_actions = array(
			'import' => array('text' => $this->l('Import selected'), 'confirm' => $this->l('Are you sure you want to create this lists on Prestashop?'))
		);
		$this->list_no_link = true;
		
		$helper = new HelperList();
		$this->setHelperDisplay($helper);
		$helper->currentIndex = self::$currentIndex.'&link'.$this->table;
		$helper->identifier = 'listnum';
		
		$api = new EgoiAPI();
		$lists = $api->getLists();
		
		if($lists) {
			$this->getList($this->context->language->id);
			$toDeleteIds = array();
			
			if($this->_list)
			foreach($this->_list as $l) {
				$toDeleteIds[$l['id_egoi']] = $l;
			}
			
			foreach($lists as $key => $list) {
				if(array_key_exists($list['listnum'], $toDeleteIds))
					unset($lists[$key]);
			}
		} else {
			$lists = array();
		}
		
		//$content = '<div>'.$this->l('Available E-goi lists that can be exported to Prestashop').'</div>';
		$content = $helper->generateList($lists, $this->_getRenderLinkFields());
		
		return $content;
	}
	
	private function _getRenderLinkFields() {
		return array( 
			'listnum' => array(
				'title' => $this->l('ID'),
				'align' => 'center',
				'width' => 25,
				'orderby' => false,
				'search' => false
			),
			'idioma' => array(
				'title' => $this->l('Lang'),
				'align' => 'center',
				'width' => 25,
				'orderby' => false,
				'search' => false
			),
			'title' => array(
				'title' => $this->l('Name'),
				'width' => 'auto',
				'orderby' => false,
				'search' => false
			),
			'subs_activos' => array(
				'title' => $this->l('Active Subs.'),
				'align' => 'center',
				'width' => 100,
				'orderby' => false,
				'search' => false
			),
			'subs_total' => array(
				'title' => $this->l('Total Subs.'),
				'align' => 'center',
				'width' => 100,
				'orderby' => false,
				'search' => false
			));
	}
	
}