<?php /* Smarty version Smarty-3.1.8, created on 2016-04-26 22:31:51
         compiled from "C:\wamp\www\themes\default\pdf\footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:29861550186d4e42aa6-11578297%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1fa301316e2a59860c994d032e15e6bd10fb2564' => 
    array (
      0 => 'C:\\wamp\\www\\themes\\default\\pdf\\footer.tpl',
      1 => 1449839983,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29861550186d4e42aa6-11578297',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_550186d4ee6b20_67073139',
  'variables' => 
  array (
    'razitko' => 0,
    'dodaci' => 0,
    'page' => 0,
    'shop_address' => 0,
    'shop_phone' => 0,
    'shop_fax' => 0,
    'shop_details' => 0,
    'free_text' => 0,
    'medzera' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_550186d4ee6b20_67073139')) {function content_550186d4ee6b20_67073139($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include 'C:\\wamp\\www\\tools\\smarty\\plugins\\modifier.escape.php';
?>
<div style="font-size: 7pt; color: #444">
<table style="width: 100%" cellspacing="0" cellpadding="5">
    <tr>
        <td style="width: 20%;text-align: center;">
            <?php if ($_smarty_tpl->tpl_vars['razitko']->value){?>
                <img src="<?php echo $_smarty_tpl->tpl_vars['razitko']->value;?>
"/>
            <?php }?>        
            <div style="border-top: 1px dotted #777;"><?php if (isset($_smarty_tpl->tpl_vars['dodaci']->value)){?>Odovzdal<?php }else{ ?>Vyhotovil<?php }?></div>
        </td>
        <td style="width: <?php if (isset($_smarty_tpl->tpl_vars['dodaci']->value)){?>39%<?php }else{ ?>54%<?php }?>;text-align: center; font-size: 6pt; color: #444; ">
        <br /><br /><br /><br />        
            <?php if (isset($_smarty_tpl->tpl_vars['page']->value)){?>
                <?php echo smartyTranslate(array('s'=>'Strana ','pdf'=>'true'),$_smarty_tpl);?>
<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
<br />
            <?php }?>
            
                <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['shop_address']->value, 'html', 'UTF-8');?>
<br />
				<?php if (!empty($_smarty_tpl->tpl_vars['shop_phone']->value)){?>
					Tel: <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['shop_phone']->value, 'html', 'UTF-8');?>

				<?php }?>

				<?php if (!empty($_smarty_tpl->tpl_vars['shop_fax']->value)){?>
					Fax: <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['shop_fax']->value, 'html', 'UTF-8');?>

				<?php }?>
				<br />            
            <?php if (isset($_smarty_tpl->tpl_vars['shop_details']->value)){?>
                <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['shop_details']->value, 'html', 'UTF-8');?>
<br />
            <?php }?>

            <?php if (isset($_smarty_tpl->tpl_vars['free_text']->value)){?>
    			<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['free_text']->value, 'html', 'UTF-8');?>
<br />
            <?php }?>
        </td>
        <?php if (isset($_smarty_tpl->tpl_vars['dodaci']->value)){?>
        <td style="width: 20%;text-align: center;">
            <?php if ($_smarty_tpl->tpl_vars['medzera']->value){?>
                <img src="<?php echo $_smarty_tpl->tpl_vars['medzera']->value;?>
"/>
            <?php }?>                
        <div style="border-top: 1px dotted #777;">Dátum prevzatia</div></td>
        <td style="width: 1%;"></td>
        <?php }?>
        <td style="width: 20%;text-align: center;">
            <?php if ($_smarty_tpl->tpl_vars['medzera']->value){?>
                <img src="<?php echo $_smarty_tpl->tpl_vars['medzera']->value;?>
"/>
            <?php }?>                
            <div style="border-top: 1px dotted #777;">Prevzal</div></td>
    </tr>
</table>
</div>
<?php }} ?>