<?php /* Smarty version Smarty-3.1.8, created on 2015-06-08 11:23:40
         compiled from "C:\wamp\www\themes\default\pdf\invoice.tpl" */ ?>
<?php /*%%SmartyHeaderCode:47335501810c9abbd4-43115906%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0417324f8aa25cb2e3d3d790ed0032870a6509c8' => 
    array (
      0 => 'C:\\wamp\\www\\themes\\default\\pdf\\invoice.tpl',
      1 => 1433755417,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '47335501810c9abbd4-43115906',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5501810cddf7b0_07413519',
  'variables' => 
  array (
    'tax_excluded_display' => 0,
    'order_details' => 0,
    'key' => 0,
    'order_detail' => 0,
    'order' => 0,
    'customizationPerAddress' => 0,
    'customization' => 0,
    'customization_infos' => 0,
    'order_invoice' => 0,
    'cart_rules' => 0,
    'cart_rule' => 0,
    'tax_tab' => 0,
    'HOOK_DISPLAY_PDF' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5501810cddf7b0_07413519')) {function content_5501810cddf7b0_07413519($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cycle')) include 'C:\\wamp\\www\\tools\\smarty\\plugins\\function.cycle.php';
?>
<style type="text/css">
    table, td, tr, th   { border-collapse: collapse; border-spacing: 0px; text-indent: 0px; }
    .indent0   { text-indent: -3px;}
    .border   { border: 1px solid #888; }
    .bordertop { border-top: 1px solid #888; }
    .bordertop2 td { border-top: 0.1px solid #BBB; }
    .gray8  { font-size: 8pt; color: #444; }
    .gray12 { font-size: 12pt; color: #444;  }
    .silver8 { font-size: 8pt; color: #777; }
    .silver6    { font-size: 6pt; color: #777; }
    .bold { font-weight: bold; }
    .normal { font-weight: normal; }
    .half { width: 50%; }
    .size8 { font-size: 8pt; }
    .allborders td { border: 0.1px solid #BBB; }
    .thead {  font-weight: bold; font-size: 6pt; }
    .center { text-align: center; }
    .left { text-align: left; }
    .right { text-align: right; }
    .c1 { width: 13%; }
    .c2 { width: 35%; }
    .c3 { width: 8%; }
    .c4 { width: 8%; }
    .c5 { width: 6%; }
    .c6 { width: 7%; }
    .c7 { width: 6%; }
    .c8 { width: 7%; }
    .c9 { width: 10%; }
</style>

<div style="line-height: 1pt">&nbsp;</div>

<!-- PRODUCTS TAB -->
<table class="" style="width: 100%; font-size: 8pt; color: #444" cellspacing="0" cellpadding="3">
    <tbody>                              
                    <tr>
                        <td class="c1 thead center"><?php echo smartyTranslate(array('s'=>'EAN','pdf'=>'true'),$_smarty_tpl);?>
</td>
                        <td class="c2 thead center"><?php echo smartyTranslate(array('s'=>'Product','pdf'=>'true'),$_smarty_tpl);?>
</td>
					    <td class="c8 thead center"><?php echo smartyTranslate(array('s'=>'Qty','pdf'=>'true'),$_smarty_tpl);?>
</td>
					    <td class="c3 thead center"><?php echo smartyTranslate(array('s'=>'Jednotková<br/>cena','pdf'=>'true'),$_smarty_tpl);?>
<br /><?php echo smartyTranslate(array('s'=>'(Tax Excl.)','pdf'=>'true'),$_smarty_tpl);?>
</td>
					    <td class="c4 thead center"><?php echo smartyTranslate(array('s'=>'Jednotková<br/>cena','pdf'=>'true'),$_smarty_tpl);?>
<br /><?php echo smartyTranslate(array('s'=>'(Tax Incl.)','pdf'=>'true'),$_smarty_tpl);?>
</td>
					    <td class="c5 thead center"><?php echo smartyTranslate(array('s'=>'Tax Rate','pdf'=>'true'),$_smarty_tpl);?>
</td>
					    <td class="c6 thead center"><?php echo smartyTranslate(array('s'=>'Tax value','pdf'=>'true'),$_smarty_tpl);?>
</td>
					    <td class="c7 thead center"><?php echo smartyTranslate(array('s'=>'Discount','pdf'=>'true'),$_smarty_tpl);?>
</td>
					    <td class="c9 thead center">
						      <?php echo smartyTranslate(array('s'=>'Total','pdf'=>'true'),$_smarty_tpl);?>

						      <?php if ($_smarty_tpl->tpl_vars['tax_excluded_display']->value){?>
							     <br /><?php echo smartyTranslate(array('s'=>'(Tax Excl.)','pdf'=>'true'),$_smarty_tpl);?>

						      <?php }else{ ?>
							     <br /><?php echo smartyTranslate(array('s'=>'(Tax Incl.)','pdf'=>'true'),$_smarty_tpl);?>

						      <?php }?>
					    </td>
	                </tr>
<!--                
	<tr >
		<td style="text-align: right">
			<table class="" style="width: 100%; font-size: 7pt;" cellspacing="0" cellpadding="1"> -->
				<!-- PRODUCTS -->
                <?php $_smarty_tpl->tpl_vars['key'] = new Smarty_variable(false, null, 0);?>
				<?php  $_smarty_tpl->tpl_vars['order_detail'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['order_detail']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['order_details']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['order_detail']->key => $_smarty_tpl->tpl_vars['order_detail']->value){
$_smarty_tpl->tpl_vars['order_detail']->_loop = true;
?>

                <?php if (!$_smarty_tpl->tpl_vars['key']->value){?>
                    <?php $_smarty_tpl->tpl_vars['key'] = new Smarty_variable(true, null, 0);?>
                <?php }?>
				<?php echo smarty_function_cycle(array('values'=>'#FFF,#EFEFEF','assign'=>'bgcolor'),$_smarty_tpl);?>

				<tr style="line-height:6px;" <?php if ($_smarty_tpl->tpl_vars['key']->value){?>class="bordertop2"<?php }?>>
					<td class="c1 left"><?php if (isset($_smarty_tpl->tpl_vars['order_detail']->value['product_ean13'])&&!empty($_smarty_tpl->tpl_vars['order_detail']->value['product_ean13'])){?><?php echo $_smarty_tpl->tpl_vars['order_detail']->value['product_ean13'];?>
<?php }?></td>
					<td class="c2 left"><?php echo $_smarty_tpl->tpl_vars['order_detail']->value['product_name'];?>
</td>
					<td class="c8 center"><?php echo $_smarty_tpl->tpl_vars['order_detail']->value['product_quantity'];?>
</td>
					<td class="c3 right"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['order_detail']->value['unit_price_tax_excl']),$_smarty_tpl);?>
</td>
					<td class="c4 right"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['order_detail']->value['unit_price_tax_incl']),$_smarty_tpl);?>
</td>
					<td class="c5 center"><?php if ($_smarty_tpl->tpl_vars['order_detail']->value['tax_rate']>0){?><?php echo number_format($_smarty_tpl->tpl_vars['order_detail']->value['tax_rate'],0);?>
<?php }else{ ?><?php echo number_format($_smarty_tpl->tpl_vars['order']->value->carrier_tax_rate,0);?>
<?php }?>%</td>
					<td class="c6 right"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>($_smarty_tpl->tpl_vars['order_detail']->value['unit_price_tax_incl']-$_smarty_tpl->tpl_vars['order_detail']->value['unit_price_tax_excl'])),$_smarty_tpl);?>
</td>
					<td class="c7 right">
					<?php if ((isset($_smarty_tpl->tpl_vars['order_detail']->value['reduction_amount'])&&$_smarty_tpl->tpl_vars['order_detail']->value['reduction_amount']>0)){?>
						-<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['order_detail']->value['reduction_amount']),$_smarty_tpl);?>

					<?php }elseif((isset($_smarty_tpl->tpl_vars['order_detail']->value['reduction_percent'])&&$_smarty_tpl->tpl_vars['order_detail']->value['reduction_percent']>0)){?>
						-<?php echo $_smarty_tpl->tpl_vars['order_detail']->value['reduction_percent'];?>
%
					<?php }else{ ?>
					--
					<?php }?>
					</td>
					<td class="c9 right">
					<?php if ($_smarty_tpl->tpl_vars['tax_excluded_display']->value){?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['order_detail']->value['total_price_tax_excl']),$_smarty_tpl);?>

					<?php }else{ ?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['order_detail']->value['total_price_tax_incl']),$_smarty_tpl);?>

					<?php }?>
					</td>
				</tr>
					<?php  $_smarty_tpl->tpl_vars['customizationPerAddress'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customizationPerAddress']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['order_detail']->value['customizedDatas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customizationPerAddress']->key => $_smarty_tpl->tpl_vars['customizationPerAddress']->value){
$_smarty_tpl->tpl_vars['customizationPerAddress']->_loop = true;
?>
						<?php  $_smarty_tpl->tpl_vars['customization'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customization']->_loop = false;
 $_smarty_tpl->tpl_vars['customizationId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['customizationPerAddress']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customization']->key => $_smarty_tpl->tpl_vars['customization']->value){
$_smarty_tpl->tpl_vars['customization']->_loop = true;
 $_smarty_tpl->tpl_vars['customizationId']->value = $_smarty_tpl->tpl_vars['customization']->key;
?>
							<tr style="line-height:6px;">
								<td style="line-height:3px; text-align: left; width: 50%; vertical-align: top">

										<blockquote>
											<?php if (isset($_smarty_tpl->tpl_vars['customization']->value['datas'][@_CUSTOMIZE_TEXTFIELD_])&&count($_smarty_tpl->tpl_vars['customization']->value['datas'][@_CUSTOMIZE_TEXTFIELD_])>0){?>
												<?php  $_smarty_tpl->tpl_vars['customization_infos'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customization_infos']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customization']->value['datas'][@_CUSTOMIZE_TEXTFIELD_]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customization_infos']->key => $_smarty_tpl->tpl_vars['customization_infos']->value){
$_smarty_tpl->tpl_vars['customization_infos']->_loop = true;
?>
													<?php echo $_smarty_tpl->tpl_vars['customization_infos']->value['name'];?>
: <?php echo $_smarty_tpl->tpl_vars['customization_infos']->value['value'];?>

													<?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['custo_foreach']['last']){?><br />
													<?php }else{ ?>
													<div style="line-height:0.4pt">&nbsp;</div>
													<?php }?>
												<?php } ?>
											<?php }?>

											<?php if (isset($_smarty_tpl->tpl_vars['customization']->value['datas'][@_CUSTOMIZE_FILE_])&&count($_smarty_tpl->tpl_vars['customization']->value['datas'][@_CUSTOMIZE_FILE_])>0){?>
												<?php echo count($_smarty_tpl->tpl_vars['customization']->value['datas'][@_CUSTOMIZE_FILE_]);?>
 <?php echo smartyTranslate(array('s'=>'image(s)','pdf'=>'true'),$_smarty_tpl);?>

											<?php }?>
										</blockquote>
								</td>
								<?php if (!$_smarty_tpl->tpl_vars['tax_excluded_display']->value){?>
									<td style="text-align: right;"></td>
								<?php }?>
								<td style="text-align: right; width: 7%"></td>
								<td style="text-align: center; width: 7%; vertical-align: top">(<?php echo $_smarty_tpl->tpl_vars['customization']->value['quantity'];?>
)</td>
								<td style="width: 12%; text-align: right;"></td>
							</tr>
						<?php } ?>
					<?php } ?>
				<?php } ?>
				<!-- END PRODUCTS -->
                
				<?php if ($_smarty_tpl->tpl_vars['order_invoice']->value->total_shipping_tax_incl>0){?>
				<?php echo smarty_function_cycle(array('values'=>'#FFF,#EFEFEF','assign'=>'bgcolor'),$_smarty_tpl);?>

				<tr style="line-height:6px;">
                    <td class="left"></td>
					<td class="left"><?php echo smartyTranslate(array('s'=>'Shipping','pdf'=>'true'),$_smarty_tpl);?>
</td>
					<td class="right"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['order_invoice']->value->total_shipping_tax_excl),$_smarty_tpl);?>
</td>
					<td class="right"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['order_invoice']->value->total_shipping_tax_incl),$_smarty_tpl);?>
</td>
					<td class="center"><?php echo number_format($_smarty_tpl->tpl_vars['order']->value->carrier_tax_rate,0);?>
%</td>
					<td class="right"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>($_smarty_tpl->tpl_vars['order_invoice']->value->total_shipping_tax_incl-$_smarty_tpl->tpl_vars['order_invoice']->value->total_shipping_tax_excl)),$_smarty_tpl);?>
</td>
                    <td class="right">-</td>
					<td class="center">1</td>
					<td class="right">
						<?php if ($_smarty_tpl->tpl_vars['tax_excluded_display']->value){?>
							<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['order_invoice']->value->total_shipping_tax_excl),$_smarty_tpl);?>

							<?php }else{ ?>
							<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['order_invoice']->value->total_shipping_tax_incl),$_smarty_tpl);?>

						<?php }?>
					</td>
				</tr>
				<?php }?>

				<?php if ($_smarty_tpl->tpl_vars['order_invoice']->value->total_wrapping_tax_incl>0){?>
				<?php echo smarty_function_cycle(array('values'=>'#FFF,#EFEFEF','assign'=>'bgcolor'),$_smarty_tpl);?>

				<tr style="line-height:6px;">
                    <td class="left"></td>
					<td class="left"><?php echo smartyTranslate(array('s'=>'Wrapping cost','pdf'=>'true'),$_smarty_tpl);?>
</td>
					<td class="right"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['order_invoice']->value->total_wrapping_tax_excl),$_smarty_tpl);?>
</td>
					<td class="right"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['order_invoice']->value->total_wrapping_tax_incl),$_smarty_tpl);?>
</td>
					<td class="center"><?php echo number_format($_smarty_tpl->tpl_vars['order']->value->carrier_tax_rate,0);?>
%</td>
					<td class="right"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>($_smarty_tpl->tpl_vars['order_invoice']->value->total_wrapping_tax_incl-$_smarty_tpl->tpl_vars['order_invoice']->value->total_wrapping_tax_excl)),$_smarty_tpl);?>
</td>
                    <td class="right">-</td>
					<td class="center">1</td>                    
					<td class="right">
					<?php if ($_smarty_tpl->tpl_vars['tax_excluded_display']->value){?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['order_invoice']->value->total_wrapping_tax_excl),$_smarty_tpl);?>

					<?php }else{ ?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['order_invoice']->value->total_wrapping_tax_incl),$_smarty_tpl);?>

					<?php }?>
					</td>
				</tr>
				<?php }?>
                
				<!-- CART RULES -->
				<?php $_smarty_tpl->tpl_vars["shipping_discount_tax_incl"] = new Smarty_variable("0", null, 0);?>
				<?php  $_smarty_tpl->tpl_vars['cart_rule'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cart_rule']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cart_rules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cart_rule']->key => $_smarty_tpl->tpl_vars['cart_rule']->value){
$_smarty_tpl->tpl_vars['cart_rule']->_loop = true;
?>
					<?php echo smarty_function_cycle(array('values'=>'#FFF,#EFEFEF','assign'=>'bgcolor'),$_smarty_tpl);?>

					<tr style="line-height:6px;text-align:left;">
                        <td></td>
						<td style="text-align:left;vertical-align:center" colspan="<?php if (!$_smarty_tpl->tpl_vars['tax_excluded_display']->value){?>7<?php }else{ ?>6<?php }?>"><?php echo $_smarty_tpl->tpl_vars['cart_rule']->value['name'];?>
</td>
						<td style="text-align:right;">
							<?php if ($_smarty_tpl->tpl_vars['tax_excluded_display']->value){?>
								- <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['cart_rule']->value['value_tax_excl']),$_smarty_tpl);?>

							<?php }else{ ?>
								- <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['cart_rule']->value['value']),$_smarty_tpl);?>

							<?php }?>
						</td>
					</tr>
				<?php } ?>
				<!-- END CART RULES -->
			</table>

			<table style="width: 100%; font-size: 8pt;" cellspacing="0" cellpadding="3">
				<?php if ((($_smarty_tpl->tpl_vars['order_invoice']->value->total_paid_tax_incl-$_smarty_tpl->tpl_vars['order_invoice']->value->total_paid_tax_excl)>0)){?>
				<tr style="line-height:5px;">
					<td style="width: 83%; text-align: right; font-weight: bold"><?php echo smartyTranslate(array('s'=>'Product Total (Tax Excl.)','pdf'=>'true'),$_smarty_tpl);?>
</td>
					<td style="width: 17%; text-align: right;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['order_invoice']->value->total_products),$_smarty_tpl);?>
</td>
				</tr>

				<tr style="line-height:5px;">
					<td style="width: 83%; text-align: right; font-weight: bold"><?php echo smartyTranslate(array('s'=>'Product Total (Tax Incl.)','pdf'=>'true'),$_smarty_tpl);?>
</td>
					<td style="width: 17%; text-align: right;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['order_invoice']->value->total_products_wt),$_smarty_tpl);?>
</td>
				</tr>
				<?php }else{ ?>
				<tr style="line-height:5px;">
					<td style="width: 83%; text-align: right; font-weight: bold"><?php echo smartyTranslate(array('s'=>'Product Total','pdf'=>'true'),$_smarty_tpl);?>
</td>
					<td style="width: 17%; text-align: right;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['order_invoice']->value->total_products),$_smarty_tpl);?>
</td>
				</tr>
				<?php }?>

				<?php if ($_smarty_tpl->tpl_vars['order_invoice']->value->total_discount_tax_incl>0){?>
				<tr style="line-height:5px;">
					<td style="text-align: right; font-weight: bold"><?php echo smartyTranslate(array('s'=>'Total Vouchers','pdf'=>'true'),$_smarty_tpl);?>
</td>
					<td style="width: 17%; text-align: right;">-<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>($_smarty_tpl->tpl_vars['order_invoice']->value->total_discount_tax_incl)),$_smarty_tpl);?>
</td>
				</tr>
				<?php }?>

				<?php if (($_smarty_tpl->tpl_vars['order_invoice']->value->total_paid_tax_incl-$_smarty_tpl->tpl_vars['order_invoice']->value->total_paid_tax_excl)>0){?>
				<tr style="line-height:5px;">
					<td style="text-align: right; font-weight: bold"><?php echo smartyTranslate(array('s'=>'Total Tax','pdf'=>'true'),$_smarty_tpl);?>
</td>
					<td style="width: 17%; text-align: right;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>($_smarty_tpl->tpl_vars['order_invoice']->value->total_paid_tax_incl-$_smarty_tpl->tpl_vars['order_invoice']->value->total_paid_tax_excl)),$_smarty_tpl);?>
</td>
				</tr>
				<?php }?>

				<tr style="line-height:5px;">
                    <td style="width: 60%;"></td>
					<td style="width: 23%;text-align: right; font-weight: bold; font-size: 12pt;"><?php echo smartyTranslate(array('s'=>'Total','pdf'=>'true'),$_smarty_tpl);?>
</td>
					<td style="width: 17%; text-align: right; font-size: 12pt;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['order_invoice']->value->total_paid_tax_incl),$_smarty_tpl);?>
</td>
				</tr>
<!--
			</table>

		</td>
	</tr>
-->    
                </tbody>
    
</table>
<!-- / PRODUCTS TAB -->

<div style="line-height: 1pt">&nbsp;</div>

<?php echo $_smarty_tpl->tpl_vars['tax_tab']->value;?>

<br />
Faktúra zároveň slúži aj ako dodací list.

<?php if (isset($_smarty_tpl->tpl_vars['order_invoice']->value->note)&&$_smarty_tpl->tpl_vars['order_invoice']->value->note){?>
<div style="line-height: 1pt">&nbsp;</div>
<table style="width: 100%">
	<tr>
		<td style="width: 17%"></td>
		<td style="width: 83%"><?php echo nl2br($_smarty_tpl->tpl_vars['order_invoice']->value->note);?>
</td>
	</tr>
</table>
<?php }?>

<?php if (isset($_smarty_tpl->tpl_vars['HOOK_DISPLAY_PDF']->value)){?>
<div style="line-height: 1pt">&nbsp;</div>
<table style="width: 100%">
	<tr>
		<td style="width: 17%"></td>
		<td style="width: 83%"><?php echo $_smarty_tpl->tpl_vars['HOOK_DISPLAY_PDF']->value;?>
</td>
	</tr>
</table>
<?php }?>

<?php }} ?>