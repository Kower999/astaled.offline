 {*
 * 
 *  2011-2013 OBSolutions S.C.P.  
 *  All Rights Reserved.
 * 
 * NOTICE:  All information contained herein is, and remains
 * the property of OBSolutions S.C.P. and its suppliers,
 * if any.  The intellectual and technical concepts contained
 * herein are proprietary to OBSolutions S.C.P.
 * and its suppliers and are protected by trade secret or copyright law.
 * Dissemination of this information or reproduction of this material
 * is strictly forbidden unless prior written permission is obtained
 * from OBSolutions S.C.P.
 *}
{include file='./errorMessages.tpl'}
{include file='./noApiKeyWarn.tpl'}
{if !$obsShowApiKeyWarn}
	<fieldset>
		<legend><img alt="{l s='Subscribers' mod='obsegoi'}" src="../img/admin/details.gif"/> {l s='Users subscribed at' mod='obsegoi'} {$listName}</legend>
		<table cellspacing="0" cellpadding="0" style="width: 100%; margin-bottom:10px;" class="table">
			<tr style="height:40px;">
				<th class="center" width="50"><span class="title_box">{l s='E-goi ID' mod='obsegoi'}</span></th>
				<th><span class="title_box">{l s='Name' mod='obsegoi'}</span></th>
				<th><span class="title_box">{l s='Email' mod='obsegoi'}</span></th>
				<th class="center" width="100"><span class="title_box">{l s='Subscribed' mod='obsegoi'}</span></th>
				<th class="center" width="150"><span class="title_box">{l s='Subs. Date' mod='obsegoi'}</span></th>
			</tr>
			{foreach $subscribersList as $subscriber}
			<tr class="row_hover">
				<td class="center">{$subscriber.sub_egoi_uid}</td>
				<td>{$subscriber.firstname} {$subscriber.lastname}</td>
				<td>{$subscriber.email}</td>
				<td class="center">{if $subscriber.newsletter}<img src="../img/admin/enabled.gif" alt="{l s='enabled' mod='obsegoi'}"/>{else}<img src="../img/admin/disabled.gif" alt="{l s='disabled' mod='obsegoi'}"/>{/if}</td>
				<td class="center">{$subscriber.newsletter_date_add}</td>
			</tr>
			{foreachelse}
			<tr class="row_hover">
				<td class="center" colspan="5">{l s='There is no subscribed customers' mod='obsegoi'}</td>
			</tr>
			{/foreach}
		</table>
	</fieldset>
{/if}