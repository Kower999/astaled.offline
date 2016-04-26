<?php /* Smarty version Smarty-3.1.8, created on 2015-03-28 15:25:31
         compiled from "C:\wamp\www\shopadmin/themes/default\template\controllers\modules\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18522544571d8e1c7c6-51891846%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '83b561da538b39ee0a73008620201bfb5378881e' => 
    array (
      0 => 'C:\\wamp\\www\\shopadmin/themes/default\\template\\controllers\\modules\\header.tpl',
      1 => 1427206705,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18522544571d8e1c7c6-51891846',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_544571d8f36c69_53071646',
  'variables' => 
  array (
    'add_permission' => 0,
    'currentIndex' => 0,
    'token' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_544571d8f36c69_53071646')) {function content_544571d8f36c69_53071646($_smarty_tpl) {?>

	<div class="toolbar-placeholder">
		<div class="toolbarBox toolbarHead">
	
			<ul class="cc_button">
				<?php if ($_smarty_tpl->tpl_vars['add_permission']->value=='1'){?>
				<li>
					<a id="desc-module-new" class="toolbar_btn" href="#top_container" onclick="$('#module_install').slideToggle();" title="<?php echo smartyTranslate(array('s'=>'Add new module'),$_smarty_tpl);?>
">
						<span class="process-icon-new-module" ></span>
						<div><?php echo smartyTranslate(array('s'=>'Add new module'),$_smarty_tpl);?>
</div>
					</a>
				</li>
				<?php }?>
			</ul>


			<div class="pageTitle">
				<h3><span id="current_obj" style="font-weight: normal;"><span class="breadcrumb item-0">Module</span> : <span class="breadcrumb item-1"><?php echo smartyTranslate(array('s'=>'List of modules'),$_smarty_tpl);?>
</span></span></h3>
			</div>

		</div>
	</div>

<?php if ($_smarty_tpl->tpl_vars['add_permission']->value=='1'){?>
	<div id="module_install" style="width:500px;margin-top:5px;<?php if (!isset($_POST['downloadflag'])){?>display: none;<?php }?>">
		<fieldset>
			<legend><img src="../img/admin/add.gif" alt="<?php echo smartyTranslate(array('s'=>'Add a new module'),$_smarty_tpl);?>
" class="middle" /> <?php echo smartyTranslate(array('s'=>'Add a new module'),$_smarty_tpl);?>
</legend>
			<p><?php echo smartyTranslate(array('s'=>'The module must be either a zip file or a tarball.'),$_smarty_tpl);?>
</p>
			<div style="float:left;margin-right:50px">
				<form action="<?php echo $_smarty_tpl->tpl_vars['currentIndex']->value;?>
&token=<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" method="post" enctype="multipart/form-data">
					<label style="width: 100px"><?php echo smartyTranslate(array('s'=>'Module file'),$_smarty_tpl);?>
</label>
					<div class="margin-form" style="padding-left: 140px">
						<input type="file" name="file" />
						<p><?php echo smartyTranslate(array('s'=>'Upload a module from your computer.'),$_smarty_tpl);?>
</p>
					</div>
					<div class="margin-form" style="padding-left: 140px">
						<input type="submit" name="download" value="<?php echo smartyTranslate(array('s'=>'Upload this module'),$_smarty_tpl);?>
" class="button" />
					</div>
				</form>
			</div>
		</fieldset>
		<br />
	</div>
<?php }?>

<?php }} ?>