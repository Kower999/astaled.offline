<?php /* Smarty version Smarty-3.1.8, created on 2016-04-27 13:43:56
         compiled from "C:\wamp\www\override\controllers\admin\templates\orders\_documents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3060254fd89f3a168c3-11084431%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7e15141bdc7a34316cc985e87ce7401cb05757bc' => 
    array (
      0 => 'C:\\wamp\\www\\override\\controllers\\admin\\templates\\orders\\_documents.tpl',
      1 => 1461742550,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3060254fd89f3a168c3-11084431',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_54fd89f3c19886_91770691',
  'variables' => 
  array (
    'order' => 0,
    'oz' => 0,
    'document' => 0,
    'disable_fakturu' => 0,
    'link' => 0,
    'current_id_lang' => 0,
    'currency' => 0,
    'current_index' => 0,
    'invoice_management_active' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54fd89f3c19886_91770691')) {function content_54fd89f3c19886_91770691($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include 'C:\\wamp\\www\\tools\\smarty\\plugins\\modifier.escape.php';
?>
<table class="table" width="100%;" cellspacing="0" cellpadding="0" id="documents_table">
	<thead>
	<tr>
		<th style="width:10%"><?php echo smartyTranslate(array('s'=>'Dátum'),$_smarty_tpl);?>
</th>
		<th style=""><?php echo smartyTranslate(array('s'=>'Dokument'),$_smarty_tpl);?>
</th>
		<th style="width:20%"><?php echo smartyTranslate(array('s'=>'Číslo'),$_smarty_tpl);?>
</th>
		<th style="width:10%"><?php echo smartyTranslate(array('s'=>'Suma'),$_smarty_tpl);?>
</th>
		<th style="width:1%"></th>
	</tr>
	</thead>
	<tbody>
	<?php  $_smarty_tpl->tpl_vars['document'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['document']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['order']->value->getDocuments(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['document']->key => $_smarty_tpl->tpl_vars['document']->value){
$_smarty_tpl->tpl_vars['document']->_loop = true;
?>

 <?php if ((!$_smarty_tpl->tpl_vars['oz']->value||(get_class($_smarty_tpl->tpl_vars['document']->value)=='OrderInvoice'&&isset($_smarty_tpl->tpl_vars['document']->value->is_delivery))||(get_class($_smarty_tpl->tpl_vars['document']->value)=='OrderSlip'))||(!$_smarty_tpl->tpl_vars['disable_fakturu']->value)){?>
	<?php if (get_class($_smarty_tpl->tpl_vars['document']->value)=='OrderInvoice'){?>
		<?php if (isset($_smarty_tpl->tpl_vars['document']->value->is_delivery)){?>
		<tr class="invoice_line" id="delivery_<?php echo $_smarty_tpl->tpl_vars['document']->value->id;?>
">
		<?php }else{ ?>
		<tr class="invoice_line" id="invoice_<?php echo $_smarty_tpl->tpl_vars['document']->value->id;?>
">
		<?php }?>
	<?php }elseif(get_class($_smarty_tpl->tpl_vars['document']->value)=='OrderSlip'){?>
		<tr class="invoice_line" id="orderslip_<?php echo $_smarty_tpl->tpl_vars['document']->value->id;?>
">
	<?php }?>

		<td class="document_date"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0][0]->dateFormat(array('date'=>$_smarty_tpl->tpl_vars['document']->value->date_add),$_smarty_tpl);?>
</td>
		<td class="document_type">
			<?php if (get_class($_smarty_tpl->tpl_vars['document']->value)=='OrderInvoice'){?>
				<?php if (isset($_smarty_tpl->tpl_vars['document']->value->is_delivery)){?>
					<?php echo smartyTranslate(array('s'=>'Dodací list'),$_smarty_tpl);?>

				<?php }else{ ?>
					<?php echo smartyTranslate(array('s'=>'Faktúra'),$_smarty_tpl);?>

				<?php }?>
			<?php }elseif(get_class($_smarty_tpl->tpl_vars['document']->value)=='OrderSlip'){?>
				<?php echo smartyTranslate(array('s'=>'Dobropis'),$_smarty_tpl);?>

			<?php }?></td>
		<td class="document_number">
			<?php if (get_class($_smarty_tpl->tpl_vars['document']->value)=='OrderInvoice'){?>
				<?php if (isset($_smarty_tpl->tpl_vars['document']->value->is_delivery)){?>
					<a target="_blank" href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminPdf'), 'htmlall', 'UTF-8');?>
&submitAction=generateDeliverySlipPDF&id_order_invoice=<?php echo $_smarty_tpl->tpl_vars['document']->value->id;?>
">
			   	<?php }else{ ?>
					<a target="_blank" href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminPdf'), 'htmlall', 'UTF-8');?>
&submitAction=generateInvoicePDF&id_order_invoice=<?php echo $_smarty_tpl->tpl_vars['document']->value->id;?>
">
			   <?php }?>
			<?php }elseif(get_class($_smarty_tpl->tpl_vars['document']->value)=='OrderSlip'){?>
				<a target="_blank" href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminPdf'), 'htmlall', 'UTF-8');?>
&submitAction=generateOrderSlipPDF&id_order_slip=<?php echo $_smarty_tpl->tpl_vars['document']->value->id;?>
">
			<?php }?>
			<?php if (get_class($_smarty_tpl->tpl_vars['document']->value)=='OrderInvoice'){?>
					<?php echo $_smarty_tpl->tpl_vars['document']->value->getInvoiceNumberFormatted($_smarty_tpl->tpl_vars['current_id_lang']->value);?>

			<?php }elseif(get_class($_smarty_tpl->tpl_vars['document']->value)=='OrderSlip'){?>
				#<?php echo Configuration::get('PS_CREDIT_SLIP_PREFIX',$_smarty_tpl->tpl_vars['current_id_lang']->value);?>
<?php echo sprintf('%06d',$_smarty_tpl->tpl_vars['document']->value->id);?>

			<?php }?> <img src="../img/admin/details.gif" alt="<?php echo smartyTranslate(array('s'=>'Zobraziť dokument'),$_smarty_tpl);?>
" /></a></td>
		<td class="document_amount">
		<?php if (get_class($_smarty_tpl->tpl_vars['document']->value)=='OrderInvoice'){?>
			<?php if (isset($_smarty_tpl->tpl_vars['document']->value->is_delivery)){?>
				--
			<?php }else{ ?>
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['document']->value->total_paid_tax_incl,'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl);?>
&nbsp;
				<?php if ($_smarty_tpl->tpl_vars['document']->value->getTotalPaid()){?>
					<span style="color:red;font-weight:bold;">
					<?php if ($_smarty_tpl->tpl_vars['document']->value->getRestPaid()>0){?>
						(<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['document']->value->getRestPaid(),'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl);?>
 <?php echo smartyTranslate(array('s'=>'nezaplatené'),$_smarty_tpl);?>
)
					<?php }elseif($_smarty_tpl->tpl_vars['document']->value->getRestPaid()<0){?>
						(<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>-$_smarty_tpl->tpl_vars['document']->value->getRestPaid(),'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl);?>
 <?php echo smartyTranslate(array('s'=>'preplatené'),$_smarty_tpl);?>
)
					<?php }?>
					</span>
				<?php }?>
			<?php }?>
		<?php }elseif(get_class($_smarty_tpl->tpl_vars['document']->value)=='OrderSlip'){?>
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['document']->value->amount,'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl);?>

		<?php }?>
		</td>
		<td class="right document_action">
		<?php if (get_class($_smarty_tpl->tpl_vars['document']->value)=='OrderInvoice'){?>
			<?php if (!isset($_smarty_tpl->tpl_vars['document']->value->is_delivery)){?>
				<?php if ($_smarty_tpl->tpl_vars['document']->value->getRestPaid()){?>
					<a href="#" class="js-set-payment" data-amount="<?php echo $_smarty_tpl->tpl_vars['document']->value->getRestPaid();?>
" data-id-invoice="<?php echo $_smarty_tpl->tpl_vars['document']->value->id;?>
" title="<?php echo smartyTranslate(array('s'=>'Nastaviť platbu'),$_smarty_tpl);?>
"><img src="../img/admin/money_add.png" alt="<?php echo smartyTranslate(array('s'=>'Nastaviť platbu'),$_smarty_tpl);?>
" /></a>
				<?php }?>
				<a href="#" onclick="$('#invoiceNote<?php echo $_smarty_tpl->tpl_vars['document']->value->id;?>
').show(); return false;" title="<?php if ($_smarty_tpl->tpl_vars['document']->value->note==''){?><?php echo smartyTranslate(array('s'=>'Pridať poznámku'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'Upraviť poznámku'),$_smarty_tpl);?>
<?php }?>"><img src="../img/admin/note.png" alt="<?php if ($_smarty_tpl->tpl_vars['document']->value->note==''){?><?php echo smartyTranslate(array('s'=>'Pridať poznámku'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'Upraviť poznámku'),$_smarty_tpl);?>
<?php }?>"<?php if ($_smarty_tpl->tpl_vars['document']->value->note==''){?> class="js-disabled-action"<?php }?> /></a>
			<?php }?>
		<?php }?>
		</td>
	</tr>
    
 <?php }?>
	<?php if (get_class($_smarty_tpl->tpl_vars['document']->value)=='OrderInvoice'){?>
		<?php if (!isset($_smarty_tpl->tpl_vars['document']->value->is_delivery)){?>
	<tr id="invoiceNote<?php echo $_smarty_tpl->tpl_vars['document']->value->id;?>
" style="display:none" class="current-edit">
		<td colspan="5">
			<form action="<?php echo $_smarty_tpl->tpl_vars['current_index']->value;?>
&viewOrder&id_order=<?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
&token=<?php echo smarty_modifier_escape($_GET['token'], 'htmlall', 'UTF-8');?>
" method="post">
				<p>
					<label for="editNote<?php echo $_smarty_tpl->tpl_vars['document']->value->id;?>
" class="t"><?php echo smartyTranslate(array('s'=>'Poznámka'),$_smarty_tpl);?>
</label>
					<input type="hidden" name="id_order_invoice" value="<?php echo $_smarty_tpl->tpl_vars['document']->value->id;?>
" />
					<textarea name="note" rows="10" cols="10" id="editNote<?php echo $_smarty_tpl->tpl_vars['document']->value->id;?>
" class="edit-note"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['document']->value->note, 'htmlall', 'UTF-8');?>
</textarea>
				</p>
				<p class="right">
					<input type="submit" name="submitEditNote" value="<?php echo smartyTranslate(array('s'=>'Uložiť'),$_smarty_tpl);?>
" class="button" />&nbsp;
					<a href="#" id="cancelNote" onclick="$('#invoiceNote<?php echo $_smarty_tpl->tpl_vars['document']->value->id;?>
').hide();return false;"><?php echo smartyTranslate(array('s'=>'Zrušiť'),$_smarty_tpl);?>
</a>
				</p>
			</form>
		</td>
	</tr>
		<?php }?>
	<?php }?>
	<?php }
if (!$_smarty_tpl->tpl_vars['document']->_loop) {
?>
	<tr>
		<td colspan="5" class="center">
			<h3><?php echo smartyTranslate(array('s'=>'Žiadne dokumenty'),$_smarty_tpl);?>
</h3>
			<?php if (isset($_smarty_tpl->tpl_vars['invoice_management_active']->value)&&$_smarty_tpl->tpl_vars['invoice_management_active']->value){?>
			<p><a class="button" href="<?php echo $_smarty_tpl->tpl_vars['current_index']->value;?>
&viewOrder&submitGenerateInvoice&id_order=<?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
&token=<?php echo smarty_modifier_escape($_GET['token'], 'htmlall', 'UTF-8');?>
"><?php echo smartyTranslate(array('s'=>'Generovať faktúru'),$_smarty_tpl);?>
</a></p>
			<?php }?>
		</td>
	</tr>
	<?php } ?>
	</tbody>
</table>
<?php }} ?>