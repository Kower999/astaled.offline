<?php /* Smarty version Smarty-3.1.8, created on 2014-10-09 21:51:06
         compiled from "G:\WEB WORK\esystems\astaled\UwAmp\UwAmp\www\shopadmin/themes/default\template\controllers\not_found\content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:108285436e72a972847-59618648%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a5ccafb4c2e377a224a3993d4bd805fc9e8e80be' => 
    array (
      0 => 'G:\\WEB WORK\\esystems\\astaled\\UwAmp\\UwAmp\\www\\shopadmin/themes/default\\template\\controllers\\not_found\\content.tpl',
      1 => 1412842272,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '108285436e72a972847-59618648',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'controller' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5436e72aa12bc6_64063082',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5436e72aa12bc6_64063082')) {function content_5436e72aa12bc6_64063082($_smarty_tpl) {?>
<h1><?php echo smartyTranslate(array('s'=>'The controller %s is missing or invalid.','sprintf'=>$_smarty_tpl->tpl_vars['controller']->value),$_smarty_tpl);?>
</h1>
<ul>
<li><a href="index.php"><?php echo smartyTranslate(array('s'=>'Go to Dashboard'),$_smarty_tpl);?>
</a></li>
<li><a href="#" onclick="window.history.back();"><?php echo smartyTranslate(array('s'=>'Back to previous page'),$_smarty_tpl);?>
</a></li>
</ul>
<?php }} ?>