<?php /* Smarty version Smarty-3.1.8, created on 2016-01-23 14:18:27
         compiled from "C:\wamp\www/override/controllers\admin\templates\orders\_product_line.tpl" */ ?>
<?php /*%%SmartyHeaderCode:181585463f41d8ce7c3-95386295%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fce25d2fc73b3e02f8e7751b41d3711177eed5a8' => 
    array (
      0 => 'C:\\wamp\\www/override/controllers\\admin\\templates\\orders\\_product_line.tpl',
      1 => 1453505737,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '181585463f41d8ce7c3-95386295',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5463f41dbef920_16703489',
  'variables' => 
  array (
    'order' => 1,
    'product' => 1,
    'product_price_tax_excl' => 1,
    'currency' => 1,
    'product_price' => 1,
    'can_edit' => 1,
    'product_price2' => 1,
    'product_provizia' => 1,
    'product_tax_rate' => 1,
    'refund' => 1,
    'return' => 1,
    'stock_management' => 1,
    'total_price_tax_incl' => 1,
    'productQuantity' => 1,
    'invoices_collection' => 1,
    'invoice' => 1,
    'current_id_lang' => 1,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5463f41dbef920_16703489')) {function content_5463f41dbef920_16703489($_smarty_tpl) {?>




<?php if (($_smarty_tpl->tpl_vars['order']->value->getTaxCalculationMethod()==@PS_TAX_EXC)){?>
	<?php $_smarty_tpl->tpl_vars['product_price'] = new Smarty_variable(($_smarty_tpl->tpl_vars['product']->value['unit_price_tax_excl']+$_smarty_tpl->tpl_vars['product']->value['ecotax']), true, 0);?>
<?php }else{ ?>
	<?php $_smarty_tpl->tpl_vars['product_price'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['unit_price_tax_incl'], true, 0);?>
	<?php $_smarty_tpl->tpl_vars['product_price_tax_excl'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['unit_price_tax_excl'], true, 0);?>
<?php }?>


<?php $_smarty_tpl->tpl_vars['total_price_tax_incl'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['total_price_tax_incl'], true, 0);?>

<?php $_smarty_tpl->tpl_vars['product_tax_rate'] = new Smarty_variable((1+($_smarty_tpl->tpl_vars['product']->value['tax_calculator']->taxes[0]->rate/100)), true, 0);?>

<?php $_smarty_tpl->tpl_vars['product_price2'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['cena_2'], true, 0);?>
<?php if (($_smarty_tpl->tpl_vars['product']->value['unit_price_tax_excl']>=$_smarty_tpl->tpl_vars['product']->value['cena_2'])){?>
    <?php $_smarty_tpl->tpl_vars['product_provizia'] = new Smarty_variable(($_smarty_tpl->tpl_vars['product']->value['unit_price_tax_excl']*$_smarty_tpl->tpl_vars['product']->value['product_quantity']*($_smarty_tpl->tpl_vars['product']->value['provizia']/100)), true, 0);?>
<?php }else{ ?>
    <?php $_smarty_tpl->tpl_vars['product_provizia'] = new Smarty_variable((($_smarty_tpl->tpl_vars['product']->value['unit_price_tax_excl']-$_smarty_tpl->tpl_vars['product']->value['wholesale_price'])/2), true, 0);?>
<?php }?>

<?php if (($_smarty_tpl->tpl_vars['product']->value['product_quantity']>$_smarty_tpl->tpl_vars['product']->value['customizationQuantityTotal'])){?>
<tr<?php if (isset($_smarty_tpl->tpl_vars['product']->value['image'])&&$_smarty_tpl->tpl_vars['product']->value['image']->id&&isset($_smarty_tpl->tpl_vars['product']->value['image_size'])){?> height="<?php echo $_smarty_tpl->tpl_vars['product']->value['image_size'][1]+7;?>
"<?php }?>>
	<td align="center"><?php if (isset($_smarty_tpl->tpl_vars['product']->value['image'])&&$_smarty_tpl->tpl_vars['product']->value['image']->id){?><?php echo $_smarty_tpl->tpl_vars['product']->value['image_tag'];?>
<?php }?></td>
	<td align="center"><?php if (isset($_smarty_tpl->tpl_vars['product']->value['ean13'])){?><?php echo $_smarty_tpl->tpl_vars['product']->value['ean13'];?>
<?php }?></td>    
	<td><a href="index.php?controller=adminproducts&id_product=<?php echo $_smarty_tpl->tpl_vars['product']->value['product_id'];?>
&updateproduct&token=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getAdminToken'][0][0]->getAdminTokenLiteSmarty(array('tab'=>'AdminProducts'),$_smarty_tpl);?>
">
		<span class="productName"><?php echo $_smarty_tpl->tpl_vars['product']->value['product_name'];?>
</span><br />
		<?php if ($_smarty_tpl->tpl_vars['product']->value['product_reference']){?><?php echo smartyTranslate(array('s'=>'Ref:'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['product']->value['product_reference'];?>
<br /><?php }?>
		<?php if ($_smarty_tpl->tpl_vars['product']->value['product_supplier_reference']){?><?php echo smartyTranslate(array('s'=>'Ref Supplier:'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['product']->value['product_supplier_reference'];?>
<?php }?>
	</a></td>
	<td align="center">
		<span class="product_price_show"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['product_price_tax_excl']->value,'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl);?>
</span>
	</td>
	<td align="center">
		<span class="product_price_show"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['product_price']->value,'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl);?>
</span>
		<?php if ($_smarty_tpl->tpl_vars['can_edit']->value){?>
		<span class="product_price_edit" style="display:none;">
			<input type="hidden" name="product_id_order_detail" class="edit_product_id_order_detail" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_order_detail'];?>
" />
			<?php if ($_smarty_tpl->tpl_vars['currency']->value->sign%2){?><?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
<?php }?><input type="text" name="product_price_tax_excl" class="edit_product_price_tax_excl edit_product_price" value="<?php echo Tools::ps_round($_smarty_tpl->tpl_vars['product']->value['unit_price_tax_excl'],2);?>
" size="5" /> <?php if (!($_smarty_tpl->tpl_vars['currency']->value->sign%2)){?><?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
<?php }?> <?php echo smartyTranslate(array('s'=>'tax excl.'),$_smarty_tpl);?>
<br />
			<?php if ($_smarty_tpl->tpl_vars['currency']->value->sign%2){?><?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
<?php }?><input type="text" name="product_price_tax_incl" class="edit_product_price_tax_incl edit_product_price" value="<?php echo Tools::ps_round($_smarty_tpl->tpl_vars['product']->value['unit_price_tax_incl'],2);?>
" size="5" /> <?php if (!($_smarty_tpl->tpl_vars['currency']->value->sign%2)){?><?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
<?php }?> <?php echo smartyTranslate(array('s'=>'tax incl.'),$_smarty_tpl);?>

		</span>
		<?php }?>
	</td>
	<td align="center">
		<span><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['product_price2']->value,'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl);?>
</span>
	</td>
	<td align="center">
		<span class="product_provizia"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['product_provizia']->value,'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl);?>
</span>
        <input type="hidden" class="cena_2" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['cena_2'];?>
" />         
        <input type="hidden" class="provizia" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['provizia'];?>
" />         
        <input type="hidden" class="wholesale_price" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['wholesale_price'];?>
" />                 
        <input type="hidden" class="product_tax_rate" value="<?php echo $_smarty_tpl->tpl_vars['product_tax_rate']->value;?>
" />                 
        
	</td>
	<td align="center" class="productQuantity">
		<span class="product_quantity_show"><?php echo $_smarty_tpl->tpl_vars['product']->value['product_quantity'];?>
</span>
		<?php if ($_smarty_tpl->tpl_vars['can_edit']->value){?>
		<span class="product_quantity_edit" style="display:none;">
			<input type="text" name="product_quantity" class="edit_product_quantity" value="<?php echo htmlentities($_smarty_tpl->tpl_vars['product']->value['product_quantity']);?>
" size="2" />
		</span>
		<?php }?>
	</td>
	<?php if (($_smarty_tpl->tpl_vars['order']->value->hasBeenPaid())){?>
		<td align="center" class="productQuantity">
			<?php echo $_smarty_tpl->tpl_vars['product']->value['product_quantity_refunded'];?>

			<?php if (count($_smarty_tpl->tpl_vars['product']->value['refund_history'])){?>
				<span class="tooltip">
					<span class="tooltip_label tooltip_button">+</span>
					<div class="tooltip_content">
					<span class="title"><?php echo smartyTranslate(array('s'=>'Refund history'),$_smarty_tpl);?>
</span>
					<?php  $_smarty_tpl->tpl_vars['refund'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['refund']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value['refund_history']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['refund']->key => $_smarty_tpl->tpl_vars['refund']->value){
$_smarty_tpl->tpl_vars['refund']->_loop = true;
?>
						<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0][0]->dateFormat(array('date'=>$_smarty_tpl->tpl_vars['refund']->value['date_add']),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['refund']->value['amount_tax_incl']),$_smarty_tpl);?>
<?php $_tmp2=ob_get_clean();?><?php echo smartyTranslate(array('s'=>'%1s - %2s','sprintf'=>array($_tmp1,$_tmp2)),$_smarty_tpl);?>
<br />
					<?php } ?>
					</div>
				</span>
			<?php }?>
		</td>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['order']->value->hasBeenDelivered()||$_smarty_tpl->tpl_vars['order']->value->hasProductReturned()){?>
		<td align="center" class="productQuantity">
			<?php echo $_smarty_tpl->tpl_vars['product']->value['product_quantity_return'];?>

			<?php if (count($_smarty_tpl->tpl_vars['product']->value['return_history'])){?>
				<span class="tooltip">
					<span class="tooltip_label tooltip_button">+</span>
					<div class="tooltip_content">
					<span class="title"><?php echo smartyTranslate(array('s'=>'Return history'),$_smarty_tpl);?>
</span>
					<?php  $_smarty_tpl->tpl_vars['return'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['return']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value['return_history']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['return']->key => $_smarty_tpl->tpl_vars['return']->value){
$_smarty_tpl->tpl_vars['return']->_loop = true;
?>
						<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0][0]->dateFormat(array('date'=>$_smarty_tpl->tpl_vars['return']->value['date_add']),$_smarty_tpl);?>
<?php $_tmp3=ob_get_clean();?><?php echo smartyTranslate(array('s'=>'%1s - %2s - %3s','sprintf'=>array($_tmp3,$_smarty_tpl->tpl_vars['return']->value['product_quantity'],$_smarty_tpl->tpl_vars['return']->value['state'])),$_smarty_tpl);?>
<br />
					<?php } ?>
					</div>
				</span>
			<?php }?>
		</td>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['stock_management']->value){?><td align="center" class="productQuantity product_stock"><?php echo $_smarty_tpl->tpl_vars['product']->value['current_stock'];?>
</td><?php }?>
	<td align="center" class="total_product">
		<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>(Tools::ps_round($_smarty_tpl->tpl_vars['total_price_tax_incl']->value,2)),'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl);?>

	</td>
	<td colspan="2" style="display: none;" class="add_product_fields">&nbsp;</td>
	<td align="center" class="cancelCheck standard_refund_fields current-edit" style="display:none">
		<input type="hidden" name="totalQtyReturn" id="totalQtyReturn" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['product_quantity_return'];?>
" />
		<input type="hidden" name="totalQty" id="totalQty" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['product_quantity'];?>
" />
		<input type="hidden" name="productName" id="productName" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['product_name'];?>
" />
	<?php if (((!$_smarty_tpl->tpl_vars['order']->value->hasBeenDelivered()||Configuration::get('PS_ORDER_RETURN'))&&(int)($_smarty_tpl->tpl_vars['product']->value['product_quantity_return'])<(int)($_smarty_tpl->tpl_vars['product']->value['product_quantity']))){?>
		<input type="checkbox" name="id_order_detail[<?php echo $_smarty_tpl->tpl_vars['product']->value['id_order_detail'];?>
]" id="id_order_detail[<?php echo $_smarty_tpl->tpl_vars['product']->value['id_order_detail'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_order_detail'];?>
" onchange="setCancelQuantity(this, <?php echo $_smarty_tpl->tpl_vars['product']->value['id_order_detail'];?>
, <?php echo $_smarty_tpl->tpl_vars['product']->value['product_quantity_in_stock']-$_smarty_tpl->tpl_vars['product']->value['customizationQuantityTotal']-$_smarty_tpl->tpl_vars['product']->value['product_quantity_reinjected'];?>
)" <?php if (($_smarty_tpl->tpl_vars['product']->value['product_quantity_return']+$_smarty_tpl->tpl_vars['product']->value['product_quantity_refunded']>=$_smarty_tpl->tpl_vars['product']->value['product_quantity'])){?>disabled="disabled" <?php }?>/>
	<?php }else{ ?>
		--
	<?php }?>
	</td>
	<td class="cancelQuantity standard_refund_fields current-edit" style="display:none">
	<?php if (($_smarty_tpl->tpl_vars['product']->value['product_quantity_return']+$_smarty_tpl->tpl_vars['product']->value['product_quantity_refunded']>=$_smarty_tpl->tpl_vars['product']->value['product_quantity'])){?>
		<input type="hidden" name="cancelQuantity[<?php echo $_smarty_tpl->tpl_vars['product']->value['id_order_detail'];?>
]" value="0" />
	<?php }elseif((!$_smarty_tpl->tpl_vars['order']->value->hasBeenDelivered()||Configuration::get('PS_ORDER_RETURN'))){?>
		<input type="text" id="cancelQuantity_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_order_detail'];?>
" name="cancelQuantity[<?php echo $_smarty_tpl->tpl_vars['product']->value['id_order_detail'];?>
]" size="2" onclick="selectCheckbox(this);" value="" />
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['product']->value['customizationQuantityTotal']){?>
		<?php $_smarty_tpl->tpl_vars['productQuantity'] = new Smarty_variable(($_smarty_tpl->tpl_vars['product']->value['product_quantity']-$_smarty_tpl->tpl_vars['product']->value['customizationQuantityTotal']), true, 0);?>
	<?php }else{ ?>
		<?php $_smarty_tpl->tpl_vars['productQuantity'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['product_quantity'], true, 0);?>
	<?php }?>

	<?php if (($_smarty_tpl->tpl_vars['order']->value->hasBeenDelivered())){?>
		<?php echo $_smarty_tpl->tpl_vars['product']->value['product_quantity_refunded'];?>
/<?php echo $_smarty_tpl->tpl_vars['productQuantity']->value-$_smarty_tpl->tpl_vars['product']->value['product_quantity_refunded'];?>

	<?php }elseif(($_smarty_tpl->tpl_vars['order']->value->hasBeenPaid())){?>
		<?php echo $_smarty_tpl->tpl_vars['product']->value['product_quantity_return'];?>
/<?php echo $_smarty_tpl->tpl_vars['productQuantity']->value;?>

	<?php }else{ ?>
		0/<?php echo $_smarty_tpl->tpl_vars['productQuantity']->value;?>

	<?php }?>
	</td>
	<td class="partial_refund_fields current-edit" style="text-align:left;display:none">
		<div style="width:40%;margin-top:5px;float:left"><?php echo smartyTranslate(array('s'=>'Quantity:'),$_smarty_tpl);?>
</div> <div style="width:60%;margin-top:2px;float:left"><input onchange="checkPartialRefundProductQuantity(this)" type="text" size="3" name="partialRefundProductQuantity[<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['product']->value['id_order_detail'];?>
<?php $_tmp4=ob_get_clean();?><?php echo $_tmp4;?>
]" value="0" /> 0/<?php echo $_smarty_tpl->tpl_vars['productQuantity']->value-$_smarty_tpl->tpl_vars['product']->value['product_quantity_refunded'];?>
</div>
		<div style="width:40%;margin-top:5px;float:left"><?php echo smartyTranslate(array('s'=>'Amount:'),$_smarty_tpl);?>
</div> <div style="width:60%;margin-top:2px;float:left"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;?>
<input onchange="checkPartialRefundProductAmount(this)" type="text" size="3" name="partialRefundProduct[<?php echo $_smarty_tpl->tpl_vars['product']->value['id_order_detail'];?>
]" /> <?php echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
</div> <?php if (!empty($_smarty_tpl->tpl_vars['product']->value['amount_refund'])&&$_smarty_tpl->tpl_vars['product']->value['amount_refund']>0){?>(<?php echo smartyTranslate(array('s'=>'%s refund','sprintf'=>$_smarty_tpl->tpl_vars['product']->value['amount_refund']),$_smarty_tpl);?>
)<?php }?>
		<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['quantity_refundable'];?>
" class="partialRefundProductQuantity" />
		<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['amount_refundable'];?>
" class="partialRefundProductAmount" />
	</td>
	<?php if (($_smarty_tpl->tpl_vars['can_edit']->value)){?>
	<td class="product_invoice" colspan="2" style="display: none;text-align:center;">
		<?php if (sizeof($_smarty_tpl->tpl_vars['invoices_collection']->value)){?>
		<select name="product_invoice" class="edit_product_invoice">
			<?php  $_smarty_tpl->tpl_vars['invoice'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['invoice']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['invoices_collection']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['invoice']->key => $_smarty_tpl->tpl_vars['invoice']->value){
$_smarty_tpl->tpl_vars['invoice']->_loop = true;
?>
			<option value="<?php echo $_smarty_tpl->tpl_vars['invoice']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['invoice']->value->id==$_smarty_tpl->tpl_vars['product']->value['id_order_invoice']){?>selected="selected"<?php }?>>#<?php echo Configuration::get('PS_INVOICE_PREFIX',$_smarty_tpl->tpl_vars['current_id_lang']->value);?>
<?php echo sprintf('%06d',$_smarty_tpl->tpl_vars['invoice']->value->number);?>
</option>
			<?php } ?>
		</select>
		<?php }else{ ?>
		&nbsp;
		<?php }?>
	</td>
	<td class="product_action" style="text-align:right">
		<a href="#" class="edit_product_change_link"><img src="../img/admin/edit.gif" alt="<?php echo smartyTranslate(array('s'=>'Edit'),$_smarty_tpl);?>
" /></a>
		<input type="submit" class="button" name="submitProductChange" value="<?php echo smartyTranslate(array('s'=>'Update'),$_smarty_tpl);?>
"  style="display: none;" />
		<a href="#" class="cancel_product_change_link" style="display: none;"><img src="../img/admin/disabled.gif" alt="<?php echo smartyTranslate(array('s'=>'Cancel'),$_smarty_tpl);?>
" /></a>
		<a href="#" class="delete_product_line"><img src="../img/admin/delete.gif" alt="<?php echo smartyTranslate(array('s'=>'Delete'),$_smarty_tpl);?>
" /></a>
	</td>
	<?php }?>
</tr>
<?php }?>
<?php }} ?>