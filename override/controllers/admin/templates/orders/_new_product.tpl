{*
* 2007-2012 PrestaShop
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
*  @copyright  2007-2012 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{nocache}
<tr id="new_product" height="52" style="display:none;background-color:#e9f1f6">
	<td style="display:none;" colspan="3">
		<input type="hidden" id="add_product_product_id" name="add_product[product_id]" value="0" />
		{l s='Produkt:'} <input type="text" id="add_product_product_name" value="" size="42" />
		<div id="add_product_product_attribute_area" style="margin-top: 5px;display: none;">
			{l s='Kombinácie:'} <select name="add_product[product_attribute_id]" id="add_product_product_attribute_id"></select>
		</div>
		<div id="add_product_product_warehouse_area" style="margin-top: 5px; display: none;">
			{l s='Sklad:'} <select  id="add_product_warehouse" name="add_product_warehouse">
			</select>
		</div>
	</td>
	<td style="display:none;">
		{if $currency->sign % 2}{$currency->sign}{/if}<input type="text" name="add_product[product_price_tax_excl]" id="add_product_product_price_tax_excl" value="" size="4" disabled="disabled" /> {if !($currency->sign % 2)}{$currency->sign}{/if} {l s='bez DPH'}<br />
		{if $currency->sign % 2}{$currency->sign}{/if}<input type="text" name="add_product[product_price_tax_incl]" id="add_product_product_price_tax_incl" value="" size="4" disabled="disabled" /> {if !($currency->sign % 2)}{$currency->sign}{/if} {l s='s DPH'}
	</td>
	<td style="display:none;">
        <span>Základná cena: </span><span id="add_product_cena_1">{displayPrice price=0 currency=$currency->id}</span>                         
	</td>
	<td style="display:none;" align="center">
		<span>Hraničná cena: </span><span id="add_product_cena_2">{displayPrice price=0 currency=$currency->id}</span> 
	</td>
	<td style="display:none;" align="center">        
		<span id="add_product_provizia">{displayPrice price=0 currency=$currency->id}</span>
        <input type="hidden" id="cena_2" />         
        <input type="hidden" id="provizia" />         
        <input type="hidden" id="wholesale_price" />         
        <input type="hidden" id="product_tax_rate" />         
	</td>
	<td style="display:none;" align="center" class="productQuantity"><input type="text" name="add_product[product_quantity]" id="add_product_product_quantity" value="1" size="3" disabled="disabled" /></td>
	{if ($order->hasBeenPaid())}<td style="display:none;" align="center" class="productQuantity">&nbsp;</td>{/if}
	{if ($order->hasBeenDelivered())}<td style="display:none;" align="center" class="productQuantity">&nbsp;</td>{/if}
	<td style="display:none;" align="center" class="productQuantity" id="add_product_product_stock">0</td>
	<td style="display:none;" align="center" id="add_product_product_total">{displayPrice price=0 currency=$currency->id}</td>
	<td style="display:none;" align="center" colspan="2">
		{if sizeof($invoices_collection)}
		<select name="add_product[invoice]" id="add_product_product_invoice" disabled="disabled" style=" visibility: hidden;">
			<optgroup class="existing" label="{l s='Existujúce'}">
				{foreach from=$invoices_collection item=invoice}
				<option value="{$invoice->id}">{$invoice->getInvoiceNumberFormatted($current_id_lang)}</option>
				{/foreach}
			</optgroup>
			<optgroup label="{l s='Nová'}">
				<option value="0">{l s='Vytvoriť novú faktúru'}</option>
			</optgroup>
		</select>
		{/if}
	</td>
	<td style="display:none;">
		<input type="button" class="button" id="submitAddProduct" value="{l s='Pridať produkt'}" disabled="disabled" />
	</td>
</tr>
<tr id="new_invoice" style="display:none;background-color:#e9f1f6;">
	<td colspan="10">
		<h3>{l s='Informácia o novej faktúre'}</h3>
		<label>{l s='Doprava:'}</label>
		<div class="margin-form">
			{$carrier->name}
		</div>
		<div class="margin-form">
			<input type="checkbox" name="add_invoice[free_shipping]" value="1" />
			<label class="t">{l s='Poštovné zdarma'}</label>
			<p>{l s='Ak nezvolíte Poštovné zdarma bude použité normálne poštovné'}</p>
		</div>
	</td>
</tr>
{/nocache}