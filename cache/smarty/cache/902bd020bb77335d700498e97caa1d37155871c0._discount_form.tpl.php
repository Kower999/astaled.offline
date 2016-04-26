<?php /*%%SmartyHeaderCode:25801552645338e55f3-52284985%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '902bd020bb77335d700498e97caa1d37155871c0' => 
    array (
      0 => 'C:\\wamp\\www\\shopadmin/themes/default\\template\\controllers\\orders\\_discount_form.tpl',
      1 => 1427206705,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25801552645338e55f3-52284985',
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_552988d9dc8983_07021939',
  'has_nocache_code' => true,
  'cache_lifetime' => 1,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_552988d9dc8983_07021939')) {function content_552988d9dc8983_07021939($_smarty_tpl) {?>
	<label>N&aacute;zov</label>
	<div class="margin-form">
		<input type="text" name="discount_name" value="" />
	</div>

	<label>Typ</label>
	<div class="margin-form">
		<select name="discount_type" id="discount_type">
			<option value="1">Perc.</option>
			<option value="2">Množstvo</option>
			<option value="3">Doručenie zdarma</option>
		</select>
	</div>

	<div id="discount_value_field">
		<label>Hodnota</label>
		<div class="margin-form">
			<?php if (($_smarty_tpl->tpl_vars['currency']->value->format%2)){?>
				<span id="discount_currency_sign" style="display: none;"><?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</span>
			<?php }?>
			<input type="text" name="discount_value" size="3" />
			<?php if (!($_smarty_tpl->tpl_vars['currency']->value->format%2)){?>
				<span id="discount_currency_sign" style="display: none;"><?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</span>
			<?php }?>
			<span id="discount_percent_symbol">%</span>
			<p class="preference_description" id="discount_value_help" style="width: 95%;display: none;">
				T&aacute;to hodnota mus&iacute; byť vr&aacute;tane DPH.
			</p>
		</div>
	</div>

	<?php if ($_smarty_tpl->tpl_vars['order']->value->hasInvoice()){?>
	<label><?php echo smartyTranslate(array('s'=>'Invoice'),$_smarty_tpl);?>
</label>
	<div class="margin-form">
		<select name="discount_invoice">
			<?php  $_smarty_tpl->tpl_vars['invoice'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['invoice']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['invoices_collection']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['invoice']->key => $_smarty_tpl->tpl_vars['invoice']->value){
$_smarty_tpl->tpl_vars['invoice']->_loop = true;
?>
				<option value="<?php echo $_smarty_tpl->tpl_vars['invoice']->value->id;?>
" selected="selected"><?php echo $_smarty_tpl->tpl_vars['invoice']->value->getInvoiceNumberFormatted($_smarty_tpl->tpl_vars['current_id_lang']->value);?>
 - <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['invoice']->value->total_paid_tax_incl,'currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency),$_smarty_tpl);?>
</option>
			<?php } ?>
		</select><br />
		<input type="checkbox" name="discount_all_invoices" id="discount_all_invoices" value="1" /> <label class="t" for="discount_all_invoices"><?php echo smartyTranslate(array('s'=>'Apply on all invoices'),$_smarty_tpl);?>
</label>
		<p class="preference_description" style="width: 95%">
			<?php echo smartyTranslate(array('s'=>'If you select to create this discount for all invoices, one discount will be created per order invoice.'),$_smarty_tpl);?>

		</p>
	</div>
	<?php }?>

	<p class="center">
		<input class="button" type="submit" name="submitNewVoucher" value="Pridať" />&nbsp;
		<a href="#" id="cancel_add_voucher">Zru&scaron;iť</a>
	</p>

<?php }} ?>