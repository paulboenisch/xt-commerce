<?php

/* -----------------------------------------------------------------------------------------
   $Id: print_order.php 300 2007-03-30 07:07:54Z mzanier $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on:
   (c) 2003	 nextcommerce (print_order.php,v 1.5 2003/08/24); www.nextcommerce.org
   
   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/

include ('includes/application_top.php');

// include needed functions
require_once (DIR_FS_INC.'xtc_get_order_data.inc.php');
require_once (DIR_FS_INC.'xtc_get_attributes_model.inc.php');


$smarty = new Smarty;

// check if custmer is allowed to see this order!
$order_query_check = xtc_db_query("SELECT
  					customers_id
  					FROM ".TABLE_ORDERS."
  					WHERE orders_id='".(int) $_GET['oID']."'");
$oID = (int) $_GET['oID'];
$order_check = xtc_db_fetch_array($order_query_check);
if ($_SESSION['customer_id'] == $order_check['customers_id']) {
	// get order data

	include (DIR_WS_CLASSES.'order.php');
	$order = new order($oID);
	$smarty->assign('address_label_customer', xtc_address_format($order->customer['format_id'], $order->customer, 1, '', '<br />'));
	$smarty->assign('address_label_shipping', xtc_address_format($order->delivery['format_id'], $order->delivery, 1, '', '<br />'));
	$smarty->assign('address_label_payment', xtc_address_format($order->billing['format_id'], $order->billing, 1, '', '<br />'));
	$smarty->assign('csID', $order->customer['csID']);
	// get products data
	$order_total = $order->getTotalData($oID); 
	$smarty->assign('order_data', $order->getOrderData($oID));
	$smarty->assign('order_total', $order_total['data']);

	// assign language to template for caching
	$smarty->assign('language', $_SESSION['language']);
	$smarty->assign('oID', (int) $_GET['oID']);
	if ($order->info['payment_method'] != '' && $order->info['payment_method'] != 'no_payment') {
		include (DIR_WS_LANGUAGES.$_SESSION['language'].'/modules/payment/'.$order->info['payment_method'].'.php');
		$payment_method = constant(strtoupper('MODULE_PAYMENT_'.$order->info['payment_method'].'_TEXT_TITLE'));
	}
	$smarty->assign('PAYMENT_METHOD', $payment_method);
	$smarty->assign('COMMENT', $order->info['comments']);
	$smarty->assign('DATE', xtc_date_long($order->info['date_purchased']));
	$path = DIR_WS_CATALOG.'templates/'.CURRENT_TEMPLATE.'/';
	$smarty->assign('tpl_path', $path);
	$smarty->assign('charset',$_SESSION['language_charset']);

	// dont allow cache
	$smarty->caching = false;

	$smarty->display(CURRENT_TEMPLATE.'/module/print_order.html');
} else {

	$smarty->assign('ERROR', 'You are not allowed to view this order!');
	$smarty->display(CURRENT_TEMPLATE.'/module/error_message.html');
}
?>