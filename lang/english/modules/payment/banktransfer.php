<?php
/* -----------------------------------------------------------------------------------------
   $Id: banktransfer.php 192 2007-02-24 16:24:52Z mzanier $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(banktransfer.php,v 1.9 2003/02/18 19:22:15); www.oscommerce.com 
   (c) 2003	 nextcommerce (banktransfer.php,v 1.5 2003/08/13); www.nextcommerce.org

   Released under the GNU General Public License 
   -----------------------------------------------------------------------------------------
   Third Party contributions:
   OSC German Banktransfer v0.85a       	Autor:	Dominik Guder <osc@guder.org>
   
   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/
  define('MODULE_PAYMENT_TYPE_PERMISSION', 'bt');

  define('MODULE_PAYMENT_BANKTRANSFER_TEXT_TITLE', 'Banktransfer');
  define('MODULE_PAYMENT_BANKTRANSFER_TEXT_DESCRIPTION', 'Banktransfer Payments');
  define('MODULE_PAYMENT_BANKTRANSFER_TEXT_BANK', 'Banktransfer');
  define('MODULE_PAYMENT_BANKTRANSFER_TEXT_EMAIL_FOOTER', 'Note: You can download our Fax Confirmation form from here: ' . HTTP_SERVER . DIR_WS_CATALOG . MODULE_PAYMENT_BANKTRANSFER_URL_NOTE . '');
  define('MODULE_PAYMENT_BANKTRANSFER_TEXT_BANK_INFO', 'Please note that Banktransfer Payments are <b>only</b> available from a <b>german</b> bank account!');
  define('MODULE_PAYMENT_BANKTRANSFER_TEXT_BANK_OWNER', 'Account Owner:');
  define('MODULE_PAYMENT_BANKTRANSFER_TEXT_BANK_NUMBER', 'Account Number:');
  define('MODULE_PAYMENT_BANKTRANSFER_TEXT_BANK_BLZ', 'Bank Code:');
  define('MODULE_PAYMENT_BANKTRANSFER_TEXT_BANK_NAME', 'Bank:');
  define('MODULE_PAYMENT_BANKTRANSFER_TEXT_BANK_FAX', 'Banktransfer Payment will be confirmed by fax');
define('MODULE_PAYMENT_BANKTRANSFER_TEXT_INFO','');

  define('MODULE_PAYMENT_BANKTRANSFER_TEXT_BANK_ERROR', 'ERROR:');
  define('MODULE_PAYMENT_BANKTRANSFER_TEXT_BANK_ERROR_1', 'Account number and bank code do not fit! Please check again.');
  define('MODULE_PAYMENT_BANKTRANSFER_TEXT_BANK_ERROR_2', 'No plausibility check method available for this bank code!');
  define('MODULE_PAYMENT_BANKTRANSFER_TEXT_BANK_ERROR_3', 'Account number cannot be verified!');
  define('MODULE_PAYMENT_BANKTRANSFER_TEXT_BANK_ERROR_4', 'Account number cannot be verified! Please check again.');
  define('MODULE_PAYMENT_BANKTRANSFER_TEXT_BANK_ERROR_5', 'Bank code not found! Please check again.');
  define('MODULE_PAYMENT_BANKTRANSFER_TEXT_BANK_ERROR_8', 'Incorrect bank code or no bank code entered!');
  define('MODULE_PAYMENT_BANKTRANSFER_TEXT_BANK_ERROR_9', 'No account number indicated!');
  define('MODULE_PAYMENT_BANKTRANSFER_TEXT_BANK_ERROR_10', 'No account holder indicated!');

  define('MODULE_PAYMENT_BANKTRANSFER_TEXT_NOTE', 'Note:');
  define('MODULE_PAYMENT_BANKTRANSFER_TEXT_NOTE2', 'If you do not want to send your<br />account data over the internet you can download our ');
  define('MODULE_PAYMENT_BANKTRANSFER_TEXT_NOTE3', 'Fax form');
  define('MODULE_PAYMENT_BANKTRANSFER_TEXT_NOTE4', ' and sent it back to us.');
  

  define('JS_BANK_BLZ', 'Please ente the BLZ or your bank!\n');
  define('JS_BANK_NAME', 'Please enter your name and bank!\n');
  define('JS_BANK_NUMBER', 'Please enter your account number!\n');
  define('JS_BANK_OWNER', 'Please enter the name of the account owner!\n');

  define('MODULE_PAYMENT_BANKTRANSFER_DATABASE_BLZ_TITLE' , 'Use database lookup for Bank Code?');
define('MODULE_PAYMENT_BANKTRANSFER_DATABASE_BLZ_DESC' , 'Do you want to use database lookup for Bank Code? Ensure that the table banktransfer_blz exists and is set up properly!');
define('MODULE_PAYMENT_BANKTRANSFER_URL_NOTE_TITLE' , 'Fax-URL');
define('MODULE_PAYMENT_BANKTRANSFER_URL_NOTE_DESC' , 'The fax-confirmation file. It must located in catalog-dir');
define('MODULE_PAYMENT_BANKTRANSFER_FAX_CONFIRMATION_TITLE' , 'Allow Fax Confirmation');
define('MODULE_PAYMENT_BANKTRANSFER_FAX_CONFIRMATION_DESC' , 'Do you want to allow fax confirmation?');
define('MODULE_PAYMENT_BANKTRANSFER_STATUS_TITLE' , 'Allow Banktransfer Payments');
define('MODULE_PAYMENT_BANKTRANSFER_STATUS_DESC' , 'Do you want to accept banktransfer payments?');
define('MODULE_PAYMENT_BANKTRANSFER_MIN_ORDER_TITLE' , 'Minimum Orders');
define('MODULE_PAYMENT_BANKTRANSFER_MIN_ORDER_DESC' , 'Minimum orders for a Customer to view this Option.');

define('MODULE_PAYMENT_BANKTRANSFER_COST_TITLE',_MODULES_PAYMENT_FEE_TITLE);
define('MODULE_PAYMENT_BANKTRANSFER_COST_DESC',_MODULES_PAYMENT_FEE_DESC);
define('MODULE_PAYMENT_BANKTRANSFER_ZONE_TITLE', _MODULES_ZONE_TITLE);
define('MODULE_PAYMENT_BANKTRANSFER_ZONE_DESC', _MODULES_ZONE_DESC);
define('MODULE_PAYMENT_BANKTRANSFER_ALLOWED_TITLE' , _MODULES_ZONE_ALLOWED_TITLE);
define('MODULE_PAYMENT_BANKTRANSFER_ALLOWED_DESC' ,_MODULES_ZONE_ALLOWED_DESC);
define('MODULE_PAYMENT_BANKTRANSFER_SORT_ORDER_TITLE', _MODULES_SORT_ORDER_TITLE);
define('MODULE_PAYMENT_BANKTRANSFER_SORT_ORDER_DESC', _MODULES_SORT_ORDER_DESC);
define('MODULE_PAYMENT_BANKTRANSFER_ORDER_STATUS_ID_TITLE' , _MODULES_SET_ORDER_STATUS_TITLE);
define('MODULE_PAYMENT_BANKTRANSFER_ORDER_STATUS_ID_DESC' , _MODULES_SET_ORDER_STATUS_DESC);
?>
