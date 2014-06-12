<?php
/*
  Include this file in your application. This file sets up the required classloader based on 
  whether you used composer or the custom installer.
*/

/*
 * @constant PP_CONFIG_PATH required if credentoal and configuration is to be used from a file
 * Let the SDK know where the sdk_config.ini file resides.
 */
define("PP_CONFIG_PATH", __DIR__ . '/config');
//echo ( __DIR__ );


/*
 * Use PPAutoloader.php
 */
require 'PPAutoloader.php';
PPAutoloader::register();

define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);
define('BILLING_AGREEMENT', 'FarmMade Shop $5 monthly subscription');
define('CURRENCY_CODE', 'USD');
define('SUBSCRIBE_FEE', 5.00);
define('NO_FEE', 0.00);

/*
 * Load up $config parameter from ~/config/sdk_config.ini and establish
 * PayPal site-woide access parameters.
 */
$config = PPConfigManager::getInstance()->config;
define('USERNAME', $config['acct1.UserName']);
define('PASSWORD', $config['acct1.Password']);
define('SIGNATURE',$config['acct1.Signature']);
# Force logging if a PayPal sandbox is being used
if ($config['mode'] == 'sandbox') {
	$config['log.LogLevel'] = 'WARN';
	$config['log.LogEnabled'] = '1';
}

$magePath = dirname(pathinfo(dirname(__FILE__), PATHINFO_DIRNAME)).DS.'app/etc/local.xml';
/*
# echo "\$config = "; var_dump($config);
foreach ($config as $key => $value) {
	echo "$key = $value<br>";
}
echo "USERNAME = ".USERNAME.'<br>';
echo "PASSWORD = ".PASSWORD.'<br>';
echo "SIGNATURE = ".SIGNATURE.'<br>';
*/

