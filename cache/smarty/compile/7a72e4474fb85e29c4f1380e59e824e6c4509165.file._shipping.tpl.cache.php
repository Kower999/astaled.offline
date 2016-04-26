<?php /* Smarty version Smarty-3.1.8, created on 2015-05-25 23:07:22
         compiled from "C:\wamp\www\shopadmin/themes/default\template\controllers\orders\_shipping.tpl" */ ?>
<?php /*%%SmartyHeaderCode:27856552645338081f8-46058534%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7a72e4474fb85e29c4f1380e59e824e6c4509165' => 
    array (
      0 => 'C:\\wamp\\www\\shopadmin/themes/default\\template\\controllers\\orders\\_shipping.tpl',
      1 => 1431718754,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27856552645338081f8-46058534',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_552645338b7996_11331413',
  'variables' => 
  array (
    'order' => 1,
    'line' => 1,
    'currency' => 1,
    'link' => 1,
  ),
  'has_nocache_code' => true,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_552645338b7996_11331413')) {function content_552645338b7996_11331413($_smarty_tpl) {?><?php echo '/*%%SmartyNocache:27856552645338081f8-46058534%%*/<?php $_smarty = $_smarty_tpl->smarty; if (!is_callable(\'smarty_modifier_replace\')) include \'C:\\\\wamp\\\\www\\\\tools\\\\smarty\\\\plugins\\\\modifier.replace.php\';
if (!is_callable(\'smarty_modifier_escape\')) include \'C:\\\\wamp\\\\www\\\\tools\\\\smarty\\\\plugins\\\\modifier.escape.php\';
?>/*/%%SmartyNocache:27856552645338081f8-46058534%%*/';?>

<table class="table" width="100%" cellspacing="0" cellpadding="0" id="shipping_table">
<colgroup>
	<col width="15%">
	<col width="15%">
	<col width="">
	<col width="10%">
	<col width="20%">
</colgroup>
	<thead>
	<tr>
		<th><?php echo smartyTranslate(array('s'=>'Date:'),$_smarty_tpl);?>
</th>
		<th><?php echo smartyTranslate(array('s'=>'Type'),$_smarty_tpl);?>
</th>
		<th><?php echo smartyTranslate(array('s'=>'Carrier'),$_smarty_tpl);?>
</th>
		<th><?php echo smartyTranslate(array('s'=>'Weight'),$_smarty_tpl);?>
</th>
		<th><?php echo smartyTranslate(array('s'=>'Shipping cost'),$_smarty_tpl);?>
</th>
		<th><?php echo smartyTranslate(array('s'=>'Tracking number'),$_smarty_tpl);?>
</th>
	</tr>
	</thead>
	<tbody>
	<?php echo '/*%%SmartyNocache:27856552645338081f8-46058534%%*/<?php  $_smarty_tpl->tpl_vars[\'line\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'line\']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars[\'order\']->value->getShipping(); if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'line\']->key => $_smarty_tpl->tpl_vars[\'line\']->value){
$_smarty_tpl->tpl_vars[\'line\']->_loop = true;
?>/*/%%SmartyNocache:27856552645338081f8-46058534%%*/';?>

	<tr>
		<td><?php echo '/*%%SmartyNocache:27856552645338081f8-46058534%%*/<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION][\'dateFormat\'][0][0]->dateFormat(array(\'date\'=>$_smarty_tpl->tpl_vars[\'line\']->value[\'date_add\'],\'full\'=>true),$_smarty_tpl);?>
/*/%%SmartyNocache:27856552645338081f8-46058534%%*/';?>
</td>
		<td><?php echo '/*%%SmartyNocache:27856552645338081f8-46058534%%*/<?php echo $_smarty_tpl->tpl_vars[\'line\']->value[\'type\'];?>
/*/%%SmartyNocache:27856552645338081f8-46058534%%*/';?>
</td>
		<td><?php echo '/*%%SmartyNocache:27856552645338081f8-46058534%%*/<?php echo $_smarty_tpl->tpl_vars[\'line\']->value[\'state_name\'];?>
/*/%%SmartyNocache:27856552645338081f8-46058534%%*/';?>
</td>
		<td><?php echo '/*%%SmartyNocache:27856552645338081f8-46058534%%*/<?php echo sprintf("%.3f",$_smarty_tpl->tpl_vars[\'line\']->value[\'weight\']);?>
/*/%%SmartyNocache:27856552645338081f8-46058534%%*/';?>
 <?php echo '/*%%SmartyNocache:27856552645338081f8-46058534%%*/<?php echo Configuration::get(\'PS_WEIGHT_UNIT\');?>
/*/%%SmartyNocache:27856552645338081f8-46058534%%*/';?>
</td>
		<td>
			<?php echo '/*%%SmartyNocache:27856552645338081f8-46058534%%*/<?php if ($_smarty_tpl->tpl_vars[\'order\']->value->getTaxCalculationMethod()==@PS_TAX_INC){?>/*/%%SmartyNocache:27856552645338081f8-46058534%%*/';?>

				<?php echo '/*%%SmartyNocache:27856552645338081f8-46058534%%*/<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION][\'displayPrice\'][0][0]->displayPriceSmarty(array(\'price\'=>$_smarty_tpl->tpl_vars[\'line\']->value[\'shipping_cost_tax_incl\'],\'currency\'=>$_smarty_tpl->tpl_vars[\'currency\']->value->id),$_smarty_tpl);?>
/*/%%SmartyNocache:27856552645338081f8-46058534%%*/';?>

			<?php echo '/*%%SmartyNocache:27856552645338081f8-46058534%%*/<?php }else{ ?>/*/%%SmartyNocache:27856552645338081f8-46058534%%*/';?>

				<?php echo '/*%%SmartyNocache:27856552645338081f8-46058534%%*/<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION][\'displayPrice\'][0][0]->displayPriceSmarty(array(\'price\'=>$_smarty_tpl->tpl_vars[\'line\']->value[\'shipping_cost_tax_excl\'],\'currency\'=>$_smarty_tpl->tpl_vars[\'currency\']->value->id),$_smarty_tpl);?>
/*/%%SmartyNocache:27856552645338081f8-46058534%%*/';?>

			<?php echo '/*%%SmartyNocache:27856552645338081f8-46058534%%*/<?php }?>/*/%%SmartyNocache:27856552645338081f8-46058534%%*/';?>

		</td>
		<td>
			<span id="shipping_number_show"><?php echo '/*%%SmartyNocache:27856552645338081f8-46058534%%*/<?php if ($_smarty_tpl->tpl_vars[\'line\']->value[\'url\']&&$_smarty_tpl->tpl_vars[\'line\']->value[\'tracking_number\']){?>/*/%%SmartyNocache:27856552645338081f8-46058534%%*/';?>
<a href="<?php echo '/*%%SmartyNocache:27856552645338081f8-46058534%%*/<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars[\'line\']->value[\'url\'],\'@\',$_smarty_tpl->tpl_vars[\'line\']->value[\'tracking_number\']);?>
/*/%%SmartyNocache:27856552645338081f8-46058534%%*/';?>
"><?php echo '/*%%SmartyNocache:27856552645338081f8-46058534%%*/<?php echo $_smarty_tpl->tpl_vars[\'line\']->value[\'tracking_number\'];?>
/*/%%SmartyNocache:27856552645338081f8-46058534%%*/';?>
</a><?php echo '/*%%SmartyNocache:27856552645338081f8-46058534%%*/<?php }else{ ?>/*/%%SmartyNocache:27856552645338081f8-46058534%%*/';?>
<?php echo '/*%%SmartyNocache:27856552645338081f8-46058534%%*/<?php echo $_smarty_tpl->tpl_vars[\'line\']->value[\'tracking_number\'];?>
/*/%%SmartyNocache:27856552645338081f8-46058534%%*/';?>
<?php echo '/*%%SmartyNocache:27856552645338081f8-46058534%%*/<?php }?>/*/%%SmartyNocache:27856552645338081f8-46058534%%*/';?>
</span>
			<?php echo '/*%%SmartyNocache:27856552645338081f8-46058534%%*/<?php if ($_smarty_tpl->tpl_vars[\'line\']->value[\'can_edit\']){?>/*/%%SmartyNocache:27856552645338081f8-46058534%%*/';?>

				<form style="display: inline;" method="post" action="<?php echo '/*%%SmartyNocache:27856552645338081f8-46058534%%*/<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars[\'link\']->value->getAdminLink(\'AdminOrders\'), \'htmlall\', \'UTF-8\');?>
/*/%%SmartyNocache:27856552645338081f8-46058534%%*/';?>
&vieworder&id_order=<?php echo '/*%%SmartyNocache:27856552645338081f8-46058534%%*/<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars[\'order\']->value->id, \'htmlall\', \'UTF-8\');?>
/*/%%SmartyNocache:27856552645338081f8-46058534%%*/';?>
">
					<span class="shipping_number_edit" style="display:none;">
						<input type="hidden" name="id_order_carrier" value="<?php echo '/*%%SmartyNocache:27856552645338081f8-46058534%%*/<?php echo htmlentities($_smarty_tpl->tpl_vars[\'line\']->value[\'id_order_carrier\']);?>
/*/%%SmartyNocache:27856552645338081f8-46058534%%*/';?>
" />
						<input type="text" name="tracking_number" value="<?php echo '/*%%SmartyNocache:27856552645338081f8-46058534%%*/<?php echo htmlentities($_smarty_tpl->tpl_vars[\'line\']->value[\'tracking_number\']);?>
/*/%%SmartyNocache:27856552645338081f8-46058534%%*/';?>
" />
						<input type="submit" class="button" name="submitShippingNumber" value="<?php echo '/*%%SmartyNocache:27856552645338081f8-46058534%%*/<?php echo smartyTranslate(array(\'s\'=>\'Update\'),$_smarty_tpl);?>
/*/%%SmartyNocache:27856552645338081f8-46058534%%*/';?>
" />
					</span>
					<a href="#" class="edit_shipping_number_link"><img src="../img/admin/edit.gif" alt="<?php echo '/*%%SmartyNocache:27856552645338081f8-46058534%%*/<?php echo smartyTranslate(array(\'s\'=>\'Edit\'),$_smarty_tpl);?>
/*/%%SmartyNocache:27856552645338081f8-46058534%%*/';?>
" /></a>
					<a href="#" class="cancel_shipping_number_link" style="display: none;"><img src="../img/admin/disabled.gif" alt="<?php echo '/*%%SmartyNocache:27856552645338081f8-46058534%%*/<?php echo smartyTranslate(array(\'s\'=>\'Cancel\'),$_smarty_tpl);?>
/*/%%SmartyNocache:27856552645338081f8-46058534%%*/';?>
" /></a>
				</form>
			<?php echo '/*%%SmartyNocache:27856552645338081f8-46058534%%*/<?php }?>/*/%%SmartyNocache:27856552645338081f8-46058534%%*/';?>

		</td>
	</tr>
	<?php echo '/*%%SmartyNocache:27856552645338081f8-46058534%%*/<?php } ?>/*/%%SmartyNocache:27856552645338081f8-46058534%%*/';?>

	</tbody>
</table>
<?php }} ?>