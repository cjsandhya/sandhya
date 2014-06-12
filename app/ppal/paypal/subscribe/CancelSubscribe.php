<?php
require_once 'PPBootStrap.php';
require_once 'FMSubscribe.php';

session_start();
/*	For testing.
if (!is_null($_SESSION['vendor_id'])) {
	echo "<pre>";
	echo "CancelSubscribe.php".PHP_EOL;
	echo "\$_SESSION['vendor_id'] = ".$_SESSION['vendor_id'].PHP_EOL;
	echo "\$_SESSION['home'] = ".$_SESSION['home'].PHP_EOL;
	echo "</pre> ";
}
*/
$fmSubscribe = new FMSubscribe($config, $_SESSION['home']);

$acknowledge = new Acknowledge();
$acknowledge->Ack = 'Failure';
$acknowledge->SubscribeMode = 'Cancel PayPal Subscribe';
$acknowledge->home = $_SESSION['home'];
$acknowledge->vendor_id = (int) $_SESSION['vendor_id'];
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
	$acknowledge->ShortMessage = "PayPal subscription does not exist for Seller's Vendor ID: \"".$acknowledge->vendor_id.'".';

	$acknowledge->vendor = serialize($vendor);
	$fmSubscribe->redirect((array) $acknowledge, 'fault.php');
	exit;	
}
$response = $fmSubscribe->cancelRecurringPaymentsProfile($acknowledge->vendor_id);      # API method call takes a `vendor_id`, where all other PayPal subscribe methods require a ProfileID paramter
$response->vendor = serialize($fmSubscribe->getVendorShortID($acknowledge->vendor_id));

if ($response->Ack == $acknowledge->Ack) {	# Ack = Failure, we hit an error while updating the PayPal Recurring Payments Profile Status
	$response->vendor = serialize($vendor);	
	$fmSubscribe->redirect((array) $response, 'fault.php');
	exit;	
}
$fmSubscribe->redirect((array) $response, 'normal.php');
?>
