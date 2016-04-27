<?php /* Smarty version Smarty-3.1.8, created on 2016-04-27 11:59:31
         compiled from "C:\wamp\www\shopadmin/themes/default\template\controllers\products\input_text_lang.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1312654f482a66d4239-14398681%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'af9c8d49da0beb2be291099b095c76c63fc3cad9' => 
    array (
      0 => 'C:\\wamp\\www\\shopadmin/themes/default\\template\\controllers\\products\\input_text_lang.tpl',
      1 => 1461742550,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1312654f482a66d4239-14398681',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_54f482a66fe192_31539457',
  'variables' => 
  array (
    'languages' => 0,
    'language' => 0,
    'input_name' => 0,
    'input_value' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f482a66fe192_31539457')) {function content_54f482a66fe192_31539457($_smarty_tpl) {?>

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