<?php /* Smarty version Smarty-3.1.8, created on 2015-05-29 09:01:58
         compiled from "C:\wamp\www\themes\default\pdf\alt-header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2938755196a4a73df17-32787259%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b63a8733cbfde18e5a16bd822e1e1a489b4400bd' => 
    array (
      0 => 'C:\\wamp\\www\\themes\\default\\pdf\\alt-header.tpl',
      1 => 1431718763,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2938755196a4a73df17-32787259',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_55196a4a7cb165_75610638',
  'variables' => 
  array (
    'logo_path' => 0,
    'title' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55196a4a7cb165_75610638')) {function content_55196a4a7cb165_75610638($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include 'C:\\wamp\\www\\tools\\smarty\\plugins\\modifier.escape.php';
?><style type="text/css">
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
                        <?php if ($_smarty_tpl->tpl_vars['logo_path']->value){?>
                            <img src="<?php echo $_smarty_tpl->tpl_vars['logo_path']->value;?>
" width="84" height="23"/>
                        <?php }?>        
                    </td>
                </tr>
            </table>
        </td>
        <td style="width: 50%;" class="">
            <table class="gray8 bold border" cellspacing="0" cellpadding="9">
                <tr style="background-color: #000;">
                    <td style="text-align: right;"><span style="width: 100%; font-size: 14pt; color: #FFF; font-weight: bold;"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['title']->value, 'html', 'UTF-8');?>
</span></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?php }} ?>