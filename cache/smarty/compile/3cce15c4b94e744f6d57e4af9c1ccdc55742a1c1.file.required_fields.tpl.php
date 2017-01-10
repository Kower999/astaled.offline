<?php /* Smarty version Smarty-3.1.8, created on 2015-02-27 05:29:58
         compiled from "C:\wamp\www\shopadmin/themes/default\template\helpers\required_fields.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1211554eff2c6683057-18361968%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3cce15c4b94e744f6d57e4af9c1ccdc55742a1c1' => 
    array (
      0 => 'C:\\wamp\\www\\shopadmin/themes/default\\template\\helpers\\required_fields.tpl',
      1 => 1423781537,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1211554eff2c6683057-18361968',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'current' => 0,
    'token' => 0,
    'table_fields' => 0,
    'field' => 0,
    'required_class_fields' => 0,
    'irow' => 0,
    'required_fields' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_54eff2c66c3df1_74307667',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54eff2c66c3df1_74307667')) {function content_54eff2c66c3df1_74307667($_smarty_tpl) {?>

<br />
<p>
	<a class="button" href="#" onclick="if ($('.requiredFieldsParameters:visible').length == 0) $('.requiredFieldsParameters').slideDown('slow'); else $('.requiredFieldsParameters').slideUp('slow'); return false;"><img src="../img/admin/duplicate.gif" alt="" /> <?php echo smartyTranslate(array('s'=>'Set required fields for this section'),$_smarty_tpl);?>
</a>
</p>
<fieldset style="display:none" class="width1 requiredFieldsParameters">
	<legend><?php echo smartyTranslate(array('s'=>'Required Fields'),$_smarty_tpl);?>
</legend>
	<form name="updateFields" action="<?php echo $_smarty_tpl->tpl_vars['current']->value;?>
&submitFields=1&token=<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" method="post">
		<p>
			<b><?php echo smartyTranslate(array('s'=>'Select the fields you would like to be required for this section.'),$_smarty_tpl);?>
</b><br />
			<table cellspacing="0" cellpadding="0" class="table width1 clear">
				<thead>
					<tr>
						<th><input type="checkbox" onclick="checkDelBoxes(this.form, 'fieldsBox[]', this.checked)" class="noborder" name="checkme"></th>
						<th><?php echo smartyTranslate(array('s'=>'Field Name'),$_smarty_tpl);?>
</th>
					</tr>
				</thead>
				<tbody>
				<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['table_fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
?>
					<?php if (!in_array($_smarty_tpl->tpl_vars['field']->value,$_smarty_tpl->tpl_vars['required_class_fields']->value)){?>
						<tr class="<?php if ($_smarty_tpl->tpl_vars['irow']->value++%2){?>alt_row<?php }?>">
							<td class="noborder"><input type="checkbox" name="fieldsBox[]" value="<?php echo $_smarty_tpl->tpl_vars['field']->value;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['field']->value,$_smarty_tpl->tpl_vars['required_fields']->value)){?> checked="checked"<?php }?> /></td>
							<td><?php echo $_smarty_tpl->tpl_vars['field']->value;?>
</td>
						</tr>
					<?php }?>
				<?php } ?>
				</tbody>
			</table><br />
			<center>
				<input style="margin-left:15px;" class="button" type="submit" value="<?php echo smartyTranslate(array('s'=>'Save'),$_smarty_tpl);?>
" name="submitFields" />
			</center>
		</p>
	</form>
</fieldset>
<?php }} ?>