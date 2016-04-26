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
{if $obsShowApiKeyWarn}
<div class="warn">
	<span style="float:right">
		<a href="" id="hideWarn"><img src="../img/admin/close.png" alt="X"></a>
	</span>
	<ul style="margin-top: 3px">
		<li>{l s='No API key configured. Please go to the' mod='obsegoi'}
			<a href="index.php?controller=AdminModules&token={getAdminToken tab='AdminModules'}&configure=obsegoi">{l s='module configuration' mod='obsegoi'}</a>
			{l s='to add one' mod='obsegoi'}.<br/>
			{l s='If you don\'t have an E-Goi account please' mod='obsegoi'} <a href="http://www.e-goi.com/index.php?cID=232&aff=3bca14d6c4" target="_blank">{l s='click here' mod='obsegoi'}</a>.
			{l s='If you want to know more about E-Goi' mod='obsegoi'} <a href="http://www.e-goi.com/index.php?cID=232&aff=3bca14d6c4" target="_blank">{l s='click here' mod='obsegoi'}</a></li>
	</ul>
</div>
{/if}