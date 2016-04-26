<?php /* Smarty version Smarty-3.1.8, created on 2015-06-08 10:25:51
         compiled from "C:\wamp\www\themes\default\pdf\alt-footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18537551980b82793d2-34462027%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5561fb0dffeb457c21ed0bef432a08ab1639642a' => 
    array (
      0 => 'C:\\wamp\\www\\themes\\default\\pdf\\alt-footer.tpl',
      1 => 1431718763,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18537551980b82793d2-34462027',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_551980b82bde73_06681907',
  'variables' => 
  array (
    'page' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_551980b82bde73_06681907')) {function content_551980b82bde73_06681907($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['page']->value)){?>
<div style="font-size: 7pt; color: #444; text-align: center;">
    <table cellspacing="0" cellpadding="0">
        <tr>
            <td>
                <?php echo smartyTranslate(array('s'=>'Strana ','pdf'=>'true'),$_smarty_tpl);?>
<?php echo $_smarty_tpl->tpl_vars['page']->value;?>

            </td>
        </tr>
    </table>
</div>
<?php }?>
<?php }} ?>