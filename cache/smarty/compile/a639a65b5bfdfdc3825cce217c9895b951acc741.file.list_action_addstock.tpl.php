<?php /* Smarty version Smarty-3.1.8, created on 2015-01-30 22:49:30
         compiled from "/var/www/virtual/esystem.sk/htdocs/clients/astaledonline/shopadmin/themes/default/template/helpers/list/list_action_addstock.tpl" */ ?>
<?php /*%%SmartyHeaderCode:170903787154cbfc6a902478-34830038%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a639a65b5bfdfdc3825cce217c9895b951acc741' => 
    array (
      0 => '/var/www/virtual/esystem.sk/htdocs/clients/astaledonline/shopadmin/themes/default/template/helpers/list/list_action_addstock.tpl',
      1 => 1420467847,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '170903787154cbfc6a902478-34830038',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'href' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_54cbfc6a90f963_62101628',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54cbfc6a90f963_62101628')) {function content_54cbfc6a90f963_62101628($_smarty_tpl) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">
	<img src="../img/admin/add_stock.png" alt="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
</a>
<?php }} ?>