<?php
/* -----------------------------------------------------------------------------------------
   $Id: content_preview.php 4 2006-11-28 14:38:03Z mzanier $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on:
   (c) 2003	 nextcommerce (content_preview.php,v 1.2 2003/08/25); www.nextcommerce.org
   
   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/
   
require('includes/application_top.php');


if ($_GET['pID']=='media') {
	$content_query=xtc_db_query("SELECT
 					content_file,
 					content_name,
 					file_comment
 					FROM ".TABLE_PRODUCTS_CONTENT."
 					WHERE content_id='".(int)$_GET['coID']."'");
 	$content_data=xtc_db_fetch_array($content_query);
	
} else {
	 $content_query=xtc_db_query("SELECT
 					content_title,
 					content_heading,
 					content_text,
 					content_file
 					FROM ".TABLE_CONTENT_MANAGER."
 					WHERE content_id='".(int)$_GET['coID']."'");
 	$content_data=xtc_db_fetch_array($content_query);
 }
?>

<html <?php echo HTML_PARAMS; ?>>
<head>
<title><?php echo $page_title; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
</head>
<div class="pageHeading"><?php echo $content_data['content_heading']; ?></div><br>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main">
 <?php
 if ($content_data['content_file']!=''){
if (strpos($content_data['content_file'],'.txt')) echo '<pre>';
if ($_GET['pID']=='media') {
	// display image
	if (eregi('.gif',$content_data['content_file']) or eregi('.jpg',$content_data['content_file']) or  eregi('.png',$content_data['content_file']) or  eregi('.tif',$content_data['content_file']) or  eregi('.bmp',$content_data['content_file'])) {	
	echo xtc_image(DIR_WS_CATALOG.'media/products/'.$content_data['content_file']);
	} else {
	include(DIR_FS_CATALOG.'media/products/'.$content_data['content_file']);	
	}
} else {
include(DIR_FS_CATALOG.'media/content/'.$content_data['content_file']);	
}
if (strpos($content_data['content_file'],'.txt')) echo '</pre>';
 } else {	      
echo $content_data['content_text'];
}
?>
</td>
          </tr>
        </table>
</body>
</html>