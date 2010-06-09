<?php
/* -----------------------------------------------------------------------------------------
   $Id: popup_image.php,v 1.9 2004/07/23 14:01:00 Novalis Exp $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2004 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(popup_image.php,v 1.12 2001/12/12); www.oscommerce.com 

   Released under the GNU General Public License 
   -----------------------------------------------------------------------------------------
   Third Party contributions:
   Modified by BIA Solutions (www.biasolutions.com) to create a bordered look to the image

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/

  require('includes/application_top.php');
  require_once(DIR_FS_INC . 'xtc_get_products_mo_images.inc.php');
  
  if ((int)$_GET['imgID'] == 0) {
  	$products_query = xtc_db_query("select pd.products_name, p.products_image from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id where p.products_status = '1' and p.products_id = '" . (int)$_GET['pID'] . "' and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'");
  	$products_values = xtc_db_fetch_array($products_query);
  } else {
  	$products_query = xtc_db_query("select pd.products_name, p.products_image, pi.image_name from " . TABLE_PRODUCTS_IMAGES . " pi, " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id where p.products_status = '1' and p.products_id = '" . (int)$_GET['pID'] . "' and pi.products_id = '" . (int)$_GET['pID'] . "' and pi.image_nr = '" . (int)$_GET['imgID'] . "' and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'");
  	$products_values = xtc_db_fetch_array($products_query);
  	$products_values['products_image'] = $products_values['image_name'];
  }

// get x and y of the image
$img = DIR_WS_POPUP_IMAGES.$products_values['products_image'];
$size = GetImageSize("$img");

//get data for mo_images
$mo_images = xtc_get_products_mo_images((int)$_GET['pID']);
$img = DIR_WS_THUMBNAIL_IMAGES.$products_values['products_image'];
$osize = GetImageSize("$img");
if (isset($mo_images)){	
	//$bwidth = $osize[0];
	$bheight = $osize[1];
	foreach ($mo_images as $mo_img){		  
		$img = DIR_WS_THUMBNAIL_IMAGES.$mo_img['image_name'];
		$mo_size = GetImageSize("$img");
		// if ($mo_size[0] > $bwidth)  $bwidth  = $mo_size[0];
		if ($mo_size[1] > $bheight) $bheight = $mo_size[1];		
	}
	$bheight += 50;
}

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<title><?php echo $products_values['products_name']; ?></title>
<base href="<?php echo (getenv('HTTPS') == 'on' ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo 'templates/'.CURRENT_TEMPLATE.'/stylesheet.css'; ?>">
<script language="javascript"><!--
var i=0;
function resize() {
  if (navigator.appName == 'Netscape') i=40;
  window.resizeTo(<? echo $size[0] ?> +105, <? echo $size[1] + $bheight ?>+125-i);
   self.focus();
}

//--></script>
</head>
<body onload="resize();" >


<!-- xtc_image($src, $alt = '', $width = '', $height = '', $params = '') -->
    
<!-- big image -->
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td bgcolor="283758"><div align="center"><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong><?php echo $products_values['products_name']; ?></strong></font></div></td>
  </tr>
  <tr>
    <td>
    <table border=0 align="center" cellpadding=5 cellspacing=0>
      <tr>
        <td align=center><?  echo xtc_image(DIR_WS_POPUP_IMAGES . $products_values['products_image'], $products_values['products_name'], $size[0], $size[1]); ?></td>
      </tr>
    </table>
</table>

<!-- thumbs -->
<center>
<?
if (isset($mo_images))
{		
?>
<iframe src="<? echo 'show_product_thumbs.php?pID='.(int)$_GET['pID'].'&imgID='.(int)$_GET['imgID']; ?>" width="<? echo $size[0] +40 ?>" height="<? echo $bheight+5; ?>" border="0" frameborder="0">
<a href="<? echo 'show_product_thumbs.php?pID='.(int)$_GET['pID'].'&imgID='.(int)$_GET['imgID']; ?>">More Images</a>
</iframe><br>
<?
}
?>
<a href="#" onClick='window.close();'><?php echo TEXT_CLOSE_WINDOW ?></a>
</body>
</html>