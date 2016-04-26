ALTER TABLE new_address MODIFY firstname VARCHAR(32);
ALTER TABLE new_address MODIFY lastname VARCHAR(32);

UPDATE new_configuration SET `value` = "VeGa solutions s.r.o." WHERE `name` = "PS_SHOP_NAME";
UPDATE new_configuration SET `value` = "info@vegasolutions.eu" WHERE `name` = "PS_SHOP_EMAIL";
UPDATE new_configuration SET `value` = "MR Štefánika 49" WHERE `name` = "PS_SHOP_ADDR1";
UPDATE new_configuration SET `value` = "94001" WHERE `name` = "PS_SHOP_CODE";
UPDATE new_configuration SET `value` = "Nové Zámky" WHERE `name` = "PS_SHOP_CITY";
UPDATE new_configuration SET `value` = "+421 (0)918 848 362" WHERE `name` = "PS_SHOP_PHONE";
UPDATE new_configuration SET `value` = "44464762" WHERE `name` = "PS_SHOP_ICO";
UPDATE new_configuration SET `value` = "2022714243" WHERE `name` = "PS_SHOP_DIC";
UPDATE new_configuration SET `value` = "SK2022714243" WHERE `name` = "PS_SHOP_ICDPH";
UPDATE new_configuration SET `value` = "SK60 7500 0000 0040 2017 2211" WHERE `name` = "PS_SHOP_IBAN";
UPDATE new_configuration SET `value` = "CEKOSKBX" WHERE `name` = "PS_SHOP_SWIFT";
UPDATE new_configuration SET `value` = "ČSOB" WHERE `name` = "PS_SHOP_BANKA";
