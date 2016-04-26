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

class MyListsOBSEgoiController extends OBSEgoiController
{
	public function __construct()
	{
	 	$this->table = 'obsegoi_lists';
		$this->className = 'OBSEgoiList';
	 	$this->lang = false;
		Shop::addTableAssociation('obsegoi_lists', array('type' => 'shop'));
		
		$this->fields_list = array(
			'id_obsegoi_lists' => array(
				'title' => $this->l('ID'),
				'align' => 'center',
				'width' => 25
			),
			'iso_lang' => array(
				'title' => $this->l('List language'),
				'width' => 75
			),
			'name' => array(
				'title' => $this->l('Name'),
				'width' => 'auto'
			),
			'subs_num' => array(
				'title' => $this->l('Subscribers'),
				'width' => '150',
				'align' => 'center',
				'orderby' => false,
				'search' => false
			)
		);
		$this->bulk_actions = array(
			'delete' => array('text' => $this->l('Delete selected'), 'confirm' => $this->l('Delete list from Prestashop? E-goi list will not be removed')),
			/*'enableSelection' => array('text' => $this->l('Create at E-goi')),
			'disableSelection' => array('text' => $this->l('Disconnect from E-goi'))*/
			);
			
		parent::__construct();
		$this->meta_title = $this->l('My Lists').' - '.$this->module->displayName;
		if (!$this->module->active)
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminHome'));
	}
	
	public function renderForm()
	{
		$validLanguages = array(
			'br' => $this->l('Brazilian'),
			'de' => $this->l('Germany'),
			'en' => $this->l('English'),
			'fr' => $this->l('French'),
			'es' => $this->l('Spanish'),
			'pt' => $this->l('Portuguese'),
			'hu' => $this->l('Hungarian')
		);
		$languages = Language::getLanguages();
		if($languages)
			foreach($languages as $key => $lang)
				if(!array_key_exists($lang['iso_code'], $validLanguages))
					unset($languages[$key]);
		
		$this->fields_form = array(
			'legend' => array(
				'title' => $this->l('List'),
				'image' => '../img/admin/world.gif'
			),
			'input' => array(
				array(
					'type' => 'text',
					'label' => $this->l('Name:'),
					'name' => 'name',
					'size' => 33,
					'required' => true,
				),
				/*array(
					'type' => 'text',
					'label' => $this->l('Internal name:'),
					'name' => 'name_ref',
					'size' => 33,
					'required' => true,
					'desc' => $this->l('Name to indetify your list internally.'),
				),*/
				array(
					'type' => 'select',
					'label' => $this->l('List language:'),
					'name' => 'iso_lang',
					'size' => 1,
					/*'options' => array('es', 'en'),*/
					'required' => true,
					'default_value' => (int)$this->context->language->id,
					'options' => array(
						'query' => $languages,
						'id' => 'iso_code',
						'name' => 'name',
					),
					'desc' => $this->l('Supported languages: Brazilian (br), Germany (de), English (en), French (fr), Spanish (es), Portuguese (pt), Hungarian (hu)'),
				)
			)
		);

		if (Shop::isFeatureActive())
		{
			$this->fields_form['input'][] = array(
				'type' => 'shop',
				'label' => $this->l('Group shop association:'),
				'name' => 'checkBoxShopAsso',
			);
		}

		$this->fields_form['submit'] = array(
			'title' => $this->l('Save   '),
			'class' => 'button'
		);

		return parent::renderForm();
	}
	
	public function initContent()
	{
		$error_msg = '';
		
		if(!$this->hasApiKey)
			$this->content = $this->fetch('noApiKeyWarn.tpl');
		else {
			if(Tools::getIsset('showSubscribers')) {
				$this->initContentSubscribers();
			} else
				parent::initContent();
		}
		
		$this->assign('content', $this->content);
		
	}
	
	public function initContentSubscribers() {
		
		$psListId = Tools::getValue('id_obsegoi_lists');
		
		$psList = new OBSEgoiList($psListId);
		
		$listName = '';
		$customers = array();
		if(!Validate::isLoadedObject($psList)) {
			$this->errorMessages .= Tools::displayError('This list is not valid');;
		} else {
			$customers = OBSEgoiSubscriber::getCustomersByListId($psListId);
			$listName = $psList->name;
		}
		$this->assign('listName', $listName);
		$this->assign('subscribersList', $customers);
		
		$this->assign('obs_egoi_error_message', $this->errorMessages);
		$this->assign('obs_egoi_has_error', $this->errorMessages?true:false);
		$this->content = $this->fetch('subscribers.tpl');
	}
	
	public function renderList() {
		$this->list_no_link = true;
		
		$this->actions = array('viewSubscribers');
		
		return parent::renderList();
	}
	
	public function displayViewSubscribersLink($token, $id, $name) {
		
		$this->assign('href', self::$currentIndex.'&showSubscribers&'.$this->identifier.'='.$id.'&token='.$this->token);
		$this->assign('action', $this->l('Subscribers'));
		$this->assign('id', $id);

		return $this->fetch('viewSubscribersLink.tpl');
	}
}