<?php /* Smarty version Smarty-3.1.8, created on 2016-01-22 12:06:33
         compiled from "C:\wamp\www\shopadmin\themes\default\template\helpers\list\list_action_delete.tpl" */ ?>
<?php /*%%SmartyHeaderCode:89195501bee508d243-64763259%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '494cee4f93d6189b8c295237edbe1445e7319680' => 
    array (
      0 => 'C:\\wamp\\www\\shopadmin\\themes\\default\\template\\helpers\\list\\list_action_delete.tpl',
      1 => 1449845524,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '89195501bee508d243-64763259',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5501bee50a4080_12067181',
  'variables' => 
  array (
    'href' => 0,
    'confirm' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5501bee50a4080_12067181')) {function content_5501bee50a4080_12067181($_smarty_tpl) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
" class="delete" <?php if (isset($_smarty_tpl->tpl_vars['confirm']->value)){?>onclick="if (confirm('<?php echo $_smarty_tpl->tpl_vars['confirm']->value;?>
')){ return true; }else{ event.stopPropagation(); event.preventDefault();};"<?php }?> title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">
	<img src="../img/admin/delete.gif" alt="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
</a><?php }} ?>