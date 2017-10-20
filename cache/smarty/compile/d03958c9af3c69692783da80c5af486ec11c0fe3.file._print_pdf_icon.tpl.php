<?php /* Smarty version Smarty-3.1.8, created on 2017-10-18 18:47:18
         compiled from "C:\wamp\www\astaled.offline\shopadmin/themes/default\template\controllers\orders\_print_pdf_icon.tpl" */ ?>
<?php /*%%SmartyHeaderCode:38334605459e7859672cbf1-72952514%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd03958c9af3c69692783da80c5af486ec11c0fe3' => 
    array (
      0 => 'C:\\wamp\\www\\astaled.offline\\shopadmin/themes/default\\template\\controllers\\orders\\_print_pdf_icon.tpl',
      1 => 1501670721,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '38334605459e7859672cbf1-72952514',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'order_state' => 0,
    'order' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_59e7859673c0d7_15271318',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59e7859673c0d7_15271318')) {function content_59e7859673c0d7_15271318($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include 'C:\\wamp\\www\\astaled.offline\\tools\\smarty\\plugins\\modifier.escape.php';
?>


<span style="width:20px; margin-right:5px;">
<?php if (($_smarty_tpl->tpl_vars['order_state']->value->invoice||$_smarty_tpl->tpl_vars['order']->value->invoice_number)){?>
	<a target="_blank" href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminPdf'), 'htmlall', 'UTF-8');?>
&submitAction=generateInvoicePDF&id_order=<?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
"><img src="../img/admin/tab-invoice.gif" alt="invoice" /></a>
<?php }else{ ?>
	-
<?php }?>
</span>


<span style="width:20px;">
<?php if (($_smarty_tpl->tpl_vars['order_state']->value->delivery||$_smarty_tpl->tpl_vars['order']->value->delivery_number)){?>
	<a target="_blank" href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminPdf'), 'htmlall', 'UTF-8');?>
&submitAction=generateDeliverySlipPDF&id_order=<?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
"><img src="../img/admin/delivery.gif" alt="delivery" /></a>
<?php }else{ ?>
	-
<?php }?>
</span>
<?php }} ?>