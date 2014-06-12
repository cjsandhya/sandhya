<?php
require_once 'PPBootStrap.php';
require_once 'FMSubscribe.php';

session_start();
/*	For testing.
if (!is_null($_SESSION['vendor_id'])) {
	echo "<pre>";
	echo "\$_SESSION['vendor_id'] = ".$_SESSION['vendor_id'].PHP_EOL;
	echo "\$_SESSION['home'] = ".$_SESSION['home'].PHP_EOL;
	echo "</pre> ";
}
*/
$fmSubscribe = new FMSubscribe($config, $_SESSION['home']);

$acknowledge = new Acknowledge();
$acknowledge->Ack = 'Failure';
$acknowledge->SubscribeMode = 'Get Subscription Details';
$acknowledge->home = $_SESSION['home'];
$vendor_id = $acknowledge->vendor_id = (int) $_SESSION['vendor_id'];
# echo "<pre>\$acknowledge = "; var_dump($acknowledge); echo PHP_EOL."</pre>";

# Check to see if the Seller's `vendor` database table record exists.
$vendor = $fmSubscribe->getVendorShortID($vendor_id);
# echo "<pre>\$vendor = "; var_dump($vendor); echo "</pre>";
if (is_null($vendor)) {		# Seller's `vendor` database table record does not exist.
	$acknowledge->ShortMessage = "Seller's Vendor ID: \"$acknowledge->vendor_id\" record is not available.";
	$fmSubscribe->redirect((array) $acknowledge, 'fault.php');
	exit;
}
$acknowledge->vendor = serialize($vendor);
if (is_null($vendor->vendor_PP_ProfileID) || $vendor->vendor_PP_ProfileID == 'Cancelled') {
	$acknowledge->ShortMessage = "PayPal subscription does not exist for Seller's Seller ID: \"".$acknowledge->vendor_id.'".';
	$fmSubscribe->redirect((array) $acknowledge, 'fault.php');
	exit;	
}
$rPPDetails = $fmSubscribe->getRecurringPaymentsProfileDetails($vendor->vendor_PP_ProfileID);

if (get_class($rPPDetails) == 'Acknowledge') {	# We hit an error while gettting the PayPal Recurring Payments profile.
	$rPPDetails->vendor = serialize($vendor);	
	$fmSubscribe->redirect((array) $rPPDetails, 'fault.php');
	exit;	
}

$acknowledge->Ack = 'Success';
$acknowledge->rPPDetails = serialize($rPPDetails);
$fmSubscribe->redirect((array) $acknowledge, 'details.php');

	
?>