<?php
/* -----------------------------------------------------------------------------------------
   $Id: xtc_db_input.inc.php,v 1.2 2004/03/01 19:16:18 fanta2k Exp $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(database.php,v 1.19 2003/03/22); www.oscommerce.com
   (c) 2003	 nextcommerce (xtc_db_input.inc.php,v 1.3 2003/08/13); www.nextcommerce.org 

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/
   

  function xtc_db_input($string, $link = 'db_link') {
  global $$link;

  if (function_exists('mysql_real_escape_string')) {
    return mysql_real_escape_string($string, $$link);
  } elseif (function_exists('mysql_escape_string')) {
    return mysql_escape_string($string);
  }

  return addslashes($string);
}
 ?>