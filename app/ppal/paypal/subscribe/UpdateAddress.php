<?php
require_once 'PPBootStrap.php';
require_once 'FMSubscribe.php';
# echo "<pre>UpdateAddress.php".PHP_EOL."</pre>";
# echo "<pre>\$_POST = "; var_dump($_POST); echo PHP_EOL."</pre>";

$fmSubscribe = new FMSubscribe($config, $_POST['home']);

$address = new stdClass();		# Brute force object types because 'normal.php' does not know about the AddressType class
								# I would never proactice this in a production environment, only a code testing environment
$addressType = new AddressType();
$address->Name = $addressType->Name = $_POST['Name'];
$address->Street1 = $addressType->Street1 = $_POST['Street1'];
$address->Street2 = $addressType->Street2 = $_POST['Street2'];
$address->CityName = $addressType->CityName = $_POST['CityName'];
$address->StateOrProvince = $addressType->StateOrProvince = $_POST['StateOrProvince'];
$address->Country = $addressType->Country = $_POST['Country'];
$address->PostalCode = $addressType->PostalCode = $_POST['PostalCode'];
# echo "<pre>\$address = "; var_dump($address); echo "</pre>";
# echo "<pre>\$addressType = "; var_dump($addressType); echo "</pre>";
 
$acknowledge = new Acknowledge();
$acknowledge->Ack = 'Failure';
$acknowledge->SubscribeMode = 'Update PayPal Subscription Address';
$acknowledge->home = $_POST['home'];
$acknowledge->vendor_id = (int) $_POST['vendor_id'];
# echo "<pre>\$acknowledge = "; var_dump($acknowledge); echo PHP_EOL."</pre>";

# Check to see if the Seller's `vendor` database table record exists.
$vendor = $fmSubscribe->getVendorShortID($acknowledge->vendor_id);
# echo "<pre>\$vendor = "; var_dump($vendor); echo "</pre>";
if (is_null($vendor)) {		# Seller's `vendor` database table record does not exist.
	$acknowledge->ShortMessage = "Seller's Vendor ID: \"$acknowledge->vendor_id\" record is not available.";
	$fmSubscribe->redirect((array) $acknowledge, 'fault.php');
	exit;
}
if (is_null($vendor->vendor_PP_ProfileID) || $vendor->vendor_PP_ProfileID == 'Cancelled') {
	$acknowledge->ShortMessage = "PayPal subscription does not exist for Seller's Seller ID: \"".$acknowledge->vendor_id.'".';
	$acknowledge->vendor = serialize($vendor);
	$fmSubscribe->redirect((array) $acknowledge, 'fault.php');
	exit;	
}
$response = $fmSubscribe->updateRecurringPaymentsProfileAddress($vendor->vendor_PP_ProfileID, $addressType);
$response->address = serialize($address);
$response->vendor = serialize($fmSubscribe->getVendorShortID($acknowledge->vendor_id));
if ($response->Ack == $acknowledge->Ack) {	# Ack = Failure, we hit an error while updating the PayPal Recurring Payments Profile Status
	$fmSubscribe->redirect((array) $response, 'fault.php');
	exit;	
}

$fmSubscribe->redirect((array) $response, 'normal.php');
?>
