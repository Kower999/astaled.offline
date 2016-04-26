<?php /* Smarty version Smarty-3.1.8, created on 2014-11-03 23:50:38
         compiled from "/var/www/virtual/esystem.sk/htdocs/clients/astaledonline/shopadmin/themes/default/template/controllers/cms_content/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:693182850545806beefb9f6-21475395%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e0a75a886bae6c2834891937e71dc3d9258303d1' => 
    array (
      0 => '/var/www/virtual/esystem.sk/htdocs/clients/astaledonline/shopadmin/themes/default/template/controllers/cms_content/content.tpl',
      1 => 1415050734,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '693182850545806beefb9f6-21475395',
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
  'unifunc' => 'content_545806bef122e5_19592651',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_545806bef122e5_19592651')) {function content_545806bef122e5_19592651($_smarty_tpl) {?>
<?php if (isset($_smarty_tpl->tpl_vars['cms_breadcrumb']->value)){?>
	<div class="cat_bar">
		<span style="color: #3C8534;"><?php echo smartyTranslate(array('s'=>'Current category'),$_smarty_tpl);?>
 :</span>&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['cms_breadcrumb']->value;?>

	</div>
<?php }?>

<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

<?php }} ?>