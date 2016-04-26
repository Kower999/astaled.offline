<?php /* Smarty version Smarty-3.1.8, created on 2015-05-25 23:07:22
         compiled from "C:\wamp\www/override/controllers\admin\templates\orders\_documents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11715526453353af59-40755948%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '151e7acd7059f32d83c2c4b97d721166beb57926' => 
    array (
      0 => 'C:\\wamp\\www/override/controllers\\admin\\templates\\orders\\_documents.tpl',
      1 => 1431718753,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11715526453353af59-40755948',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_552645337ac910_74021003',
  'variables' => 
  array (
    'order' => 1,
    'oz' => 1,
    'document' => 1,
    'disable_fakturu' => 1,
    'link' => 1,
    'current_id_lang' => 1,
    'currency' => 1,
    'current_index' => 1,
    'invoice_management_active' => 1,
  ),
  'has_nocache_code' => true,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_552645337ac910_74021003')) {function content_552645337ac910_74021003($_smarty_tpl) {?><?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php $_smarty = $_smarty_tpl->smarty; if (!is_callable(\'smarty_modifier_escape\')) include \'C:\\\\wamp\\\\www\\\\tools\\\\smarty\\\\plugins\\\\modifier.escape.php\';
?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

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
	<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php  $_smarty_tpl->tpl_vars[\'document\'] = new Smarty_Variable; $_smarty_tpl->tpl_vars[\'document\']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars[\'order\']->value->getDocuments(); if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
foreach ($_from as $_smarty_tpl->tpl_vars[\'document\']->key => $_smarty_tpl->tpl_vars[\'document\']->value){
$_smarty_tpl->tpl_vars[\'document\']->_loop = true;
?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>


 <?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php if ((!$_smarty_tpl->tpl_vars[\'oz\']->value||(get_class($_smarty_tpl->tpl_vars[\'document\']->value)==\'OrderInvoice\'&&isset($_smarty_tpl->tpl_vars[\'document\']->value->is_delivery))||(get_class($_smarty_tpl->tpl_vars[\'document\']->value)==\'OrderSlip\'))||(!$_smarty_tpl->tpl_vars[\'disable_fakturu\']->value)){?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

	<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php if (get_class($_smarty_tpl->tpl_vars[\'document\']->value)==\'OrderInvoice\'){?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

		<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php if (isset($_smarty_tpl->tpl_vars[\'document\']->value->is_delivery)){?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

		<tr class="invoice_line" id="delivery_<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo $_smarty_tpl->tpl_vars[\'document\']->value->id;?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
">
		<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }else{ ?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

		<tr class="invoice_line" id="invoice_<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo $_smarty_tpl->tpl_vars[\'document\']->value->id;?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
">
		<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

	<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }elseif(get_class($_smarty_tpl->tpl_vars[\'document\']->value)==\'OrderSlip\'){?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

		<tr class="invoice_line" id="orderslip_<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo $_smarty_tpl->tpl_vars[\'document\']->value->id;?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
">
	<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>


		<td class="document_date"><?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION][\'dateFormat\'][0][0]->dateFormat(array(\'date\'=>$_smarty_tpl->tpl_vars[\'document\']->value->date_add),$_smarty_tpl);?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
</td>
		<td class="document_type">
			<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php if (get_class($_smarty_tpl->tpl_vars[\'document\']->value)==\'OrderInvoice\'){?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

				<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php if (isset($_smarty_tpl->tpl_vars[\'document\']->value->is_delivery)){?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

					<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo smartyTranslate(array(\'s\'=>\'Dodací list\'),$_smarty_tpl);?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

				<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }else{ ?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

					<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo smartyTranslate(array(\'s\'=>\'Faktúra\'),$_smarty_tpl);?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

				<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

			<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }elseif(get_class($_smarty_tpl->tpl_vars[\'document\']->value)==\'OrderSlip\'){?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

				<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo smartyTranslate(array(\'s\'=>\'Dobropis\'),$_smarty_tpl);?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

			<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
</td>
		<td class="document_number">
			<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php if (get_class($_smarty_tpl->tpl_vars[\'document\']->value)==\'OrderInvoice\'){?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

				<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php if (isset($_smarty_tpl->tpl_vars[\'document\']->value->is_delivery)){?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

					<a target="_blank" href="<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars[\'link\']->value->getAdminLink(\'AdminPdf\'), \'htmlall\', \'UTF-8\');?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
&submitAction=generateDeliverySlipPDF&id_order_invoice=<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo $_smarty_tpl->tpl_vars[\'document\']->value->id;?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
">
			   	<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }else{ ?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

					<a target="_blank" href="<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars[\'link\']->value->getAdminLink(\'AdminPdf\'), \'htmlall\', \'UTF-8\');?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
&submitAction=generateInvoicePDF&id_order_invoice=<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo $_smarty_tpl->tpl_vars[\'document\']->value->id;?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
">
			   <?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

			<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }elseif(get_class($_smarty_tpl->tpl_vars[\'document\']->value)==\'OrderSlip\'){?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

				<a target="_blank" href="<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars[\'link\']->value->getAdminLink(\'AdminPdf\'), \'htmlall\', \'UTF-8\');?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
&submitAction=generateOrderSlipPDF&id_order_slip=<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo $_smarty_tpl->tpl_vars[\'document\']->value->id;?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
">
			<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

			<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php if (get_class($_smarty_tpl->tpl_vars[\'document\']->value)==\'OrderInvoice\'){?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

					<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo $_smarty_tpl->tpl_vars[\'document\']->value->getInvoiceNumberFormatted($_smarty_tpl->tpl_vars[\'current_id_lang\']->value);?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

			<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }elseif(get_class($_smarty_tpl->tpl_vars[\'document\']->value)==\'OrderSlip\'){?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

				#<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo Configuration::get(\'PS_CREDIT_SLIP_PREFIX\',$_smarty_tpl->tpl_vars[\'current_id_lang\']->value);?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo sprintf(\'%06d\',$_smarty_tpl->tpl_vars[\'document\']->value->id);?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

			<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
 <img src="../img/admin/details.gif" alt="<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo smartyTranslate(array(\'s\'=>\'Zobraziť dokument\'),$_smarty_tpl);?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
" /></a></td>
		<td class="document_amount">
		<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php if (get_class($_smarty_tpl->tpl_vars[\'document\']->value)==\'OrderInvoice\'){?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

			<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php if (isset($_smarty_tpl->tpl_vars[\'document\']->value->is_delivery)){?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

				--
			<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }else{ ?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

				<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION][\'displayPrice\'][0][0]->displayPriceSmarty(array(\'price\'=>$_smarty_tpl->tpl_vars[\'document\']->value->total_paid_tax_incl,\'currency\'=>$_smarty_tpl->tpl_vars[\'currency\']->value->id),$_smarty_tpl);?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
&nbsp;
				<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php if ($_smarty_tpl->tpl_vars[\'document\']->value->getTotalPaid()){?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

					<span style="color:red;font-weight:bold;">
					<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php if ($_smarty_tpl->tpl_vars[\'document\']->value->getRestPaid()>0){?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

						(<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION][\'displayPrice\'][0][0]->displayPriceSmarty(array(\'price\'=>$_smarty_tpl->tpl_vars[\'document\']->value->getRestPaid(),\'currency\'=>$_smarty_tpl->tpl_vars[\'currency\']->value->id),$_smarty_tpl);?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
 <?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo smartyTranslate(array(\'s\'=>\'nezaplatené\'),$_smarty_tpl);?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
)
					<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }elseif($_smarty_tpl->tpl_vars[\'document\']->value->getRestPaid()<0){?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

						(<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION][\'displayPrice\'][0][0]->displayPriceSmarty(array(\'price\'=>-$_smarty_tpl->tpl_vars[\'document\']->value->getRestPaid(),\'currency\'=>$_smarty_tpl->tpl_vars[\'currency\']->value->id),$_smarty_tpl);?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
 <?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo smartyTranslate(array(\'s\'=>\'preplatené\'),$_smarty_tpl);?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
)
					<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

					</span>
				<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

			<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

		<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }elseif(get_class($_smarty_tpl->tpl_vars[\'document\']->value)==\'OrderSlip\'){?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

			<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION][\'displayPrice\'][0][0]->displayPriceSmarty(array(\'price\'=>$_smarty_tpl->tpl_vars[\'document\']->value->amount,\'currency\'=>$_smarty_tpl->tpl_vars[\'currency\']->value->id),$_smarty_tpl);?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

		<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

		</td>
		<td class="right document_action">
		<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php if (get_class($_smarty_tpl->tpl_vars[\'document\']->value)==\'OrderInvoice\'){?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

			<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php if (!isset($_smarty_tpl->tpl_vars[\'document\']->value->is_delivery)){?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

				<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php if ($_smarty_tpl->tpl_vars[\'document\']->value->getRestPaid()){?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

					<a href="#" class="js-set-payment" data-amount="<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo $_smarty_tpl->tpl_vars[\'document\']->value->getRestPaid();?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
" data-id-invoice="<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo $_smarty_tpl->tpl_vars[\'document\']->value->id;?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
" title="<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo smartyTranslate(array(\'s\'=>\'Nastaviť platbu\'),$_smarty_tpl);?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
"><img src="../img/admin/money_add.png" alt="<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo smartyTranslate(array(\'s\'=>\'Nastaviť platbu\'),$_smarty_tpl);?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
" /></a>
				<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

				<a href="#" onclick="$('#invoiceNote<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo $_smarty_tpl->tpl_vars[\'document\']->value->id;?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
').show(); return false;" title="<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php if ($_smarty_tpl->tpl_vars[\'document\']->value->note==\'\'){?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo smartyTranslate(array(\'s\'=>\'Pridať poznámku\'),$_smarty_tpl);?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }else{ ?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo smartyTranslate(array(\'s\'=>\'Upraviť poznámku\'),$_smarty_tpl);?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
"><img src="../img/admin/note.png" alt="<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php if ($_smarty_tpl->tpl_vars[\'document\']->value->note==\'\'){?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo smartyTranslate(array(\'s\'=>\'Pridať poznámku\'),$_smarty_tpl);?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }else{ ?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo smartyTranslate(array(\'s\'=>\'Upraviť poznámku\'),$_smarty_tpl);?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
"<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php if ($_smarty_tpl->tpl_vars[\'document\']->value->note==\'\'){?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
 class="js-disabled-action"<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
 /></a>
			<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

		<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

		</td>
	</tr>
    
 <?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

	<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php if (get_class($_smarty_tpl->tpl_vars[\'document\']->value)==\'OrderInvoice\'){?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

		<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php if (!isset($_smarty_tpl->tpl_vars[\'document\']->value->is_delivery)){?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

	<tr id="invoiceNote<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo $_smarty_tpl->tpl_vars[\'document\']->value->id;?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
" style="display:none" class="current-edit">
		<td colspan="5">
			<form action="<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo $_smarty_tpl->tpl_vars[\'current_index\']->value;?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
&viewOrder&id_order=<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo $_smarty_tpl->tpl_vars[\'order\']->value->id;?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
&token=<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo smarty_modifier_escape($_GET[\'token\'], \'htmlall\', \'UTF-8\');?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
" method="post">
				<p>
					<label for="editNote<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo $_smarty_tpl->tpl_vars[\'document\']->value->id;?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
" class="t"><?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo smartyTranslate(array(\'s\'=>\'Poznámka\'),$_smarty_tpl);?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
</label>
					<input type="hidden" name="id_order_invoice" value="<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo $_smarty_tpl->tpl_vars[\'document\']->value->id;?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
" />
					<textarea name="note" rows="10" cols="10" id="editNote<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo $_smarty_tpl->tpl_vars[\'document\']->value->id;?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
" class="edit-note"><?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars[\'document\']->value->note, \'htmlall\', \'UTF-8\');?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
</textarea>
				</p>
				<p class="right">
					<input type="submit" name="submitEditNote" value="<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo smartyTranslate(array(\'s\'=>\'Uložiť\'),$_smarty_tpl);?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
" class="button" />&nbsp;
					<a href="#" id="cancelNote" onclick="$('#invoiceNote<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo $_smarty_tpl->tpl_vars[\'document\']->value->id;?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
').hide();return false;"><?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo smartyTranslate(array(\'s\'=>\'Zrušiť\'),$_smarty_tpl);?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
</a>
				</p>
			</form>
		</td>
	</tr>
		<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

	<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

	<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }
if (!$_smarty_tpl->tpl_vars[\'document\']->_loop) {
?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

	<tr>
		<td colspan="5" class="center">
			<h3><?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo smartyTranslate(array(\'s\'=>\'Žiadne dokumenty\'),$_smarty_tpl);?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
</h3>
			<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php if (isset($_smarty_tpl->tpl_vars[\'invoice_management_active\']->value)&&$_smarty_tpl->tpl_vars[\'invoice_management_active\']->value){?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

			<p><a class="button" href="<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo $_smarty_tpl->tpl_vars[\'current_index\']->value;?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
&viewOrder&submitGenerateInvoice&id_order=<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo $_smarty_tpl->tpl_vars[\'order\']->value->id;?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
&token=<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo smarty_modifier_escape($_GET[\'token\'], \'htmlall\', \'UTF-8\');?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
"><?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php echo smartyTranslate(array(\'s\'=>\'Generovať faktúru\'),$_smarty_tpl);?>
/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>
</a></p>
			<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php }?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

		</td>
	</tr>
	<?php echo '/*%%SmartyNocache:11715526453353af59-40755948%%*/<?php } ?>/*/%%SmartyNocache:11715526453353af59-40755948%%*/';?>

	</tbody>
</table>
<?php }} ?>