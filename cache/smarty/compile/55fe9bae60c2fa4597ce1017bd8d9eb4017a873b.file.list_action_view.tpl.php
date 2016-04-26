<?php /* Smarty version Smarty-3.1.8, created on 2015-12-11 15:53:03
         compiled from "C:\wamp\www\shopadmin/themes/default\template\helpers\list\list_action_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:169825501bee505b8d7-70699688%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '55fe9bae60c2fa4597ce1017bd8d9eb4017a873b' => 
    array (
      0 => 'C:\\wamp\\www\\shopadmin/themes/default\\template\\helpers\\list\\list_action_view.tpl',
      1 => 1449845523,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '169825501bee505b8d7-70699688',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5501bee5066ff7_07115567',
  'variables' => 
  array (
    'href' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5501bee5066ff7_07115567')) {function content_5501bee5066ff7_07115567($_smarty_tpl) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" >
	<img src="../img/admin/details.gif" alt="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
</a><?php }} ?>