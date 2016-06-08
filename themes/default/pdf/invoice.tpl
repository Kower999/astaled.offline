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
    .c2 { width: 41%; }
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
                        <td class="c1 thead center">{l s='EAN' pdf='true'}</td>
                        <td class="c2 thead center">{l s='Product' pdf='true'}</td>
					    <td class="c8 thead center">{l s='Qty' pdf='true'}</td>
					    <td class="c3 thead center">{l s='Jednotková<br/>cena' pdf='true'}<br />{l s='(Tax Excl.)' pdf='true'}</td>
					    <td class="c4 thead center">{l s='Jednotková<br/>cena' pdf='true'}<br />{l s='(Tax Incl.)' pdf='true'}</td>
					    <td class="c5 thead center">{l s='Tax Rate' pdf='true'}</td>
					    <td class="c6 thead center">{l s='Tax value' pdf='true'}</td>
<!--					    <td class="c7 thead center">{l s='Discount' pdf='true'}</td> -->
					    <td class="c9 thead center">
						      {l s='Total' pdf='true'}
						      {if $tax_excluded_display}
							     <br />{l s='(Tax Excl.)' pdf='true'}
						      {else}
							     <br />{l s='(Tax Incl.)' pdf='true'}
						      {/if}
					    </td>
	                </tr>
<!--                
	<tr >
		<td style="text-align: right">
			<table class="" style="width: 100%; font-size: 7pt;" cellspacing="0" cellpadding="1"> -->
				<!-- PRODUCTS -->
                {$key = false}
				{foreach $order_details as $order_detail}
{*}            {$order_detail|@var_dump}  
            {$order|@var_dump} {*}
                {if !$key}
                    {$key = true}
                {/if}
				{cycle values='#FFF,#EFEFEF' assign=bgcolor}
				<tr style="line-height:6px;" {if $key}class="bordertop2"{/if}>
					<td class="c1 left">{if isset($order_detail.product_ean13) && !empty($order_detail.product_ean13)}{$order_detail.product_ean13}{/if}</td>
					<td class="c2 left">{$order_detail.product_name}</td>
					<td class="c8 center">{$order_detail.product_quantity}</td>
					<td class="c3 right">{displayPrice currency=$order->id_currency price=$order_detail.unit_price_tax_excl}</td>
					<td class="c4 right">{displayPrice currency=$order->id_currency price=$order_detail.unit_price_tax_incl}</td>
					<td class="c5 center">{if $order_detail.tax_rate>0}{$order_detail.tax_rate|number_format:0}{else}{$order->carrier_tax_rate|number_format:0}{/if}%</td>
					<td class="c6 right">{displayPrice currency=$order->id_currency price=($order_detail.unit_price_tax_incl - $order_detail.unit_price_tax_excl)}</td>
<!--					<td class="c7 right">
					{if (isset($order_detail.reduction_amount) && $order_detail.reduction_amount > 0)}
						-{displayPrice currency=$order->id_currency price=$order_detail.reduction_amount}
					{elseif (isset($order_detail.reduction_percent) && $order_detail.reduction_percent > 0)}
						-{$order_detail.reduction_percent}%
					{else}
					-
					{/if}                    
					</td>
-->                    
					<td class="c9 right">
					{if $tax_excluded_display}
						{displayPrice currency=$order->id_currency price=$order_detail.total_price_tax_excl}
					{else}
						{displayPrice currency=$order->id_currency price=$order_detail.total_price_tax_incl}
					{/if}
					</td>
				</tr>
                {if $order_detail.ecotax>0}
				<tr style="line-height:6px;" {if $key}class="bordertop2"{/if}>
					<td class="c1 left"></td>
					<td class="c2 left">{l s='Recyklačný poplatok' pdf='true'}</td>
					<td class="c8 center">{$order_detail.product_quantity}</td>
					<td class="c3 right">{displayPrice currency=$order->id_currency price=$order_detail.ecotax}</td>
					<td class="c4 right">{displayPrice currency=$order->id_currency price=$order_detail.ecotax_wt}</td>
					<td class="c5 center">{if $order_detail.ecotax_tax_rate>0}{$order_detail.ecotax_tax_rate|number_format:0}{else}{$order->carrier_tax_rate|number_format:0}{/if}%</td>
					<td class="c6 right">{displayPrice currency=$order->id_currency price=$order_detail.ecotax_tax}</td>
					<td class="c9 right">{displayPrice currency=$order->id_currency price=$order_detail.ecotax_total}</td>
				</tr>
                {/if}
					{foreach $order_detail.customizedDatas as $customizationPerAddress}
						{foreach $customizationPerAddress as $customizationId => $customization}
							<tr style="line-height:6px;">
								<td style="line-height:3px; text-align: left; width: 50%; vertical-align: top">

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
								{if !$tax_excluded_display}
									<td style="text-align: right;"></td>
								{/if}
								<td style="text-align: right; width: 7%"></td>
								<td style="text-align: center; width: 7%; vertical-align: top">({$customization.quantity})</td>
								<td style="width: 12%; text-align: right;"></td>
							</tr>
						{/foreach}
					{/foreach}
				{/foreach}
				<!-- END PRODUCTS -->
                
				{if $order_invoice->total_shipping_tax_incl > 0}
				{cycle values='#FFF,#EFEFEF' assign=bgcolor}
				<tr style="line-height:6px;">
                    <td class="left"></td>
					<td class="left">{l s='Shipping' pdf='true'}</td>
					<td class="right">{displayPrice currency=$order->id_currency price=$order_invoice->total_shipping_tax_excl}</td>
					<td class="right">{displayPrice currency=$order->id_currency price=$order_invoice->total_shipping_tax_incl}</td>
					<td class="center">{$order->carrier_tax_rate|number_format:0}%</td>
					<td class="right">{displayPrice currency=$order->id_currency price=($order_invoice->total_shipping_tax_incl - $order_invoice->total_shipping_tax_excl)}</td>
					<td class="center">1</td>
					<td class="right">
						{if $tax_excluded_display}
							{displayPrice currency=$order->id_currency price=$order_invoice->total_shipping_tax_excl}
							{else}
							{displayPrice currency=$order->id_currency price=$order_invoice->total_shipping_tax_incl}
						{/if}
					</td>
				</tr>
				{/if}

				{if $order_invoice->total_wrapping_tax_incl > 0}
				{cycle values='#FFF,#EFEFEF' assign=bgcolor}
				<tr style="line-height:6px;">
                    <td class="left"></td>
					<td class="left">{l s='Wrapping cost' pdf='true'}</td>
					<td class="right">{displayPrice currency=$order->id_currency price=$order_invoice->total_wrapping_tax_excl}</td>
					<td class="right">{displayPrice currency=$order->id_currency price=$order_invoice->total_wrapping_tax_incl}</td>
					<td class="center">{$order->carrier_tax_rate|number_format:0}%</td>
					<td class="right">{displayPrice currency=$order->id_currency price=($order_invoice->total_wrapping_tax_incl - $order_invoice->total_wrapping_tax_excl)}</td>
					<td class="center">1</td>                    
					<td class="right">
					{if $tax_excluded_display}
						{displayPrice currency=$order->id_currency price=$order_invoice->total_wrapping_tax_excl}
					{else}
						{displayPrice currency=$order->id_currency price=$order_invoice->total_wrapping_tax_incl}
					{/if}
					</td>
				</tr>
				{/if}
                
				<!-- CART RULES -->
				{assign var="shipping_discount_tax_incl" value="0"}
				{foreach $cart_rules as $cart_rule}
					{cycle values='#FFF,#EFEFEF' assign=bgcolor}
					<tr style="line-height:6px;text-align:left;">
                        <td></td>
						<td style="text-align:left;vertical-align:center" colspan="{if !$tax_excluded_display}7{else}6{/if}">{$cart_rule.name}</td>
						<td style="text-align:right;">
							{if $tax_excluded_display}
								- {displayPrice currency=$order->id_currency price=$cart_rule.value_tax_excl}
							{else}
								- {displayPrice currency=$order->id_currency price=$cart_rule.value}
							{/if}
						</td>
					</tr>
				{/foreach}
				<!-- END CART RULES -->
			</table>

			<table style="width: 100%; font-size: 8pt;" cellspacing="0" cellpadding="3">
				{if (($order_invoice->total_paid_tax_incl - $order_invoice->total_paid_tax_excl) > 0)}
				<tr style="line-height:5px;">
					<td style="width: 83%; text-align: right; font-weight: bold">{l s='Product Total (Tax Excl.)' pdf='true'}</td>
					<td style="width: 17%; text-align: right;">{displayPrice currency=$order->id_currency price=$order_invoice->total_products}</td>
				</tr>

				<tr style="line-height:5px;">
					<td style="width: 83%; text-align: right; font-weight: bold">{l s='Product Total (Tax Incl.)' pdf='true'}</td>
					<td style="width: 17%; text-align: right;">{displayPrice currency=$order->id_currency price=$order_invoice->total_products_wt}</td>
				</tr>
				{else}
				<tr style="line-height:5px;">
					<td style="width: 83%; text-align: right; font-weight: bold">{l s='Product Total' pdf='true'}</td>
					<td style="width: 17%; text-align: right;">{displayPrice currency=$order->id_currency price=$order_invoice->total_products}</td>
				</tr>
				{/if}

				{if $order_invoice->total_discount_tax_incl > 0}
				<tr style="line-height:5px;">
					<td style="text-align: right; font-weight: bold">{l s='Total Vouchers' pdf='true'}</td>
					<td style="width: 17%; text-align: right;">-{displayPrice currency=$order->id_currency price=($order_invoice->total_discount_tax_incl)}</td>
				</tr>
				{/if}

				{if ($order_invoice->total_paid_tax_incl - $order_invoice->total_paid_tax_excl) > 0}
				<tr style="line-height:5px;">
					<td style="text-align: right; font-weight: bold">{l s='Total Tax' pdf='true'}</td>
					<td style="width: 17%; text-align: right;">{displayPrice currency=$order->id_currency price=($order_invoice->total_paid_tax_incl - $order_invoice->total_paid_tax_excl)}</td>
				</tr>
				{/if}

				<tr style="line-height:5px;">
                    <td style="width: 60%;"></td>
					<td style="width: 23%;text-align: right; font-weight: bold; font-size: 12pt;">{l s='Total' pdf='true'}</td>
					<td style="width: 17%; text-align: right; font-size: 12pt;">{displayPrice currency=$order->id_currency price=$order_invoice->total_paid_tax_incl}</td>
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

{$tax_tab}
<br />
Faktúra zároveň slúži aj ako dodací list.

{if isset($order_invoice->note) && $order_invoice->note}
<div style="line-height: 1pt">&nbsp;</div>
<table style="width: 100%">
	<tr>
		<td style="width: 17%"></td>
		<td style="width: 83%">{$order_invoice->note|nl2br}</td>
	</tr>
</table>
{/if}

{if isset($HOOK_DISPLAY_PDF)}
<div style="line-height: 1pt">&nbsp;</div>
<table style="width: 100%">
	<tr>
		<td style="width: 17%"></td>
		<td style="width: 83%">{$HOOK_DISPLAY_PDF}</td>
	</tr>
</table>
{/if}

