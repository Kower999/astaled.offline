<?php /* Smarty version Smarty-3.1.8, created on 2014-10-09 20:50:00
         compiled from "G:\WEB WORK\esystems\astaled\UwAmp\UwAmp\www\modules\obsegoi\views\templates\admin\errorMessages.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15425436d8d860cc42-00860453%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '64d110b534216896e323144f862a8cfa38f20ef6' => 
    array (
      0 => 'G:\\WEB WORK\\esystems\\astaled\\UwAmp\\UwAmp\\www\\modules\\obsegoi\\views\\templates\\admin\\errorMessages.tpl',
      1 => 1396508198,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15425436d8d860cc42-00860453',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'obs_egoi_has_error' => 0,
    'obs_egoi_error_message' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5436d8d8632ea3_63654872',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5436d8d8632ea3_63654872')) {function content_5436d8d8632ea3_63654872($_smarty_tpl) {?> 
<?php if ($_smarty_tpl->tpl_vars['obs_egoi_has_error']->value){?>
	<?php echo $_smarty_tpl->tpl_vars['obs_egoi_error_message']->value;?>

<?php }?><?php }} ?>