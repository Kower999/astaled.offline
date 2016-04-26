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
<div style="font-size: 7pt; color: #444">
<table style="width: 100%" cellspacing="0" cellpadding="5">
    <tr>
        <td style="width: 20%;text-align: center;">
            {if $razitko}
                <img src="{$razitko}"/>
            {/if}        
            <div style="border-top: 1px dotted #777;">{if isset($dodaci)}Odovzdal{else}Vyhotovil{/if}</div>
        </td>
        <td style="width: {if isset($dodaci)}39%{else}54%{/if};text-align: center; font-size: 6pt; color: #444; ">
        <br /><br /><br /><br />        
            {if isset($page)}
                {l s='Strana ' pdf='true'}{$page}<br />
            {/if}
{*}
            {if !empty($address)}
                {if !empty($address->company)}
			         {$address->company},
				{/if}
            {/if}
{*}            
                {$shop_address|escape:'html':'UTF-8'}<br />
				{if !empty($shop_phone)}
					Tel: {$shop_phone|escape:'html':'UTF-8'}
				{/if}

				{if !empty($shop_fax)}
					Fax: {$shop_fax|escape:'html':'UTF-8'}
				{/if}
				<br />            
            {if isset($shop_details)}
                {$shop_details|escape:'html':'UTF-8'}<br />
            {/if}

            {if isset($free_text)}
    			{$free_text|escape:'html':'UTF-8'}<br />
            {/if}
        </td>
        {if isset($dodaci)}
        <td style="width: 20%;text-align: center;">
            {if $medzera}
                <img src="{$medzera}"/>
            {/if}                
        <div style="border-top: 1px dotted #777;">Dátum prevzatia</div></td>
        <td style="width: 1%;"></td>
        {/if}
        <td style="width: 20%;text-align: center;">
            {if $medzera}
                <img src="{$medzera}"/>
            {/if}                
            <div style="border-top: 1px dotted #777;">Prevzal</div></td>
    </tr>
</table>
</div>
