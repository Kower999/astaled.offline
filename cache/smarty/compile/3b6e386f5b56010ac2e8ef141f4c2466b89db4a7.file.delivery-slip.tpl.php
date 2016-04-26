<?php /* Smarty version Smarty-3.1.8, created on 2016-04-26 23:06:50
         compiled from "C:\wamp\www\themes\default\pdf\delivery-slip.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8314550186d5016e38-91022412%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3b6e386f5b56010ac2e8ef141f4c2466b89db4a7' => 
    array (
      0 => 'C:\\wamp\\www\\themes\\default\\pdf\\delivery-slip.tpl',
      1 => 1449839983,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8314550186d5016e38-91022412',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_550186d52a7043_00631318',
  'variables' => 
  array (
    'order_details' => 0,
    'order_detail' => 0,
    'order' => 0,
    'totalcount' => 0,
    'customizationPerAddress' => 0,
    'customization' => 0,
    'customization_infos' => 0,
    'order_invoice' => 0,
    'HOOK_DISPLAY_PDF' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_550186d52a7043_00631318')) {function content_550186d52a7043_00631318($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cycle')) include 'C:\\wamp\\www\\tools\\smarty\\plugins\\function.cycle.php';
?>
<style type="text/css">
    table, td, tr   { border-collapse: collapse; border-spacing: 0px; text-indent: 0px;}
    .indent0   { text-indent: -3px;}
    .border   { border: 0.1px solid #888; }
    .bordertop { border-top: 0.1px solid #888; }
    .borderbottom { border-bottom: 0.1px solid #888; }
    .gray8  { font-size: 8pt; color: #444; }
    .gray12 { font-size: 12pt; color: #444;  }
    .silver8 { font-size: 8pt; color: #777; }
    .silver6    { font-size: 6pt; color: #777; }
    .bold { font-weight: bold; }
    .normal { font-weight: normal; }
    .half { width: 50%; }
    .size8 { font-size: 8pt; }
    .allborders td { border: 0.1px solid #BBB; }
</style>

<div style="font-size: 6pt; color: #444">

<div style="line-height: 1pt">&nbsp;</div>

<!-- PRODUCTS TAB -->
<?php $_smarty_tpl->tpl_vars['totalcount'] = new Smarty_variable(0, null, 0);?>
<table style="width: 100%">
	<tr>
		<td style="width: 100%; text-align: right">
			<table class="" style="width: 100%; font-size: 8pt;" cellspacing="0" cellpadding="3">
				<tr style="line-height:4px;">
				    <td class="borderbottom" style="text-align: left; font-weight: bold; width: 13%"><?php echo smartyTranslate(array('s'=>'EAN','pdf'=>'true'),$_smarty_tpl);?>
</td>
					<td class="borderbottom" style="text-align: left; padding-left: 10px; font-weight: bold; width: 60%"><?php echo smartyTranslate(array('s'=>'Product','pdf'=>'true'),$_smarty_tpl);?>
</td>
					<td class="borderbottom" style="text-align: center; font-weight: bold; width: 7%"><?php echo smartyTranslate(array('s'=>'Qty','pdf'=>'true'),$_smarty_tpl);?>
</td>                    
	                <td class="borderbottom" style="text-align: center; font-weight: bold; width: 10%"><?php echo smartyTranslate(array('s'=>'Jednotková<br/>cena','pdf'=>'true'),$_smarty_tpl);?>
<br /><?php echo smartyTranslate(array('s'=>'(Tax Excl.)','pdf'=>'true'),$_smarty_tpl);?>
</td>
                    <td class="borderbottom" style="text-align: center; font-weight: bold; width: 10%">
                        <?php echo smartyTranslate(array('s'=>'Total','pdf'=>'true'),$_smarty_tpl);?>

                        <br /><?php echo smartyTranslate(array('s'=>'(Tax Excl.)','pdf'=>'true'),$_smarty_tpl);?>

                    </td>
				</tr>
				<?php  $_smarty_tpl->tpl_vars['order_detail'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['order_detail']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['order_details']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['order_detail']->key => $_smarty_tpl->tpl_vars['order_detail']->value){
$_smarty_tpl->tpl_vars['order_detail']->_loop = true;
?>
				<?php echo smarty_function_cycle(array('values'=>'#EEE,#DDD','assign'=>'bgcolor'),$_smarty_tpl);?>

				<tr style="line-height:6px;">
					<td style="text-align: left; width: 13%"><?php if (isset($_smarty_tpl->tpl_vars['order_detail']->value['product_ean13'])&&!empty($_smarty_tpl->tpl_vars['order_detail']->value['product_ean13'])){?><?php echo $_smarty_tpl->tpl_vars['order_detail']->value['product_ean13'];?>
<?php }?></td>
					<td style="text-align: left; width: 60% "><?php echo $_smarty_tpl->tpl_vars['order_detail']->value['product_name'];?>
</td>
					<td style="text-align: center; width: 7%"><?php echo $_smarty_tpl->tpl_vars['order_detail']->value['product_quantity'];?>
</td>
					<td style="text-align: right; width: 10%"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['order_detail']->value['unit_price_tax_excl']),$_smarty_tpl);?>
</td>
					<td style="text-align: right; width: 10%">
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['order_detail']->value['total_price_tax_excl']),$_smarty_tpl);?>

					</td>

                    <?php $_smarty_tpl->tpl_vars['totalcount'] = new Smarty_variable($_smarty_tpl->tpl_vars['totalcount']->value+$_smarty_tpl->tpl_vars['order_detail']->value['product_quantity'], null, 0);?>
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
								<td style="text-align: right; width: 13%"></td>
								<td style="line-height:3px; text-align: left; width: 80%; vertical-align: top">

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
								<td style="text-align: center; width: 7%; vertical-align: top">(<?php echo $_smarty_tpl->tpl_vars['customization']->value['quantity'];?>
)</td>
                                <?php $_smarty_tpl->tpl_vars['totalcount'] = new Smarty_variable($_smarty_tpl->tpl_vars['totalcount']->value+$_smarty_tpl->tpl_vars['customization']->value['quantity'], null, 0);?>
							</tr>
						<?php } ?>
					<?php } ?>
				<?php } ?>
				<tr style="line-height:6px;">
					<td class="bordertop" style="text-align: left; width: 13%"></td>
					<td class="bordertop" style="text-align: left; width: 60% "><?php echo smartyTranslate(array('s'=>'Spolu množstvo','pdf'=>'true'),$_smarty_tpl);?>
</td>
					<td class="bordertop" style="text-align: center; width: 7%"><?php echo $_smarty_tpl->tpl_vars['totalcount']->value;?>
</td>
                    <td class="bordertop" style="text-align: center; font-weight: bold; width: 10%"></td>
                    <td class="bordertop" style="text-align: center; font-weight: bold; width: 10%"></td>
				</tr>           
				<tr style="line-height:5px;">
					<td style="text-align: left; width: 13%"></td>
					<td style="width: 70%; text-align: left; font-weight: bold"><?php echo smartyTranslate(array('s'=>'Product Total (Tax Excl.)','pdf'=>'true'),$_smarty_tpl);?>
</td>
					<td style="width: 17%; text-align: right;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['order_invoice']->value->total_products),$_smarty_tpl);?>
</td>
				</tr>
                     
				<!-- END PRODUCTS -->
			</table>

		</td>
	</tr>
</table>
<!-- / PRODUCTS TAB -->

<div style="line-height: 1pt">&nbsp;</div>

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

</div>

<?php }} ?>