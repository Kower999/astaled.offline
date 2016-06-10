<?php
if(ENT_XML1 != 16) { define('ENT_XML1', 16); }

define('_ASTALED_UPDATE_',              true);
define('_ASTALED_ADMIN_MAIL_',          'kower99@gmail.com');
if(_PS_MODE_DEV_) {
    define('_PS_ONLINE_MAIL_',          'kower99@gmail.com');        
} else {
    define('_PS_ONLINE_MAIL_',          'marian.gabris.vega@gmail.com');    
}

define('_ASTALED_ONLINE_',              'http://www.astaled.sk');
define('_ASTALED_OFFLINE_',             'AstaledOffline');
//define('_ASTALED_ONLINE_',              'http://obchod.astaled.sk');
//define('_ASTALED_OFFLINE_',             'BaterkyOffline');

define('_ASTALED_SENDER_MAIL_',         'astaledonline@gmail.com');
define('_ASTALED_SENDER_MAIL_PWD_',     'L83OwYky');

define('_PS_EXPORTS_DIR_',              _PS_DOWNLOAD_DIR_ . 'updates/exports/');
define('_PS_CUSTOMERS_DATA_',           _PS_EXPORTS_DIR_ . 'customers.data');
define('_PS_ADRESSES_DATA_',            _PS_EXPORTS_DIR_ . 'adresses.data');
define('_PS_ADRESSES_CATEGORY_DATA_',   _PS_EXPORTS_DIR_ . 'adresses_category.data');
define('_PS_ADRESSES_MORE_DATA_',       _PS_EXPORTS_DIR_ . 'adresses_more.data');
define('_PS_ADRESSES_VISITS_DATA_',     _PS_EXPORTS_DIR_ . 'adresses_visits.data');
define('_PS_ORDERS_DATA_',              _PS_EXPORTS_DIR_ . 'orders.data');
define('_PS_STOCK_DATA_',               _PS_EXPORTS_DIR_ . 'stock.data');

define('_PS_ONLINE_DOWNLOAD_',         _ASTALED_ONLINE_ . '/download/');

define('_PS_ADMIN_IMPORT_',            _PS_ROOT_DIR_ . '/shopadmin/import/');

define('_PS_ONLINE_DOWNLOAD_STOCK_UPDATES_', _PS_ONLINE_DOWNLOAD_ . 'updates/stock_updates/');
define('_PS_STOCK_UPDATES_DIR_',        _PS_DOWNLOAD_DIR_ . 'updates/stock_updates/');

define('_PS_ONLINE_DOWNLOAD_XML_',      _ASTALED_ONLINE_ . '/');

define('_PS_WAMP_DIR_',                 realpath(_PS_ROOT_DIR_ . '/../bin/'));

define('_PS_ONLINE_SQL_DOWNLOAD_',      _PS_ONLINE_DOWNLOAD_ . 'updates/sql_updates/');
define('_PS_ONLINE_PHP_DOWNLOAD_',      _PS_ONLINE_DOWNLOAD_ . 'updates/onetime_php/');
