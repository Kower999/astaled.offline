<?php

class AdminCustomersController extends AdminCustomersControllerCore
{

	public function renderList()
	{
    
        if (Context::getContext()->employee->isLoggedBack() && (Context::getContext()->employee->id_profile == 5) ) {            
            $this->_where = 'AND a.`id_employee` = '.(Context::getContext()->employee->id);            
        }
   		return parent::renderList();

    }


}

