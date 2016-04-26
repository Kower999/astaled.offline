<?php /* Smarty version Smarty-3.1.8, created on 2014-10-09 19:30:20
         compiled from "G:\WEB WORK\esystems\astaled\UwAmp\UwAmp\www\shopadmin/themes/default\template\helpers\list\list_action_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:244165436c62c745928-15279316%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '95214399e2736a7bb6b21f75de9228750b7bb83b' => 
    array (
      0 => 'G:\\WEB WORK\\esystems\\astaled\\UwAmp\\UwAmp\\www\\shopadmin/themes/default\\template\\helpers\\list\\list_action_edit.tpl',
      1 => 1412842281,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '244165436c62c745928-15279316',
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
  'unifunc' => 'content_5436c62c773599_91334558',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5436c62c773599_91334558')) {function content_5436c62c773599_91334558($_smarty_tpl) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
" class="edit" title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">
	<img src="../img/admin/edit.gif" alt="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
</a><?php }} ?>