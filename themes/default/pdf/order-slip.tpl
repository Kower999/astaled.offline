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
    .thead { background-color: #6D6D6D; color: #FFF; font-weight: bold; }
    .center { text-align: center; }
    .left { text-align: left; }
    .right { text-align: right; }
    .c1 { width: 8%; }
    .c2 { width: 30%; }
    .c3 { width: 10%; }
    .c4 { width: 10%; }
    .c5 { width: 6%; }
    .c6 { width: 10%; }
    .c7 { width: 10%; }
    .c8 { width: 9%; }
    .c9 { width: 10%; }    
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
                    <td style="width:50%">
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
                    <td style="width:50%">
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
                    <td style="width:50%;padding:10px 10px 10px 0px;">
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
                    <td style="width:50%">
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
                                <td>{$shop->domain|escape:'html':'UTF-8'}</td>
                            </tr>
                        </table>                                                
                    </td>
                </tr>
            </table>                        
    		<table class="gray8 normal bordertop" cellspacing="0" cellpadding="5">
                <tr>
                    <td style="width:50%;padding:10px 10px 10px 0px;">
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
                        {if !empty($vs)}                            
                            <tr>
                                <td>Variabilný symbol:</td>
                            </tr>
                        {/if}                            
                        {if !empty($ks)}                            
                            <tr>
                                <td>Konštantný symbol:</td>
                            </tr>
                        {/if}                            
                        </table>                                                
                    </td>
                    <td style="width:50%">
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
                        {if !empty($vs)}                            
                            <tr>
                                <td>{$vs|escape:'html':'UTF-8'}</td>
                            </tr>
                        {/if}                            
                        {if !empty($ks)}                            
                            <tr>
                                <td>{$ks|escape:'html':'UTF-8'}</td>
                            </tr>
                        {/if}                            
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
                            <tr>
                                <td style="font-weight: bold; font-size: 10pt; color: #9E9F9E">{l s='Delivery Address' pdf='true'}</td>					                                       
                            </tr>
                            <tr>
                                <td>{$delivery_address}</td>
                            </tr>
                        {/if}
                            <tr>
                                <td style="font-weight: bold; font-size: 10pt; color: #9E9F9E">{l s='Billing Address' pdf='true'}</td>					                                       
                            </tr>
                            <tr>
                                <td>{$invoice_address}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <table class="silver8 normal" cellspacing="0" cellpadding="5" border="0">
                <tr>
                    <td class="border" style="text-align: center;"><span class="size8 green bold">Dátum vystavenia</span><br /><span class="gray8 bold">{$date|date_format:"%d.%m.%Y"|escape:'html':'UTF-8'}</span></td>
                    <td class="border" style="text-align: center;"><span class="size8 blue bold">Dátum zd. plnenia</span><br /><span class="gray8 bold">{$date|date_format:"%d.%m.%Y"|escape:'html':'UTF-8'}</span></td>
                    <td class="border" style="text-align: center;"><span class="size8 red bold">Dátum splatnosti</span><br /><span class="gray8 normal">{$order->date_pay|date_format:"%d.%m.%Y"|escape:'html':'UTF-8'}</span></td>
                </tr>
            </table>
    		<table class="gray8 normal border" cellspacing="0" cellpadding="5">
                <tr>
                    <td style="width:50%;padding:10px 10px 10px 0px;">
                        <table class="gray8 bold" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>Číslo objednávky:</td>
                            </tr>
                        </table>                                                
                    </td>
                    <td style="width:50%">
                        <table class="gray8 bold" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>{$order->getUniqReference()}</td>
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
				    <td class="c1 thead center">{l s='Reference' pdf='true'}</td>
					<td class="c2 thead left">{l s='Product' pdf='true'}</td>
					<td class="c3 thead center">{l s='Unit Price' pdf='true'}<br />{l s='(Tax Excl.)' pdf='true'}</td>
					<td class="c4 thead center">{l s='Unit Price' pdf='true'}<br />{l s='(Tax Incl.)' pdf='true'}</td>
					<td class="c5 thead center">{l s='Tax Rate' pdf='true'}</td>
					<td class="c5 thead center">{l s='Tax value' pdf='true'}</td>
					<td class="c7 thead center">{l s='Discount' pdf='true'}</td>
					<td class="c8 thead center">{l s='Qty' pdf='true'}</td>
					<td class="c9 thead center">
						{l s='Total' pdf='true'}
						{if $tax_excluded_display}
							<br />{l s='(Tax Excl.)' pdf='true'}
						{else}
							<br />{l s='(Tax Incl.)' pdf='true'}
						{/if}
					</td>
				</tr>
				<!-- PRODUCTS -->
				{foreach $order_details as $order_detail}
				{cycle values='#FFF,#EFEFEF' assign=bgcolor}
				<tr style="line-height:6px;background-color:{$bgcolor};">
					<td class="left">{if isset($order_detail.product_reference) && !empty($order_detail.product_reference)}{$order_detail.product_reference}{/if}</td>
					<td class="left">{$order_detail.product_name}</td>
					<td class="right">- {displayPrice currency=$order->id_currency price=$order_detail.unit_price_tax_excl}</td>
					<td class="right">- {displayPrice currency=$order->id_currency price=$order_detail.unit_price_tax_incl}</td>
					<td class="center">{if $order_detail.tax_rate>0}{$order_detail.tax_rate|number_format:0}{else}{$order->carrier_tax_rate|number_format:0}{/if}%</td>
					<td class="right">- {displayPrice currency=$order->id_currency price=($order_detail.unit_price_tax_incl - $order_detail.unit_price_tax_excl)}</td>
					<td class="right">
					{if (isset($order_detail.reduction_amount) && $order_detail.reduction_amount > 0)}
						- {displayPrice currency=$order->id_currency price=$order_detail.reduction_amount}
					{elseif (isset($order_detail.reduction_percent) && $order_detail.reduction_percent > 0)}
						- {$order_detail.reduction_percent}%
					{else}
					--
					{/if}
					</td>
					<td class="center">{$order_detail.product_quantity}</td>
					<td class="right">
					{if $tax_excluded_display}
						- {displayPrice currency=$order->id_currency price=$order_detail.total_price_tax_excl}
					{else}
						- {displayPrice currency=$order->id_currency price=$order_detail.total_price_tax_incl}
					{/if}
					</td>
				</tr>
					{foreach $order_detail.customizedDatas as $customizationPerAddress}
						{foreach $customizationPerAddress as $customizationId => $customization}
							<tr style="line-height:6px;background-color:{$bgcolor};">
                                <td></td>
								<td class="left">

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
								<td></td>                                
								<td></td>                                
								<td></td>                                
								<td></td>                                
								<td></td>
								<td class="center">({$customization.quantity})</td>
								<td></td>
							</tr>
						{/foreach}
					{/foreach}
				{/foreach}
				<!-- END PRODUCTS -->
				{if $order->total_shipping_tax_incl > 0}
				{cycle values='#FFF,#EFEFEF' assign=bgcolor}
				<tr style="line-height:6px;background-color:{$bgcolor};">
                    <td class="left"></td>
					<td class="left">{l s='Shipping' pdf='true'}</td>
					<td class="right">- {displayPrice currency=$order->id_currency price=$order->total_shipping_tax_excl}</td>
					<td class="right">- {displayPrice currency=$order->id_currency price=$order->total_shipping_tax_incl}</td>
					<td class="center">{$order->carrier_tax_rate|number_format:0}%</td>
					<td class="right">- {displayPrice currency=$order->id_currency price=($order->total_shipping_tax_incl - $order->total_shipping_tax_excl)}</td>
                    <td class="right">-</td>
					<td class="center">1</td>
					<td class="right">
						{if $tax_excluded_display}
							- {displayPrice currency=$order->id_currency price=$order->total_shipping_tax_excl}
							{else}
							- {displayPrice currency=$order->id_currency price=$order->total_shipping_tax_incl}
						{/if}
					</td>
				</tr>
				{/if}

				{if $order->total_wrapping_tax_incl <> 0}
				{cycle values='#FFF,#EFEFEF' assign=bgcolor}
				<tr style="line-height:6px;background-color:{$bgcolor};">
                    <td class="left"></td>
					<td class="left">{l s='Wrapping cost' pdf='true'}</td>
					<td class="right">- {displayPrice currency=$order->id_currency price=$order_->total_wrapping_tax_excl}</td>
					<td class="right">- {displayPrice currency=$order->id_currency price=$order->total_wrapping_tax_incl}</td>
					<td class="center">{$order->carrier_tax_rate|number_format:0}%</td>
					<td class="right">- {displayPrice currency=$order->id_currency price=($order_->total_wrapping_tax_incl - $order->total_wrapping_tax_excl)}</td>
                    <td class="right">-</td>
					<td class="center">1</td>                    
					<td class="right">
					{if $tax_excluded_display}
						- {displayPrice currency=$order->id_currency price=$order->total_wrapping_tax_excl}
					{else}
						- {displayPrice currency=$order->id_currency price=$order->total_wrapping_tax_incl}
					{/if}
					</td>
				</tr>
				{/if}
                

				<!-- CART RULES -->
				{assign var="shipping_discount_tax_incl" value="0"}
				{foreach $cart_rules as $cart_rule}
					{cycle values='#FFF,#EFEFEF' assign=bgcolor}
					<tr style="line-height:6px;background-color:{$bgcolor};text-align:left;">
						<td style="line-height:3px;text-align:left;width:60%;vertical-align:top" colspan="{if !$tax_excluded_display}5{else}4{/if}">{$cart_rule.name}</td>
						<td>
							{if $tax_excluded_display}
								- {$cart_rule.value_tax_excl}
							{else}
								- {$cart_rule.value}
							{/if}
						</td>
					</tr>
				{/foreach}
				<!-- END CART RULES -->
			</table>

			<table style="width: 100%" cellspacing="0" cellpadding="3">
				{if (($order->total_paid_tax_incl - $order->total_paid_tax_excl) > 0)}
				<tr style="line-height:5px;">
					<td style="width: 83%; text-align: right; font-weight: bold">{l s='Product Total (Tax Excl.)' pdf='true'}</td>
					<td style="width: 17%; text-align: right;">- {displayPrice currency=$order->id_currency price=$order->total_products}</td>
				</tr>

				<tr style="line-height:5px;">
					<td style="width: 83%; text-align: right; font-weight: bold">{l s='Product Total (Tax Incl.)' pdf='true'}</td>
					<td style="width: 17%; text-align: right;">- {displayPrice currency=$order->id_currency price=$order->total_products_wt}</td>
				</tr>
				{else}
				<tr style="line-height:5px;">
					<td style="width: 83%; text-align: right; font-weight: bold">{l s='Product Total' pdf='true'}</td>
					<td style="width: 17%; text-align: right;">- {displayPrice currency=$order->id_currency price=$order->total_products}</td>
				</tr>
				{/if}

				{if $order->total_discount_tax_incl > 0}
				<tr style="line-height:5px;">
					<td style="text-align: right; font-weight: bold">{l s='Total Vouchers' pdf='true'}</td>
					<td style="width: 17%; text-align: right;">-{displayPrice currency=$order->id_currency price=($order->total_discount_tax_incl)}</td>
				</tr>
				{/if}

				{if ($order->total_paid_tax_incl - $order->total_paid_tax_excl) > 0}
				<tr style="line-height:5px;">
					<td style="text-align: right; font-weight: bold">{l s='Total Tax' pdf='true'}</td>
					<td style="width: 17%; text-align: right;">- {displayPrice currency=$order->id_currency price=($order->total_paid_tax_incl - $order->total_paid_tax_excl)}</td>
				</tr>
				{/if}

				<tr style="line-height:5px;">
                    <td style="width: 60%;"></td>
					<td style="width: 23%;text-align: right; color: #FFF; background-color: #6D6D6D; font-weight: bold; font-size: 12pt;">{l s='Total' pdf='true'}</td>
					<td style="width: 17%; color: #FFF; background-color: #6D6D6D; text-align: right; font-size: 12pt;">- {displayPrice currency=$order->id_currency price=$order->total_paid_tax_incl}</td>
				</tr>

			</table>

		</td>
	</tr>
</table>
<!-- / PRODUCTS TAB -->

<div style="line-height: 1pt">&nbsp;</div>

{$tax_tab}


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

