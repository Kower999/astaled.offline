<?php /* Smarty version Smarty-3.1.8, created on 2016-01-13 17:12:22
         compiled from "C:\wamp\www\shopadmin/themes/default\template\controllers\not_found\content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2812544818d05b1367-68469487%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e304cab5fe649506dead0065d1f8a49cb757ee11' => 
    array (
      0 => 'C:\\wamp\\www\\shopadmin/themes/default\\template\\controllers\\not_found\\content.tpl',
      1 => 1449845529,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2812544818d05b1367-68469487',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_544818d0605230_61831110',
  'variables' => 
  array (
    'controller' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_544818d0605230_61831110')) {function content_544818d0605230_61831110($_smarty_tpl) {?>
<h1><?php echo smartyTranslate(array('s'=>'The controller %s is missing or invalid.','sprintf'=>$_smarty_tpl->tpl_vars['controller']->value),$_smarty_tpl);?>
</h1>
<ul>
<li><a href="index.php"><?php echo smartyTranslate(array('s'=>'Go to Dashboard'),$_smarty_tpl);?>
</a></li>
<li><a href="#" onclick="window.history.back();"><?php echo smartyTranslate(array('s'=>'Back to previous page'),$_smarty_tpl);?>
</a></li>
</ul>
<?php }} ?>