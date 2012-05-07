<?php
/**
 * MMT bootstrap
 * 
 * Main bootstrap file -- must be included in all access-points
 * 
 * @author Matthias ETIENNE <matt@allty.com>
 * @package MMT
 * @version 1.0
 */

define('MMT_BASE_PATH', 	realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);
define('MMT_DRIVERS_PATH', 	MMT_BASE_PATH."drivers".DIRECTORY_SEPARATOR);
define('MMT_LIB_PATH', 		MMT_BASE_PATH."lib".DIRECTORY_SEPARATOR);
define('MMT_CONFIG_PATH', 	MMT_BASE_PATH."config".DIRECTORY_SEPARATOR);
define('MMT_CLI_PATH', 		MMT_BASE_PATH."cli".DIRECTORY_SEPARATOR);
define('MMT_PLUGINS_PATH',	MMT_BASE_PATH."plugins".DIRECTORY_SEPARATOR);

require(MMT_LIB_PATH."Mmt.php");