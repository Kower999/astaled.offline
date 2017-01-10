<?php /* Smarty version Smarty-3.1.8, created on 2015-01-18 23:40:43
         compiled from "/var/www/virtual/esystem.sk/htdocs/clients/astaledonline/pdf/supply-order.tpl" */ ?>
<?php /*%%SmartyHeaderCode:73232070754bc366b1ae0b8-69651831%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '97b9962038056c17a539b419afacfc04b51bcf5d' => 
    array (
      0 => '/var/www/virtual/esystem.sk/htdocs/clients/astaledonline/pdf/supply-order.tpl',
      1 => 1420467766,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '73232070754bc366b1ae0b8-69651831',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'shop_name' => 0,
    'address_warehouse' => 0,
    'supply_order' => 0,
    'address_supplier' => 0,
    'supply_order_details' => 0,
    'supply_order_detail' => 0,
    'currency' => 0,
    'tax_order_summary' => 0,
    'entry' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_54bc366b3d05c1_29271772',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54bc366b3d05c1_29271772')) {function content_54bc366b3d05c1_29271772($_smarty_tpl) {?>
<div style="font-size: 9pt; color: #444">

	<!-- SHOP ADDRESS -->
	<div>
		<table style="width: 100%">
			<tr>
				<td style="font-size: 13pt; font-weight: bold"><?php echo $_smarty_tpl->tpl_vars['shop_name']->value;?>
</td>
			</tr>
			<tr>
				<td style="font-size: 13pt; font-weight: bold"><?php echo $_smarty_tpl->tpl_vars['address_warehouse']->value->address1;?>
</td>
			</tr>
			
			<?php if (!empty($_smarty_tpl->tpl_vars['address_warehouse']->value->address2)){?>
			<tr>
				<td style="font-size: 13pt; font-weight: bold"><?php echo $_smarty_tpl->tpl_vars['address_warehouse']->value->address2;?>
</td>
			</tr>
			<?php }?>
			<tr>
				<td style="font-size: 13pt; font-weight: bold"><?php echo $_smarty_tpl->tpl_vars['address_warehouse']->value->postcode;?>
 <?php echo $_smarty_tpl->tpl_vars['address_warehouse']->value->city;?>
</td>
			</tr>
		</table>
	</div>
	<!-- / SHOP ADDRESS -->
	
	<!-- SUPPLIER ADDRESS -->
	<div style="text-align: right;">
		<table style="width: 70%">
			<tr>
				<td style="font-size: 13pt; font-weight: bold"><?php echo $_smarty_tpl->tpl_vars['supply_order']->value->supplier_name;?>
</td>
			</tr>
			<tr>
				<td style="font-size: 13pt; font-weight: bold"><?php echo $_smarty_tpl->tpl_vars['address_supplier']->value->address1;?>
</td>
			</tr>
			
			<?php if (!empty($_smarty_tpl->tpl_vars['address_supplier']->value->address2)){?>
			<tr>
				<td style="font-size: 13pt; font-weight: bold"><?php echo $_smarty_tpl->tpl_vars['address_supplier']->value->address2;?>
</td>
			</tr>
			<?php }?>
			<tr>
				<td style="font-size: 13pt; font-weight: bold"><?php echo $_smarty_tpl->tpl_vars['address_supplier']->value->postcode;?>
 <?php echo $_smarty_tpl->tpl_vars['address_supplier']->value->city;?>
</td>
			</tr>
			<tr>
				<td style="font-size: 13pt; font-weight: bold"><?php echo $_smarty_tpl->tpl_vars['address_supplier']->value->country;?>
</td>
			</tr>
		</table>
	</div>
	<!-- / SUPPLIER ADDRESS -->

	<table>
		<tr><td style="line-height: 8px">&nbsp;</td></tr>
	</table>

	<?php echo smartyTranslate(array('s'=>'Products ordered:','pdf'=>'true'),$_smarty_tpl);?>

	<!-- PRODUCTS -->
	<div style="font-size: 5pt;">
		<table style="width: 100%;">
			<tr style="line-height:6px; border: none">
				<td style="width: 14%; text-align: left; background-color: #4D4D4D; color: #FFF; padding-left: 2px; font-weight: bold;"><?php echo smartyTranslate(array('s'=>'Reference','pdf'=>'true'),$_smarty_tpl);?>
</td>
				<td style="width: 21%; text-align: left; background-color: #4D4D4D; color: #FFF; padding-left: 2px; font-weight: bold;"><?php echo smartyTranslate(array('s'=>'Designation','pdf'=>'true'),$_smarty_tpl);?>
</td>
				<td style="width: 5%; text-align: left; background-color: #4D4D4D; color: #FFF; padding-left: 2px; font-weight: bold;"><?php echo smartyTranslate(array('s'=>'Qty','pdf'=>'true'),$_smarty_tpl);?>
</td>
				<td style="width: 10%; text-align: left; background-color: #4D4D4D; color: #FFF; padding-left: 2px; font-weight: bold;"><?php echo smartyTranslate(array('s'=>'Unit Price TE','pdf'=>'true'),$_smarty_tpl);?>
</td>
				<td style="width: 11%; text-align: left; background-color: #4D4D4D; color: #FFF; padding-left: 2px; font-weight: bold;"><?php echo smartyTranslate(array('s'=>'Total TE','pdf'=>'true'),$_smarty_tpl);?>
 <br /> <?php echo smartyTranslate(array('s'=>'Before discount','pdf'=>'true'),$_smarty_tpl);?>
</td>
				<td style="width: 9%; text-align: left; background-color: #4D4D4D; color: #FFF; padding-left: 2px; font-weight: bold;"><?php echo smartyTranslate(array('s'=>'Discount Rate','pdf'=>'true'),$_smarty_tpl);?>
</td>
				<td style="width: 11%; text-align: left; background-color: #4D4D4D; color: #FFF; padding-left: 2px; font-weight: bold;"><?php echo smartyTranslate(array('s'=>'Total TE','pdf'=>'true'),$_smarty_tpl);?>
 <br /> <?php echo smartyTranslate(array('s'=>'After discount','pdf'=>'true'),$_smarty_tpl);?>
</td>
				<td style="width: 9%; text-align: left; background-color: #4D4D4D; color: #FFF; padding-left: 2px; font-weight: bold;"><?php echo smartyTranslate(array('s'=>'Tax rate','pdf'=>'true'),$_smarty_tpl);?>
</td>
				<td style="width: 10%; text-align: left; background-color: #4D4D4D; color: #FFF; padding-left: 2px; font-weight: bold;"><?php echo smartyTranslate(array('s'=>'Total TI','pdf'=>'true'),$_smarty_tpl);?>
</td>
			</tr>
			
			<?php  $_smarty_tpl->tpl_vars['supply_order_detail'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['supply_order_detail']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['supply_order_details']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['supply_order_detail']->key => $_smarty_tpl->tpl_vars['supply_order_detail']->value){
$_smarty_tpl->tpl_vars['supply_order_detail']->_loop = true;
?>
			<tr>
				<td style="text-align: left; padding-left: 1px;"><?php echo $_smarty_tpl->tpl_vars['supply_order_detail']->value->supplier_reference;?>
</td>
				<td style="text-align: left; padding-left: 1px;"><?php echo $_smarty_tpl->tpl_vars['supply_order_detail']->value->name;?>
</td>
				<td style="text-align: right; padding-right: 1px;"><?php echo $_smarty_tpl->tpl_vars['supply_order_detail']->value->quantity_expected;?>
</td>
				<td style="text-align: right; padding-right: 1px;"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;?>
 <?php echo $_smarty_tpl->tpl_vars['supply_order_detail']->value->unit_price_te;?>
 <?php echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
</td>
				<td style="text-align: right; padding-right: 1px;"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;?>
 <?php echo $_smarty_tpl->tpl_vars['supply_order_detail']->value->price_te;?>
 <?php echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
</td>
				<td style="text-align: right; padding-right: 1px;"><?php echo $_smarty_tpl->tpl_vars['supply_order_detail']->value->discount_rate;?>
</td>
				<td style="text-align: right; padding-right: 1px;"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;?>
 <?php echo $_smarty_tpl->tpl_vars['supply_order_detail']->value->price_with_discount_te;?>
 <?php echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
</td>
				<td style="text-align: right; padding-right: 1px;"><?php echo $_smarty_tpl->tpl_vars['supply_order_detail']->value->tax_rate;?>
</td>
				<td style="text-align: right; padding-right: 1px;"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;?>
 <?php echo $_smarty_tpl->tpl_vars['supply_order_detail']->value->price_ti;?>
 <?php echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
</td>
			</tr>
			<?php } ?>
		</table>
	</div>
	<!-- / PRODUCTS -->
	
	<table>
		<tr><td style="line-height: 8px">&nbsp;</td></tr>
	</table>

	<?php echo smartyTranslate(array('s'=>'Taxes:','pdf'=>'true'),$_smarty_tpl);?>

	<!-- PRODUCTS TAXES -->
	<div style="font-size: 6pt;">
		<table style="width: 30%;">
				<tr style="line-height:6px; border: none">
					<td style="text-align: left; background-color: #4D4D4D; color: #FFF; padding-left: 2px; font-weight: bold;"><?php echo smartyTranslate(array('s'=>'Base TE','pdf'=>'true'),$_smarty_tpl);?>
</td>
					<td style="text-align: left; background-color: #4D4D4D; color: #FFF; padding-left: 2px; font-weight: bold;"><?php echo smartyTranslate(array('s'=>'Tax Rate','pdf'=>'true'),$_smarty_tpl);?>
</td>
					<td style="text-align: left; background-color: #4D4D4D; color: #FFF; padding-left: 2px; font-weight: bold;"><?php echo smartyTranslate(array('s'=>'Tax Value','pdf'=>'true'),$_smarty_tpl);?>
</td>
				</tr>
				<?php  $_smarty_tpl->tpl_vars['entry'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entry']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tax_order_summary']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entry']->key => $_smarty_tpl->tpl_vars['entry']->value){
$_smarty_tpl->tpl_vars['entry']->_loop = true;
?>
				<tr style="line-height:6px; border: none">
					<td style="text-align: right; padding-right: 1px;"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;?>
 <?php echo $_smarty_tpl->tpl_vars['entry']->value['base_te'];?>
 <?php echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
</td>
					<td style="text-align: right; padding-right: 1px;"><?php echo $_smarty_tpl->tpl_vars['entry']->value['tax_rate'];?>
</td>
					<td style="text-align: right; padding-right: 1px;"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;?>
 <?php echo $_smarty_tpl->tpl_vars['entry']->value['total_tax_value'];?>
 <?php echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
</td>
				</tr>
				<?php } ?>
		</table>
	</div>
	<!-- / PRODUCTS TAXES -->
	
	<table>
		<tr><td style="line-height: 8px">&nbsp;</td></tr>
	</table>
	
	<?php echo smartyTranslate(array('s'=>'Summary:','pdf'=>'true'),$_smarty_tpl);?>

	<!-- TOTAL -->
	<div style="font-size: 6pt;">
		<table style="width: 30%;">
				<tr style="line-height:6px; border: none">
					<td style="text-align: left; background-color: #4D4D4D; color: #FFF; padding-left: 2px; font-weight: bold;"><?php echo smartyTranslate(array('s'=>'Total TE','pdf'=>'true'),$_smarty_tpl);?>
 <br /> <?php echo smartyTranslate(array('s'=>'(Discount excluded)','pdf'=>'true'),$_smarty_tpl);?>
</td>
					<td width="43px" style="text-align: right;"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;?>
 <?php echo $_smarty_tpl->tpl_vars['supply_order']->value->total_te;?>
 <?php echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
</td>
				</tr>
				<tr style="line-height:6px; border: none">
					<td style="text-align: left; background-color: #4D4D4D; color: #FFF; padding-left: 2px; font-weight: bold;"><?php echo smartyTranslate(array('s'=>'Order Discount','pdf'=>'true'),$_smarty_tpl);?>
</td>
					<td width="43px" style="text-align: right;"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;?>
 <?php echo $_smarty_tpl->tpl_vars['supply_order']->value->discount_value_te;?>
 <?php echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
</td>
				</tr>
				<tr style="line-height:6px; border: none">
					<td style="text-align: left; background-color: #4D4D4D; color: #FFF; padding-left: 2px; font-weight: bold;"><?php echo smartyTranslate(array('s'=>'Total TE','pdf'=>'true'),$_smarty_tpl);?>
 <br /> <?php echo smartyTranslate(array('s'=>'(Discount included)','pdf'=>'true'),$_smarty_tpl);?>
</td>
					<td width="43px" style="text-align: right;"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;?>
 <?php echo $_smarty_tpl->tpl_vars['supply_order']->value->total_with_discount_te;?>
 <?php echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
</td>
				</tr>
				<tr style="line-height:6px; border: none">
					<td style="text-align: left; background-color: #4D4D4D; color: #FFF; padding-left: 2px; font-weight: bold;"><?php echo smartyTranslate(array('s'=>'Tax value','pdf'=>'true'),$_smarty_tpl);?>
</td>
					<td width="43px" style="text-align: right;"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;?>
 <?php echo $_smarty_tpl->tpl_vars['supply_order']->value->total_tax;?>
 <?php echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
</td>
				</tr>
				<tr style="line-height:6px; border: none">
					<td style="text-align: left; background-color: #4D4D4D; color: #FFF; padding-left: 2px; font-weight: bold;"><?php echo smartyTranslate(array('s'=>'Total TI','pdf'=>'true'),$_smarty_tpl);?>
</td>
					<td width="43px" style="text-align: right;"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;?>
 <?php echo $_smarty_tpl->tpl_vars['supply_order']->value->total_ti;?>
 <?php echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
</td>
				</tr>
				<tr style="line-height:6px; border: none">
					<td style="text-align: left; background-color: #4D4D4D; color: #FFF; padding-left: 2px; font-weight: bold;"><?php echo smartyTranslate(array('s'=>'TOTAL TO PAY','pdf'=>'true'),$_smarty_tpl);?>
</td>
					<td width="43px" style="text-align: right;"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;?>
 <?php echo $_smarty_tpl->tpl_vars['supply_order']->value->total_ti;?>
 <?php echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
</td>
				</tr>
		</table>
	</div>
	<!-- / TOTAL -->
</div>
<?php }} ?>