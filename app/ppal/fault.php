<?php
$_POST['ShortMessage'] = stripcslashes($_POST['ShortMessage']);
$_POST['LongMessage'] = stripcslashes($_POST['LongMessage']);
# echo "<pre>fault.php:".PHP_EOL;
# echo "\$_POST = "; var_dump($_POST); echo "</pre>";
$vendor = isset($_POST['vendor']) ? unserialize(stripcslashes($_POST['vendor'])) : null;
# echo "<pre>\$vendor = "; var_dump($vendor); echo "</pre>";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Subscribe Fault Return</title>
	</head>
	<body>
		<h3>FarmMade Subscribe Fault Return</h3>
	<?php
		echo "<table>";
		echo "<tr><td>Ack :</td><td><div id='Ack'>". $_POST['Ack'] ."</div> </td></tr>";
		echo "<tr><td>SubscribeMode :</td><td><div id='SubscribeMode'>". $_POST['SubscribeMode'] ."</div> </td></tr>";
		echo "<tr><td>LongMessage :</td><td><div id='LongMessage'>". $_POST['LongMessage'] ."</div> </td></tr>";
		echo "<tr><td>ShortMessage :</td><td><div id='ShortMessage'>". $_POST['ShortMessage'] ."</div> </td></tr>";
		echo "<tr><td>ErrorCode :</td><td><div id='ErrorCode'>". $_POST['ErrorCode'] ."</div> </td></tr>";
		echo "</table><br>";
		if (!is_null($vendor)) {
			echo "<b>Seller's PayPal subscribe record:</b> ";
			echo "<table>";
			echo "<tr><td>vendor_id :</td><td><div id='vendor_id'>$vendor->vendor_id</div> </td></tr>";
			echo "<tr><td>vendor_shop_name :</td><td><div id='vendor_shop_name'>". $vendor->vendor_shop_name ."</div> </td></tr>";
			echo "<tr><td>vendor_first_name :</td><td><div id='vendor_first_name'>". $vendor->vendor_first_name ."</div> </td></tr>";
			echo "<tr><td>vendor_last_name :</td><td><div id='vendor_last_name'>". $vendor->vendor_last_name ."</div> </td></tr>";
			echo "<tr><td>vendor_paypal_address :</td><td><div id='vendor_paypal_address'>". $vendor->vendor_paypal_address ."</div> </td></tr>";
			echo "<tr><td>vendor_address1 :</td><td><div id='vendor_address1'>". $vendor->vendor_address1 ."</div> </td></tr>";
			echo "<tr><td>vendor_address2 :</td><td><div id='vendor_address2'>". $vendor->vendor_address2 ."</div> </td></tr>";
			echo "<tr><td>vendor_city :</td><td><div id='vendor_city'>". $vendor->vendor_city ."</div> </td></tr>";
			echo "<tr><td>vendor_state_province :</td><td><div id='vendor_state_province'>". $vendor->vendor_state_province ."</div> </td></tr>";
			echo "<tr><td>vendor_zip_postal :</td><td><div id='vendor_zip_postal'>". $vendor->vendor_zip_postal ."</div> </td></tr>";
			echo "<tr><td>vendor_country :</td><td><div id='vendor_country'>". $vendor->vendor_country ."</div> </td></tr>";
			echo "<tr><td>vendor_PP_PayerID :</td><td><div id='vendor_PP_PayerID'>$vendor->vendor_PP_PayerID</div> </td></tr>";
			echo "<tr><td>vendor_PP_ProfileID :</td><td><div id='vendor_PP_ProfileID'>". $vendor->vendor_PP_ProfileID ."</div> </td></tr>";
			echo "<tr><td>vendor_PP_ProfileStatus :</td><td><div id='vendor_PP_ProfileStatus'>". $vendor->vendor_PP_ProfileStatus ."</div> </td></tr>";
			echo "<tr><td>vendor_PP_ProfileStartDate :</td><td><div id='vendor_PP_ProfileStartDate'>". $vendor->vendor_PP_ProfileStartDate ."</div> </td></tr>";
			echo "<tr><td>vendor_PP_PayerCountry :</td><td><div id='vendor_PP_PayerCountry'>". $vendor->vendor_PP_PayerCountry ."</div> </td></tr>";
			echo "</table><br>";
		}
		echo "<a href=".$_POST['home']."><b>FarmMade PayPal Subscribe Home</b></a><br>";
	?>
	</body>
</html>


