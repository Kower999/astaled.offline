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
abstract class DataController extends ModuleAdminController {
	
	protected $errors = array();
	
	public function __construct() {
		parent::__construct();
	}
	
	public function fetch($template) {
		return $this->context->smarty->fetch($this->module->getTemplatePath('views/templates/admin/'.$template));
	}
	
	public function assign($key, $value) {
		$this->context->smarty->assign($key, $value);
	}
	
}