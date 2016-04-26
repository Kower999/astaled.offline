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
<h2>{$obs_egoi_title} {$obs_egoi_version}</h2>
<form method="post" action="">
	<fieldset>
		<div id="items">
			<div style="clear:both">
				<label>{l s='Your API Key ' mod='obsegoi'}</label>
				<div class="margin-form">
					<input type="text" name="obsegoi_api_key" size="55" value="{Configuration::get('OBSEGOI_API_KEY')}" />
				</div>
			</div>
			<div style="clear:both">
				<div style="width:350px" class="margin-form">
					{l s='To get your API Key, login into your E-goi.com panel, go to your user menu (upper right corner), select "Integrations" and copy the account API key' mod='obsegoi'}
				</div>
			</div>
		</div>
		<div class="margin-form clear">
			<div class="clear pspace"></div>
			<div class="margin-form">
				<input type="submit" name="submitUpdate" value="{l s='Save' mod='obsegoi'}" class="button" />
			</div>
		</div>
	</fieldset>
</form>
		