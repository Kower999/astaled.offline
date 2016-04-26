UPDATE `new_address_format` SET `format`='firstname lastname\r\ncompany\r\naddress1\r\naddress2\r\npostcode city\r\nCountry:name\r\nphone\r\n\r\ndni\r\ndic\r\nvat_number\r\n\r\nother' WHERE (`id_country`='37');
UPDATE `new_order_state_lang` SET `name`='Dodací List' WHERE (`id_order_state`='4') AND (`id_lang`='7');
UPDATE `new_order_state` SET `delivery`='1', `shipped`='1' WHERE (`id_order_state`='10');
