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
{$totalcount = 0}
<table style="width: 100%">
	<tr>
		<td style="width: 100%; text-align: right">
			<table class="" style="width: 100%; font-size: 8pt;" cellspacing="0" cellpadding="3">
				<tr style="line-height:4px;">
				    <td class="borderbottom" style="text-align: left; font-weight: bold; width: 13%">{l s='EAN' pdf='true'}</td>
					<td class="borderbottom" style="text-align: left; padding-left: 10px; font-weight: bold; width: 60%">{l s='Product' pdf='true'}</td>
					<td class="borderbottom" style="text-align: center; font-weight: bold; width: 7%">{l s='Qty' pdf='true'}</td>                    
	                <td class="borderbottom" style="text-align: center; font-weight: bold; width: 10%">{l s='Jednotková<br/>cena' pdf='true'}<br />{l s='(Tax Excl.)' pdf='true'}</td>
                    <td class="borderbottom" style="text-align: center; font-weight: bold; width: 10%">
                        {l s='Total' pdf='true'}
                        <br />{l s='(Tax Excl.)' pdf='true'}
                    </td>
				</tr>
				{foreach $order_details as $order_detail}
				{cycle values='#EEE,#DDD' assign=bgcolor}
				<tr style="line-height:6px;">
					<td style="text-align: left; width: 13%">{if isset($order_detail.product_ean13) && !empty($order_detail.product_ean13)}{$order_detail.product_ean13}{/if}</td>
					<td style="text-align: left; width: 60% ">{$order_detail.product_name}</td>
					<td style="text-align: center; width: 7%">{$order_detail.product_quantity}</td>
					<td style="text-align: right; width: 10%">{displayPrice currency=$order->id_currency price=$order_detail.unit_price_tax_excl}</td>
					<td style="text-align: right; width: 10%">
						{displayPrice currency=$order->id_currency price=$order_detail.total_price_tax_excl}
					</td>

                    {$totalcount = $totalcount +  $order_detail.product_quantity}
				</tr>                
					{foreach $order_detail.customizedDatas as $customizationPerAddress}
						{foreach $customizationPerAddress as $customizationId => $customization}
							<tr style="line-height:6px;">
								<td style="text-align: right; width: 13%"></td>
								<td style="line-height:3px; text-align: left; width: 80%; vertical-align: top">

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
								<td style="text-align: center; width: 7%; vertical-align: top">({$customization.quantity})</td>
                                {$totalcount = $totalcount +  $customization.quantity}
							</tr>
						{/foreach}
					{/foreach}
				{/foreach}
				<tr style="line-height:6px;">
					<td class="bordertop" style="text-align: left; width: 13%"></td>
					<td class="bordertop" style="text-align: left; width: 60% ">{l s='Spolu množstvo' pdf='true'}</td>
					<td class="bordertop" style="text-align: center; width: 7%">{$totalcount}</td>
                    <td class="bordertop" style="text-align: center; font-weight: bold; width: 10%"></td>
                    <td class="bordertop" style="text-align: center; font-weight: bold; width: 10%"></td>
				</tr>           
				<tr style="line-height:5px;">
					<td style="text-align: left; width: 13%"></td>
					<td style="width: 70%; text-align: left; font-weight: bold">{l s='Product Total (Tax Excl.)' pdf='true'}</td>
					<td style="width: 17%; text-align: right;">{displayPrice currency=$order->id_currency price=$order_invoice->total_products}</td>
				</tr>
                     
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

