<?php /* Smarty version Smarty-3.1.8, created on 2014-10-09 19:30:10
         compiled from "G:\WEB WORK\esystems\astaled\UwAmp\UwAmp\www\shopadmin/themes/default\template\helpers\list\list_action_details.tpl" */ ?>
<?php /*%%SmartyHeaderCode:70585436c622487ab9-89838360%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c1782b4d90e7ba6c10e131ec45fc50727c0fdc0e' => 
    array (
      0 => 'G:\\WEB WORK\\esystems\\astaled\\UwAmp\\UwAmp\\www\\shopadmin/themes/default\\template\\helpers\\list\\list_action_details.tpl',
      1 => 1412842282,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '70585436c622487ab9-89838360',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'params' => 0,
    'id' => 0,
    'action' => 0,
    'controller' => 0,
    'token' => 0,
    'json_params' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5436c6225058d4_21034499',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5436c6225058d4_21034499')) {function content_5436c6225058d4_21034499($_smarty_tpl) {?>

<a class="pointer" id="details_<?php echo $_smarty_tpl->tpl_vars['params']->value['action'];?>
_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" onclick="display_action_details('<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['controller']->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['params']->value['action'];?>
', <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['json_params']->value, ENT_QUOTES, 'UTF-8');?>
); return false">
	<img src="../img/admin/more.png" alt="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
</a>
<?php }} ?>