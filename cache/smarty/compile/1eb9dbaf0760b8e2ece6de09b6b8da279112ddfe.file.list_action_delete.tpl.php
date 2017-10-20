<?php /* Smarty version Smarty-3.1.8, created on 2017-10-20 20:54:15
         compiled from "C:\wamp\www\astaled.offline\shopadmin\themes\default\template\helpers\list\list_action_delete.tpl" */ ?>
<?php /*%%SmartyHeaderCode:49918214859ea46578dad75-49435133%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1eb9dbaf0760b8e2ece6de09b6b8da279112ddfe' => 
    array (
      0 => 'C:\\wamp\\www\\astaled.offline\\shopadmin\\themes\\default\\template\\helpers\\list\\list_action_delete.tpl',
      1 => 1501670721,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '49918214859ea46578dad75-49435133',
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
  'unifunc' => 'content_59ea46578f96f3_32233533',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59ea46578f96f3_32233533')) {function content_59ea46578f96f3_32233533($_smarty_tpl) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
" class="delete" <?php if (isset($_smarty_tpl->tpl_vars['confirm']->value)){?>onclick="if (confirm('<?php echo $_smarty_tpl->tpl_vars['confirm']->value;?>
')){ return true; }else{ event.stopPropagation(); event.preventDefault();};"<?php }?> title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">
	<img src="../img/admin/delete.gif" alt="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
</a><?php }} ?>