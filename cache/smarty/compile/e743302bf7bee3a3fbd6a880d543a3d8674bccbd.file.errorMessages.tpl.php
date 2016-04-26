<?php /* Smarty version Smarty-3.1.8, created on 2014-10-15 16:05:48
         compiled from "G:\WEB WORK\esystems\astaled\UwAmp\UwAmp\www\modules\data\views\templates\admin\errorMessages.tpl" */ ?>
<?php /*%%SmartyHeaderCode:25894543e7f3c0b34a8-81084626%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e743302bf7bee3a3fbd6a880d543a3d8674bccbd' => 
    array (
      0 => 'G:\\WEB WORK\\esystems\\astaled\\UwAmp\\UwAmp\\www\\modules\\data\\views\\templates\\admin\\errorMessages.tpl',
      1 => 1413379793,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25894543e7f3c0b34a8-81084626',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data_has_error' => 0,
    'data_error_message' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_543e7f3c16e365_31495442',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543e7f3c16e365_31495442')) {function content_543e7f3c16e365_31495442($_smarty_tpl) {?> <?php if ($_smarty_tpl->tpl_vars['data_has_error']->value){?>
	<?php echo $_smarty_tpl->tpl_vars['data_error_message']->value;?>

<?php }?><?php }} ?>