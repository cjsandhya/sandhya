
<?php
/*
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'fm_invoice');
define('DB_PASSWD', '3ka7wp4'); 
define('DB_NAME', 'fminvoice');
*/

$vendor = new stdClass();

$vendor->vendor_id = 1;
$vendor->vendor_shop_name = "Lester's Farm";
$vendor->vendor_first_name = "Lester";
$vendor->vendor_last_name = "Tester";
$vendor->vendor_paypal_address = "lester2@tester.com";
$vendor->vendor_address1 = "2010 S.W. Broadway";
$vendor->vendor_address2 = "";
$vendor->vendor_city = "Portland";
$vendor->vendor_state_province = "OR";
$vendor->vendor_zip_postal = "97123";
$vendor->vendor_country = "US";
$vendor->vendor_PP_PayerID = NULL;
$vendor->vendor_PP_ProfileID = NULL;
$vendor->vendor_PP_ProfileStatus = "Cancelled";
$vendor->vendor_PP_ProfileStartDate = NULL;
$vendor->vendor_PP_PayerCountry = NULL;

echo "<pre>getVendorShortID: \$vendor = "; var_dump($vendor); echo "</pre>";
$vendorSerial = serialize($vendor); 
echo "<pre>getVendorShortID: \$vendorSerial = "; var_dump($vendorSerial); echo "</pre>";
$vendor1 = unserialize($vendorSerial); 
echo "<pre>getVendorShortID: \$vendor1 = "; var_dump($vendor1); echo "</pre>";

exit;
//
define('DB_HOST', '');
define('DB_USERNAME', 'farmmade_ppal');
define('DB_PASSWD', ''); 
define('DB_NAME', 'farmmade_ppal');
//

$mysqli = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWD, DB_NAME);
if (mysqli_connect_errno()) {
	$msg="dbtest.php: could not connect: ".mysqli_connect_error();
	echo "$msg";
	exit;
}
$vendor_id = 3;

$vendorShortoObj = getVendorShortID($vendor_id);
echo "<pre>\$vendorShortoObj = "; var_dump($vendorShortoObj); echo "</pre>";

function getVendorShortID($vendor_id) {
	global $mysqli;
echo "<pre>getVendorShortID: \$vendor_id = "; var_dump($vendor_id); echo "</pre>";
# echo "getVendorShortID: \$vendor_id = "; var_dump($vendor_id);
//
	$result=$mysqli->query("SELECT vendor_id, vendor_shop_name, vendor_first_name, vendor_last_name, vendor_paypal_address, vendor_address1,
	vendor_address2, vendor_city, vendor_state_province, vendor_zip_postal, vendor_country, vendor_PP_PayerID, vendor_PP_ProfileID,
	vendor_PP_ProfileStatus, vendor_PP_ProfileStartDate, vendor_PP_PayerCountry FROM vendor WHERE vendor_id='$vendor_id'");
//
	# $result=$mysqli->query("SELECT vendor_id, vendor_shop_name, vendor_first_name , vendor_last_name FROM vendor WHERE vendor_id='$vendor_id'");
	
echo "<pre>getVendorShortID: \$result = "; var_dump($result); echo "</pre>";
# echo "getVendorShortID: \$result = "; var_dump($result);
	$vendorShortoObj = $result->fetch_object();
	$result->free();
	return $vendorShortoObj;
}
	
?>