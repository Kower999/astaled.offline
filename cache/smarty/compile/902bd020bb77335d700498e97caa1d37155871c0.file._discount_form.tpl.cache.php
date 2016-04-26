<?php /* Smarty version Smarty-3.1.8, created on 2015-05-25 23:07:22
         compiled from "C:\wamp\www\shopadmin/themes/default\template\controllers\orders\_discount_form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:25801552645338e55f3-52284985%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '902bd020bb77335d700498e97caa1d37155871c0' => 
    array (
      0 => 'C:\\wamp\\www\\shopadmin/themes/default\\template\\controllers\\orders\\_discount_form.tpl',
      1 => 1431718754,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25801552645338e55f3-52284985',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_55264533954002_55850304',
  'variables' => 
  array (
    'currency' => 1,
    'order' => 1,
    'invoices_collection' => 1,
    'invoice' => 1,
    'current_id_lang' => 1,
  ),
  'has_nocache_code' => true,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55264533954002_55850304')) {function content_55264533954002_55850304($_smarty_tpl) {?>

	<label><?php echo smartyTranslate(array('s'=>'Name'),$_smarty_tpl);?>
</label>
	<div class="margin-form">
		<input type="text" name="discount_name" value="" />
	</div>

	<label><?php echo smartyTranslate(array('s'=>'Type'),$_smarty_tpl);?>
</label>
	<div class="margin-form">
		<select name="discount_type" id="discount_type">
			<option value="1"><?php echo smartyTranslate(array('s'=>'Percent'),$_smarty_tpl);?>
</option>
			<option value="2"><?php echo smartyTranslate(array('s'=>'Amount'),$_smarty_tpl);?>
</option>
			<option value="3"><?php echo smartyTranslate(array('s'=>'Free shipping'),$_smarty_tpl);?>
</option>
		</select>
	</div>

	<div id="discount_value_field">
		<label><?php echo smartyTranslate(array('s'=>'Value'),$_smarty_tpl);?>
</label>
		<div class="margin-form">
			<?php echo '/*%%SmartyNocache:25801552645338e55f3-52284985%%*/<?php if (($_smarty_tpl->tpl_vars[\'currency\']->value->format%2)){?>/*/%%SmartyNocache:25801552645338e55f3-52284985%%*/';?>

				<span id="discount_currency_sign" style="display: none;"><?php echo '/*%%SmartyNocache:25801552645338e55f3-52284985%%*/<?php echo $_smarty_tpl->tpl_vars[\'currency\']->value->sign;?>
/*/%%SmartyNocache:25801552645338e55f3-52284985%%*/';?>
</span>
			<?php echo '/*%%SmartyNocache:25801552645338e55f3-52284985%%*/<?php }?>/*/%%SmartyNocache:25801552645338e55f3-52284985%%*/';?>

			<input type="text" name="discount_value" size="3" />
			<?php echo '/*%%SmartyNocache:25801552645338e55f3-52284985%%*/<?php if (!($_smarty_tpl->tpl_vars[\'currency\']->value->format%2)){?>/*/%%SmartyNocache:25801552645338e55f3-52284985%%*/';?>

				<span id="discount_currency_sign" style="display: none;"><?php echo '/*%%SmartyNocache:25801552645338e55f3-52284985%%*/<?php echo $_smarty_tpl->tpl_vars[\'currency\']->value->sign;?>
/*/%%SmartyNocache:25801552645338e55f3-52284985%%*/';?>
</span>
			<?php echo '/*%%SmartyNocache:25801552645338e55f3-52284985%%*/<?php }?>/*/%%SmartyNocache:25801552645338e55f3-52284985%%*/';?>

			<span id="discount_percent_symbol">%</span>
			<p class="preference_description" id="discount_value_help" style="width: 95%;display: none;">
				<?php echo smartyTranslate(array('s'=>'This value must be taxes included.'),$_smarty_tpl);?>

			</p>
		</div>
	</div>

	<?php echo '/*%%SmartyNocache:25801552645338e55f3-52284985%%*/<?php if ($_smarty_tpl->tpl_vars[\'order\']->value->hasInvoice()){?>/*/%%SmartyNocache:25801552645338e55f3-52284985%%*/';?>

	<label><?php echo '/*%%SmartyNocache:25801552645338e55f3-52284985%%*/<?php echo smartyTranslate(array(\'s\'=>\'Invoice\'),$_smarty_tpl);?>
/*/%%SmartyNocache:25801552645338e55f3-52284985%%*/';?>
</label>
	<div class="margin-form">
		<select name="discount_invoice">
			<?php echo '/*%%SmartyNocache:25801552645338e55f3-52284985%%*/<?php  $_smarty_tpl->tpl_vars[\'invoice\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'invoice\']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars[\'invoices_collection\']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'invoice\']->key => $_smarty_tpl->tpl_vars[\'invoice\']->value){
$_smarty_tpl->tpl_vars[\'invoice\']->_loop = true;
?>/*/%%SmartyNocache:25801552645338e55f3-52284985%%*/';?>

				<option value="<?php echo '/*%%SmartyNocache:25801552645338e55f3-52284985%%*/<?php echo $_smarty_tpl->tpl_vars[\'invoice\']->value->id;?>
/*/%%SmartyNocache:25801552645338e55f3-52284985%%*/';?>
" selected="selected"><?php echo '/*%%SmartyNocache:25801552645338e55f3-52284985%%*/<?php echo $_smarty_tpl->tpl_vars[\'invoice\']->value->getInvoiceNumberFormatted($_smarty_tpl->tpl_vars[\'current_id_lang\']->value);?>
/*/%%SmartyNocache:25801552645338e55f3-52284985%%*/';?>
 - <?php echo '/*%%SmartyNocache:25801552645338e55f3-52284985%%*/<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION][\'displayPrice\'][0][0]->displayPriceSmarty(array(\'price\'=>$_smarty_tpl->tpl_vars[\'invoice\']->value->total_paid_tax_incl,\'currency\'=>$_smarty_tpl->tpl_vars[\'order\']->value->id_currency),$_smarty_tpl);?>
/*/%%SmartyNocache:25801552645338e55f3-52284985%%*/';?>
</option>
			<?php echo '/*%%SmartyNocache:25801552645338e55f3-52284985%%*/<?php } ?>/*/%%SmartyNocache:25801552645338e55f3-52284985%%*/';?>

		</select><br />
		<input type="checkbox" name="discount_all_invoices" id="discount_all_invoices" value="1" /> <label class="t" for="discount_all_invoices"><?php echo '/*%%SmartyNocache:25801552645338e55f3-52284985%%*/<?php echo smartyTranslate(array(\'s\'=>\'Apply on all invoices\'),$_smarty_tpl);?>
/*/%%SmartyNocache:25801552645338e55f3-52284985%%*/';?>
</label>
		<p class="preference_description" style="width: 95%">
			<?php echo '/*%%SmartyNocache:25801552645338e55f3-52284985%%*/<?php echo smartyTranslate(array(\'s\'=>\'If you select to create this discount for all invoices, one discount will be created per order invoice.\'),$_smarty_tpl);?>
/*/%%SmartyNocache:25801552645338e55f3-52284985%%*/';?>

		</p>
	</div>
	<?php echo '/*%%SmartyNocache:25801552645338e55f3-52284985%%*/<?php }?>/*/%%SmartyNocache:25801552645338e55f3-52284985%%*/';?>


	<p class="center">
		<input class="button" type="submit" name="submitNewVoucher" value="<?php echo smartyTranslate(array('s'=>'Add'),$_smarty_tpl);?>
" />&nbsp;
		<a href="#" id="cancel_add_voucher"><?php echo smartyTranslate(array('s'=>'Cancel'),$_smarty_tpl);?>
</a>
	</p>

<?php }} ?>