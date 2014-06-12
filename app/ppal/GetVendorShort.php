<?php
$magePath = dirname(__FILE__).'/app/etc/local.xml';
$doc = new DOMDocument('1.0');
$doc->load($magePath);
define('DB_HOST', $doc->getElementsByTagName('host')->item(0)->nodeValue);
define('DB_USERNAME', $doc->getElementsByTagName('username')->item(0)->nodeValue);
define('DB_PASSWD', $doc->getElementsByTagName('password')->item(0)->nodeValue); 
define('DB_NAME', $doc->getElementsByTagName('dbname')->item(0)->nodeValue);
$doc = null;

class GetVendorShort {
	private $mysqli;

	public function __construct() {
		# Database I/O connection
        $this->mysqli = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWD, DB_NAME);
		if (mysqli_connect_errno()) {
			$msg=self::errorPrefix."could not connect: ".mysqli_connect_error();
			throw new Exception($msg);
		}
		# $home = dirname('http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI']);
		# echo "GetVendorShort \$home = $home<br>";
	}

	function __destruct() {
		$this->mysqli->close();
		$this->mysqli = null;
	}

	public function getVendorShort($vendor_id) {
		$result=$this->mysqli->query("SELECT vendor_id, vendor_shop_name, vendor_first_name, vendor_last_name, vendor_paypal_address, vendor_address1,
		vendor_address2, vendor_city, vendor_state_province, vendor_zip_postal, vendor_country, vendor_PP_PayerID, vendor_PP_ProfileID,
		vendor_PP_ProfileStatus, vendor_PP_ProfileStartDate, vendor_PP_PayerCountry FROM vendor WHERE vendor_id='$vendor_id'");
		$vendorShortoObj = $result->fetch_object();
		$result->free();
		return $vendorShortoObj;
	}
}