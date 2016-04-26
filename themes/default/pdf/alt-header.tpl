<style type="text/css">
    table, td, tr   { border-collapse: collapse; border-spacing: 0px; text-indent: 0px;}
    .indent0   { text-indent: -3px;}
    .border   { border: 1px solid #888; }
    .bordertop { border-top: 1px solid #888; }
    .gray8  { font-size: 8pt; color: #444; }
    .gray12 { font-size: 12pt; color: #444;  }
    .silver8 { font-size: 8pt; color: #777; }
    .silver6    { font-size: 6pt; color: #777; }
    .bold { font-weight: bold; }
    .normal { font-weight: normal; }
    .half { width: 50%; }
    .size8 { font-size: 8pt; }
    .green { color: #60A060; }
    .blue { color: #6060A0; }
    .red { color: #A06060; }
    .allborders td { border: 0.1px solid #BBB; }
    .thead { background-color: #6D6D6D; color: #FFF; font-weight: bold; }
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
            <table cellspacing="0" cellpadding="5">
                <tr>
                    <td>
                        {if $logo_path}
                            <img src="{$logo_path}" width="84" height="23"/>
                        {/if}        
                    </td>
                </tr>
            </table>
        </td>
        <td style="width: 50%;" class="">
            <table class="gray8 bold border" cellspacing="0" cellpadding="9">
                <tr style="background-color: #000;">
                    <td style="text-align: right;"><span style="width: 100%; font-size: 14pt; color: #FFF; font-weight: bold;">{$title|escape:'html':'UTF-8'}</span></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
