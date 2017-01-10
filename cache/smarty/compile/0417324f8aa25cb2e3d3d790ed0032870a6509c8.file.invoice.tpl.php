<?php /* Smarty version Smarty-3.1.8, created on 2015-02-26 01:34:41
         compiled from "C:\wamp\www\themes\default\pdf\invoice.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1556454da6e1f26dcb1-29530062%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0417324f8aa25cb2e3d3d790ed0032870a6509c8' => 
    array (
      0 => 'C:\\wamp\\www\\themes\\default\\pdf\\invoice.tpl',
      1 => 1424910812,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1556454da6e1f26dcb1-29530062',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_54da6e1f6fd179_18818921',
  'variables' => 
  array (
    'address' => 0,
    'country' => 0,
    'logo_path' => 0,
    'ico' => 0,
    'dic' => 0,
    'icdph' => 0,
    'shop_details' => 0,
    'shop_phone' => 0,
    'shop_fax' => 0,
    'email' => 0,
    'shop' => 0,
    'iban' => 0,
    'swift' => 0,
    'banka' => 0,
    'vs' => 0,
    'ks' => 0,
    'ucet' => 0,
    'title' => 0,
    'delivery_address' => 0,
    'invoice_address' => 0,
    'date' => 0,
    'order' => 0,
    'order_invoice' => 0,
    'payment' => 0,
    'carrier' => 0,
    'tax_excluded_display' => 0,
    'order_details' => 0,
    'bgcolor' => 0,
    'order_detail' => 0,
    'customizationPerAddress' => 0,
    'customization' => 0,
    'customization_infos' => 0,
    'cart_rules' => 0,
    'cart_rule' => 0,
    'tax_tab' => 0,
    'HOOK_DISPLAY_PDF' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54da6e1f6fd179_18818921')) {function content_54da6e1f6fd179_18818921($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include 'C:\\wamp\\www\\tools\\smarty\\plugins\\modifier.escape.php';
if (!is_callable('smarty_modifier_date_format')) include 'C:\\wamp\\www\\tools\\smarty\\plugins\\modifier.date_format.php';
if (!is_callable('smarty_function_cycle')) include 'C:\\wamp\\www\\tools\\smarty\\plugins\\function.cycle.php';
?>
<style type="text/css">
    table, td, tr   { border-collapse: collapse; border-spacing: 0px; text-indent: 0px;}
    .indent0   { text-indent: -3px;}
    .border   { border: 1px solid #888; }
    .bordertop { border-top: 1px solid #888; }
    .gray8  { font-size: 8pt; color: #444; }
    .gray12 { font-size: 12pt; color: #444;  }
    .silver8 { font-size: 8pt; color: #777; }
    .silver6    { font-size: 6pt; color: #777; }
    .bold { font-weight: bold; }
    .normal { font-weight: normal; }
    .half { width: 50%; }
    .size8 { font-size: 8pt; }
    .green { color: #60A060; }
    .blue { color: #6060A0; }
    .red { color: #A06060; }
    .allborders td { border: 0.1px solid #BBB; }
    .thead { background-color: #6D6D6D; color: #FFF; font-weight: bold; }
    .center { text-align: center; }
    .left { text-align: left; }
    .right { text-align: right; }
    .c1 { width: 11%; }
    .c2 { width: 28%; }
    .c3 { width: 10%; }
    .c4 { width: 10%; }
    .c5 { width: 6%; }
    .c6 { width: 10%; }
    .c7 { width: 9%; }
    .c8 { width: 9%; }
    .c9 { width: 10%; }
</style>

<table class="mytable gray8 bold border" cellspacing="0" cellpadding="0">
    <tr>
        <td style="width: 50%;">
            <table class="" cellspacing="0" cellpadding="5">
                <tr>
				    <td style="width:50%;">
                        <table class="silver8 normal" cellspacing="0" cellpadding="0">
                            <tr>
                                <td class="gray12 bold">Dodávateľ:</td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td class="gray8 bold"><?php echo $_smarty_tpl->tpl_vars['address']->value->company;?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['address']->value->address1;?>
</td>
                            </tr>
				        <?php if (!empty($_smarty_tpl->tpl_vars['address']->value->address2)){?>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['address']->value->address2;?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['address']->value->postcode;?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['address']->value->city;?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['country']->value;?>
</td>
                            </tr>
				        <?php }else{ ?>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['address']->value->postcode;?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['address']->value->city;?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['country']->value;?>
</td>
                            </tr>                                    
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                        <?php }?>
                        </table>
                    </td>                    
				    <td style="width:50%;">
		              <?php if ($_smarty_tpl->tpl_vars['logo_path']->value){?>
			             <img src="<?php echo $_smarty_tpl->tpl_vars['logo_path']->value;?>
"/>
		              <?php }?>
                    </td>
                </tr>
                <tr class="">
                    <td style="width:40%">
                        <table class="gray8 bold" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>IČO:</td>
                            </tr>
                            <tr>
                                <td>DIČ:</td>
                            </tr>
                            <tr>
                                <td>IČ DPH:</td>
                            </tr>
                        </table>                                                
                    </td>
                    <td style="width:60%">
                        <table class="gray8 bold" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['ico']->value;?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['dic']->value;?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['icdph']->value;?>
</td>
                            </tr>
                        </table>                                                
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="silver6 normal lrp">
				        <?php if (!empty($_smarty_tpl->tpl_vars['shop_details']->value)){?>
                            <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['shop_details']->value, 'html', 'UTF-8');?>

                        <?php }?>
                    </td>
                </tr>
		    </table>
    		<table class="gray8 normal bordertop" cellspacing="0" cellpadding="5">
                <tr>
                    <td style="width:40%;padding:10px 10px 10px 0px;">
                        <table class="gray8 bold" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>Telefón:</td>
                            </tr>
                            <tr>
                                <td>Fax:</td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                            </tr>
                            <tr>
                                <td>Web:</td>
                            </tr>
                        </table>                                                
                    </td>
                    <td style="width:60%">
                        <table class="gray8 bold" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['shop_phone']->value, 'html', 'UTF-8');?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['shop_fax']->value, 'html', 'UTF-8');?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['email']->value, 'html', 'UTF-8');?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['shop']->value->domain, 'html', 'UTF-8');?>
</td>
                            </tr>
                        </table>                                                
                    </td>
                </tr>
            </table>                        
    		<table class="gray8 normal bordertop" cellspacing="0" cellpadding="5">
                <tr>
                    <td style="width:40%;padding:10px 10px 10px 0px;">
                        <table class="gray8 bold" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>Číslo účtu:</td>
                            </tr>
                        <?php if (!empty($_smarty_tpl->tpl_vars['iban']->value)){?>                            
                            <tr>
                                <td>IBAN:</td>
                            </tr>
                        <?php }?>                            
                        <?php if (!empty($_smarty_tpl->tpl_vars['swift']->value)){?>                            
                            <tr>
                                <td>SWIFT:</td>
                            </tr>
                        <?php }?>                            
                        <?php if (!empty($_smarty_tpl->tpl_vars['banka']->value)){?>                            
                            <tr>
                                <td>Názov banky:</td>
                            </tr>
                        <?php }?>                            
                        <?php if (!empty($_smarty_tpl->tpl_vars['vs']->value)){?>                            
                            <tr>
                                <td>Variabilný symbol:</td>
                            </tr>
                        <?php }?>                            
                        <?php if (!empty($_smarty_tpl->tpl_vars['ks']->value)){?>                            
                            <tr>
                                <td>Konštantný symbol:</td>
                            </tr>
                        <?php }?>                            
                        </table>                                                
                    </td>
                    <td style="width:60%">
                        <table class="gray8 bold" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['ucet']->value, 'html', 'UTF-8');?>
</td>
                            </tr>
                        <?php if (!empty($_smarty_tpl->tpl_vars['iban']->value)){?>                            
                            <tr>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['iban']->value, 'html', 'UTF-8');?>
</td>
                            </tr>
                        <?php }?>                            
                        <?php if (!empty($_smarty_tpl->tpl_vars['swift']->value)){?>                            
                            <tr>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['swift']->value, 'html', 'UTF-8');?>
</td>
                            </tr>
                        <?php }?>                            
                        <?php if (!empty($_smarty_tpl->tpl_vars['banka']->value)){?>                            
                            <tr>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['banka']->value, 'html', 'UTF-8');?>
</td>
                            </tr>
                        <?php }?>                            
                        <?php if (!empty($_smarty_tpl->tpl_vars['vs']->value)){?>                            
                            <tr>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['vs']->value, 'html', 'UTF-8');?>
</td>
                            </tr>
                        <?php }?>                            
                        <?php if (!empty($_smarty_tpl->tpl_vars['ks']->value)){?>                            
                            <tr>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['ks']->value, 'html', 'UTF-8');?>
</td>
                            </tr>
                        <?php }?>                            
                        </table>                                                
                    </td>
                </tr>
            </table>                        
        </td>
        <td style="width: 50%;" class="">
            <table class="gray8 bold border" cellspacing="0" cellpadding="5">
                <tr style="background-color: #000;">
                    <td style="text-align: right;"><span style="width: 100%; font-size: 14pt; color: #FFF; font-weight: bold;"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['title']->value, 'html', 'UTF-8');?>
</span></td>
                </tr>
                <tr>
                    <td class="">
                        <table class="silver8 normal" cellspacing="0" cellpadding="0">
                            <tr>
                                <td class="gray12 bold">Odberateľ:</td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                        <?php if (!empty($_smarty_tpl->tpl_vars['delivery_address']->value)){?>                            
                            <tr>
                                <td style="font-weight: bold; font-size: 10pt; color: #9E9F9E"><?php echo smartyTranslate(array('s'=>'Delivery Address','pdf'=>'true'),$_smarty_tpl);?>
</td>					                                       
                            </tr>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['delivery_address']->value;?>
</td>
                            </tr>
                        <?php }?>
                            <tr>
                                <td style="font-weight: bold; font-size: 10pt; color: #9E9F9E"><?php echo smartyTranslate(array('s'=>'Billing Address','pdf'=>'true'),$_smarty_tpl);?>
</td>					                                       
                            </tr>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['invoice_address']->value;?>
</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <table class="silver8 normal" cellspacing="0" cellpadding="5" border="0">
                <tr>
                    <td class="border center"><span class="size8 green bold">Dátum vystavenia</span><br /><span class="gray8 bold"><?php echo smarty_modifier_escape(smarty_modifier_date_format($_smarty_tpl->tpl_vars['date']->value,"%d.%m.%Y"), 'html', 'UTF-8');?>
</span></td>
                    <td class="border center"><span class="size8 blue bold">Dátum zd. plnenia</span><br /><span class="gray8 bold"><?php echo smarty_modifier_escape(smarty_modifier_date_format($_smarty_tpl->tpl_vars['date']->value,"%d.%m.%Y"), 'html', 'UTF-8');?>
</span></td>
                    <td class="border center"><span class="size8 red bold">Dátum splatnosti</span><br /><span class="gray8 normal"><?php echo smarty_modifier_escape(smarty_modifier_date_format($_smarty_tpl->tpl_vars['order']->value->date_pay,"%d.%m.%Y"), 'html', 'UTF-8');?>
</span></td>
                </tr>
            </table>
    		<table class="gray8 normal border" cellspacing="0" cellpadding="5">
                <tr>
                    <td style="width:50%;padding:10px 10px 10px 0px;">
                        <table class="gray8 bold" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>Číslo objednávky:</td>
                            </tr>
<!--                            <tr>
                                <td>Spôsob platby:</td>
                            </tr>
-->                            
                            <tr>
                                <td>Spôsob doručenia:</td>
                            </tr>
                            <tr>
                                <td>Spôsob platby:</td>
                            </tr>
                        </table>                                                
                    </td>
                    <td style="width:50%">
                        <table class="gray8 bold" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['order']->value->getUniqReference();?>
</td>
                            </tr>
<!--                            <tr>
                                <td>
			                         <table class="gray8 bold" cellspacing="0" cellpadding="0">
			                             <?php  $_smarty_tpl->tpl_vars['payment'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['payment']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['order_invoice']->value->getOrderPaymentCollection(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['payment']->key => $_smarty_tpl->tpl_vars['payment']->value){
$_smarty_tpl->tpl_vars['payment']->_loop = true;
?>
				                            <tr>
					                           <td style="width: 50%"><?php echo $_smarty_tpl->tpl_vars['payment']->value->payment_method;?>
</td>
					                           <td style="width: 50%"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['payment']->value->amount,'currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency),$_smarty_tpl);?>
</td>
				                            </tr>
			                             <?php }
if (!$_smarty_tpl->tpl_vars['payment']->_loop) {
?>
				                            <tr>
					                           <td><?php echo smartyTranslate(array('s'=>'No payment','pdf'=>'true'),$_smarty_tpl);?>
</td>
				                            </tr>
			                             <?php } ?>
			                         </table>
                                </td>
                            </tr>
-->                            
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['carrier']->value->name;?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['order']->value->payment;?>
</td>
                            </tr>                            
                        </table>                                                
                    </td>
                </tr>
            </table>                                    
        </td>
    </tr>
</table>

<div style="font-size: 8pt; color: #444">

<div style="line-height: 1pt">&nbsp;</div>

<!-- PRODUCTS TAB -->
<table style="width: 100%">
	<tr>
		<td style="width: 100%; text-align: right">
			<table class="allborders" style="width: 100%; font-size: 6pt;" cellspacing="0" cellpadding="3">
				<tr>
				    <td class="c1 thead center"><?php echo smartyTranslate(array('s'=>'EAN','pdf'=>'true'),$_smarty_tpl);?>
</td>
					<td class="c2 thead left"><?php echo smartyTranslate(array('s'=>'Product','pdf'=>'true'),$_smarty_tpl);?>
</td>
					<td class="c3 thead center"><?php echo smartyTranslate(array('s'=>'Unit Price','pdf'=>'true'),$_smarty_tpl);?>
<br /><?php echo smartyTranslate(array('s'=>'(Tax Excl.)','pdf'=>'true'),$_smarty_tpl);?>
</td>
					<td class="c4 thead center"><?php echo smartyTranslate(array('s'=>'Unit Price','pdf'=>'true'),$_smarty_tpl);?>
<br /><?php echo smartyTranslate(array('s'=>'(Tax Incl.)','pdf'=>'true'),$_smarty_tpl);?>
</td>
					<td class="c5 thead center"><?php echo smartyTranslate(array('s'=>'Tax Rate','pdf'=>'true'),$_smarty_tpl);?>
</td>
					<td class="c5 thead center"><?php echo smartyTranslate(array('s'=>'Tax value','pdf'=>'true'),$_smarty_tpl);?>
</td>
					<td class="c7 thead center"><?php echo smartyTranslate(array('s'=>'Discount','pdf'=>'true'),$_smarty_tpl);?>
</td>
					<td class="c8 thead center"><?php echo smartyTranslate(array('s'=>'Qty','pdf'=>'true'),$_smarty_tpl);?>
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
				<!-- PRODUCTS -->
				<?php  $_smarty_tpl->tpl_vars['order_detail'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['order_detail']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['order_details']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['order_detail']->key => $_smarty_tpl->tpl_vars['order_detail']->value){
$_smarty_tpl->tpl_vars['order_detail']->_loop = true;
?>

                
				<?php echo smarty_function_cycle(array('values'=>'#FFF,#EFEFEF','assign'=>'bgcolor'),$_smarty_tpl);?>

				<tr style="line-height:6px;background-color:<?php echo $_smarty_tpl->tpl_vars['bgcolor']->value;?>
;">
					<td class="left"><?php if (isset($_smarty_tpl->tpl_vars['order_detail']->value['product_ean13'])&&!empty($_smarty_tpl->tpl_vars['order_detail']->value['product_ean13'])){?><?php echo $_smarty_tpl->tpl_vars['order_detail']->value['product_ean13'];?>
<?php }?></td>
					<td class="left"><?php echo $_smarty_tpl->tpl_vars['order_detail']->value['product_name'];?>
</td>
					<td class="right"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['order_detail']->value['unit_price_tax_excl']),$_smarty_tpl);?>
</td>
					<td class="right"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['order_detail']->value['unit_price_tax_incl']),$_smarty_tpl);?>
</td>
					<td class="center"><?php if ($_smarty_tpl->tpl_vars['order_detail']->value['tax_rate']>0){?><?php echo number_format($_smarty_tpl->tpl_vars['order_detail']->value['tax_rate'],0);?>
<?php }else{ ?><?php echo number_format($_smarty_tpl->tpl_vars['order']->value->carrier_tax_rate,0);?>
<?php }?>%</td>
					<td class="right"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>($_smarty_tpl->tpl_vars['order_detail']->value['unit_price_tax_incl']-$_smarty_tpl->tpl_vars['order_detail']->value['unit_price_tax_excl'])),$_smarty_tpl);?>
</td>
					<td class="right">
					<?php if ((isset($_smarty_tpl->tpl_vars['order_detail']->value['reduction_amount'])&&$_smarty_tpl->tpl_vars['order_detail']->value['reduction_amount']>0)){?>
						-<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['order_detail']->value['reduction_amount']),$_smarty_tpl);?>

					<?php }elseif((isset($_smarty_tpl->tpl_vars['order_detail']->value['reduction_percent'])&&$_smarty_tpl->tpl_vars['order_detail']->value['reduction_percent']>0)){?>
						-<?php echo $_smarty_tpl->tpl_vars['order_detail']->value['reduction_percent'];?>
%
					<?php }else{ ?>
					--
					<?php }?>
					</td>
					<td class="center"><?php echo $_smarty_tpl->tpl_vars['order_detail']->value['product_quantity'];?>
</td>
					<td class="right">
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
							<tr style="line-height:6px;background-color:<?php echo $_smarty_tpl->tpl_vars['bgcolor']->value;?>
;">
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

				<!-- CART RULES -->
				<?php $_smarty_tpl->tpl_vars["shipping_discount_tax_incl"] = new Smarty_variable("0", null, 0);?>
				<?php  $_smarty_tpl->tpl_vars['cart_rule'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cart_rule']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cart_rules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cart_rule']->key => $_smarty_tpl->tpl_vars['cart_rule']->value){
$_smarty_tpl->tpl_vars['cart_rule']->_loop = true;
?>
					<?php echo smarty_function_cycle(array('values'=>'#FFF,#EFEFEF','assign'=>'bgcolor'),$_smarty_tpl);?>

					<tr style="line-height:6px;background-color:<?php echo $_smarty_tpl->tpl_vars['bgcolor']->value;?>
;text-align:left;">
						<td style="text-align:left;vertical-align:center" colspan="<?php if (!$_smarty_tpl->tpl_vars['tax_excluded_display']->value){?>6<?php }else{ ?>5<?php }?>"><?php echo $_smarty_tpl->tpl_vars['cart_rule']->value['name'];?>
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
                
				<?php if ($_smarty_tpl->tpl_vars['order_invoice']->value->total_shipping_tax_incl>0){?>
				<?php echo smarty_function_cycle(array('values'=>'#FFF,#EFEFEF','assign'=>'bgcolor'),$_smarty_tpl);?>

				<tr style="line-height:6px;background-color:<?php echo $_smarty_tpl->tpl_vars['bgcolor']->value;?>
;">
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

				<tr style="line-height:6px;background-color:<?php echo $_smarty_tpl->tpl_vars['bgcolor']->value;?>
;">
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
                
			</table>

			<table style="width: 100%" cellspacing="0" cellpadding="3">
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
					<td style="width: 23%;text-align: right; color: #FFF; background-color: #6D6D6D; font-weight: bold; font-size: 12pt;"><?php echo smartyTranslate(array('s'=>'Total','pdf'=>'true'),$_smarty_tpl);?>
</td>
					<td style="width: 17%; color: #FFF; background-color: #6D6D6D; text-align: right; font-size: 12pt;"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['order_invoice']->value->total_paid_tax_incl),$_smarty_tpl);?>
</td>
				</tr>

			</table>

		</td>
	</tr>
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

</div>

<?php }} ?>