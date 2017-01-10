<?php /* Smarty version Smarty-3.1.8, created on 2014-10-09 20:50:06
         compiled from "G:\WEB WORK\esystems\astaled\UwAmp\UwAmp\www\modules\obsegoi\views\templates\admin\noApiKeyWarn.tpl" */ ?>
<?php /*%%SmartyHeaderCode:183895436d8de895444-15881837%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '00f63e947b2a1e68b1e2e6bdd01e4b18d74c4d1d' => 
    array (
      0 => 'G:\\WEB WORK\\esystems\\astaled\\UwAmp\\UwAmp\\www\\modules\\obsegoi\\views\\templates\\admin\\noApiKeyWarn.tpl',
      1 => 1404726854,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '183895436d8de895444-15881837',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'obsShowApiKeyWarn' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5436d8de981c69_33114669',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5436d8de981c69_33114669')) {function content_5436d8de981c69_33114669($_smarty_tpl) {?> 
<?php if ($_smarty_tpl->tpl_vars['obsShowApiKeyWarn']->value){?>
<div class="warn">
	<span style="float:right">
		<a href="" id="hideWarn"><img src="../img/admin/close.png" alt="X"></a>
	</span>
	<ul style="margin-top: 3px">
		<li><?php echo smartyTranslate(array('s'=>'No API key configured. Please go to the','mod'=>'obsegoi'),$_smarty_tpl);?>

			<a href="index.php?controller=AdminModules&token=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getAdminToken'][0][0]->getAdminTokenLiteSmarty(array('tab'=>'AdminModules'),$_smarty_tpl);?>
&configure=obsegoi"><?php echo smartyTranslate(array('s'=>'module configuration','mod'=>'obsegoi'),$_smarty_tpl);?>
</a>
			<?php echo smartyTranslate(array('s'=>'to add one','mod'=>'obsegoi'),$_smarty_tpl);?>
.<br/>
			<?php echo smartyTranslate(array('s'=>'If you don\'t have an E-Goi account please','mod'=>'obsegoi'),$_smarty_tpl);?>
 <a href="http://www.e-goi.com/index.php?cID=232&aff=3bca14d6c4" target="_blank"><?php echo smartyTranslate(array('s'=>'click here','mod'=>'obsegoi'),$_smarty_tpl);?>
</a>.
			<?php echo smartyTranslate(array('s'=>'If you want to know more about E-Goi','mod'=>'obsegoi'),$_smarty_tpl);?>
 <a href="http://www.e-goi.com/index.php?cID=232&aff=3bca14d6c4" target="_blank"><?php echo smartyTranslate(array('s'=>'click here','mod'=>'obsegoi'),$_smarty_tpl);?>
</a></li>
	</ul>
</div>
<?php }?><?php }} ?>