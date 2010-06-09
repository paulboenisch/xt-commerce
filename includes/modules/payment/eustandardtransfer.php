<?php
/* -----------------------------------------------------------------------------------------
   $Id: eustandardtransfer.php,v 1.1 2004/06/04 20:04:30 fanta2k Exp $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on:
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(ptebanktransfer.php,v 1.4.1 2003/09/25 19:57:14); www.oscommerce.com

   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/


  class eustandardtransfer {
    var $code, $title, $description, $enabled;

// class constructor
    function eustandardtransfer() {
      $this->code = 'eustandardtransfer';
      $this->title = MODULE_PAYMENT_EUTRANSFER_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_EUTRANSFER_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_EUTRANSFER_SORT_ORDER;
      $this->email_footer = MODULE_PAYMENT_EUTRANSFER_TEXT_EMAIL_FOOTER;
      $this->enabled = ((MODULE_PAYMENT_EUTRANSFER_STATUS == 'True') ? true : false);
    }
// class methods
    function javascript_validation() {
      return false;
    }

    function selection() {
      return array('id' => $this->code,
                   'module' => $this->title);
    } 
//    function selection() {
//      return false;
//    }

    function pre_confirmation_check() {
      return false;
    }


// I take no credit for this, I just hunted down variables, the actual code was stolen from the 2checkout
// module.  About 20 minutes of trouble shooting and poof, here it is. -- Thomas Keats
    function confirmation() {
      global $_POST;

      $confirmation = array('title' => $this->title . ': ' . $this->check,
                            'fields' => array(array('title' => MODULE_PAYMENT_EUTRANSFER_TEXT_DESCRIPTION)));

      return $confirmation;
    }

// Below is the original pre-November snapshot code.  I have left it souly for the less technical minded might
// be able to compare what some of the more indepth changes consisted of.  Perhaps it will facilitate more preNov
// Snapshots to being modified to postNov snapshot compatibility -- Thomas Keats

//    function confirmation() {
//      $confirmation_string = '          <tr>' . "\n" .
//                             '            <td class="main">&nbsp;' . MODULE_PAYMENT_EUTRANSFER_TEXT_DESCRIPTION . $
//                             '          </tr>' . "\n";
//      return $confirmation_string;
//    }

    function process_button() {
      return false;
    }

    function before_process() {
      return false;
    }

    function after_process() {
      return false;
    }

    function output_error() {
      return false;
    }

    function check() {
      if (!isset($this->check)) {
        $check_query = xtc_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_EUTRANSFER_STATUS'");
        $this->check = xtc_db_num_rows($check_query);
      }
      return $this->check;
    }

    function install() {
     xtc_db_query("insert into " . TABLE_CONFIGURATION . " ( configuration_key, configuration_value,  configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_EUSTANDARDTRANSFER_ALLOWED', '', '6', '0', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value,configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_EUTRANSFER_STATUS', 'True', '6', '3', 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now());");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value,configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_EUTRANSFER_BANKNAM', '---',  '6', '1', now());");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value,configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_EUTRANSFER_BRANCH', '---', '6', '1', now());");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value,configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_EUTRANSFER_ACCNAM', '---',  '6', '1', now());");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value,configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_EUTRANSFER_ACCNUM', '---',  '6', '1', now());");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value,configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_EUTRANSFER_ACCIBAN', '---',  '6', '1', now());");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value,configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_EUTRANSFER_BANKBIC', '---',  '6', '1', now());");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value,configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_EUTRANSFER_SORT_ORDER', '0',  '6', '0', now())");

   }

    function remove() {
      xtc_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      $keys = array('MODULE_PAYMENT_EUTRANSFER_STATUS','MODULE_PAYMENT_EUSTANDARDTRANSFER_ALLOWED', 'MODULE_PAYMENT_EUTRANSFER_BANKNAM', 'MODULE_PAYMENT_EUTRANSFER_BRANCH',
					'MODULE_PAYMENT_EUTRANSFER_ACCNAM', 'MODULE_PAYMENT_EUTRANSFER_ACCNUM',  'MODULE_PAYMENT_EUTRANSFER_ACCIBAN', 
					'MODULE_PAYMENT_EUTRANSFER_BANKBIC', 'MODULE_PAYMENT_EUTRANSFER_SORT_ORDER');

      return $keys;
    }
  }
?>