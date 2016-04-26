<?php
include('../../config/config.inc.php'); 
include('../../init.php');
include('stockcheck.php');
global $cookie, $id_lang, $id_category, $link;
$skipcategory = Configuration::get('STOCK_CHECK_SKIP_CAT');
$skipcat = Configuration::get('STOCK_CHECK_SKIP_CAT');
$nb = intval(Configuration::get('STOCK_CHECK_NBR'));
$sort = Configuration::get('STOCK_CHECK_SORT');

$name1 = Configuration::get('STOCK_CHECK_NAME1');
$name2 = Configuration::get('STOCK_CHECK_NAME2');
$name3 = Configuration::get('STOCK_CHECK_NAME3');
$name4 = Configuration::get('STOCK_CHECK_NAME4');
$type = Configuration::get('STOCK_CHECK_TYPE');
$name5 = Configuration::get('STOCK_CHECK_NAME5');
$name6 = Configuration::get('STOCK_CHECK_NAME6');
$title = Configuration::get('STOCK_CHECK_TITLE');
$path = Configuration::get('STOCK_CHECK_PATH');
$subtitle = Configuration::get('STOCK_CHECK_SUBTITLE');
$foot = Configuration::get('STOCK_CHECK_FOOTER');
$ss = Configuration::get('STOCK_CHECK_SS');
$image1 = Configuration::get('STOCK_CHECK_IMAGE1');
$sp = Configuration::get('STOCK_CHECK_SP');
$w1 = Configuration::get('STOCK_CHECK_W1');
$w2 = Configuration::get('STOCK_CHECK_W2');
$ppp = Configuration::get('STOCK_CHECK_PPP');
$w3 = Configuration::get('STOCK_CHECK_W3');
$w4 = Configuration::get('STOCK_CHECK_W4');
$w5 = Configuration::get('STOCK_CHECK_W5');
$o = Configuration::get('STOCK_CHECK_O');

	$currencya = Configuration::get('STOCK_CHECK_CURRENCY');

$langs = Configuration::get('STOCK_CHECK_LANGS');

	


$limage = Configuration::get('STOCK_CHECK_LIMAGE', $langs);
$lref = Configuration::get('STOCK_CHECK_LREF', $langs);
$lref = Configuration::get('STOCK_CHECK_LREF', $langs);
$lname = Configuration::get('STOCK_CHECK_LNAME', $langs);
$lprice = Configuration::get('STOCK_CHECK_LPRICE', $langs);
$lpricetax = Configuration::get('STOCK_CHECK_LPRICETAX', $langs);
$lwrice = Configuration::get('STOCK_CHECK_LWPRICE', $langs);
$ldescription = Configuration::get('STOCK_CHECK_LDESCRIPTION', $langs);
$lcategory = Configuration::get('STOCK_CHECK_LCATEGORY', $langs);
$lmanufacturer = Configuration::get('STOCK_CHECK_LMANUFACTURER', $langs);
$lfeatures = Configuration::get('STOCK_CHECK_LFEATURES', $langs);
$lstock = Configuration::get('STOCK_CHECK_LSTOCK', $langs);


$currencye = Currency::getCurrency($currencya);
$sign = $currencye['sign'];
$rate = $currencye['conversion_rate'];
$code =  Configuration::get('STOCK_CHECK_CODE');
$str = iconv('UTF-8', $code, $sign);
$currency = Currency::getCurrency($cookie->id_currency);

		mysql_connect(_DB_SERVER_, _DB_USER_, _DB_PASSWD_) or die(mysql_error());
mysql_query("SET NAMES UTF8");//this is needed for UTF 8 characters - multilanguage
mysql_select_db(_DB_NAME_) or die(mysql_error());
global $cookie, $id_category, $context;
	if(_PS_VERSION_ > "1.5.0.0"){
		if (!$context)
			$context = Context::getContext();
	}
	
if(_PS_VERSION_ < "1.4.0.0"){


$sorgu='
SELECT p.*, pa.`id_product_attribute`, pl.`description`, pl.`description_short`, pl.`available_now`, pl.`available_later`, pl.`link_rewrite`, pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`, pl.`name`, i.`id_image`, il.`legend`, m.`name` AS manufacturer_name, tl.`name` AS tax_name, t.`rate`, cl.`name` AS category_default, DATEDIFF(p.`date_add`, DATE_SUB(NOW(), INTERVAL '.(Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).' DAY)) > 0 AS new
		            
		FROM `'._DB_PREFIX_.'category_product` cp
		LEFT JOIN `'._DB_PREFIX_.'product` p ON p.`id_product` = cp.`id_product`
		LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa ON (p.`id_product` = pa.`id_product` AND default_on = 1)
		LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (p.`id_category_default` = cl.`id_category` AND cl.`id_lang` = '.intval($langs).')
		LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (p.`id_product` = pl.`id_product` AND pl.`id_lang` = '.intval($langs).')
		LEFT JOIN `'._DB_PREFIX_.'image` i ON (i.`id_product` = p.`id_product` AND i.`cover` = 1)
		LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = '.intval($langs).')
		LEFT JOIN `'._DB_PREFIX_.'tax` t ON (t.`id_tax` = p.`id_tax`)
		LEFT JOIN `'._DB_PREFIX_.'tax_lang` tl ON (t.`id_tax` = tl.`id_tax` AND tl.`id_lang` = '.intval($langs).')
		LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON (m.`id_manufacturer` = p.`id_manufacturer`)
		WHERE cp.`id_category` IN ('.$skipcat.') AND p.`active` = 1 AND p.quantity < '.$title.' 
		GROUP BY cp.id_product
		ORDER BY '.$sort.' ASC
		LIMIT '.$nb.'';
}
if(_PS_VERSION_ > "1.4.0.0" && _PS_VERSION_ < "1.5.0.0"){
	$sorgu='
		
	SELECT cp.*,p.*, pl.* , t.`rate` AS tax_rate, m.`name` AS manufacturer_name, s.`name` AS supplier_name,i.`id_image`, il.`legend`
		
		FROM `'._DB_PREFIX_.'category_product` cp
		LEFT JOIN `'._DB_PREFIX_.'product` p ON p.`id_product` = cp.`id_product`
		LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (p.`id_product` = pl.`id_product`)
		LEFT JOIN `'._DB_PREFIX_.'image` i ON (i.`id_product` = p.`id_product` AND i.`cover` = 1)
		LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = '.intval($langs).')

		LEFT JOIN `'._DB_PREFIX_.'tax_rule` tr ON (p.`id_tax_rules_group` = tr.`id_tax_rules_group`
			AND tr.`id_country` = '.(int)Country::getDefaultCountryId().'
			AND tr.`id_state` = 0)
		LEFT JOIN `'._DB_PREFIX_.'tax` t ON (t.`id_tax` = tr.`id_tax`)
		LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON (m.`id_manufacturer` = p.`id_manufacturer`)
		LEFT JOIN `'._DB_PREFIX_.'supplier` s ON (s.`id_supplier` = p.`id_supplier`)'.
		($id_category ? 'LEFT JOIN `'._DB_PREFIX_.'category_product` c ON (c.`id_product` = p.`id_product`)' : '').'
			WHERE cp.`id_category` IN ('.$skipcat.') AND p.`active` = 1 AND p.quantity < '.$title.' 
		GROUP BY cp.id_product
		ORDER BY '.$sort.' ASC
		LIMIT '.$nb.'';
	}
		if(_PS_VERSION_ > "1.5.0.0")
	
	{
		$sorgu = 'SELECT p.*,cp.*, ps.*, pl.`description`, pl.`description_short`, pl.`link_rewrite`, pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`,
		pl.`name`, p.`ean13`, p.`upc`, i.`id_image`, il.`legend`, tl.`name` AS tax_name, t.`rate`,tr.*, m.`name` AS manufacturer_name,cl.`name` AS category_default,sp.from,sp.to, sp.reduction, sp.reduction_type,sa.`quantity` AS `qa`
		FROM `'._DB_PREFIX_.'category_product` cp
		LEFT JOIN `'._DB_PREFIX_.'product` p ON p.`id_product` = cp.`id_product`
		LEFT JOIN `'._DB_PREFIX_.'product_shop` ps ON p.`id_product` = ps.`id_product`
		LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa ON (p.`id_product` = pa.`id_product` AND default_on = 1)
		LEFT JOIN `'._DB_PREFIX_.'specific_price` sp ON (p.`id_product` = sp.`id_product` )
		LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (p.`id_category_default` = cl.`id_category` AND cl.`id_lang` = '.$langs.')
		LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (p.`id_product` = pl.`id_product` AND pl.`id_lang` = '.$langs.')
		LEFT JOIN `'._DB_PREFIX_.'stock_available` sa ON p.`id_product` = sa.`id_product`
		LEFT JOIN `'._DB_PREFIX_.'image` i ON (i.`id_product` = p.`id_product` AND i.`cover` = 1)
		LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = '.$langs.')
		LEFT JOIN `'._DB_PREFIX_.'tax_rule` tr ON (p.`id_tax_rules_group` = tr.`id_tax_rules_group`
		 		  AND tr.`id_country` = '.(int)Context::getContext()->country->id.'
		 		  AND tr.`id_state` = 0)
	    LEFT JOIN `'._DB_PREFIX_.'tax` t ON (t.`id_tax` = tr.`id_tax`)
		LEFT JOIN `'._DB_PREFIX_.'tax_lang` tl ON (t.`id_tax` = tl.`id_tax` AND tl.`id_lang` = '.$langs.')
		LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON (m.`id_manufacturer` = p.`id_manufacturer`)
						WHERE cp.`id_category` IN ('.$skipcat.') AND p.`active` = 1 AND sa.`quantity` < '.$title.' 
							AND ps.id_shop = '.$context->shop->id.' 
						GROUP BY cp.`id_product`
						ORDER BY '.$sort.' ASC
						LIMIT '.$nb.'';
	
	
		}
	
$resultado = mysql_query($sorgu);
$veri= mysql_fetch_array($resultado);


		
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type="text/css" media="screen">
body{ 
font-family: php_times}
#tr{
	background-color:#333
	}
	td {
  border-width: 5px;
 
}
	td.line { 
	border-style:solid;
	color:orange;
 }

	 td{
		  border-style:solid;
	 border-color:orange;
	 border-width:1px
		 
		 }
		 tr{  border: 0.1em #0033DD solid;}


</style>
</head>
<body>


<table width="100%" border="0" >
 <tr>
    <td align="center" ><img src="<?php echo __PS_BASE_URI__."img/logo".((_PS_VERSION_ > "1.5.0.0") ? "-".$context->shop->id : '').".jpg"; ?>"></td>
  </tr>
</table>
<table width="100%" border="0">
  <tr >
    <th width="116" align="center" bgcolor="#CCCCCC"><?php echo $limage;?></th>
    <th width="115" align="center" bgcolor="#CCCCCC"><?php echo $lname;?></th>
    <th width="50" align="center" bgcolor="#CCCCCC"><?php echo $lref;?></th>
    <th align="center" bgcolor="#CCCCCC"><?php echo $ldescription;?></th>
    <th align="center" bgcolor="#CCCCCC"><?php echo $lpricetax;?>(<?php echo $sign;?>)</th>
    <th align="center" bgcolor="#CCCCCC"><?php echo $lstock;?></th>
  </tr>
   <?php 
   
	do{	
	$newlink = new Link;
	
	$id_image = $veri['id_image'];



$link2 =$newlink->getProductLink($veri['id_product'], null,  null, null, $cookie->id_lang);

/**/

$legacy=Configuration::get('PS_LEGACY_IMAGES');
			$newlink = new Link;
if(_PS_VERSION_ < "1.4.3"){
			$link = $veri['link_rewrite'];
$legend = $veri['legend'];
$id_image = $veri['id_image'];

$images = $newlink->getImageLink($link, $veri['id_product'].'-'.$id_image, $type);
		}
		if(_PS_VERSION_ >= "1.4.3" && _PS_VERSION_ < "1.5.0.0"){
		$link = $veri['link'];
$id_image = $veri['id_image'];
if($legacy==1){
$images = $newlink->getImageLink($link, $veri['id_product'].'-'.$id_image,$type); 
}
else{
	$images = $newlink->getImageLink($link, $id_image,$type); 
	}
}
if(_PS_VERSION_ > "1.5.0.0"){
		
		$link = $veri['link_rewrite'];
$id_image = $veri['id_image'];
$images = $newlink->getImageLink($link, $veri['id_product'].'-'.$id_image,$type); 


}
	
 ?>
  <tr>
  
    <td align="center" valign="top"><img src="<?php 	if(_PS_VERSION_ > "1.5.0.0"){
	echo str_replace("".$_SERVER['HTTP_HOST'].__PS_BASE_URI__."","../../",$images);
	}
	else
	{
		echo $images;
		}?>" style="width:<?php echo $image1;?>px" >
    
    </td>
    <td valign="top" ><span style="color:#f26822"><a href="<?php echo $link2;?>" target="_blank"><?php echo $veri["name"];?></a></span></td>
    <td valign="top" ><?php echo $veri["reference"];?></td>
    <td width="133" valign="top" >
      <?php
    $description_short = $veri["description_short"];
$description_short2 = strip_tags($description_short);
echo $description_short2;
    ?>
    </td>
<td width="102" align="right" valign="top" ><?php echo number_format($veri["price"]*$rate,2,',','.');?></td>
    <td width="79" align="right" valign="top" ><?php echo ((_PS_VERSION_ > "1.5.0.0") ? $veri["qa"] : $veri["quantity"])?></td>
  </tr>
 <?php
  }
  while($veri=mysql_fetch_array($resultado));
   ?>
</table>

</body>
</html>