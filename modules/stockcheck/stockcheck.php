<?php 

	
class StockCheck extends Module
{
	private $_html = '';
	private $_postErrors = array();
	

	function __construct()
	{
		$this->name = 'stockcheck';
			if(_PS_VERSION_ > "1.4.0.0" && _PS_VERSION_ < "1.5.0.0"){
		$this->tab = 'administration';
		$this->author = 'RSI';
		$this->need_instance = 0;
		}
		elseif(_PS_VERSION_ > "1.5.0.0"){
				$this->tab = 'administration';
		$this->author = 'RSI';
			}
		
		else{
		$this->tab = 'Tools';
		}
		$this->version = 2.9;

		parent::__construct(); // The parent construct is required for translations

		$this->page = basename(__FILE__, '.php');
		$this->displayName = $this->l('Stock Check');
		$this->description = $this->l('Export your out of stock products - www.catalogo-onlinersi.com.ar');
	}
public function getImageLink($name, $ids, $type = NULL)
	{
		global $object;
		
		if(floatval(substr(_PS_VERSION_,0,3)) <= "1.3.7")
		{
			return ($object->allow == 1) ? (__PS_BASE_URI__.$ids.($type ? '-'.$type : '').'/'.$name.'.jpg') : (_THEME_PROD_DIR_.$ids.($type ? '-'.$type : '').'.jpg');
		}
		if(floatval(substr(_PS_VERSION_,0,3)) < "1.4.3" && floatval(substr(_PS_VERSION_,0,3)) > "1.3.7" )
		{
			global $protocol_content;
		if ($object->allow == 1)
			$uri_path = __PS_BASE_URI__.$ids.($type ? '-'.$type : '').'/'.$name.'.jpg';
		else
			$uri_path = _THEME_PROD_DIR_.$ids.($type ? '-'.$type : '').'.jpg';
		return $protocol_content.Tools::getMediaServer($uri_path).$uri_path;
		
		}
		
		if(floatval(substr(_PS_VERSION_,0,3)) >= "1.4.3")
		{
		
	
		global $protocol_content;

		// legacy mode
		if (Configuration::get('PS_LEGACY_IMAGES') 
			&& (file_exists(_PS_PROD_IMG_DIR_.$ids.($type ? '-'.$type : '').'.jpg')))
		{
			if (@$object->allow == 1)
				$uri_path = __PS_BASE_URI__.$ids.($type ? '-'.$type : '').'/'.$name.'.jpg';
			else
				$uri_path = _THEME_PROD_DIR_.$ids.($type ? '-'.$type : '').'.jpg';
		}else
		{
			// if ids if of the form id_product-id_image, we want to extract the id_image part
			$split_ids = explode('-', $ids);
			$id_image = (isset($split_ids[1]) ? $split_ids[1] : $split_ids[0]);
			
			if (@$object->allow == 1)
				$uri_path = __PS_BASE_URI__.$id_image.($type ? '-'.$type : '').'/'.$name.'.jpg';
			else
				$uri_path = _THEME_PROD_DIR_.Image::getImgFolderStatic($id_image).$id_image.($type ? '-'.$type : '').'.jpg';
		}
		
		return $protocol_content.Tools::getMediaServer($uri_path).$uri_path;
	
	}
	}
	function install()
	{
		if (!Configuration::updateValue('STOCK_CHECK_NBR', 10) OR !parent::install())
			return false;
			if (!Configuration::updateValue('STOCK_CHECK_SKIP_CAT', 1))
			return false;
			if (!Configuration::updateValue('STOCK_CHECK_TITLE', '33'))
			return false;
			if (!Configuration::updateValue('STOCK_CHECK_LANGS', 1))
			return false;
			if (!Configuration::updateValue('STOCK_CHECK_NAME1', "Ref"))
			return false;
			if (!Configuration::updateValue('STOCK_CHECK_NAME2', "Name"))
			return false;
			if (!Configuration::updateValue('STOCK_CHECK_NAME3', "Price"))
			return false;
			if (!Configuration::updateValue('STOCK_CHECK_NAME4', "Quantity"))
			return false;
				if (!Configuration::updateValue('STOCK_CHECK_PPP', 10))
			return false;
			if (!Configuration::updateValue('STOCK_CHECK_NAME5', "Category"))
			return false;
			if (!Configuration::updateValue('STOCK_CHECK_PATH', "http://www.prestashop.com"))
			return false;
		
			if (!Configuration::updateValue('STOCK_CHECK_NAME6', "Image"))
			return false;
			if(_PS_VERSION_ < "1.5.0.0"){
			if (!Configuration::updateValue('STOCK_CHECK_TYPE', "home"))
			return false;
			}
			else
			{
				if (!Configuration::updateValue('STOCK_CHECK_TYPE', "home_default"))
			return false;
			}
			if (!Configuration::updateValue('STOCK_CHECK_O', "P"))
			return false;
			if (!Configuration::updateValue('STOCK_CHECK_FOOTER', 'Contact info'))
			return false;
			if (!Configuration::updateValue('STOCK_CHECK_SUBTITLE', 'Catalog of our store'))
			return false;
			if (!Configuration::updateValue('STOCK_CHECK_SORT', 'p.name'))
			return false;
			if (!Configuration::updateValue('STOCK_CHECK_W1', 15))
			return false;
			if (!Configuration::updateValue('STOCK_CHECK_W2', 90))
			return false;
			if (!Configuration::updateValue('STOCK_CHECK_W3', 30))
			return false;
			if (!Configuration::updateValue('STOCK_CHECK_W4', 20))
			return false;
			if (!Configuration::updateValue('STOCK_CHECK_W5', 'cccccc'))
			return false;
			if (!Configuration::updateValue('STOCK_CHECK_CODE', 'windows-1252'))
			return false;
			if (!Configuration::updateValue('STOCK_CHECK_SS', 'yes'))
			return false;
			if (!Configuration::updateValue('STOCK_CHECK_IMAGE1', '100'))
			return false;
			if (!Configuration::updateValue('STOCK_CHECK_IMAGE3', '50'))
			return false;
			if (!Configuration::updateValue('STOCK_CHECK_IMAGE4', '80'))
			return false;
			if (!Configuration::updateValue('STOCK_CHECK_FORMAT', 'productlist.php'))
			return false;
			
			if (!Configuration::updateValue('STOCK_CHECK_SP', 'yes'))
			return false;
				if (!Configuration::updateValue('STOCK_CHECK_CURRENCY', 1))
			return false;
if (!Configuration::updateValue('STOCK_CHECK_LIMAGE', array('1' => 'Image', '2' => 'Image', '3' => 'Imagen')))
return false;
if (!Configuration::updateValue('STOCK_CHECK_LREF', array('1' => 'Ref', '2' => 'Ref', '3' => 'Ref')))
return false;
if (!Configuration::updateValue('STOCK_CHECK_LNAME', array('1' => 'Name', '2' => 'Nom', '3' => 'Nombre')) AND Configuration::updateValue('STOCK_CHECK_LNAME', ''))
return false;
if (!Configuration::updateValue('STOCK_CHECK_LPRICE', array('1' => 'Price', '2' => 'Prix', '3' => 'Precio')) AND Configuration::updateValue('STOCK_CHECK_LPRICE', ''))
return false;
if (!Configuration::updateValue('STOCK_CHECK_LPRICETAX', array('1' => 'Price w/tax', '2' => 'Prix TTC', '3' => 'Precio con iva')) AND Configuration::updateValue('STOCK_CHECK_LPRICETAX', ''))
return false;
if (!Configuration::updateValue('STOCK_CHECK_LWPRICE', array('1' => 'Wholesale Price', '2' => 'Prix de gros', '3' => 'Precio mayorista')) AND Configuration::updateValue('STOCK_CHECK_LWPRICE', ''))
return false;
if (!Configuration::updateValue('STOCK_CHECK_LDESCRIPTION', array('1' => 'Description', '2' => 'Description', '3' => 'Descripción')) AND Configuration::updateValue('STOCK_CHECK_LDESCRIPTION', ''))
return false;
if (!Configuration::updateValue('STOCK_CHECK_LCATEGORY', array('1' => 'Caterory', '2' => 'Catégorie', '3' => 'Categoría')) AND Configuration::updateValue('STOCK_CHECK_LCATEGORY', ''))
return false;
if (!Configuration::updateValue('STOCK_CHECK_LMANUFACTURER', array('1' => 'Manufacturer', '2' => 'Fabricant', '3' => 'Fabricante')) AND Configuration::updateValue('STOCK_CHECK_LMANUFACTURER', ''))
return false;
if (!Configuration::updateValue('STOCK_CHECK_LFEATURES', array('1' => 'Features', '2' => 'Caractéristiques', '3' => 'Catacterísticas')) AND Configuration::updateValue('STOCK_CHECK_LFEATURES', ''))
return false;
if (!Configuration::updateValue('STOCK_CHECK_LSTOCK', array('1' => 'Stock', '2' => 'Stock', '3' => 'Stock')) AND Configuration::updateValue('STOCK_CHECK_LSTOCK', ''))
return false;
return true;
	}

	public function getContent()
	{
		global $cookie,$currentIndex,$limage2,$limage3,$limage4,$limage5,$limage1;
		$output = '<h2>'.$this->displayName.'</h2>';
			
		
		if (Tools::isSubmit('submitStockCheck'))
		{
	
			
			
			$nbr = intval(Tools::getValue('nbr'));
			$skipcat = Tools::getValue('skipcat');
			$sort = Tools::getValue('sort');
			$langs = intval(Tools::getValue('langs'));
			$title = Tools::getValue('title');
			$code = Tools::getValue('code');
			$o = Tools::getValue('o');
			$name1 = Tools::getValue('name1');
			$w1 = Tools::getValue('w1');
			$ss = Tools::getValue('ss');
			$sp = Tools::getValue('sp');
			$w2= Tools::getValue('w2');
			$w3 = Tools::getValue('w3');
			$type = Tools::getValue('type');
			$w4 = Tools::getValue('w4');
			$format = Tools::getValue('format');
			$ppp = Tools::getValue('ppp');
				$image1 = Tools::getValue('image1');
					$image3 = Tools::getValue('image3');
						$image4 = Tools::getValue('image4');
			$w5 = Tools::getValue('w5');
			$name2 = Tools::getValue('name2');
			$name3 = Tools::getValue('name3');
			$name4 = Tools::getValue('name4');
			$path = Tools::getValue('path');
			$name5 = Tools::getValue('name5');
			$name6 = Tools::getValue('name6');
			$subtitle = Tools::getValue('subtitle');
			$footer = Tools::getValue('footer');
			$currencya = Tools::getValue('currencya');
			if (!$nbr OR $nbr <= 0 OR !Validate::isInt($nbr))
				$errors[] = $this->l('Invalid number of products');
			else
				Configuration::updateValue('STOCK_CHECK_NBR', $nbr);
				Configuration::updateValue('STOCK_CHECK_SORT', $sort);
					Configuration::updateValue('STOCK_CHECK_FORMAT', $format);
				Configuration::updateValue('STOCK_CHECK_TITLE', $title);
				Configuration::updateValue('STOCK_CHECK_O', $o);
				Configuration::updateValue('STOCK_CHECK_NAME1', $name1);
				Configuration::updateValue('STOCK_CHECK_NAME2', $name2);
				Configuration::updateValue('STOCK_CHECK_IMAGE1', $image1);
						Configuration::updateValue('STOCK_CHECK_IMAGE3', $image3);
								Configuration::updateValue('STOCK_CHECK_IMAGE4', $image4);
				Configuration::updateValue('STOCK_CHECK_NAME3', $name3);
				Configuration::updateValue('STOCK_CHECK_NAME4', $name4);
				Configuration::updateValue('STOCK_CHECK_NAME5', $name5);
				Configuration::updateValue('STOCK_CHECK_NAME6', $name6);
				Configuration::updateValue('STOCK_CHECK_PATH', $path);
					Configuration::updateValue('STOCK_CHECK_TYPE', $type);
				Configuration::updateValue('STOCK_CHECK_W1', $w1);
					Configuration::updateValue('STOCK_CHECK_PPP', $ppp);
				Configuration::updateValue('STOCK_CHECK_CODE', $code);
				Configuration::updateValue('STOCK_CHECK_W2', $w2);
				Configuration::updateValue('STOCK_CHECK_SS', $ss);
				Configuration::updateValue('STOCK_CHECK_SP', $sp);
				Configuration::updateValue('STOCK_CHECK_W3', $w3);
				Configuration::updateValue('STOCK_CHECK_W4', $w4);
				Configuration::updateValue('STOCK_CHECK_W5', $w5);
				Configuration::updateValue('STOCK_CHECK_SUBTITLE', $subtitle);
				Configuration::updateValue('STOCK_CHECK_FOOTER', $footer);
				Configuration::updateValue('STOCK_CHECK_LANGS', $langs);
				Configuration::updateValue('STOCK_CHECK_CURRENCY', $currencya);
		if (!empty($skipcat))
				Configuration::updateValue('STOCK_CHECK_SKIP_CAT', implode(',',$skipcat));
				
if(ini_get("allow_url_fopen") == "0"){
ini_set("allow_url_fopen", "1");
}
	
	if(_PS_VERSION_ < "1.5.0.0"){
		$defaultLanguage = intval(Configuration::get('PS_LANG_DEFAULT'));
		$languages = Language::getLanguages();
			}
			else
			{
					$languages = Language::getLanguages(false);
			$defaultLanguage = (int)(Configuration::get('PS_LANG_DEFAULT'));
				}
				
		$result = array();
		foreach ($languages AS $language)
		$result[$language['id_lang']] = @$_POST['limage_'.$language['id_lang']];
	 	if (!Configuration::updateValue('STOCK_CHECK_LIMAGE', $result))
	 	return false;
			$result2 = array();
		foreach ($languages AS $language)
		$result2[$language['id_lang']] = @$_POST['lref_'.$language['id_lang']];
	 	if (!Configuration::updateValue('STOCK_CHECK_LREF', $result2))
	 	return false;
			$result3 = array();
		foreach ($languages AS $language)
		$result3[$language['id_lang']] = @$_POST['lname_'.$language['id_lang']];
	 	if (!Configuration::updateValue('STOCK_CHECK_LNAME', $result3))
	 	return false;
			$result4 = array();
		foreach ($languages AS $language)
		$result4[$language['id_lang']] = @$_POST['lprice_'.$language['id_lang']];
	 	if (!Configuration::updateValue('STOCK_CHECK_LPRICE', $result4))
	 	return false;
			$result5= array();
		foreach ($languages AS $language)
		$result5[$language['id_lang']] = @$_POST['lpricetax_'.$language['id_lang']];
	 	if (!Configuration::updateValue('STOCK_CHECK_LPRICETAX', $result5))
	 	return false;
			$result6= array();
		foreach ($languages AS $language)
		$result6[$language['id_lang']] = @$_POST['lwprice_'.$language['id_lang']];
	 	if (!Configuration::updateValue('STOCK_CHECK_LWPRICE', $result6))
	 	return false;
		
		
			
				
					$result10= array();
		foreach ($languages AS $language)
		$result10[$language['id_lang']] = @$_POST['lstock_'.$language['id_lang']];
	 	if (!Configuration::updateValue('STOCK_CHECK_LSTOCK', $result10))
	 	return false;
				$result11= array();
		foreach ($languages AS $language)
		$result11[$language['id_lang']] = @$_POST['ldescription_'.$language['id_lang']];
	 	if (!Configuration::updateValue('STOCK_CHECK_LDESCRIPTION', $result11))
	 	return false;
		
	 	
			if (isset($errors) AND sizeof($errors))
				$output .= $this->displayError(implode('<br />', $errors));
				
			else
				$output .= $this->displayConfirmation($this->l('Settings updated'));
		}
		global $cookie;


	   





		return $output.$this->displayForm();
	}
	function recurseCategory($categories, $current, $id_category = 1, $selectids_array)
	{
		global $currentIndex;		

if(str_repeat('&nbsp;', $current['infos']['level_depth'] * 5) . preg_replace('/^[0-9]+\./', '', stripslashes($current['infos']['name'])) != "Root"){
		if($id_category != NULL && $current['infos']['name'] != NULL)echo '<option value="'.$id_category.'"'.(in_array($id_category,$selectids_array) ? ' selected="selected"' : '').'>'.
		str_repeat('&nbsp;', $current['infos']['level_depth'] * 5) . preg_replace('/^[0-9]+\./', '', stripslashes($current['infos']['name'])) . '</option>';}
		if (isset($categories[$id_category]))
			foreach ($categories[$id_category] AS $key => $row)
				$this->recurseCategory($categories, $categories[$id_category][$key], $key, $selectids_array);
	
	}

	public function displayForm()
	{
		global $cookie,$currentIndex,$limage2,$limage3,$limage4,$limage5,$limage1;
		/* Language */
	if(_PS_VERSION_ < "1.5.0.0"){
		$defaultLanguage = intval(Configuration::get('PS_LANG_DEFAULT'));
		$languages = Language::getLanguages();
			}
			else
			{
					$languages = Language::getLanguages(false);
			$defaultLanguage = (int)(Configuration::get('PS_LANG_DEFAULT'));
				}
		$iso = Language::getIsoById($defaultLanguage);
		$divLangName = 'limage¤lref¤lprice¤lwprice¤lpricetax¤lname¤ldescription¤lcategory¤lstock¤lmanufacturer';
		/* Title */
		$output = '
		<script type="text/javascript">
			id_language = Number('.$defaultLanguage.');
		</script>
	
			<form method="post" action="'.$_SERVER['REQUEST_URI'].'">
		
		<fieldset>
			
				<label>'.$this->l('Image:').'</label>
				 <div class="margin-form">';
				foreach ($languages as $language)
				{
					$output.= '
					<div id="limage_'.$language['id_lang'].'" style="display: '.($language['id_lang'] == $defaultLanguage ? 'block' : 'none').';float: left;">
					<input type="text"  name="limage_'.$language['id_lang'].'" size="70" value="'.Configuration::get('STOCK_CHECK_LIMAGE', $language['id_lang']).'" />
					</div>';
				 }
				$output.= $this->displayFlags($languages, $defaultLanguage, $divLangName, 'limage', true);

       $output.= '</div><p class="clear"> </p>
	   	<label>'.$this->l('Ref:').'</label>
				 <div class="margin-form">';
				foreach ($languages as $language)
				{
					$output.= '
					<div id="lref_'.$language['id_lang'].'" style="display: '.($language['id_lang'] == $defaultLanguage ? 'block' : 'none').';float: left;">
					<input type="text" id="lref['.$language['id_lang'].']" name="lref_'.$language['id_lang'].'" size="70" value="'.Configuration::get('STOCK_CHECK_LREF', $language['id_lang']).'" />
					</div>';
				 }
				$output.= $this->displayFlags($languages, $defaultLanguage, $divLangName, 'lref', true);

       $output.= '</div><p class="clear"> </p>
	   	   	<label>'.$this->l('Price:').'</label>
				 <div class="margin-form">';
				foreach ($languages as $language)
				{
					$output.= '
					<div id="lprice_'.$language['id_lang'].'" style="display: '.($language['id_lang'] == $defaultLanguage ? 'block' : 'none').';float: left;">
					<input type="text"  name="lprice_'.$language['id_lang'].'" size="70" value="'.Configuration::get('STOCK_CHECK_LPRICE', $language['id_lang']).'" />
					</div>';
				 }
				$output.= $this->displayFlags($languages, $defaultLanguage, $divLangName, 'lprice', true);

       $output.= '</div><p class="clear"> </p>
	   <label>'.$this->l('Wholesale price:').'</label>
				 <div class="margin-form">';
				foreach ($languages as $language)
				{
					$output.= '
					<div id="lwprice_'.$language['id_lang'].'" style="display: '.($language['id_lang'] == $defaultLanguage ? 'block' : 'none').';float: left;">
					<input type="text"  name="lwprice_'.$language['id_lang'].'" size="70" value="'.Configuration::get('STOCK_CHECK_LWPRICE', $language['id_lang']).'" />
					</div>';
				 }
				$output.= $this->displayFlags($languages, $defaultLanguage, $divLangName, 'lwprice', true);

       $output.= '</div><p class="clear"> </p>
	    <label>'.$this->l('Price With tax:').'</label>
				 <div class="margin-form">';
				foreach ($languages as $language)
				{
					$output.= '
					<div id="lpricetax_'.$language['id_lang'].'" style="display: '.($language['id_lang'] == $defaultLanguage ? 'block' : 'none').';float: left;">
					<input type="text"  name="lpricetax_'.$language['id_lang'].'" size="70" value="'.Configuration::get('STOCK_CHECK_LPRICETAX', $language['id_lang']).'" />
					</div>';
				 }
				$output.= $this->displayFlags($languages, $defaultLanguage, $divLangName, 'lpricetax', true);

       $output.= '</div><p class="clear"> </p>
	       <label>'.$this->l('Name:').'</label>
				 <div class="margin-form">';
				foreach ($languages as $language)
				{
					$output.= '
					<div id="lname_'.$language['id_lang'].'" style="display: '.($language['id_lang'] == $defaultLanguage ? 'block' : 'none').';float: left;">
					<input type="text"  name="lname_'.$language['id_lang'].'" size="70" value="'.Configuration::get('STOCK_CHECK_LNAME', $language['id_lang']).'" />
					</div>';
				 }
				$output.= $this->displayFlags($languages, $defaultLanguage, $divLangName, 'lname', true);

       $output.= '</div><p class="clear"> </p>
	        <label>'.$this->l('Description:').'</label>
				 <div class="margin-form">';
				foreach ($languages as $language)
				{
					$output.= '
					<div id="ldescription_'.$language['id_lang'].'" style="display: '.($language['id_lang'] == $defaultLanguage ? 'block' : 'none').';float: left;">
					<input type="text"  name="ldescription_'.$language['id_lang'].'" size="70" value="'.Configuration::get('STOCK_CHECK_LDESCRIPTION', $language['id_lang']).'" />
					</div>';
				 }
				$output.= $this->displayFlags($languages, $defaultLanguage, $divLangName, 'ldescription', true);

       $output.= '</div><p class="clear"> </p>
	   	   
	   	   	        <label>'.$this->l('Stock:').'</label>
				 <div class="margin-form">';
				foreach ($languages as $language)
				{
					$output.= '
					<div id="lstock_'.$language['id_lang'].'" style="display: '.($language['id_lang'] == $defaultLanguage ? 'block' : 'none').';float: left;">
					<input type="text"  name="lstock_'.$language['id_lang'].'" size="70" value="'.Configuration::get('STOCK_CHECK_LSTOCK', $language['id_lang']).'" />
					</div>';
				 }
				$output.= $this->displayFlags($languages, $defaultLanguage, $divLangName, 'lstock', true);

       $output.= '</div><p class="clear"> </p>
	   	   	   	    
	
			
			</div>
	 
	
			
		</fieldset>	
			
	
			<fieldset><legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->l('Settings').'</legend>
				<label>'.$this->l('Number of product to export').'</label>
				<div class="margin-form">
					<input type="text" size="5" name="nbr" value="'.Tools::getValue('nbr', Configuration::get('STOCK_CHECK_NBR')).'" />
					<p class="clear">'.$this->l('Number of products to export (default: 10)').'</p>
					
				
		</div>
		
		<label>'.$this->l('Export products that quantity is less or equal than:').'</label>
				<div class="margin-form">
					<input type="text" size="5" name="title" value="'.Tools::getValue('title', Configuration::get('STOCK_CHECK_TITLE')).'" />
						<p class="clear">'.$this->l('Default 3').'</p>
</div>
		
		
		<label>'.$this->l('Language ID to export').'</label>
				<div class="margin-form">
					<input type="text" size="5" name="langs" value="'.Tools::getValue('langs', Configuration::get('STOCK_CHECK_LANGS')).'" />
					<p class="clear">'.$this->l('Id of the language to export (default: 1)').'</p>
					
				
		</div>
		<label>'.$this->l('Currency ID').'</label>
				<div class="margin-form">
					<input type="text" size="5" name="currencya" value="'.Tools::getValue('currencya', Configuration::get('STOCK_CHECK_CURRENCY')).'" />
					<p class="clear">'.$this->l('Set the currency ID').'</p>
					
				
		</div>
		
				
				';
		$skipcat = Configuration::get('STOCK_CHECK_SKIP_CAT');
		
		if (!empty($skipcat))
		{
			$skipcat_array = explode(',',$skipcat);
		}
		else
		{
			$skipcat_array = array();
		}
		
		
		$output .= '
				  <label>'.$this->l('Shop categories to include').'</label>
				  <div class="margin-form">
						<select name="skipcat[]" multiple="multiple">';
		@$categories = Category::getCategories(intval($cookie->id_lang));
		ob_start();
	
		@$this->recurseCategory($categories, $categories[0][1], 1, $skipcat_array);
		$output .= ob_get_contents();
		ob_end_clean();
		$output .= '
					    </select>
							
						<p class="clear">'.$this->l('Select the categories you want to include(ctrl+clic)').'</p>									
				   </div>
				   <label>'.$this->l('Choice of sort').'</label>
				<div class="margin-form">
					<select name="sort" >
						<option value="p.id_product" '.(Configuration::get('STOCK_CHECK_SORT') == 'p.id_product' ? 'selected' : '').'>'.$this->l('No Sort - Sort by Back Office => Catalogue -> Position').'</option>
						<option value="p.reference" '.(Configuration::get('STOCK_CHECK_SORT') == 'p.reference' ? 'selected' : '').'>'.$this->l('Ref').'</option>
						<option value="p.price" '.(Configuration::get('STOCK_CHECK_SORT') == 'p.price' ? 'selected' : '').'>'.$this->l('Price').'</option>
						<option value="p.date_add" '.(Configuration::get('STOCK_CHECK_SORT') == 'p.date_add' ? 'selected' : '').'>'.$this->l('Date').'</option>
						<option value="pl.name" '.(Configuration::get('STOCK_CHECK_SORT') == 'pl.name' ? 'selected' : '').'>'.$this->l('Alphabetical').'</option>
							<option value="p.quantity" '.(Configuration::get('STOCK_CHECK_SORT') == 'p.quantity' ? 'selected' : '').'>'.$this->l('Stock').'</option>
					</select>
				</div>
				
			   
			   
			    
			   
			   
			   
			  
			 
			   
			   <label>'.$this->l('Image size').'</label>
			   	<div class="margin-form">
					<input type="text" size="40" name="image1" value="'.Tools::getValue('image1', Configuration::get('STOCK_CHECK_IMAGE1')).'" />
					<p class="clear">'.$this->l('Default: 10').'</p>
		       </div>	
			   	
				  
			  
			   
			   	<label>'.$this->l('Type of image').'</label>
				<div class="margin-form">
								    <select name="type" >
     
     <option value="home"'.((Configuration::get('STOCK_CHECK_TYPE') == "home") ? 'selected="selected"' : '').'>home</option>
	 <option value="small"'.((Configuration::get('STOCK_CHECK_TYPE') == "small") ? 'selected="selected"' : '').'>small</option>
	 <option value="medium"'.((Configuration::get('STOCK_CHECK_TYPE') == "medium") ? 'selected="selected"' : '').'>medium</option>
	 <option value="large"'.((Configuration::get('STOCK_CHECK_TYPE') == "large") ? 'selected="selected"' : '').'>large</option>
	 <option value="thickbox"'.((Configuration::get('STOCK_CHECK_TYPE') == "thickbox") ? 'selected="selected"' : '').'>thickbox</option>
	 
	      <option value="home_default"'.((Configuration::get('STOCK_CHECK_TYPE') == "home_default") ? 'selected="selected"' : '').'>home_default</option>
	 <option value="small_default"'.((Configuration::get('STOCK_CHECK_TYPE') == "small_default") ? 'selected="selected"' : '').'>small_default</option>
	 <option value="medium_default"'.((Configuration::get('STOCK_CHECK_TYPE') == "medium_default") ? 'selected="selected"' : '').'>medium_default</option>
	 <option value="large_default"'.((Configuration::get('STOCK_CHECK_TYPE') == "large_default") ? 'selected="selected"' : '').'>large_default</option>
	 <option value="thickbox_default"'.((Configuration::get('STOCK_CHECK_TYPE') == "thickbox_default") ? 'selected="selected"' : '').'>thickbox_default</option>
    </select>
				
					
				
		</div>
			   
			  
			   
			   
			   
			   <div>
			
			<b style="color:red">'.$this->l('Clic to view').'</b>
			<br /><br />
			
		<legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->l('Settings').'</legend><br>
		
			
		<table width="200" border="1">
  <tr>
    <td><a href="../modules/stockcheck/productlist.php" target="_blank"><img src="'.$this->_path.'1.jpg" alt="'.$this->l('View ').'" width="100" title="'.$this->l('View').'" /></a></td>
   
</table>
		<br/>
	
				<center><input type="submit" name="submitStockCheck" value="'.$this->l('Save').'" class="button" /></center><br/>
				<center><a href="../modules/stockcheck/moduleinstall.pdf">README</a></center><br/>
				<center><a href="../modules/stockcheck/termsandconditions.pdf">TERMS</a></center><br/>
				
			
			</fieldset>		
							
		</form>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<fieldset><legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->l('Contribute').'</legend>
				<p class="clear">'.$this->l('You can contribute with a donation if our free modules and themes are usefull for you. Clic on the link and support us!').'</p>
				<p class="clear">'.$this->l('For more modules & themes visit: www.catalogo-onlinersi.com.ar').'</p>
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="HMBZNQAHN9UMJ">
<input type="image" src="https://www.paypalobjects.com/WEBSCR-640-20110401-1/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/WEBSCR-640-20110401-1/en_US/i/scr/pixel.gif" width="1" height="1">
	</fieldset>
</form>
		';
		

		return $output;
		
		
		
	}

public function getProductscat($idcat, $id_lang, $p, $n, $orderBy = NULL, $orderWay = NULL)
	{
		global $cookie;

		if (empty($idcat))
		{
			return false;
		}

		if ($p < 1) $p = 1;
		if (empty($orderBy))
			$orderBy = 'position';
		if (empty($orderWay))
			$orderWay = 'ASC';
		if ($orderBy == 'id_product' OR	$orderBy == 'price' OR	$orderBy == 'date_add')
			$orderByPrefix = 'p';
		elseif ($orderBy == 'name')
			$orderByPrefix = 'pl';
		elseif ($orderBy == 'manufacturer')
		{
			$orderByPrefix = 'm';
			$orderBy = 'name';
		}
		elseif ($orderBy == 'position')
			$orderByPrefix = 'cp';

		$sql = '
		SELECT p.*, pa.`id_product_attribute`, pl.`description`, pl.`description_short`, pl.`available_now`, pl.`available_later`, pl.`link_rewrite`, pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`, pl.`name`, i.`id_image`, il.`legend`, m.`name` AS manufacturer_name, tl.`name` AS tax_name, t.`rate`, cl.`name` AS category_default, DATEDIFF(p.`date_add`, DATE_SUB(NOW(), INTERVAL '.(Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).' DAY)) > 0 AS new
		            
		FROM `'._DB_PREFIX_.'category_product` cp
		LEFT JOIN `'._DB_PREFIX_.'product` p ON p.`id_product` = cp.`id_product`
		LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa ON (p.`id_product` = pa.`id_product` AND default_on = 1)
		LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (p.`id_category_default` = cl.`id_category` AND cl.`id_lang` = '.Configuration::get('STOCK_CHECK_LANGS').')
		LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (p.`id_product` = pl.`id_product` AND pl.`id_lang` = '.Configuration::get('STOCK_CHECK_LANGS').')
		LEFT JOIN `'._DB_PREFIX_.'image` i ON (i.`id_product` = p.`id_product` AND i.`cover` = 1)
		LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = '.Configuration::get('STOCK_CHECK_LANGS').')
		LEFT JOIN `'._DB_PREFIX_.'tax` t ON (t.`id_tax` = p.`id_tax`)
		LEFT JOIN `'._DB_PREFIX_.'tax_lang` tl ON (t.`id_tax` = tl.`id_tax` AND tl.`id_lang` = '.Configuration::get('STOCK_CHECK_LANGS').')
		LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON (m.`id_manufacturer` = p.`id_manufacturer`)
	WHERE cp.`id_category` IN ('.$skipcat.') AND p.`active` = 1 AND p.quantity < '.$title.' LIMIT '.$nb.'
		GROUP BY cp.`id_product`
		ORDER BY '.(isset($orderByPrefix) ? $orderByPrefix.'.' : '').'`'.pSQL($orderBy).'` '.pSQL($orderWay).'
		LIMIT '.((intval($p) - 1) * intval($n)).','.intval($n);
		
		$result = Db::getInstance()->ExecuteS($sql);
		
		if ($orderBy == 'price')
			Tools::orderbyPrice($result, $orderWay);
		if (!$result)
			return false;

		/* Modify SQL result */
		return Product::getProductsProperties($id_lang, $result);
	}

	
	public function getL($key)
	{
		$translations = array(
			'Image' => $this->l('Image'),
			'Ref' => $this->l('Ref'),
			'Name' => $this->l('Name'),
			'Description' => $this->l('Description'),
			'Category' => $this->l('Category'),
			'Wholesale rice' => $this->l('Wholesale rice'),
			'Retail price' => $this->l('Retail price'),
			'Price with tax' => $this->l('Price with tax'),
			'Stock' => $this->l('Stock'),
			'Features' => $this->l('Features'),
			'Manufacturer' => $this->l('Manufacturer'),
			'Atributes' => $this->l('Atributes')
			
		);
		return $translations[$key];
	}
	

	

}


?>