<?php /* Smarty version Smarty-3.1.8, created on 2013-02-28 22:22:37
         compiled from "/var/www/virtual/astaled.sk/htdocs/shopadmin/themes/default/template/controllers/products/input_text_lang.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1395410878512fca9db18433-80456772%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '19f98e365d44fe7e0a2707ddd2f74c1f1533403f' => 
    array (
      0 => '/var/www/virtual/astaled.sk/htdocs/shopadmin/themes/default/template/controllers/products/input_text_lang.tpl',
      1 => 1356963554,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1395410878512fca9db18433-80456772',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'languages' => 0,
    'language' => 0,
    'input_name' => 0,
    'input_value' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_512fca9dca5af1_66766822',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_512fca9dca5af1_66766822')) {function content_512fca9dca5af1_66766822($_smarty_tpl) {?>

<div class="translatable">
<?php  $_smarty_tpl->tpl_vars['language'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['language']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['language']->key => $_smarty_tpl->tpl_vars['language']->value){
$_smarty_tpl->tpl_vars['language']->_loop = true;
?>
<div class="lang_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" style="<?php if (!$_smarty_tpl->tpl_vars['language']->value['is_default']){?>display:none;<?php }?>float: left;">
	<input size="30" type="text" id="<?php echo $_smarty_tpl->tpl_vars['input_name']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" 
	name="<?php echo $_smarty_tpl->tpl_vars['input_name']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
"
		value="<?php echo (($tmp = @smarty_modifier_htmlentitiesUTF8($_smarty_tpl->tpl_vars['input_value']->value[$_smarty_tpl->tpl_vars['language']->value['id_lang']]))===null||$tmp==='' ? '' : $tmp);?>
"
		onkeyup="if (isArrowKey(event)) return ;updateFriendlyURL();"/>
</div>
<?php } ?>
</div>
<?php }} ?>