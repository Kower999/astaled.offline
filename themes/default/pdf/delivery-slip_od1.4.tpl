{*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
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
</style>

<table class="mytable gray8 bold border" cellspacing="0" cellpadding="0">
    <tr>
        <td class="" style="width: 50%;">
            <table class="" cellspacing="0" cellpadding="5">
                <tr class="">
				    <td style="width:50%;">
                        <table class="silver8 normal" cellspacing="0" cellpadding="0">
                            <tr>
                                <td class="gray12 bold">Dodávateľ:</td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td class="gray8 bold">{$address->company}</td>
                            </tr>
                            <tr>
                                <td>{$address->address1}</td>
                            </tr>
				        {if !empty($address->address2)}
                            <tr>
                                <td>{$address->address2}</td>
                            </tr>
                            <tr>
                                <td>{$address->postcode}&nbsp;{$address->city}</td>
                            </tr>
                            <tr>
                                <td>{$country}</td>
                            </tr>
				        {else}
                            <tr>
                                <td>{$address->postcode}&nbsp;{$address->city}</td>
                            </tr>
                            <tr>
                                <td>{$country}</td>
                            </tr>                                    
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                        {/if}
                        </table>
                    </td>                    
				    <td style="width:50%;">
		              {if $logo_path}
			             <img src="{$logo_path}"/>
		              {/if}
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
                                <td>{$ico}</td>
                            </tr>
                            <tr>
                                <td>{$dic}</td>
                            </tr>
                            <tr>
                                <td>{$icdph}</td>
                            </tr>
                        </table>                                                
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="silver6 normal lrp">
				        {if !empty($shop_details)}
                            {$shop_details|escape:'html':'UTF-8'}
                        {/if}
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
                                <td>{$shop_phone|escape:'html':'UTF-8'}</td>
                            </tr>
                            <tr>
                                <td>{$shop_fax|escape:'html':'UTF-8'}</td>
                            </tr>
                            <tr>
                                <td>{$email|escape:'html':'UTF-8'}</td>
                            </tr>
                            <tr>
                                <td>www.vegasolutions.eu<br />www.vegaonline.sk</td>
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
                        {if !empty($iban)}                            
                            <tr>
                                <td>IBAN:</td>
                            </tr>
                        {/if}                            
                        {if !empty($swift)}                            
                            <tr>
                                <td>SWIFT:</td>
                            </tr>
                        {/if}                            
                        {if !empty($banka)}                            
                            <tr>
                                <td>Názov banky:</td>
                            </tr>
                        {/if}                            
{*}                        {if !empty($vs)}                            
                            <tr>
                                <td>Variabilný symbol:</td>
                            </tr>
                        {/if}                            
                        {if !empty($ks)}                            
                            <tr>
                                <td>Konštantný symbol:</td>
                            </tr>
                        {/if}    
{*}                                                
                        </table>                                                
                    </td>
                    <td style="width:60%">
                        <table class="gray8 bold" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>{$ucet|escape:'html':'UTF-8'}</td>
                            </tr>
                        {if !empty($iban)}                            
                            <tr>
                                <td>{$iban|escape:'html':'UTF-8'}</td>
                            </tr>
                        {/if}                            
                        {if !empty($swift)}                            
                            <tr>
                                <td>{$swift|escape:'html':'UTF-8'}</td>
                            </tr>
                        {/if}                            
                        {if !empty($banka)}                            
                            <tr>
                                <td>{$banka|escape:'html':'UTF-8'}</td>
                            </tr>
                        {/if}                            
{*}                        {if !empty($vs)}                            
                            <tr>
                                <td>{$vs|escape:'html':'UTF-8'}</td>
                            </tr>
                        {/if}                            
                        {if !empty($ks)}                            
                            <tr>
                                <td>{$ks|escape:'html':'UTF-8'}</td>
                            </tr>
                        {/if}
{*}                                                    
                        </table>                                                
                    </td>
                </tr>
            </table>                        
        </td>
        <td style="width: 50%;" class="">
            <table class="gray8 bold border" cellspacing="0" cellpadding="5">
                <tr style="background-color: #000;">
                    <td style="text-align: right;"><span style="width: 100%; font-size: 14pt; color: #FFF; font-weight: bold;">{$title|escape:'html':'UTF-8'}</span></td>
                </tr>
                <tr>
                    <td class="">
                        <table class="silver8 normal" cellspacing="0" cellpadding="0">
                            <tr>
                                <td class="gray12 bold">Odberateľ:</td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                        {if !empty($delivery_address)}                            
                            {if !empty($invoice_address)}                            
                                <tr>
                                    <td style="font-weight: bold; font-size: 10pt; color: #9E9F9E">{l s='Delivery Address' pdf='true'}</td>					                                       
                                </tr>
                            {/if}
                            <tr>
                                <td>{$delivery_address}</td>
                            </tr>
                        {/if}
                        {if !empty($invoice_address)}                            
                            <tr>
                                <td style="font-weight: bold; font-size: 10pt; color: #9E9F9E">{l s='Billing Address' pdf='true'}</td>					                                       
                            </tr>
                            <tr>
                                <td>{$invoice_address}</td>                                
                            </tr>
                        {/if}
                            
                        </table>
                    </td>
                </tr>
            </table>
            <table class="silver8 normal" cellspacing="0" cellpadding="5" border="0">
                <tr>
                    <td class="border" style="text-align: center;"><span class="size8 green bold">Dátum vystavenia</span><br /><span class="gray8 bold">{$date|date_format:"%d.%m.%Y"|escape:'html':'UTF-8'}</span></td>
{*}                    <td class="border" style="text-align: center;"><span class="size8 blue bold">Dátum zd. plnenia</span><br /><span class="gray8 bold">{$date|date_format:"%d.%m.%Y"|escape:'html':'UTF-8'}</span></td>
                    <td class="border" style="text-align: center;"><span class="size8 red bold">Dátum splatnosti</span><br /><span class="gray8 normal">{$order->date_pay|date_format:"%d.%m.%Y"|escape:'html':'UTF-8'}</span></td>
{*}                    
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
                        </table>                                                
                    </td>
                    <td style="width:50%">
                        <table class="gray8 bold" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>{$order->getUniqReference()}</td>
                            </tr>
<!--                            <tr>
                                <td>
			                         <table class="gray8 bold" cellspacing="0" cellpadding="0">
			                             {foreach from=$order_invoice->getOrderPaymentCollection() item=payment}
				                            <tr>
					                           <td style="width: 50%">{$payment->payment_method}</td>
					                           <td style="width: 50%">{displayPrice price=$payment->amount currency=$order->id_currency}</td>
				                            </tr>
			                             {foreachelse}
				                            <tr>
					                           <td>{l s='No payment' pdf='true'}</td>
				                            </tr>
			                             {/foreach}
			                         </table>                                     
                                </td>
                            </tr>
-->                            
                            <tr>
                                <td>{$carrier->name}</td>
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
				<tr style="line-height:4px;">
				    <td style="background-color: #6D6D6D; color: #FFF; text-align: left; font-weight: bold; width: 11%">{l s='EAN' pdf='true'}</td>
					<td style="text-align: left; background-color: #6D6D6D; color: #FFF; padding-left: 10px; font-weight: bold; width: 82%">{l s='Product' pdf='true'}</td>
					<td style="background-color: #6D6D6D; color: #FFF; text-align: center; font-weight: bold; width: 7%">{l s='Qty' pdf='true'}</td>
				</tr>
				{foreach $order_details as $order_detail}
				{cycle values='#EEE,#DDD' assign=bgcolor}
				<tr style="line-height:6px;background-color:{$bgcolor};">
					<td style="text-align: left; width: 11%">{if isset($order_detail.product_ean13) && !empty($order_detail.product_ean13)}{$order_detail.product_ean13}{/if}</td>
					<td style="text-align: left; width: 82% ">{$order_detail.product_name}</td>
					<td style="text-align: center; width: 7%">{$order_detail.product_quantity}</td>
				</tr>                
					{foreach $order_detail.customizedDatas as $customizationPerAddress}
						{foreach $customizationPerAddress as $customizationId => $customization}
							<tr style="line-height:6px;background-color:{$bgcolor};">
								<td style="text-align: right; width: 11%"></td>
								<td style="line-height:3px; text-align: left; width: 82%; vertical-align: top">

										<blockquote>
											{if isset($customization.datas[$smarty.const._CUSTOMIZE_TEXTFIELD_]) && count($customization.datas[$smarty.const._CUSTOMIZE_TEXTFIELD_]) > 0}
												{foreach $customization.datas[$smarty.const._CUSTOMIZE_TEXTFIELD_] as $customization_infos}
													{$customization_infos.name}: {$customization_infos.value}
													{if !$smarty.foreach.custo_foreach.last}<br />
													{else}
													<div style="line-height:0.4pt">&nbsp;</div>
													{/if}
												{/foreach}
											{/if}

											{if isset($customization.datas[$smarty.const._CUSTOMIZE_FILE_]) && count($customization.datas[$smarty.const._CUSTOMIZE_FILE_]) > 0}
												{count($customization.datas[$smarty.const._CUSTOMIZE_FILE_])} {l s='image(s)' pdf='true'}
											{/if}
										</blockquote>
								</td>
								<td style="text-align: right;"></td>
								<td style="text-align: center; width: 7%; vertical-align: top">({$customization.quantity})</td>
							</tr>
						{/foreach}
					{/foreach}
				{/foreach}
				<!-- END PRODUCTS -->

			</table>

		</td>
	</tr>
</table>
<!-- / PRODUCTS TAB -->

<div style="line-height: 1pt">&nbsp;</div>

{if isset($HOOK_DISPLAY_PDF)}
<div style="line-height: 1pt">&nbsp;</div>
<table style="width: 100%">
	<tr>
		<td style="width: 17%"></td>
		<td style="width: 83%">{$HOOK_DISPLAY_PDF}</td>
	</tr>
</table>
{/if}

</div>

