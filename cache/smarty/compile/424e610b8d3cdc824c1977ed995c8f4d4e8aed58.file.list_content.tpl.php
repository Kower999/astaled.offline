<?php /* Smarty version Smarty-3.1.8, created on 2017-10-18 16:36:22
         compiled from "C:\wamp\www\astaled.offline\shopadmin/themes/default\template\helpers\list\list_content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:100255458059e766e603dbf7-79812003%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '424e610b8d3cdc824c1977ed995c8f4d4e8aed58' => 
    array (
      0 => 'C:\\wamp\\www\\astaled.offline\\shopadmin/themes/default\\template\\helpers\\list\\list_content.tpl',
      1 => 1501670721,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '100255458059e766e603dbf7-79812003',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'list' => 0,
    'position_identifier' => 0,
    'id_category' => 0,
    'identifier' => 0,
    'tr' => 0,
    'index' => 0,
    'row_hover' => 0,
    'color_on_bg' => 0,
    'has_bulk_actions' => 0,
    'list_skip_actions' => 0,
    'table' => 0,
    'fields_display' => 0,
    'params' => 0,
    'key' => 0,
    'no_link' => 0,
    'order_by' => 0,
    'order_way' => 0,
    'current_index' => 0,
    'view' => 0,
    'token' => 0,
    'positions' => 0,
    'shop_link_type' => 0,
    'has_actions' => 0,
    'actions' => 0,
    'action' => 0,
    'oz' => 0,
    'mytotal2' => 0,
    'mytotal' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_59e766e60c31b9_26037995',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59e766e60c31b9_26037995')) {function content_59e766e60c31b9_26037995($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include 'C:\\wamp\\www\\astaled.offline\\tools\\smarty\\plugins\\modifier.escape.php';
if (!is_callable('smarty_function_mycount')) include 'C:\\wamp\\www\\astaled.offline\\tools\\smarty\\plugins\\function.mycount.php';
?>
<tbody>

<?php $_smarty_tpl->tpl_vars['mytotal'] = new Smarty_variable(array(), null, 0);?>
<?php $_smarty_tpl->tpl_vars['mytotal2'] = new Smarty_variable(array(), null, 0);?>

<?php if (count($_smarty_tpl->tpl_vars['list']->value)){?>
<?php  $_smarty_tpl->tpl_vars['tr'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tr']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tr']->key => $_smarty_tpl->tpl_vars['tr']->value){
$_smarty_tpl->tpl_vars['tr']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['tr']->key;
?>
	<tr
	<?php if ($_smarty_tpl->tpl_vars['position_identifier']->value){?>id="tr_<?php echo $_smarty_tpl->tpl_vars['id_category']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['identifier']->value];?>
_<?php if (isset($_smarty_tpl->tpl_vars['tr']->value['position']['position'])){?><?php echo $_smarty_tpl->tpl_vars['tr']->value['position']['position'];?>
<?php }else{ ?>0<?php }?>"<?php }?>
	class="<?php if ((1 & $_smarty_tpl->tpl_vars['index']->value)){?>alt_row<?php }?> <?php if ($_smarty_tpl->tpl_vars['row_hover']->value){?>row_hover<?php }?>"
	<?php if (isset($_smarty_tpl->tpl_vars['tr']->value['color'])&&$_smarty_tpl->tpl_vars['color_on_bg']->value){?>style="background-color: <?php echo $_smarty_tpl->tpl_vars['tr']->value['color'];?>
"<?php }?>
	<?php if (isset($_smarty_tpl->tpl_vars['tr']->value['on_sale'])){?><?php if ($_smarty_tpl->tpl_vars['tr']->value['on_sale']){?>style="background-color: #FBB98C" title="<?php echo smartyTranslate(array('s'=>'Výpredaj'),$_smarty_tpl);?>
"<?php }?><?php }?>
	>
    
		<td class="center">
			<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['has_bulk_actions']->value;?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1){?>
				<?php if (isset($_smarty_tpl->tpl_vars['list_skip_actions']->value['delete'])){?>
					<?php if (!in_array($_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['identifier']->value],$_smarty_tpl->tpl_vars['list_skip_actions']->value['delete'])){?>
						<input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['table']->value;?>
Box[]" value="<?php echo $_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['identifier']->value];?>
" class="noborder" />
					<?php }?>
				<?php }else{ ?>
					<input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['table']->value;?>
Box[]" value="<?php echo $_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['identifier']->value];?>
" class="noborder" />
				<?php }?>
			<?php }?>
		</td>
		<?php  $_smarty_tpl->tpl_vars['params'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['params']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['fields_display']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['params']->key => $_smarty_tpl->tpl_vars['params']->value){
$_smarty_tpl->tpl_vars['params']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['params']->key;
?>
	<?php if (isset($_smarty_tpl->tpl_vars['params']->value['provisions'])){?>
        <?php $_smarty_tpl->createLocalArrayVariable('mytotal', null, 0);
$_smarty_tpl->tpl_vars['mytotal']->value[] = $_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value];?> 
    <?php }?>        
	<?php if (isset($_smarty_tpl->tpl_vars['params']->value['tprice'])){?>
        <?php $_smarty_tpl->createLocalArrayVariable('mytotal2', null, 0);
$_smarty_tpl->tpl_vars['mytotal2']->value[] = $_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value];?> 
    <?php }?>        
			
				<td
					<?php if (isset($_smarty_tpl->tpl_vars['params']->value['position'])){?>
						id="td_<?php if (!empty($_smarty_tpl->tpl_vars['id_category']->value)){?><?php echo $_smarty_tpl->tpl_vars['id_category']->value;?>
<?php }else{ ?>0<?php }?>_<?php echo $_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['identifier']->value];?>
"
					<?php }?>
					class="<?php if (!$_smarty_tpl->tpl_vars['no_link']->value){?>pointer<?php }?>
					<?php if (isset($_smarty_tpl->tpl_vars['params']->value['position'])&&$_smarty_tpl->tpl_vars['order_by']->value=='position'&&$_smarty_tpl->tpl_vars['order_way']->value!='DESC'){?> dragHandle<?php }?>
					<?php if (isset($_smarty_tpl->tpl_vars['params']->value['align'])){?> <?php echo $_smarty_tpl->tpl_vars['params']->value['align'];?>
<?php }?>"
					<?php if ((!isset($_smarty_tpl->tpl_vars['params']->value['position'])&&!$_smarty_tpl->tpl_vars['no_link']->value&&!isset($_smarty_tpl->tpl_vars['params']->value['remove_onclick']))){?>
						onclick="document.location = '<?php echo $_smarty_tpl->tpl_vars['current_index']->value;?>
&<?php echo $_smarty_tpl->tpl_vars['identifier']->value;?>
=<?php echo $_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['identifier']->value];?>
<?php if ($_smarty_tpl->tpl_vars['view']->value){?>&view<?php }else{ ?>&update<?php }?><?php echo $_smarty_tpl->tpl_vars['table']->value;?>
&token=<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
'">
					<?php }else{ ?>
					>
				<?php }?>
			
			
				<?php if (isset($_smarty_tpl->tpl_vars['params']->value['prefix'])){?><?php echo $_smarty_tpl->tpl_vars['params']->value['prefix'];?>
<?php }?>
				<?php if (isset($_smarty_tpl->tpl_vars['params']->value['color'])&&isset($_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['params']->value['color']])){?>
					<span class="color_field" style="background-color:<?php echo $_smarty_tpl->tpl_vars['tr']->value['color'];?>
;color:<?php if (Tools::getBrightness($_smarty_tpl->tpl_vars['tr']->value['color'])<128){?>white<?php }else{ ?>#383838<?php }?>">
				<?php }?>

				<?php if (isset($_smarty_tpl->tpl_vars['params']->value['active'])){?>
					<?php echo $_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value];?>

				<?php }elseif(isset($_smarty_tpl->tpl_vars['params']->value['activeVisu'])){?>
					<img src="../img/admin/<?php if ($_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value]){?>enabled.gif<?php }else{ ?>disabled.gif<?php }?>"
					alt="<?php if ($_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value]){?><?php echo smartyTranslate(array('s'=>'Enabled'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'Disabled'),$_smarty_tpl);?>
<?php }?>" title="<?php if ($_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value]){?><?php echo smartyTranslate(array('s'=>'Enabled'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'Disabled'),$_smarty_tpl);?>
<?php }?>" />
				<?php }elseif(isset($_smarty_tpl->tpl_vars['params']->value['position'])){?>
					<?php if ($_smarty_tpl->tpl_vars['order_by']->value=='position'&&$_smarty_tpl->tpl_vars['order_way']->value!='DESC'){?>
						<a href="<?php echo $_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value]['position_url_down'];?>
" <?php if (!($_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value]['position']!=$_smarty_tpl->tpl_vars['positions']->value[count($_smarty_tpl->tpl_vars['positions']->value)-1])){?>style="display: none;"<?php }?>>
							<img src="../img/admin/<?php if ($_smarty_tpl->tpl_vars['order_way']->value=='ASC'){?>down<?php }else{ ?>up<?php }?>.gif" alt="<?php echo smartyTranslate(array('s'=>'Down'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'Down'),$_smarty_tpl);?>
" />
						</a>

						<a href="<?php echo $_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value]['position_url_up'];?>
" <?php if (!($_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value]['position']!=$_smarty_tpl->tpl_vars['positions']->value[0])){?>style="display: none;"<?php }?>>
							<img src="../img/admin/<?php if ($_smarty_tpl->tpl_vars['order_way']->value=='ASC'){?>up<?php }else{ ?>down<?php }?>.gif" alt="<?php echo smartyTranslate(array('s'=>'Up'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'Up'),$_smarty_tpl);?>
" />
						</a>
					<?php }else{ ?>
						<?php echo $_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value]['position']+1;?>

					<?php }?>
				<?php }elseif(isset($_smarty_tpl->tpl_vars['params']->value['image'])){?>
					<?php echo $_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value];?>

				<?php }elseif(isset($_smarty_tpl->tpl_vars['params']->value['icon'])){?>
					<img src="../img/admin/<?php echo $_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value]['src'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value]['alt'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value]['alt'];?>
" />
				<?php }elseif(isset($_smarty_tpl->tpl_vars['params']->value['price'])){?>
					<?php echo $_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value];?>

				<?php }elseif(isset($_smarty_tpl->tpl_vars['params']->value['float'])){?>
					<?php echo $_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value];?>

				<?php }elseif(isset($_smarty_tpl->tpl_vars['params']->value['type'])&&$_smarty_tpl->tpl_vars['params']->value['type']=='date'){?>
					<?php echo $_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value];?>

				<?php }elseif(isset($_smarty_tpl->tpl_vars['params']->value['type'])&&$_smarty_tpl->tpl_vars['params']->value['type']=='datetime'){?>
					<?php echo $_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value];?>

				<?php }elseif(isset($_smarty_tpl->tpl_vars['params']->value['type'])&&$_smarty_tpl->tpl_vars['params']->value['type']=='decimal'){?>
					<?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value]);?>

				<?php }elseif(isset($_smarty_tpl->tpl_vars['params']->value['type'])&&$_smarty_tpl->tpl_vars['params']->value['type']=='percent'){?>
					<?php echo $_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value];?>
 <?php echo smartyTranslate(array('s'=>'%'),$_smarty_tpl);?>

				
				<?php }elseif(isset($_smarty_tpl->tpl_vars['params']->value['type'])&&$_smarty_tpl->tpl_vars['params']->value['type']=='editable'&&isset($_smarty_tpl->tpl_vars['tr']->value['id'])){?>
					<input type="text" name="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['tr']->value['id'];?>
" value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value], 'htmlall', 'UTF-8');?>
" class="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" />
				<?php }elseif(isset($_smarty_tpl->tpl_vars['params']->value['callback'])){?>
					<?php echo $_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value];?>

				<?php }elseif(isset($_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value])&&$_smarty_tpl->tpl_vars['key']->value=='color'){?>
					<div style="float: left; width: 18px; height: 12px; border: 1px solid #996633; background-color: <?php echo $_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value];?>
; margin-right: 4px;"></div>
				<?php }elseif(isset($_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value])){?>
					<?php if (isset($_smarty_tpl->tpl_vars['params']->value['maxlength'])&&Tools::strlen($_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value])>$_smarty_tpl->tpl_vars['params']->value['maxlength']){?>
						<span title="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value], 'htmlall', 'UTF-8');?>
"><?php echo smarty_modifier_escape($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value],$_smarty_tpl->tpl_vars['params']->value['maxlength'],'...'), 'htmlall', 'UTF-8');?>
</span>
					<?php }else{ ?>
						<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value], 'htmlall', 'UTF-8');?>

					<?php }?>
				<?php }else{ ?>
					--
				<?php }?>
				<?php if (isset($_smarty_tpl->tpl_vars['params']->value['suffix'])){?><?php echo $_smarty_tpl->tpl_vars['params']->value['suffix'];?>
<?php }?>
				<?php if (isset($_smarty_tpl->tpl_vars['params']->value['color'])&&isset($_smarty_tpl->tpl_vars['tr']->value['color'])){?>
					</span>
				<?php }?>
				</td>
			
		<?php } ?>
	<?php if ($_smarty_tpl->tpl_vars['shop_link_type']->value){?>
		<td class="center" title="<?php echo $_smarty_tpl->tpl_vars['tr']->value['shop_name'];?>
">
			<?php if (isset($_smarty_tpl->tpl_vars['tr']->value['shop_short_name'])){?>
				<?php echo $_smarty_tpl->tpl_vars['tr']->value['shop_short_name'];?>

			<?php }else{ ?>
				<?php echo $_smarty_tpl->tpl_vars['tr']->value['shop_name'];?>

			<?php }?></td>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['has_actions']->value){?>
		<td class="center" style="white-space: nowrap;">
			<?php  $_smarty_tpl->tpl_vars['action'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['action']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['actions']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['action']->key => $_smarty_tpl->tpl_vars['action']->value){
$_smarty_tpl->tpl_vars['action']->_loop = true;
?>
				<?php if (isset($_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['action']->value])){?>
					<?php echo $_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['action']->value];?>

				<?php }?>
			<?php } ?>
		</td>
	<?php }?>
	</tr>
<?php } ?>
<?php }else{ ?>
	<tr><td class="center" colspan="<?php echo count($_smarty_tpl->tpl_vars['fields_display']->value)+2;?>
"><?php echo smartyTranslate(array('s'=>'No items found'),$_smarty_tpl);?>
</td></tr>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['table']->value=='order'){?>

	<tr class="filter">
        <td colspan="<?php if ($_smarty_tpl->tpl_vars['oz']->value){?>5<?php }else{ ?>6<?php }?>">&nbsp;&nbsp;&nbsp;<b>Suma</b></td>
        <td class="right">
            <b><?php if ($_smarty_tpl->tpl_vars['mytotal2']->value){?><?php echo smarty_function_mycount(array('this'=>$_smarty_tpl->tpl_vars['mytotal2']->value),$_smarty_tpl);?>
<?php }else{ ?>0,0<?php }?></b>
        </td>
        <td class="right">
            <b><?php if ($_smarty_tpl->tpl_vars['mytotal']->value){?><?php echo smarty_function_mycount(array('this'=>$_smarty_tpl->tpl_vars['mytotal']->value),$_smarty_tpl);?>
<?php }else{ ?>0,0<?php }?></b>
        </td>
        <td colspan="7"></td>
    </tr>
<?php }?>    
</tbody>
<?php }} ?>