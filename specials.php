<?php
/* -----------------------------------------------------------------------------------------
   $Id: specials.php,v 1.9 2004/03/16 15:01:16 fanta2k Exp $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(specials.php,v 1.47 2003/05/27); www.oscommerce.com 
   (c) 2003	 nextcommerce (specials.php,v 1.12 2003/08/17); www.nextcommerce.org

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/

  include( 'includes/application_top.php');
    $smarty = new Smarty;
  // include boxes
  require(DIR_FS_CATALOG .'templates/'.CURRENT_TEMPLATE. '/source/boxes.php'); 

  require_once(DIR_FS_INC . 'xtc_get_short_description.inc.php');

  $breadcrumb->add(NAVBAR_TITLE_SPECIALS, xtc_href_link(FILENAME_SPECIALS));

 require(DIR_WS_INCLUDES . 'header.php');

      //fsk18 lock
  $fsk_lock='';
  if ($_SESSION['customers_status']['customers_fsk18_display']=='0') {
  $fsk_lock=' and p.products_fsk18!=1';
  }
    if (GROUP_CHECK=='true') {
   $group_check="and p.group_ids LIKE '%c_".$_SESSION['customers_status']['customers_status_id']."_group%'";
  }
  $specials_query_raw = "select p.products_id,
                                pd.products_name,
                                p.products_price,
                                p.products_tax_class_id,
                                p.products_image,
                                s.specials_new_products_price from " .
                                TABLE_PRODUCTS . " p, " .
                                TABLE_PRODUCTS_DESCRIPTION . " pd, " .
                                TABLE_SPECIALS . " s
                                where p.products_status = '1'
                                and s.products_id = p.products_id ".$fsk_lock."
                                and p.products_id = pd.products_id
                                ".$group_check."
                                and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                                and s.status = '1' order by s.specials_date_added DESC";
  $specials_split = new splitPageResults($specials_query_raw, $_GET['page'], MAX_DISPLAY_SPECIAL_PRODUCTS);



$module_content='';
    $row = 0;
    $specials_query = xtc_db_query($specials_split->sql_query);
    while ($specials = xtc_db_fetch_array($specials_query)) {
      $row++;
      $products_price = $xtPrice->xtcGetPrice($specials['products_id'],$format=true,1,$specials['products_tax_class_id'],$specials['products_price']);
      $image='';
      if ($specials['products_image']!='') {
      $image=DIR_WS_THUMBNAIL_IMAGES . $specials['products_image'];
      }
      $module_content[]=array(
                            'PRODUCTS_ID' => $specials['products_id'],
                            'PRODUCTS_NAME' => $specials['products_name'],
                            'PRODUCTS_PRICE' => $products_price,
                            'PRODUCTS_LINK' => xtc_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $specials['products_id']),
                            'PRODUCTS_IMAGE'=> $image,
                            'PRODUCTS_SHORT_DESCRIPTION' => xtc_get_short_description($new_products['products_id']));

    }

if (($specials_split->number_of_rows > 0)) {
$smarty->assign('NAVBAR','
<table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText">'.$specials_split->display_count(TEXT_DISPLAY_NUMBER_OF_SPECIALS).'</td>
            <td align="right" class="smallText">'.TEXT_RESULT_PAGE . ' ' . $specials_split->display_links(MAX_DISPLAY_PAGE_LINKS, xtc_get_all_get_params(array('page', 'info', 'x', 'y'))).'</td>
          </tr>
        </table>

');
}


  $smarty->assign('language', $_SESSION['language']);
  $smarty->assign('module_content',$module_content);
  $smarty->caching = 0;
  $main_content= $smarty->fetch(CURRENT_TEMPLATE.'/module/specials.html');


  $smarty->assign('language', $_SESSION['language']);
  $smarty->assign('main_content',$main_content);
  $smarty->caching = 0;
  if (!defined(RM)) $smarty->load_filter('output', 'note');
  $smarty->display(CURRENT_TEMPLATE . '/index.html');
  ?>