<?php /* Smarty version Smarty-3.1.8, created on 2015-02-27 21:48:26
         compiled from "C:\wamp\www\shopadmin/themes/default\template\controllers\stats\stats.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1724054f0d81a71f6c3-73036557%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '14f69c6fc4b50ac9bd0888dd6ae439bc4d099314' => 
    array (
      0 => 'C:\\wamp\\www\\shopadmin/themes/default\\template\\controllers\\stats\\stats.tpl',
      1 => 1423781537,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1724054f0d81a71f6c3-73036557',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module_name' => 0,
    'module_instance' => 0,
    'hook' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_54f0d81a73a200_95213740',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f0d81a73a200_95213740')) {function content_54f0d81a73a200_95213740($_smarty_tpl) {?>

<div>
	<?php if ($_smarty_tpl->tpl_vars['module_name']->value){?>
		<?php if ($_smarty_tpl->tpl_vars['module_instance']->value&&$_smarty_tpl->tpl_vars['module_instance']->value->active){?>
			<?php echo $_smarty_tpl->tpl_vars['hook']->value;?>

		<?php }else{ ?>
			<?php echo smartyTranslate(array('s'=>'Module not found'),$_smarty_tpl);?>

		<?php }?>
	<?php }else{ ?>
		<h3 class="space"><?php echo smartyTranslate(array('s'=>'Please select a module in the left column.'),$_smarty_tpl);?>
</h3>
	<?php }?>
</div>
</div>
</div>


<?php }} ?>