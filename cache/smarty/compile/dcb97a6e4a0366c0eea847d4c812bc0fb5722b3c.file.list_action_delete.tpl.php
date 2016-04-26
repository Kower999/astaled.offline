<?php /* Smarty version Smarty-3.1.8, created on 2015-01-30 22:49:37
         compiled from "/var/www/virtual/esystem.sk/htdocs/clients/astaledonline/shopadmin/themes/default/template/helpers/list/list_action_delete.tpl" */ ?>
<?php /*%%SmartyHeaderCode:185007253054cbfc711daa10-09296039%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dcb97a6e4a0366c0eea847d4c812bc0fb5722b3c' => 
    array (
      0 => '/var/www/virtual/esystem.sk/htdocs/clients/astaledonline/shopadmin/themes/default/template/helpers/list/list_action_delete.tpl',
      1 => 1420467848,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '185007253054cbfc711daa10-09296039',
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
  'unifunc' => 'content_54cbfc711f5bb0_19384547',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54cbfc711f5bb0_19384547')) {function content_54cbfc711f5bb0_19384547($_smarty_tpl) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
" class="delete" <?php if (isset($_smarty_tpl->tpl_vars['confirm']->value)){?>onclick="if (confirm('<?php echo $_smarty_tpl->tpl_vars['confirm']->value;?>
')){ return true; }else{ event.stopPropagation(); event.preventDefault();};"<?php }?> title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">
	<img src="../img/admin/delete.gif" alt="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
</a><?php }} ?>