<?php
session_start();
require_once 'GetVendorShort.php';
$getVendorShort = new GetVendorShort();
$vendor = $getVendorShort->getVendorShort($_SESSION['vendor_id']);
/*	For testing.
if (!is_null($_SESSION['vendor_id'])) {
	echo "<pre>";
	echo "payPalCancel.php".PHP_EOL;
	echo "\$_SESSION['vendor_id'] = ".$_SESSION['vendor_id'].PHP_EOL;
	echo "\$_SESSION['home'] = ".$_SESSION['home'].PHP_EOL;
	echo "</pre> ";
}
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>PayPal Subscribe Cancel</title>
</head>
	<body>
		<h3>FarmMade Subscribe PayPal Signup Cancelled</h3>
		<?php
			if (!is_null($vendor)) {
				echo "<b>FarmMade Seller's PayPal subscribe record:</b> ";
				echo "<table>";
				echo "<tr><td>vendor_id :</td><td><div id='vendor_id'>$vendor->vendor_id</div> </td></tr>";
				echo "<tr><td>vendor_shop_name :</td><td><div id='vendor_shop_name'>". $vendor->vendor_shop_name ."</div> </td></tr>";
				echo "<tr><td>vendor_first_name :</td><td><div id='vendor_first_name'>". $vendor->vendor_first_name ."</div> </td></tr>";
				echo "<tr><td>vendor_last_name :</td><td><div id='vendor_last_name'>". $vendor->vendor_last_name ."</div> </td></tr>";
				echo "<tr><td>vendor_paypal_address :</td><td><div id='vendor_paypal_address'>". $vendor->vendor_paypal_address ."</div> </td></tr>";
				echo "<tr><td>vendor_address1 :</td><td><div id='vendor_address1'>". $vendor->vendor_address1 ."</div> </td></tr>";
				echo "<tr><td>vendor_address2 :</td><td><div id='vendor_address2'>". $vendor->vendor_address2 ."</div> </td></tr>";
				echo "<tr><td>vendor_city :</td><td><div id='vendor_city'>". $vendor->vendor_city ."</div> </td></tr>";
				echo "<tr><td>vendor_zip_postal :</td><td><div id='vendor_zip_postal'>". $vendor->vendor_zip_postal ."</div> </td></tr>";
				echo "<tr><td>vendor_country :</td><td><div id='vendor_country'>". $vendor->vendor_country ."</div> </td></tr>";
				echo "<tr><td>vendor_PP_PayerID :</td><td><div id='vendor_PP_PayerID'>$vendor->vendor_PP_PayerID</div> </td></tr>";
				echo "<tr><td>vendor_PP_ProfileID :</td><td><div id='vendor_PP_ProfileID'>". $vendor->vendor_PP_ProfileID ."</div> </td></tr>";
				echo "<tr><td>vendor_PP_ProfileStatus :</td><td><div id='vendor_PP_ProfileStatus'>". $vendor->vendor_PP_ProfileStatus ."</div> </td></tr>";
				echo "<tr><td>vendor_PP_ProfileStartDate :</td><td><div id='vendor_PP_ProfileStartDate'>". $vendor->vendor_PP_ProfileStartDate ."</div> </td></tr>";
				echo "<tr><td>vendor_PP_PayerCountry :</td><td><div id='vendor_PP_PayerCountry'>". $vendor->vendor_PP_PayerCountry ."</div> </td></tr>";
				echo "</table><br>";
			}
			echo "<a href=".$_SESSION['home']."><b>FarmMade PayPal Subscribe Home</b></a><br>";
		?>
	</body>
</html>


