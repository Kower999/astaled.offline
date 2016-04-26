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

class SubscribersOBSEgoiController extends OBSEgoiController
{
	public function __construct()
	{
	 	$this->table = 'obsegoi_subscribers';
		$this->className = 'OBSEgoiSubscriber';
	 	$this->lang = false;
		parent::__construct();
		$this->meta_title = $this->l('Subscribers').' - '.$this->module->displayName;
		if (!$this->module->active)
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminHome'));
	}
	
	
	
	public function initContent()
	{
		$subscribersList = array();
		if($this->hasApiKey) {
			
			parent::initContent();
			/*if(Tools::getIsset('id_obsegoi_lists')) {
				$list = new OBSEgoiList(Tools::getValue('id_obsegoi_lists'));
				
				if(!Validate::isLoadedObject($list) || !$list->id_egoi)
					$error_msg = Tools::displayError('This list is not valid');
				else {
					$api = new EgoiAPI();
					$result = $api->getSubscribersFromListId($list->id_egoi);
					
					if(!is_array($result) OR array_key_exists('ERROR', $result))
						$error_msg = Tools::displayError('No subscribers found');
					else {
						$subscribersList = $result['subscriber'];
						/*
		  'UID' => string 'a68a2ec8a3' (length=10)
          'ADD_DATE' => string '2014-02-05 21:07:09' (length=19)
          'SUBSCRIPTION_METHOD' => string 'manual' (length=6)
          'LIST' => string '9' (length=1)
          'FIRST_NAME' => string 'Joaquim' (length=7)
          'LAST_NAME' => string 'Test OBSolutions' (length=16)
          'EMAIL' => string 'jhilari+21@obsolutions.es' (length=25)
          'CELLPHONE' => string '' (length=0)
          'TELEPHONE' => string '34-666666666' (length=12)
          'FAX' => string '' (length=0)
          'LANGUAGE' => string 'es' (length=2)
          'BIRTH_DATE' => string '' (length=0)
          'STATUS' => int 1
          'BOUNCES' => string '0' (length=1)
          'EMAIL_SENT' => string '0' (length=1)
          'EMAIL_VIEWS' => string '0' (length=1)
          'REFERRALS' => string '0' (length=1)
          'REFERRALS_CONVERTED' => string '0' (length=1)
          'CLICKS' => string '0' (length=1)
          'SMS_SENT' => string '0' (length=1)
          'SMS_DELIVERED' => string '0' (length=1)
          'FAX_SENT' => string '0' (length=1)
          'VOICE_CALLS_SENT' => string '0' (length=1)
          'VOICE_CALLS_ANSWERED' => string '0' (length=1)
          'MMS_SENT' => string '0' (length=1)
						 */ /*
					}
				}
			} else
				$error_msg = Tools::displayError('This list is not valid');
		
			$this->assign('subscribersList', $subscribersList);*/
		}
		
		$this->assign('obs_egoi_error_message', $this->errorMessages);
		$this->assign('obs_egoi_has_error', $this->errorMessages?true:false);
		$this->assign('subsContent', $this->content);
		$this->content = $this->fetch('subscribers.tpl');
		$this->assign('content', $this->content);
		
	}
	
}