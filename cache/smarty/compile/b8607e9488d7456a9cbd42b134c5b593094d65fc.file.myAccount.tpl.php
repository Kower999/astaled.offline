<?php /* Smarty version Smarty-3.1.8, created on 2014-10-09 20:50:00
         compiled from "G:\WEB WORK\esystems\astaled\UwAmp\UwAmp\www\modules\obsegoi\views\templates\admin\myAccount.tpl" */ ?>
<?php /*%%SmartyHeaderCode:22735436d8d853ec62-90061353%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b8607e9488d7456a9cbd42b134c5b593094d65fc' => 
    array (
      0 => 'G:\\WEB WORK\\esystems\\astaled\\UwAmp\\UwAmp\\www\\modules\\obsegoi\\views\\templates\\admin\\myAccount.tpl',
      1 => 1396508198,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22735436d8d853ec62-90061353',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'obsShowApiKeyWarn' => 0,
    'clientData' => 0,
    'key' => 0,
    'value' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5436d8d85f9b12_54721852',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5436d8d85f9b12_54721852')) {function content_5436d8d85f9b12_54721852($_smarty_tpl) {?> 
<?php echo $_smarty_tpl->getSubTemplate ('./errorMessages.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('./noApiKeyWarn.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php if (!$_smarty_tpl->tpl_vars['obsShowApiKeyWarn']->value){?>
	<fieldset>
		<legend><img alt="<?php echo smartyTranslate(array('s'=>'Account Details','mod'=>'obsegoi'),$_smarty_tpl);?>
" src="../img/admin/details.gif"/> <?php echo smartyTranslate(array('s'=>'Account Details','mod'=>'obsegoi'),$_smarty_tpl);?>
</legend>
		<?php if ($_smarty_tpl->tpl_vars['clientData']->value){?>
			<table class="table">
				<tr><th colspan="2">Account Data</th></tr>
				<?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['clientData']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
				<tr><td width="200"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['obs_l'][0][0]->getTranslation(array('l'=>$_smarty_tpl->tpl_vars['key']->value),$_smarty_tpl);?>
</td><td width="200"><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</td></tr>
				<?php } ?>
			</table>
		<?php }else{ ?>
			<?php echo smartyTranslate(array('s'=>'Error retrieving client data','mod'=>'obsegoi'),$_smarty_tpl);?>

		<?php }?>
	</fieldset>
<?php }?><?php }} ?>