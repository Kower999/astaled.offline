<?php /* Smarty version Smarty-3.1.8, created on 2014-10-09 12:01:46
         compiled from "G:\WEB WORK\esystems\astaled\UwAmp\UwAmp\www\shopadmin\themes\default\template\helpers\list\list_action_delete.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2104254365d0a2123e1-48253147%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fcb52e2db4bc3cf194e72c5a8fd99a6775b250c6' => 
    array (
      0 => 'G:\\WEB WORK\\esystems\\astaled\\UwAmp\\UwAmp\\www\\shopadmin\\themes\\default\\template\\helpers\\list\\list_action_delete.tpl',
      1 => 1412842281,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2104254365d0a2123e1-48253147',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'href' => 0,
    'confirm' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_54365d0a2719c9_73262332',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54365d0a2719c9_73262332')) {function content_54365d0a2719c9_73262332($_smarty_tpl) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
" class="delete" <?php if (isset($_smarty_tpl->tpl_vars['confirm']->value)){?>onclick="if (confirm('<?php echo $_smarty_tpl->tpl_vars['confirm']->value;?>
')){ return true; }else{ event.stopPropagation(); event.preventDefault();};"<?php }?> title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">
	<img src="../img/admin/delete.gif" alt="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
</a><?php }} ?>