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
<table class="table" width="100%;" cellspacing="0" cellpadding="0" id="documents_table">
	<thead>
	<tr>
		<th style="width:10%">{l s='Dátum'}</th>
		<th style="">{l s='Dokument'}</th>
		<th style="width:20%">{l s='Číslo'}</th>
		<th style="width:10%">{l s='Suma'}</th>
		<th style="width:1%"></th>
	</tr>
	</thead>
	<tbody>
	{foreach from=$order->getDocuments() item=document}

 {if (!$oz || (get_class($document) eq 'OrderInvoice' && isset($document->is_delivery)) || (get_class($document) eq 'OrderSlip')) || (!$disable_fakturu)}
	{if get_class($document) eq 'OrderInvoice'}
		{if isset($document->is_delivery)}
		<tr class="invoice_line" id="delivery_{$document->id}">
		{else}
		<tr class="invoice_line" id="invoice_{$document->id}">
		{/if}
	{elseif get_class($document) eq 'OrderSlip'}
		<tr class="invoice_line" id="orderslip_{$document->id}">
	{/if}

		<td class="document_date">{dateFormat date=$document->date_add}</td>
		<td class="document_type">
			{if get_class($document) eq 'OrderInvoice'}
				{if isset($document->is_delivery)}
					{l s='Dodací list'}
				{else}
					{l s='Faktúra'}
				{/if}
			{elseif get_class($document) eq 'OrderSlip'}
				{l s='Dobropis'}
			{/if}</td>
		<td class="document_number">
			{if get_class($document) eq 'OrderInvoice'}
				{if isset($document->is_delivery)}
					<a target="_blank" href="{$link->getAdminLink('AdminPdf')|escape:'htmlall':'UTF-8'}&submitAction=generateDeliverySlipPDF&id_order_invoice={$document->id}">
			   	{else}
					<a target="_blank" href="{$link->getAdminLink('AdminPdf')|escape:'htmlall':'UTF-8'}&submitAction=generateInvoicePDF&id_order_invoice={$document->id}">
			   {/if}
			{elseif get_class($document) eq 'OrderSlip'}
				<a target="_blank" href="{$link->getAdminLink('AdminPdf')|escape:'htmlall':'UTF-8'}&submitAction=generateOrderSlipPDF&id_order_slip={$document->id}">
			{/if}
			{if get_class($document) eq 'OrderInvoice'}
					{$document->getInvoiceNumberFormatted($current_id_lang)}
			{elseif get_class($document) eq 'OrderSlip'}
				#{Configuration::get('PS_CREDIT_SLIP_PREFIX', $current_id_lang)}{'%06d'|sprintf:$document->id}
			{/if} <img src="../img/admin/details.gif" alt="{l s='Zobraziť dokument'}" /></a></td>
		<td class="document_amount">
		{if get_class($document) eq 'OrderInvoice'}
			{if isset($document->is_delivery)}
				--
			{else}
				{displayPrice price=$document->total_paid_tax_incl currency=$currency->id}&nbsp;
				{if $document->getTotalPaid()}
					<span style="color:red;font-weight:bold;">
					{if $document->getRestPaid() > 0}
						({displayPrice price=$document->getRestPaid() currency=$currency->id} {l s='nezaplatené'})
					{else if $document->getRestPaid() < 0}
						({displayPrice price=-$document->getRestPaid() currency=$currency->id} {l s='preplatené'})
					{/if}
					</span>
				{/if}
			{/if}
		{elseif get_class($document) eq 'OrderSlip'}
			{displayPrice price=$document->amount currency=$currency->id}
		{/if}
		</td>
		<td class="right document_action">
		{if get_class($document) eq 'OrderInvoice'}
			{if !isset($document->is_delivery)}
				{if $document->getRestPaid()}
					<a href="#" class="js-set-payment" data-amount="{$document->getRestPaid()}" data-id-invoice="{$document->id}" title="{l s='Nastaviť platbu'}"><img src="../img/admin/money_add.png" alt="{l s='Nastaviť platbu'}" /></a>
				{/if}
				<a href="#" onclick="$('#invoiceNote{$document->id}').show(); return false;" title="{if $document->note eq ''}{l s='Pridať poznámku'}{else}{l s='Upraviť poznámku'}{/if}"><img src="../img/admin/note.png" alt="{if $document->note eq ''}{l s='Pridať poznámku'}{else}{l s='Upraviť poznámku'}{/if}"{if $document->note eq ''} class="js-disabled-action"{/if} /></a>
			{/if}
		{/if}
		</td>
	</tr>
    
 {/if}
	{if get_class($document) eq 'OrderInvoice'}
		{if !isset($document->is_delivery)}
	<tr id="invoiceNote{$document->id}" style="display:none" class="current-edit">
		<td colspan="5">
			<form action="{$current_index}&viewOrder&id_order={$order->id}&token={$smarty.get.token|escape:'htmlall':'UTF-8'}" method="post">
				<p>
					<label for="editNote{$document->id}" class="t">{l s='Poznámka'}</label>
					<input type="hidden" name="id_order_invoice" value="{$document->id}" />
					<textarea name="note" rows="10" cols="10" id="editNote{$document->id}" class="edit-note">{$document->note|escape:'htmlall':'UTF-8'}</textarea>
				</p>
				<p class="right">
					<input type="submit" name="submitEditNote" value="{l s='Uložiť'}" class="button" />&nbsp;
					<a href="#" id="cancelNote" onclick="$('#invoiceNote{$document->id}').hide();return false;">{l s='Zrušiť'}</a>
				</p>
			</form>
		</td>
	</tr>
		{/if}
	{/if}
	{foreachelse}
	<tr>
		<td colspan="5" class="center">
			<h3>{l s='Žiadne dokumenty'}</h3>
			{if isset($invoice_management_active) && $invoice_management_active}
			<p><a class="button" href="{$current_index}&viewOrder&submitGenerateInvoice&id_order={$order->id}&token={$smarty.get.token|escape:'htmlall':'UTF-8'}">{l s='Generovať faktúru'}</a></p>
			{/if}
		</td>
	</tr>
	{/foreach}
	</tbody>
</table>
