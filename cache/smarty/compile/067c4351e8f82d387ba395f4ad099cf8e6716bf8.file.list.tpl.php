<?php /* Smarty version Smarty-3.1.8, created on 2015-03-28 15:25:31
         compiled from "C:\wamp\www\shopadmin/themes/default\template\controllers\modules\list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:26472544571d9583686-24025831%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '067c4351e8f82d387ba395f4ad099cf8e6716bf8' => 
    array (
      0 => 'C:\\wamp\\www\\shopadmin/themes/default\\template\\controllers\\modules\\list.tpl',
      1 => 1427206705,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26472544571d9583686-24025831',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_544571d9c43775_41990309',
  'variables' => 
  array (
    'modules' => 0,
    'module' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_544571d9c43775_41990309')) {function content_544571d9c43775_41990309($_smarty_tpl) {?>

			<?php if (count($_smarty_tpl->tpl_vars['modules']->value)){?>

				<table cellspacing="0" cellpadding="0" style="width: 100%; margin-bottom:10px;" class="table" id="">
					<col width="20px">
					<col width="40px">
					<col>
					<col width="150px">
					</colgroup>
					<thead>
						<tr class="nodrag nodrop">
							<th class="center">
								<input type="checkbox" rel="false" class="noborder" id="checkme"><br>
							</th>
							<th class="center"></th>
							<th><?php echo smartyTranslate(array('s'=>'Module name'),$_smarty_tpl);?>
</th>
							<th></th>
						</tr>			
					<tbody>
					<?php  $_smarty_tpl->tpl_vars['module'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['module']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['modules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['module']->key => $_smarty_tpl->tpl_vars['module']->value){
$_smarty_tpl->tpl_vars['module']->_loop = true;
?>
						<tr>
							<td><input type="checkbox" name="modules" value="<?php echo $_smarty_tpl->tpl_vars['module']->value->name;?>
" <?php if (!isset($_smarty_tpl->tpl_vars['module']->value->confirmUninstall)||empty($_smarty_tpl->tpl_vars['module']->value->confirmUninstall)){?>rel="false"<?php }else{ ?>rel="<?php echo addslashes($_smarty_tpl->tpl_vars['module']->value->confirmUninstall);?>
"<?php }?> class="noborder"></td>
							<td><img class="imgm" alt="" src="<?php if (isset($_smarty_tpl->tpl_vars['module']->value->image)){?><?php echo $_smarty_tpl->tpl_vars['module']->value->image;?>
<?php }else{ ?>../modules/<?php echo $_smarty_tpl->tpl_vars['module']->value->name;?>
/<?php echo $_smarty_tpl->tpl_vars['module']->value->logo;?>
<?php }?>"></td>
							<td>
								<div class="moduleDesc" id="anchor<?php echo ucfirst($_smarty_tpl->tpl_vars['module']->value->name);?>
">
									<h3><?php echo $_smarty_tpl->tpl_vars['module']->value->displayName;?>

										<?php if (isset($_smarty_tpl->tpl_vars['module']->value->type)&&$_smarty_tpl->tpl_vars['module']->value->type=='addonsMustHave'){?>
											<span class="setup must-have"><?php echo smartyTranslate(array('s'=>'Must Have'),$_smarty_tpl);?>
</span>
										<?php }else{ ?>
											<?php if (isset($_smarty_tpl->tpl_vars['module']->value->id)&&$_smarty_tpl->tpl_vars['module']->value->id>0){?>
												<span class="setup<?php if (isset($_smarty_tpl->tpl_vars['module']->value->active)&&$_smarty_tpl->tpl_vars['module']->value->active==0){?> off<?php }?>"><?php echo smartyTranslate(array('s'=>'Installed'),$_smarty_tpl);?>
</span>
											<?php }else{ ?>
												<span class="setup non-install"><?php echo smartyTranslate(array('s'=>'Not installed'),$_smarty_tpl);?>
</span>
											<?php }?>
										<?php }?>
									</h3>
									<div class="metadata">
										<?php if (isset($_smarty_tpl->tpl_vars['module']->value->author)&&!empty($_smarty_tpl->tpl_vars['module']->value->author)){?>
										<dl class="">
											<dt><?php echo smartyTranslate(array('s'=>'Developed by'),$_smarty_tpl);?>
 :</dt>
											<dd><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['module']->value->author,20,'...');?>
</dd>|
										</dl>
										<?php }?>
										<dl class="">
											<dt><?php echo smartyTranslate(array('s'=>'Version'),$_smarty_tpl);?>
 :</dt>
											<dd><?php echo $_smarty_tpl->tpl_vars['module']->value->version;?>
 
												<?php if (isset($_smarty_tpl->tpl_vars['module']->value->version_addons)){?>(<?php echo smartyTranslate(array('s'=>'Update'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['module']->value->version_addons;?>
 <?php echo smartyTranslate(array('s'=>'available on PrestaShop Addons'),$_smarty_tpl);?>
)<?php }?>
											</dd>|
										</dl>
										<dl class="">
											<dt><?php echo smartyTranslate(array('s'=>'Category'),$_smarty_tpl);?>
 :</dt>
											<dd><?php echo $_smarty_tpl->tpl_vars['module']->value->categoryName;?>
</dd>
										</dl>
									</div>
									<p class="desc"><?php if (isset($_smarty_tpl->tpl_vars['module']->value->description)&&$_smarty_tpl->tpl_vars['module']->value->description!=''){?><?php echo smartyTranslate(array('s'=>'Description'),$_smarty_tpl);?>
 : <?php echo $_smarty_tpl->tpl_vars['module']->value->description;?>
<?php }else{ ?>&nbsp;<?php }?></p>
									<?php if (isset($_smarty_tpl->tpl_vars['module']->value->message)){?><div class="conf"><?php echo $_smarty_tpl->tpl_vars['module']->value->message;?>
</div><?php }?>
									<div class="row-actions-module">
										<?php if (!isset($_smarty_tpl->tpl_vars['module']->value->not_on_disk)){?><?php echo $_smarty_tpl->tpl_vars['module']->value->optionsHtml;?>
<?php }else{ ?>&nbsp;<?php }?>
									</div>
								</div>
							</td>
							<td>
								<ul id="list-action-button">
									<?php if (isset($_smarty_tpl->tpl_vars['module']->value->type)&&$_smarty_tpl->tpl_vars['module']->value->type=='addonsMustHave'){?>
										<li>
											<a href="<?php echo $_smarty_tpl->tpl_vars['module']->value->addons_buy_url;?>
" target="_blank" class="button updated"><span><img src="../img/admin/cart_addons.png">&nbsp;&nbsp;<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['module']->value->price,'currency'=>$_smarty_tpl->tpl_vars['module']->value->id_currency),$_smarty_tpl);?>
</span></a>
										</li>
									<?php }else{ ?>
										<?php if ($_smarty_tpl->tpl_vars['module']->value->id&&isset($_smarty_tpl->tpl_vars['module']->value->version_addons)&&$_smarty_tpl->tpl_vars['module']->value->version_addons){?>
											<li><a href="<?php echo $_smarty_tpl->tpl_vars['module']->value->options['update_url'];?>
" class="button updated"><span><?php echo smartyTranslate(array('s'=>'Update it!'),$_smarty_tpl);?>
</span></a></li>
										<?php }?>
							      			<li>
							      				<a <?php if (isset($_smarty_tpl->tpl_vars['module']->value->id)&&$_smarty_tpl->tpl_vars['module']->value->id>0&&!empty($_smarty_tpl->tpl_vars['module']->value->options['uninstall_onclick'])){?>onclick="<?php echo $_smarty_tpl->tpl_vars['module']->value->options['uninstall_onclick'];?>
"<?php }?> href="<?php if (isset($_smarty_tpl->tpl_vars['module']->value->id)&&$_smarty_tpl->tpl_vars['module']->value->id>0){?><?php echo $_smarty_tpl->tpl_vars['module']->value->options['uninstall_url'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['module']->value->options['install_url'];?>
<?php }?>" class="button installed">
							      					<span><?php if (isset($_smarty_tpl->tpl_vars['module']->value->id)&&$_smarty_tpl->tpl_vars['module']->value->id>0){?><?php echo smartyTranslate(array('s'=>'Uninstall'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'Install'),$_smarty_tpl);?>
<?php }?></span>
							      				</a>
							      			</li>
								     <?php }?>
								</ul>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>

				<div style="margin-top: 12px;">
					<input type="button" class="button big" value="<?php echo smartyTranslate(array('s'=>'Install the selection'),$_smarty_tpl);?>
" onclick="modules_management('install')"/>
					<input type="button" class="button big" value="<?php echo smartyTranslate(array('s'=>'Uninstall the selection'),$_smarty_tpl);?>
" onclick="modules_management('uninstall')" />
				</div>
			<?php }else{ ?>
				<div style="margin-top: 12px;color: #585A69;font-size: 16px;"><p align="center"><?php echo smartyTranslate(array('s'=>'No modules available in this section.'),$_smarty_tpl);?>
</p></div>
			<?php }?>

<?php }} ?>