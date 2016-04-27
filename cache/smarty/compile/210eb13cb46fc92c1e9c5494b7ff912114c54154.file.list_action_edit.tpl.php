<?php /* Smarty version Smarty-3.1.8, created on 2016-04-27 11:59:18
         compiled from "C:\wamp\www\shopadmin/themes/default\template\helpers\list\list_action_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:316805502e1b21298b8-22308242%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '210eb13cb46fc92c1e9c5494b7ff912114c54154' => 
    array (
      0 => 'C:\\wamp\\www\\shopadmin/themes/default\\template\\helpers\\list\\list_action_edit.tpl',
      1 => 1461742550,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '316805502e1b21298b8-22308242',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5502e1b2134fd1_72352433',
  'variables' => 
  array (
    'href' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5502e1b2134fd1_72352433')) {function content_5502e1b2134fd1_72352433($_smarty_tpl) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
" class="edit" title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">
	<img src="../img/admin/edit.gif" alt="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
</a><?php }} ?>