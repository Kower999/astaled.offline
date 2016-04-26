<style type="text/css">
    table, td, tr   { border-collapse: collapse; border-spacing: 0px; text-indent: 0px;}
    .indent0   { text-indent: -3px;}
    .border   { border: 0.1px solid #888; }
    .bordertop { border-top: 0.1px solid #888; }
    .gray8  { font-size: 8pt; color: #444; }
    .gray12 { font-size: 9pt; color: #444;  }
    .silver8 { font-size: 8pt; color: #777; }
    .silver6    { font-size: 6pt; color: #777; }
    .bold { font-weight: bold; }
    .normal { font-weight: normal; }
    .half { width: 50%; }
    .size8 { font-size: 8pt; }
    .allborders td { border: 0.1px solid #BBB; }
    .thead {  font-weight: bold; }
    .center { text-align: center; }
    .left { text-align: left; }
    .right { text-align: right; }
    .c1 { width: 11%; }
    .c2 { width: 28%; }
    .c3 { width: 10%; }
    .c4 { width: 10%; }
    .c5 { width: 6%; }
    .c6 { width: 10%; }
    .c7 { width: 9%; }
    .c8 { width: 9%; }
    .c9 { width: 10%; }
</style>

<table class="mytable gray8 bold border" cellspacing="0" cellpadding="0">
    <tr>
        <td style="width: 50%;">
            <table class="" cellspacing="0" cellpadding="5">
                <tr>
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
                        {/if}
                        </table>
                    </td>                    
				    <td style="width:50%; text-align: right;">
		              {if $logo_path}
			             <img src="{$logo_path}" width="70"/>
		              {/if}
                    </td>
                </tr>
                <tr class="">
                    <td style="width:40%">
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
                    <td style="width:60%">
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
                {if !empty($shop_details)}
                <tr>
                    <td colspan="2" class="silver6 normal lrp">
                            {$shop_details|escape:'html':'UTF-8'}
                    </td>
                </tr>
                {/if}
		    </table>
    		<table class="gray8 normal bordertop" cellspacing="0" cellpadding="5">
                <tr>
                    <td style="width:40%;padding:10px 10px 10px 0px;">
                        <table class="gray8 bold" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>Telefón:</td>
                            </tr>
                        {if !empty($shop_fax)}                                                        
                            <tr>
                                <td>Fax:</td>
                            </tr>
                        {/if}                                                        
                            <tr>
                                <td>Email:</td>
                            </tr>
                            <tr>
                                <td>Web:</td>
                            </tr>
                        </table>                                                
                    </td>
                    <td style="width:60%">
                        <table class="gray8 bold" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>{$shop_phone|escape:'html':'UTF-8'}</td>
                            </tr>
                        {if !empty($shop_fax)}                                                        
                            <tr>
                                <td>{$shop_fax|escape:'html':'UTF-8'}</td>
                            </tr>
                        {/if}                                                        
                            <tr>
                                <td>{$email|escape:'html':'UTF-8'}</td>
                            </tr>
                            <tr>
                                <td>www.vegasolutions.eu<br />www.vegaonline.sk</td>
<!--                                <td>{$shop->domain|escape:'html':'UTF-8'}</td> -->
                            </tr>
                        </table>                                                
                    </td>
                </tr>
            </table>                        
    		<table class="gray8 normal bordertop" cellspacing="0" cellpadding="5">
                <tr>
                    <td style="width:40%;padding:10px 10px 10px 0px;">
                        <table class="gray8 bold" cellspacing="0" cellpadding="0">
                        {if !empty($ucet)}                            
                            <tr>
                                <td>Číslo účtu:</td>
                            </tr>
                        {/if}                            
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
                    {if !isset($dodaci)}                                                                          
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
                    {/if}                                                    
                        </table>                                                
                    </td>
                    <td style="width:60%">
                        <table class="gray8 bold" cellspacing="0" cellpadding="0">
                        {if !empty($ucet)}                            
                            <tr>
                                <td>{$ucet|escape:'html':'UTF-8'}</td>
                            </tr>
                        {/if}                            
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
                    {if !isset($dodaci)}                                      
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
                    {/if}                            
                        </table>                                                
                    </td>
                </tr>
            </table>                        
        </td>
        <td style="width: 50%;" class="">
            <table class="gray8 bold border" cellspacing="0" cellpadding="5">
                <tr>
                    <td style="text-align: right;"><span style="width: 100%; font-size: 12pt; font-weight: bold;">{$title|escape:'html':'UTF-8'}</span></td>
                </tr>
                <tr>
                    <td>
                        <span class="gray12 bold">Odberateľ:</span><br />
                        <table class="silver8 normal" cellspacing="0" cellpadding="5" border="0">
                            <tr>
                                {if !empty($delivery_address)}                            
                                <td>
                                    <div style="font-weight: bold; font-size: 8pt; color: #9E9F9E">{l s='Delivery Address' pdf='true'}</div>
                                    {$delivery_address}
                                </td>
                                {/if}                                        
                                <td>
                                    <div style="font-weight: bold; font-size: 8pt; color: #9E9F9E">{l s='Billing Address' pdf='true'}</div>
                                    {$invoice_address}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <table class="silver8 normal" cellspacing="0" cellpadding="5" border="0">
                <tr>
                    <td class="border center"><span class="size8 green bold">Dátum vystavenia</span><br /><span class="gray8 bold">{$date|date_format:"%d.%m.%Y"|escape:'html':'UTF-8'}</span></td>
                    {if !isset($dodaci)}
                        <td class="border center"><span class="size8 blue bold">Dátum zd. plnenia</span><br /><span class="gray8 bold">{$date|date_format:"%d.%m.%Y"|escape:'html':'UTF-8'}</span></td>
                        <td class="border center"><span class="size8 red bold">Dátum splatnosti</span><br /><span class="gray8 normal">{$order->date_pay|date_format:"%d.%m.%Y"|escape:'html':'UTF-8'}</span></td>
                    {/if}
                </tr>
            </table>
    		<table class="gray8 normal border" cellspacing="0" cellpadding="5">
                <tr>
                    <td style="width:50%;padding:10px 10px 10px 0px;">
                        <table class="gray8 bold" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>Číslo objednávky:</td>
                            </tr>
                            <tr>
                                <td>Spôsob doručenia:</td>
                            </tr>
                    {if !isset($dodaci)}                                                                  
                            <tr>
                                <td>Spôsob platby:</td>
                            </tr>
                    {/if}
                        </table>                                                
                    </td>
                    <td style="width:50%">
                        <table class="gray8 bold" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>{$order->shipping_number}</td>
                            </tr>
                            <tr>
                                <td>{$carrier->name}</td>
                            </tr>
                    {if !isset($dodaci)}                                                                  
                            <tr>
                                <td>{$order->payment}</td>
                            </tr>                            
                    {/if}                            
                        </table>                                                
                    </td>
                </tr>
            </table>                                    
        </td>
    </tr>
</table>
