<?php
/* -----------------------------------------------------------------------------------------
   $Id: ups.php 194 2007-02-25 11:46:12Z mzanier $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(UPS.php,v 1.4 2003/02/18 04:28:00); www.oscommerce.com 
   (c) 2003	 nextcommerce (UPS.php,v 1.5 2003/08/13); www.nextcommerce.org

   Released under the GNU General Public License 
   -----------------------------------------------------------------------------------------
   Third Party contributions:
   German Post (Deutsche Post WorldNet)
   Autor:	Copyright (C) 2002 - 2003 TheMedia, Dipl.-Ing Thomas Pl�nkers | http://www.themedia.at & http://www.oscommerce.at
   Changes for personal use: Copyright (C) 2004 Comm4All, Bernd Blazynski | http://www.comm4all.com & http://www.cheapshirt.de

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/


define('MODULE_SHIPPING_UPS_TEXT_TITLE', 'United Parcel Service Standard');
define('MODULE_SHIPPING_UPS_TEXT_DESCRIPTION', 'United Parcel Service Standard - Versandmodul');
define('MODULE_SHIPPING_UPS_TEXT_WAY', 'Versand nach');
define('MODULE_SHIPPING_UPS_TEXT_UNITS', 'kg');
define('MODULE_SHIPPING_UPS_TEXT_FREE', 'Ab EUR ' . MODULE_SHIPPING_UPS_FREEAMOUNT . ' Bestellwert versenden wir Ihre Bestellung versandkostenfrei!');
define('MODULE_SHIPPING_UPS_TEXT_LOW', 'Ab EUR ' . MODULE_SHIPPING_UPS_FREEAMOUNT . ' Bestellwert versenden wir Ihre Bestellung zu erm&auml;&szlig;igten Versandkosten!');


define('MODULE_SHIPPING_UPS_STATUS_TITLE' , 'UPS Standard');
define('MODULE_SHIPPING_UPS_STATUS_DESC' , 'Wollen Sie den Versand &uuml;ber UPS Standard anbieten?');
define('MODULE_SHIPPING_UPS_HANDLING_TITLE' , 'Zuschlag');
define('MODULE_SHIPPING_UPS_HANDLING_DESC' , 'Bearbeitungszuschlag f&uuml;r diese Versandart in Euro');
define('MODULE_SHIPPING_UPS_FREEAMOUNT_TITLE' , 'Versandkostenfrei Inland');
define('MODULE_SHIPPING_UPS_FREEAMOUNT_DESC' , 'Mindestbestellwert f�r den versandkostenfreien Versand im Inland und den erm&auml;&szlig;igten Versand ins Ausland.');

define('MODULE_SHIPPING_UPS_COUNTRIES_1_TITLE' , 'Staaten f&uuml;r UPS Standard Zone 1');
define('MODULE_SHIPPING_UPS_COUNTRIES_1_DESC' , 'Durch Komma getrennte ISO-K&uuml;rzel der Staaten f&uuml;r Zone 1:');
define('MODULE_SHIPPING_UPS_COST_1_TITLE' , 'Tarife f&uuml;r UPS Standard Zone 1');
define('MODULE_SHIPPING_UPS_COST_1_DESC' , 'Gewichtsbasierte Versandkosten innerhalb Zone 1. Beispiel: Sendung zwischen 0 und 4kg kostet EUR 5,15 = 4:5.15,...');

define('MODULE_SHIPPING_UPS_COUNTRIES_2_TITLE' , 'Staaten f&uuml;r UPS Standard Zone 3');
define('MODULE_SHIPPING_UPS_COUNTRIES_2_DESC' , 'Durch Komma getrennte ISO-K&uuml;rzel der Staaten f&uuml;r Zone 3:');
define('MODULE_SHIPPING_UPS_COST_2_TITLE' , 'Tarife f&uuml;r UPS Standard Zone 3');
define('MODULE_SHIPPING_UPS_COST_2_DESC' , 'Gewichtsbasierte Versandkosten innerhalb Zone 3. Beispiel: Sendung zwischen 0 und 4kg kostet EUR 13,75 = 4:13.75,...');

define('MODULE_SHIPPING_UPS_COUNTRIES_3_TITLE' , 'Staaten f&uuml;r UPS Standard Zone 31');
define('MODULE_SHIPPING_UPS_COUNTRIES_3_DESC' , 'Durch Komma getrennte ISO-K&uuml;rzel der Staaten f&uuml;r Zone 31:');
define('MODULE_SHIPPING_UPS_COST_3_TITLE' , 'Tarife f&uuml;r UPS Standard Zone 31');
define('MODULE_SHIPPING_UPS_COST_3_DESC' , 'Gewichtsbasierte Versandkosten innerhalb Zone 31. Beispiel: Sendung zwischen 0 und 4kg kostet EUR 23,50 = 4:23.50,...');

define('MODULE_SHIPPING_UPS_COUNTRIES_4_TITLE' , 'Staaten f&uuml;r UPS Standard Zone 4');
define('MODULE_SHIPPING_UPS_COUNTRIES_4_DESC' , 'Durch Komma getrennte ISO-K&uuml;rzel der Staaten f&uuml;r Zone 4:');
define('MODULE_SHIPPING_UPS_COST_4_TITLE' , 'Tarife f&uuml;r UPS Standard Zone 4');
define('MODULE_SHIPPING_UPS_COST_4_DESC' , 'Gewichtsbasierte Versandkosten innerhalb Zone 4. Beispiel: Sendung zwischen 0 und 4kg kostet EUR 25,40 = 4:25.40,...');

define('MODULE_SHIPPING_UPS_COUNTRIES_5_TITLE' , 'Staaten f&uuml;r UPS Standard Zone 41');
define('MODULE_SHIPPING_UPS_COUNTRIES_5_DESC' , 'Durch Komma getrennte ISO-K&uuml;rzel der Staaten f&uuml;r Zone 41:');
define('MODULE_SHIPPING_UPS_COST_5_TITLE' , 'Tarife f&uuml;r UPS Standard Zone 41');
define('MODULE_SHIPPING_UPS_COST_5_DESC' , 'Gewichtsbasierte Versandkosten innerhalb Zone 41. Beispiel: Sendung zwischen 0 und 4kg kostet EUR 30,00 = 4:30.00,...');

define('MODULE_SHIPPING_UPS_COUNTRIES_6_TITLE' , 'Staaten f&uuml;r UPS Standard Zone 5');
define('MODULE_SHIPPING_UPS_COUNTRIES_6_DESC' , 'Durch Komma getrennte ISO-K&uuml;rzel der Staaten f&uuml;r Zone 5:');
define('MODULE_SHIPPING_UPS_COST_6_TITLE' , 'Tarife f&uuml;r UPS Standard Zone 5');
define('MODULE_SHIPPING_UPS_COST_6_DESC' , 'Gewichtsbasierte Versandkosten innerhalb Zone 5. Beispiel: Sendung zwischen 0 und 4kg kostet EUR 34,35 = 4:34.35,...');

define('MODULE_SHIPPING_UPS_COUNTRIES_7_TITLE' , 'Staaten f&uuml;r UPS Standard Zone 6');
define('MODULE_SHIPPING_UPS_COUNTRIES_7_DESC' , 'Durch Komma getrennte ISO-K&uuml;rzel der Staaten f&uuml;r Zone 6:');
define('MODULE_SHIPPING_UPS_COST_7_TITLE' , 'Tarife f&uuml;r UPS Standard Zone 6');
define('MODULE_SHIPPING_UPS_COST_7_DESC' , 'Gewichtsbasierte Versandkosten innerhalb Zone 6. Beispiel: Sendung zwischen 0 und 4kg kostet EUR 37,10 = 4:37.10,...');


define('MODULE_SHIPPING_UPS_TAX_CLASS_TITLE' , _MODULES_TAX_ZONE_TITLE);
define('MODULE_SHIPPING_UPS_TAX_CLASS_DESC' ,_MODULES_TAX_ZONE_DESC);
define('MODULE_SHIPPING_UPS_ZONE_TITLE' , _MODULES_ZONE_TITLE);
define('MODULE_SHIPPING_UPS_ZONE_DESC' , _MODULES_ZONE_DESC);
define('MODULE_SHIPPING_UPS_SORT_ORDER_TITLE' , _MODULES_SORT_ORDER_TITLE);
define('MODULE_SHIPPING_UPS_SORT_ORDER_DESC' , _MODULES_SORT_ORDER_DESC);
define('MODULE_SHIPPING_UPS_ALLOWED_TITLE' , _MODULES_ZONE_ALLOWED_TITLE);
define('MODULE_SHIPPING_UPS_ALLOWED_DESC' , _MODULES_ZONE_ALLOWED_DESC);
define('MODULE_SHIPPING_UPS_INVALID_ZONE', _MODULE_INVALID_SHIPPING_ZONE);
define('MODULE_SHIPPING_UPS_UNDEFINED_RATE', _MODULE_UNDEFINED_SHIPPING_RATE);
?>
