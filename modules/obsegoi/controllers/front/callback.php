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
class OBSEgoiCallbackModuleFrontController extends ModuleFrontController {

	public function initContent()
	{

		//$this->enviarEmailTest();
		
		if(Tools::getIsset('addSubscriber'))
			$this->addPSSubscriber(Tools::getValue('addSubscriber'));
		if(Tools::getIsset('editSubscriber'))
			$this->editPSSubscriber(Tools::getValue('editSubscriber'));
		if(Tools::getIsset('removeSubscriber'))
			$this->deletePSSubscriber(Tools::getValue('removeSubscriber'));
			
		die();
	}
	
	private function addPSSubscriber($data){
		
		preg_match('/<UID>(.*?)<\/UID>/', $data, $transac);
		$id_egoi_customer = $transac[1];
		preg_match('/<LIST>(.*?)<\/LIST>/', $data, $transac);
		$egoiListId = $transac[1];
		preg_match('/<FIRST_NAME>(.*?)<\/FIRST_NAME>/', $data, $transac);
		$firstname = $transac[1];
		preg_match('/<LAST_NAME>(.*?)<\/LAST_NAME>/', $data, $transac);
		$lastname = $transac[1];
		preg_match('/<EMAIL>(.*?)<\/EMAIL>/', $data, $transac);
		$email = $transac[1];
		preg_match('/<BIRTH_DATE>(.*?)<\/BIRTH_DATE>/', $data, $transac);
		$birthday = $transac[1];
		
		$listData = OBSEgoiList::getList($egoiListId);
		$listShopData = OBSEgoiList::getShopListIds($egoiListId);
		$newsletterCheckedFieldId = $listData['id_extra_newsletter_check'];
		
		preg_match('/<EXTRA_FIELD_'.$newsletterCheckedFieldId.'>(.*?)<\/EXTRA_FIELD_'.$newsletterCheckedFieldId.'>/', $data, $transac);
		$newsletterCheck = $transac[1];
		
		//PRIMERO BUSCAMOS EL SUSCRITO EN LA TABLA DE EGOI
		$subscriber = new OBSEgoiSubscriber($id_egoi_customer);
		
		if($subscriber->sub_egoi_uid){
			$customer = new Customer($subscriber->sub_customer_id);
		}
		//SINO, LO BUSCAMOS EN LA LISTA DE CUSTOMERS BUSCANDO POR EL EMAIL
		else {
			$customer = new Customer();
			$customer = $customer->getByEmail($email);
		}
		
		//SI ENCONTRAMOS EL USUARIO, LO ACTUALIZAMOS SIEMPRE
		if($customer){
			$customer->firstname = $firstname;
			$customer->lastname = $lastname;
			$customer->email = $email;
			$customer->newsletter = ($newsletterCheck)?'1':'0';
			if($newsletterCheck)
				$customer->newsletter_date_add = date('Y-m-d H:i:s');
			$customer->update();
		}
		else
		{
			//SINO, LO CREAMOS PARA CADA TIENDA A LA QUE PERTENEZCA LA LISTA
			foreach($listShopData as $listShop)
			{
				$customer = new Customer();
				$customer->id_shop = $listShop['id_shop'];
				$customer->firstname = $firstname;
				$customer->lastname = $lastname;
				$customer->email = $email;
				$customer->birthday = $birthday;
				$customer->newsletter = ($newsletterCheck)?'1':'0';
				$customer->passwd = Tools::encrypt($password = Tools::passwdGen(MIN_PASSWD_LENGTH));
				
				if($newsletterCheck)
					$customer->newsletter_date_add = date('Y-m-d H:i:s');
					
				$success = $customer->add();
				//var_dump($customer, $success);die();
			}
			
		}
		
		
		if($customer->id)
		{
				
			if($subscriber->sub_egoi_uid)
			{
				//var_dump($subscriber);
				$subscriber->sub_is_subscribed = ($customer->newsletter)? $customer->newsletter:'0';
				$subscriber->update();
			}
			
			else
			{
				//TABLE SUBSCRIBERS
				$subscriber = new OBSEgoiSubscriber();
				$subscriber->sub_customer_id = $customer->id;
				$subscriber->sub_egoi_uid = $id_egoi_customer;
				$subscriber->sub_list_id = $listData['id_obsegoi_lists'];
				$subscriber->sub_is_subscribed = ($customer->newsletter)? $customer->newsletter:'0';
				$subscriber->sub_dateadd = date('Y-m-d H:i:s');
				
				$subscriber->save();
				
				//TABLE LISTS
				$list = new OBSEgoiList($listData['id_obsegoi_lists']);
				$list->subs_num = (int) $list->subs_num  + 1;
				$list->update();
			}
		
		}
		
	}
	
	private function editPSSubscriber($data){
		
		$this->addPSSubscriber($data);
		
	}
	
	private function deletePSSubscriber($data){
		
		preg_match('/<UID>(.*?)<\/UID>/', $data, $transac);
		$id_egoi_customer = $transac[1];
		preg_match('/<LIST>(.*?)<\/LIST>/', $data, $transac);
		$egoiListId = $transac[1];
		preg_match('/<EMAIL>(.*?)<\/EMAIL>/', $data, $transac);
		$email = $transac[1];
		
		//PRIMERO BUSCAMOS EL SUSCRITO EN LA TABLA DE EGOI
		$subscriber = new OBSEgoiSubscriber($id_egoi_customer);
		
		if($subscriber->sub_egoi_uid){
			$customer = new Customer($subscriber->sub_customer_id);
		}
		//SINO, LO BUSCAMOS EN LA LISTA DE CUSTOMERS BUSCANDO POR EL EMAIL
		else {
			$customer = new Customer();
			$customer = $customer->getByEmail($email);
		}
		
		//SI ENCONTRAMOS EL USUARIO, LO ACTUALIZAMOS SIEMPRE
		if($customer){
			$customer->newsletter = '0';
			$customer->update();
		}
		
		if($customer->id)
		{
				
			if($subscriber->sub_egoi_uid)
			{
				//var_dump($subscriber);
				$subscriber->sub_is_subscribed = '0';
				$subscriber->update();
			}
			
			else
			{
				//TABLE SUBSCRIBERS
				$subscriber = new OBSEgoiSubscriber();
				$subscriber->sub_customer_id = $customer->id;
				$subscriber->sub_egoi_uid = $id_egoi_customer;
				$subscriber->sub_list_id = $listData['id_obsegoi_lists'];
				$subscriber->sub_is_subscribed = '0';
				$subscriber->sub_dateadd = date('Y-m-d H:i:s');
				
				$subscriber->save();
				
				//TABLE LISTS
				$list = new OBSEgoiList($listData['id_obsegoi_lists']);
				$list->subs_num = (int) $list->subs_num  + 1;
				$list->update();
			}
		
		}
		
	}
	
	private function enviarEmailTest()
	{
		ob_start();
		var_dump($_GET, $_POST);
		$content = ob_get_contents();
		ob_end_clean();
		
		include_once(_PS_SWIFT_DIR_.'Swift.php');
		include_once(_PS_SWIFT_DIR_.'Swift/Connection/SMTP.php');
		include_once(_PS_SWIFT_DIR_.'Swift/Connection/NativeMail.php');
		include_once(_PS_SWIFT_DIR_.'Swift/Plugin/Decorator.php');
		$id_shop = null;
		$configuration = Configuration::getMultiple(array(
			'PS_SHOP_EMAIL',
			'PS_MAIL_METHOD',
			'PS_MAIL_SERVER',
			'PS_MAIL_USER',
			'PS_MAIL_PASSWD',
			'PS_SHOP_NAME',
			'PS_MAIL_SMTP_ENCRYPTION',
			'PS_MAIL_SMTP_PORT',
			'PS_MAIL_TYPE'
		), null, null, $id_shop);
		$die = true;
		/* Connect with the appropriate configuration */
		if ($configuration['PS_MAIL_METHOD'] == 2)
		{
			if (empty($configuration['PS_MAIL_SERVER']) || empty($configuration['PS_MAIL_SMTP_PORT']))
			{
				Tools::dieOrLog(Tools::displayError('Error: invalid SMTP server or SMTP port'), $die);
				return false;
			}
			$connection = new Swift_Connection_SMTP($configuration['PS_MAIL_SERVER'], $configuration['PS_MAIL_SMTP_PORT'],
				($configuration['PS_MAIL_SMTP_ENCRYPTION'] == 'ssl') ? Swift_Connection_SMTP::ENC_SSL :
				(($configuration['PS_MAIL_SMTP_ENCRYPTION'] == 'tls') ? Swift_Connection_SMTP::ENC_TLS : Swift_Connection_SMTP::ENC_OFF));
			$connection->setTimeout(4);
			if (!$connection)
				return false;
			if (!empty($configuration['PS_MAIL_USER']))
				$connection->setUsername($configuration['PS_MAIL_USER']);
			if (!empty($configuration['PS_MAIL_PASSWD']))
				$connection->setPassword($configuration['PS_MAIL_PASSWD']);
		}
		else
			$connection = new Swift_Connection_NativeMail();
		$swift = new Swift($connection, Configuration::get('PS_MAIL_DOMAIN', null, null, $id_shop));
		
		$message = new Swift_Message('['.Configuration::get('PS_SHOP_NAME', null, null, $id_shop).'] '.'CALL BACK TEST');
		$message->attach(new Swift_Message_Part($content, 'text/plain', '8bit', 'utf-8'));
		
		$to_list = new Swift_RecipientList();
		$to_list->addTo('eulerico@gmail.com');
		
		$send = $swift->send($message, $to_list, new Swift_Address('jhilari@obsolutions.es', 'Joaquim'));
		$swift->disconnect();
		
	}
	
}

?>