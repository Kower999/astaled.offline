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
		<legend><img alt="{l s='Account Details' mod='obsegoi'}" src="../img/admin/details.gif"/> {l s='Account Details' mod='obsegoi'}</legend>
		{if $clientData}
			<table class="table">
				<tr><th colspan="2">Account Data</th></tr>
				{foreach $clientData as $key => $value}
				<tr><td width="200">{obs_l l=$key}</td><td width="200">{$value}</td></tr>
				{/foreach}
			</table>
		{else}
			{l s='Error retrieving client data' mod='obsegoi'}
		{/if}
	</fieldset>
{/if}