<?php /* Smarty version Smarty-3.1.8, created on 2017-10-18 18:47:18
         compiled from "C:\wamp\www\astaled.offline\shopadmin/themes/default\template\helpers\list\list_action_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24856039259e785966dc889-02913020%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '010ebd4f961e69891c765251c76d1a65f44708e9' => 
    array (
      0 => 'C:\\wamp\\www\\astaled.offline\\shopadmin/themes/default\\template\\helpers\\list\\list_action_view.tpl',
      1 => 1501670721,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24856039259e785966dc889-02913020',
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
  'unifunc' => 'content_59e785966fa853_28675530',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59e785966fa853_28675530')) {function content_59e785966fa853_28675530($_smarty_tpl) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" >
	<img src="../img/admin/details.gif" alt="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
</a><?php }} ?>