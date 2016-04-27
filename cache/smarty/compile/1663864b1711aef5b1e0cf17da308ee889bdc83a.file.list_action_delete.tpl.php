<?php /* Smarty version Smarty-3.1.8, created on 2016-04-27 11:59:18
         compiled from "C:\wamp\www\shopadmin/themes/default\template\helpers\list\list_action_delete.tpl" */ ?>
<?php /*%%SmartyHeaderCode:248255502e1b214be14-85266224%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1663864b1711aef5b1e0cf17da308ee889bdc83a' => 
    array (
      0 => 'C:\\wamp\\www\\shopadmin/themes/default\\template\\helpers\\list\\list_action_delete.tpl',
      1 => 1461742550,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '248255502e1b214be14-85266224',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5502e1b2162c45_25590010',
  'variables' => 
  array (
    'href' => 0,
    'confirm' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5502e1b2162c45_25590010')) {function content_5502e1b2162c45_25590010($_smarty_tpl) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
" class="delete" <?php if (isset($_smarty_tpl->tpl_vars['confirm']->value)){?>onclick="if (confirm('<?php echo $_smarty_tpl->tpl_vars['confirm']->value;?>
')){ return true; }else{ event.stopPropagation(); event.preventDefault();};"<?php }?> title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">
	<img src="../img/admin/delete.gif" alt="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
</a><?php }} ?>