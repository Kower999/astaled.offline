<?php /* Smarty version Smarty-3.1.8, created on 2014-11-11 01:03:48
         compiled from "C:\wamp\www\shopadmin/themes/default\template\controllers\cms_content\content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2979554615264c78e66-58481118%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '66aaa12c3715975610270679698bf82f863061c1' => 
    array (
      0 => 'C:\\wamp\\www\\shopadmin/themes/default\\template\\controllers\\cms_content\\content.tpl',
      1 => 1412842272,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2979554615264c78e66-58481118',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cms_breadcrumb' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_54615264cc5327_76371575',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54615264cc5327_76371575')) {function content_54615264cc5327_76371575($_smarty_tpl) {?>
<?php if (isset($_smarty_tpl->tpl_vars['cms_breadcrumb']->value)){?>
	<div class="cat_bar">
		<span style="color: #3C8534;"><?php echo smartyTranslate(array('s'=>'Current category'),$_smarty_tpl);?>
 :</span>&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['cms_breadcrumb']->value;?>

	</div>
<?php }?>

<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

<?php }} ?>