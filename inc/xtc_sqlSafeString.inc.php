<?php
/* -----------------------------------------------------------------------------------------
   $Id: xtc_sqlSafeString.inc.php 70 2007-01-07 14:19:12Z mzanier $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   by Mario Zanier for neXTCommerce
   
   based on:
   (c) 2003	 nextcommerce (xtc_sqlSafeString.inc.php,v 1.4 2003/08/13); www.nextcommerce.org

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/

  function xtc_sqlSafeString($param) {
    // Hier wird wg. der grossen Verbreitung auf MySQL eingegangen
    return (NULL === $param ? "NULL" : '"' . mysql_escape_string($param) . '"');
  }
?>