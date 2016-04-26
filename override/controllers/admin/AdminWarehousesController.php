<?php

class AdminWarehousesController extends AdminWarehousesControllerCore
{

	protected function updateAddress()
	{
		// updates/creates address if it does not exist
		if (Tools::isSubmit('id_address') && (int)Tools::getValue('id_address') > 0)
			$address = new Address((int)Tools::getValue('id_address')); // updates address
		else
			$address = new Address(); // creates address
			// sets the address
		$address->alias = Tools::getValue('reference', null);
		$address->lastname = 'warehouse'; // skip problem with numeric characters in warehouse name
		$address->firstname = 'warehouse'; // skip problem with numeric characters in warehouse name
		$address->address1 = Tools::getValue('address', null);
		$address->address2 = Tools::getValue('address2', null);
		$address->postcode = Tools::getValue('postcode', null);
		$address->phone = Tools::getValue('phone', null);
		$address->phone_mobile = Tools::getValue('phone', null);
        $address->company = 'Astaled'; // chyba prestyashop      
		$address->id_country = Tools::getValue('id_country', null);
		$address->id_state = Tools::getValue('id_state', null);
		$address->city = Tools::getValue('city', null);

		// validates the address
		$validation = $address->validateController();

		// checks address validity
		if (count($validation) > 0) // if not valid
		{
			foreach ($validation as $item)
				$this->errors[] = $item;
			$this->errors[] = Tools::displayError('The address is not correct. Check if all required fields are filled.');
		}
		else // valid
		{
			if (Tools::isSubmit('id_address') && Tools::getValue('id_address') > 0)
				$address->update();
			else
			{
				$address->save();
				$_POST['id_address'] = $address->id;
			}
		}
	}

}

