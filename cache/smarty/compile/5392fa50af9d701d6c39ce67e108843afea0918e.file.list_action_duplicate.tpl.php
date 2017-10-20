<?php /* Smarty version Smarty-3.1.8, created on 2017-10-20 20:02:43
         compiled from "C:\wamp\www\astaled.offline\shopadmin/themes/default\template\helpers\list\list_action_duplicate.tpl" */ ?>
<?php /*%%SmartyHeaderCode:114321209259ea3a43cbc813-98462761%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5392fa50af9d701d6c39ce67e108843afea0918e' => 
    array (
      0 => 'C:\\wamp\\www\\astaled.offline\\shopadmin/themes/default\\template\\helpers\\list\\list_action_duplicate.tpl',
      1 => 1501670721,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '114321209259ea3a43cbc813-98462761',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'action' => 0,
    'confirm' => 0,
    'location_ok' => 0,
    'location_ko' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_59ea3a43cc0748_52003005',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59ea3a43cc0748_52003005')) {function content_59ea3a43cc0748_52003005($_smarty_tpl) {?>
<a class="pointer" title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" onclick="if (confirm('<?php echo $_smarty_tpl->tpl_vars['confirm']->value;?>
')) document.location = '<?php echo $_smarty_tpl->tpl_vars['location_ok']->value;?>
'; else document.location = '<?php echo $_smarty_tpl->tpl_vars['location_ko']->value;?>
';">
	<img src="../img/admin/duplicate.png" alt="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
</a><?php }} ?>