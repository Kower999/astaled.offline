<?php

class AddressFormat extends AddressFormatCore
{
	/**
	 * Generates the full address text
	 * @param address is an instanciate object of Address class
	 * @param patternrules is a defined rules array to avoid some pattern
	 * @param newLine is a string containing the newLine format
	 * @param separator is a string containing the separator format
	 * @return string
	 */
	public static function generateAddress(Address $address, $patternRules = array(), $newLine = "\r\n", $separator = ' ', $style = array())
	{
		$addressFields = AddressFormat::getOrderedAddressFields($address->id_country);
        
        
        if(isset($address->other)){
            $address->other = Tools::nl2br($address->other);            
        }
//        echo '<br/>----------------------<br/>';
//        echo '<br/>----------------------<br/>';
//        var_dump($address);
//        echo '<br/>----------------------<br/>';
//        var_dump($addressFields);
	    $addressFormatedValues = AddressFormat::getFormattedAddressFieldsValues($address, $addressFields);
//        echo '<br/>----------------------<br/>';
//        var_dump($addressFormatedValues);
		$addressText = '';
		foreach ($addressFields as $line)
			if (($patternsList = preg_split(self::_CLEANING_REGEX_, $line, -1, PREG_SPLIT_NO_EMPTY)))
				{
					$tmpText = '';
					foreach ($patternsList as $pattern)
						if ((!array_key_exists('avoid', $patternRules)) ||
								(array_key_exists('avoid', $patternRules) && !in_array($pattern, $patternRules['avoid'])))
							$tmpText .= (isset($addressFormatedValues[$pattern]) && !empty($addressFormatedValues[$pattern])) ?
								(((isset($style[$pattern])) ?
									(sprintf($style[$pattern], $addressFormatedValues[$pattern])) :
									$addressFormatedValues[$pattern]).$separator) : '';
					$tmpText = trim($tmpText);
					$addressText .= (!empty($tmpText)) ? $tmpText.$newLine: '';
				}

		$addressText = rtrim($addressText, $newLine);
		$addressText = rtrim($addressText, $separator);

		return $addressText;
	}        

}

