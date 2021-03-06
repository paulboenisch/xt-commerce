<?php

/* -----------------------------------------------------------------------------------------
   $Id: products_new.php 256 2007-03-09 09:08:19Z mzanier $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce 
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(products_new.php,v 1.25 2003/05/27); www.oscommerce.com 
   (c) 2003	 nextcommerce (products_new.php,v 1.16 2003/08/18); www.nextcommerce.org

   Released under the GNU General Public License 
   -----------------------------------------------------------------------------------------
   Third Party contributions:
   Enable_Disable_Categories 1.3        	Autor: Mikel Williams | mikel@ladykatcostumes.com

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/

include ('includes/application_top.php');
// create smarty elements
$module_smarty = new Smarty;
$smarty = new Smarty;
$smarty->assign('language', $_SESSION['language']);
// include boxes
require (DIR_FS_CATALOG . 'templates/' . CURRENT_TEMPLATE . '/source/boxes.php');
// include needed function

require_once (DIR_FS_INC . 'xtc_date_long.inc.php');
require_once (DIR_FS_INC . 'xtc_get_vpe_name.inc.php');

$breadcrumb->add(NAVBAR_TITLE_PRODUCTS_NEW, xtc_href_link(FILENAME_PRODUCTS_NEW));

require (DIR_WS_INCLUDES . 'header.php');

$rebuild = false;

$module_smarty->assign('language', $_SESSION['language']);
// set cache ID
if (!CacheCheck()) {
	$cache = false;
	$module_smarty->caching = 0;
} else {
	$cache = true;
	$module_smarty->caching = 1;
	$module_smarty->cache_lifetime = CACHE_LIFETIME;
	$module_smarty->cache_modified_check = CACHE_CHECK;
	$cache_id = $_SESSION['language'] . $_SESSION['customers_status']['customers_status_id'] . $_SESSION['currency'] . $_GET['page'];
}

if (!$module_smarty->is_cached(CURRENT_TEMPLATE . '/module/new_products_overview.html', $cache_id) || !$cache) {
	$module_smarty->assign('tpl_path', 'templates/' . CURRENT_TEMPLATE . '/');
	$rebuild = true;

	$products_new_array = array ();
	$fsk_lock = '';
	if ($_SESSION['customers_status']['customers_fsk18_display'] == '0') {
		$fsk_lock = ' and p.products_fsk18!=1';
	}
	if (GROUP_CHECK == 'true') {
		$group_check = " and p.group_permission_" . $_SESSION['customers_status']['customers_status_id'] . "=1 ";
	}
	if (MAX_DISPLAY_NEW_PRODUCTS_DAYS != '0') {
		$date_new_products = date("Y.m.d", mktime(1, 1, 1, date(m), date(d) - MAX_DISPLAY_NEW_PRODUCTS_DAYS, date(Y)));
		$days = " and p.products_date_added > '" . $date_new_products . "' ";
	}
	$products_new_query_raw = "select distinct
	                                    p.products_id,
	                                    p.products_fsk18,
	                                    pd.products_name,
	                                    pd.products_short_description,
	                                    p.products_image,
	                                    p.products_price,
	                               	    p.products_vpe,
	                               	    p.products_quantity,
	                                    p.products_average_stock,
	                               	    p.products_vpe_status,
	                                    p.products_vpe_value,                                                          
	                                    p.products_tax_class_id,
	                                    p.products_date_added,
	                                    m.manufacturers_name
	                                    from " . TABLE_PRODUCTS . " p
	                                    left join " . TABLE_MANUFACTURERS . " m
	                                    on p.manufacturers_id = m.manufacturers_id
	                                    left join " . TABLE_PRODUCTS_DESCRIPTION . " pd
	                                    on p.products_id = pd.products_id,
	                                    " . TABLE_CATEGORIES . " c,
	                                    " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c 
	                                    WHERE pd.language_id = '" . (int) $_SESSION['languages_id'] . "'
	                                    and c.categories_status=1
	                                    and p.products_id = p2c.products_id
	                                    and c.categories_id = p2c.categories_id
	                                    and products_status = '1'
	                                    " . $group_check . "
	                                    " . $fsk_lock . "                                    
	                                    " . $days . "
	                                    order
	                                    by
	                                    p.products_date_added DESC ";

	$products_new_split = new splitPageResults($products_new_query_raw, $_GET['page'], MAX_DISPLAY_PRODUCTS_NEW, 'p.products_id');

	if (($products_new_split->number_of_rows > 0)) {
		$smarty->assign('NAVIGATION_BAR', '
				   <table border="0" width="100%" cellspacing="0" cellpadding="2">
				          <tr>
				            <td class="smallText">' . $products_new_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW) . '</td>
				            <td align="right" class="smallText">' . TEXT_RESULT_PAGE . ' ' . $products_new_split->display_links(MAX_DISPLAY_PAGE_LINKS, xtc_get_all_get_params(array (
			'page',
			'info',
			'x',
			'y'
		))) . '</td>
				          </tr>
				        </table>
				
				   ');

	}

	$module_content = '';
	if ($products_new_split->number_of_rows > 0) {
		$products_new = xtc_db_query($products_new_split->sql_query);
		while ($products_data = xtc_db_fetch_array($products_new)) {
			$module_content[] = $product->buildDataArray($products_data);

		}
	} else {
		$module_smarty->assign('ERROR', TEXT_NO_NEW_PRODUCTS);
	}

}

if (!$cache || $rebuild) {
	if (count($module_content) > 0) {
		$module_smarty->assign('module_content', $module_content);
		if ($rebuild)
			$module_smarty->clear_cache(CURRENT_TEMPLATE . '/module/new_products_overview.html', $cache_id);
		$main_content = $module_smarty->fetch(CURRENT_TEMPLATE . '/module/new_products_overview.html', $cache_id);
	}
} else {
	$main_content = $module_smarty->fetch(CURRENT_TEMPLATE . '/module/new_products_overview.html', $cache_id);
}

$smarty->assign('main_content', $main_content);

$smarty->caching = 0;
if (!defined(RM))
	$smarty->load_filter('output', 'note');
$smarty->display(CURRENT_TEMPLATE . '/index.html');
include ('includes/application_bottom.php');
?>