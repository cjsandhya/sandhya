<?php
$_POST['ShortMessage'] = stripcslashes($_POST['ShortMessage']);
$_POST['LongMessage'] = stripcslashes($_POST['LongMessage']);
# echo "<pre>details.php:".PHP_EOL;
# echo "\$_POST = "; var_dump($_POST); echo "</pre>";

$vendor = isset($_POST['vendor']) ? unserialize(stripcslashes($_POST['vendor'])) : null;
$address = isset($_POST['address']) ? unserialize(stripcslashes($_POST['address'])) : null;
$rPPDetails = isset($_POST['rPPDetails']) ? unserialize(stripcslashes($_POST['rPPDetails'])) : null;
$detailsAddress = !is_null($rPPDetails) ? $rPPDetails->AddressType : null;
# echo "<pre>\$vendor = "; var_dump($vendor); echo "</pre>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Subscribe Normal Return</title>
	</head>
	<body>
		<h3>FarmMade Subscribe PayPal Recurring Payments Details</h3>
		<?php
			echo "<table>";
			echo "<tr><td>Ack :</td><td><div id='Ack'>". $_POST['Ack'] ."</div> </td></tr>";
			echo "<tr><td>SubscribeMode :</td><td><div id='SubscribeMode'>". $_POST['SubscribeMode'] ."</div> </td></tr>";
			echo "<tr><td>LongMessage :</td><td><div id='LongMessage'>". $_POST['LongMessage'] ."</div> </td></tr>";
			echo "<tr><td>ShortMessage :</td><td><div id='ShortMessage'>". $_POST['ShortMessage'] ."</div> </td></tr>";
			echo "<tr><td>ErrorCode :</td><td><div id='ErrorCode'>". $_POST['ErrorCode'] ."</div> </td></tr>";
			echo "</table><br>";
			if (!is_null($address)) {
				echo "<b>New PayPal Subscription Address:</b> ";
				echo "<table>";
				echo "<tr><td>Name :</td><td><div id='Name'>" . $address->Name ."</div> </td></tr>";
				echo "<tr><td>Address :</td><td><div id='Street1'>". $address->Street1 ."</div> </td></tr>";
				echo "<tr><td>Address :</td><td><div id='Street2'>". $address->Street2 ."</div> </td></tr>";
				echo "<tr><td>City :</td><td><div id='CityName'>". $address->CityName ."</div> </td></tr>";
				echo "<tr><td>State or Province :</td><td><div id='StateOrProvince'>". $address->StateOrProvince ."</div> </td></tr>";
				echo "<tr><td>Country :</td><td><div id='Country'>". $address->Country ."</div> </td></tr>";
				echo "<tr><td>PostalCode :</td><td><div id='PostalCode'>". $address->PostalCode ."</div> </td></tr>";
				echo "</table><br>";
			}
			if (!is_null($vendor)) {
				echo "<b>Seller's PayPal Subscribe Record:</b> ";
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
			if (!is_null($rPPDetails)) {
				echo "<b>Seller's PayPal Recurring Payments Details:</b> ";
				echo "<table>";
				echo "<tr><td>Seller's Name :</td><td><div id='SubscriberName'>$rPPDetails->SubscriberName</div> </td></tr>";
				echo "<tr><td>PayPal Payer Email :</td><td><div id='vendor_PP_PayerEmail'>$rPPDetails->vendor_PP_PayerEmail</div> </td></tr>";
				echo "<tr><td>PayPal Payer ID :</td><td><div id='vendor_PP_PayerID'>$rPPDetails->vendor_PP_PayerID</div> </td></tr>";
				echo "<tr><td>PayPal Profile ID :</td><td><div id='ProfileID'>$rPPDetails->ProfileID</div> </td></tr>";
				echo "<tr><td>PayPal Profile Status :</td><td><div id='ProfileStatus'>$rPPDetails->ProfileStatus</div> </td></tr>";
				echo "<tr><td>Subscribe Date :</td><td><div id='SubscribeDate'>$rPPDetails->SubscribeDate</div> </td></tr>";
				echo "<tr><td>Vendor ID :</td><td><div id='vendor_id'>$rPPDetails->vendor_id</div> </td></tr>";
				echo "</table><br>";
			}
			if (!is_null($detailsAddress)) {
				echo "<b>Seller's PayPal Recurring Payments Address:</b> ";
				echo "<table>";
				echo "<tr><td>PayPal Subscriber Name :</td><td><div id='Name'>$detailsAddress->Name</div> </td></tr>";
				echo "<tr><td>Street 1 :</td><td><div id='Street1'>$detailsAddress->Street1</div> </td></tr>";
				echo "<tr><td>Street 2 :</td><td><div id='Street2'>$detailsAddress->Street2</div> </td></tr>";
				echo "<tr><td>City :</td><td><div id='CityName'>$detailsAddress->CityName</div> </td></tr>";
				echo "<tr><td>State or Province :</td><td><div id='StateOrProvince'>$detailsAddress->StateOrProvince</div> </td></tr>";
				echo "<tr><td>Country :</td><td><div id='Country'>$detailsAddress->Country</div> </td></tr>";
				echo "<tr><td>Country Name :</td><td><div id='CountryName'>$detailsAddress->CountryName</div> </td></tr>";
				echo "<tr><td>Postal Code :</td><td><div id='PostalCode'>$detailsAddress->PostalCode</div> </td></tr>";
				echo "</table><br>";
				
			}	
			echo "<a href=".$_POST['home']."><b>FarmMade PayPal Subscribe Home</b></a><br>";
		?>
	</body>
</html>
