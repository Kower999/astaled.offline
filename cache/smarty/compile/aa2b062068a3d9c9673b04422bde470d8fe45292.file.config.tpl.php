<?php /* Smarty version Smarty-3.1.8, created on 2014-10-09 23:07:35
         compiled from "G:\WEB WORK\esystems\astaled\UwAmp\UwAmp\www\modules\data\views\templates\admin\config.tpl" */ ?>
<?php /*%%SmartyHeaderCode:274975436f9177f50c6-11616394%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aa2b062068a3d9c9673b04422bde470d8fe45292' => 
    array (
      0 => 'G:\\WEB WORK\\esystems\\astaled\\UwAmp\\UwAmp\\www\\modules\\data\\views\\templates\\admin\\config.tpl',
      1 => 1412883283,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '274975436f9177f50c6-11616394',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'obs_egoi_title' => 0,
    'obs_egoi_version' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5436f9178bf3a5_00240607',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5436f9178bf3a5_00240607')) {function content_5436f9178bf3a5_00240607($_smarty_tpl) {?> 


<h2><?php echo $_smarty_tpl->tpl_vars['obs_egoi_title']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['obs_egoi_version']->value;?>
</h2>
<form method="post" action="">
	<fieldset>
		<div id="items">
			<div style="clear:both">
				<label><?php echo smartyTranslate(array('s'=>'Your API Key ','mod'=>'obsegoi'),$_smarty_tpl);?>
</label>
				<div class="margin-form">
					<input type="text" name="obsegoi_api_key" size="55" value="<?php echo Configuration::get('OBSEGOI_API_KEY');?>
" />
				</div>
			</div>
			<div style="clear:both">
				<div style="width:350px" class="margin-form">
					<?php echo smartyTranslate(array('s'=>'To get your API Key, login into your E-goi.com panel, go to your user menu (upper right corner), select "Integrations" and copy the account API key','mod'=>'obsegoi'),$_smarty_tpl);?>

				</div>
			</div>
		</div>
		<div class="margin-form clear">
			<div class="clear pspace"></div>
			<div class="margin-form">
				<input type="submit" name="submitUpdate" value="<?php echo smartyTranslate(array('s'=>'Save','mod'=>'obsegoi'),$_smarty_tpl);?>
" class="button" />
			</div>
		</div>
	</fieldset>
</form>
		<?php }} ?>