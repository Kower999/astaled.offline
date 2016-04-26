<?php

class Group extends GroupCore
{

    public static function getVIPgroups(){
        $sql = 'SELECT g.id_group FROM `'._DB_PREFIX_.'group` g LEFT JOIN `'._DB_PREFIX_.'group_lang` gl ON ( gl.id_group = g.id_group AND gl.id_lang = '.Context::getContext()->language->id.' )  WHERE gl.name LIKE "%VIP%"';
        $ret = Db::getInstance()->executeS($sql);
        return $ret;
    }
}

