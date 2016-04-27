<?php /* Smarty version Smarty-3.1.8, created on 2016-04-27 13:45:47
         compiled from "C:\wamp\www\themes\default\pdf\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8860550186d4e0d421-73310347%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f77525d3c0efb611e82408a5a32dc0f25b602d4a' => 
    array (
      0 => 'C:\\wamp\\www\\themes\\default\\pdf\\header.tpl',
      1 => 1461742550,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8860550186d4e0d421-73310347',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_550186d4e11135_86956166',
  'variables' => 
  array (
    'address' => 0,
    'country' => 0,
    'logo_path' => 0,
    'ico' => 0,
    'dic' => 0,
    'icdph' => 0,
    'shop_details' => 0,
    'shop_fax' => 0,
    'shop_phone' => 0,
    'email' => 0,
    'shop' => 0,
    'ucet' => 0,
    'iban' => 0,
    'swift' => 0,
    'banka' => 0,
    'dodaci' => 0,
    'vs' => 0,
    'ks' => 0,
    'title' => 0,
    'delivery_address' => 0,
    'invoice_address' => 0,
    'date' => 0,
    'order' => 0,
    'carrier' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_550186d4e11135_86956166')) {function content_550186d4e11135_86956166($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include 'C:\\wamp\\www\\tools\\smarty\\plugins\\modifier.escape.php';
if (!is_callable('smarty_modifier_date_format')) include 'C:\\wamp\\www\\tools\\smarty\\plugins\\modifier.date_format.php';
?><style type="text/css">
    table, td, tr   { border-collapse: collapse; border-spacing: 0px; text-indent: 0px;}
    .indent0   { text-indent: -3px;}
    .border   { border: 0.1px solid #888; }
    .bordertop { border-top: 0.1px solid #888; }
    .gray8  { font-size: 8pt; color: #444; }
    .gray12 { font-size: 9pt; color: #444;  }
    .silver8 { font-size: 8pt; color: #777; }
    .silver6    { font-size: 6pt; color: #777; }
    .bold { font-weight: bold; }
    .normal { font-weight: normal; }
    .half { width: 50%; }
    .size8 { font-size: 8pt; }
    .allborders td { border: 0.1px solid #BBB; }
    .thead {  font-weight: bold; }
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
                        <?php }?>
                        </table>
                    </td>                    
				    <td style="width:50%; text-align: right;">
		              <?php if ($_smarty_tpl->tpl_vars['logo_path']->value){?>
			             <img src="<?php echo $_smarty_tpl->tpl_vars['logo_path']->value;?>
" width="70"/>
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
                <?php if (!empty($_smarty_tpl->tpl_vars['shop_details']->value)){?>
                <tr>
                    <td colspan="2" class="silver6 normal lrp">
                            <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['shop_details']->value, 'html', 'UTF-8');?>

                    </td>
                </tr>
                <?php }?>
		    </table>
    		<table class="gray8 normal bordertop" cellspacing="0" cellpadding="5">
                <tr>
                    <td style="width:40%;padding:10px 10px 10px 0px;">
                        <table class="gray8 bold" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>Telefón:</td>
                            </tr>
                        <?php if (!empty($_smarty_tpl->tpl_vars['shop_fax']->value)){?>                                                        
                            <tr>
                                <td>Fax:</td>
                            </tr>
                        <?php }?>                                                        
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
                        <?php if (!empty($_smarty_tpl->tpl_vars['shop_fax']->value)){?>                                                        
                            <tr>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['shop_fax']->value, 'html', 'UTF-8');?>
</td>
                            </tr>
                        <?php }?>                                                        
                            <tr>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['email']->value, 'html', 'UTF-8');?>
</td>
                            </tr>
                            <tr>
                                <td>www.vegasolutions.eu<br />www.vegaonline.sk</td>
<!--                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['shop']->value->domain, 'html', 'UTF-8');?>
</td> -->
                            </tr>
                        </table>                                                
                    </td>
                </tr>
            </table>                        
    		<table class="gray8 normal bordertop" cellspacing="0" cellpadding="5">
                <tr>
                    <td style="width:40%;padding:10px 10px 10px 0px;">
                        <table class="gray8 bold" cellspacing="0" cellpadding="0">
                        <?php if (!empty($_smarty_tpl->tpl_vars['ucet']->value)){?>                            
                            <tr>
                                <td>Číslo účtu:</td>
                            </tr>
                        <?php }?>                            
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
                    <?php if (!isset($_smarty_tpl->tpl_vars['dodaci']->value)){?>                                                                          
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
                    <?php }?>                                                    
                        </table>                                                
                    </td>
                    <td style="width:60%">
                        <table class="gray8 bold" cellspacing="0" cellpadding="0">
                        <?php if (!empty($_smarty_tpl->tpl_vars['ucet']->value)){?>                            
                            <tr>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['ucet']->value, 'html', 'UTF-8');?>
</td>
                            </tr>
                        <?php }?>                            
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
                    <?php if (!isset($_smarty_tpl->tpl_vars['dodaci']->value)){?>                                      
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
                    <?php }?>                            
                        </table>                                                
                    </td>
                </tr>
            </table>                        
        </td>
        <td style="width: 50%;" class="">
            <table class="gray8 bold border" cellspacing="0" cellpadding="5">
                <tr>
                    <td style="text-align: right;"><span style="width: 100%; font-size: 12pt; font-weight: bold;"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['title']->value, 'html', 'UTF-8');?>
</span></td>
                </tr>
                <tr>
                    <td>
                        <span class="gray12 bold">Odberateľ:</span><br />
                        <table class="silver8 normal" cellspacing="0" cellpadding="5" border="0">
                            <tr>
                                <?php if (!empty($_smarty_tpl->tpl_vars['delivery_address']->value)){?>                            
                                <td>
                                    <div style="font-weight: bold; font-size: 8pt; color: #9E9F9E"><?php echo smartyTranslate(array('s'=>'Delivery Address','pdf'=>'true'),$_smarty_tpl);?>
</div>
                                    <?php echo $_smarty_tpl->tpl_vars['delivery_address']->value;?>

                                </td>
                                <?php }?>                                        
                                <td>
                                    <div style="font-weight: bold; font-size: 8pt; color: #9E9F9E"><?php echo smartyTranslate(array('s'=>'Billing Address','pdf'=>'true'),$_smarty_tpl);?>
</div>
                                    <?php echo $_smarty_tpl->tpl_vars['invoice_address']->value;?>

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
                    <?php if (!isset($_smarty_tpl->tpl_vars['dodaci']->value)){?>
                        <td class="border center"><span class="size8 blue bold">Dátum zd. plnenia</span><br /><span class="gray8 bold"><?php echo smarty_modifier_escape(smarty_modifier_date_format($_smarty_tpl->tpl_vars['date']->value,"%d.%m.%Y"), 'html', 'UTF-8');?>
</span></td>
                        <td class="border center"><span class="size8 red bold">Dátum splatnosti</span><br /><span class="gray8 normal"><?php echo smarty_modifier_escape(smarty_modifier_date_format($_smarty_tpl->tpl_vars['order']->value->date_pay,"%d.%m.%Y"), 'html', 'UTF-8');?>
</span></td>
                    <?php }?>
                </tr>
            </table>
    		<table class="gray8 normal border" cellspacing="0" cellpadding="5">
                <tr>
                    <td style="width:50%;padding:10px 10px 10px 0px;">
                        <table class="gray8 bold" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>Číslo objednávky:</td>
                            </tr>
                            <tr>
                                <td>Spôsob doručenia:</td>
                            </tr>
                    <?php if (!isset($_smarty_tpl->tpl_vars['dodaci']->value)){?>                                                                  
                            <tr>
                                <td>Spôsob platby:</td>
                            </tr>
                    <?php }?>
                        </table>                                                
                    </td>
                    <td style="width:50%">
                        <table class="gray8 bold" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['order']->value->shipping_number;?>
</td>
                            </tr>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['carrier']->value->name;?>
</td>
                            </tr>
                    <?php if (!isset($_smarty_tpl->tpl_vars['dodaci']->value)){?>                                                                  
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['order']->value->payment;?>
</td>
                            </tr>                            
                    <?php }?>                            
                        </table>                                                
                    </td>
                </tr>
            </table>                                    
        </td>
    </tr>
</table>
<?php }} ?>