<?php
require_once 'PPBootStrap.php';
require_once 'FMSubscribe.php';
# echo "<pre>UpdateTrial.php".PHP_EOL."</pre>";
# echo "<pre>\$_POST = "; var_dump($_POST); echo PHP_EOL."</pre>";

$fmSubscribe = new FMSubscribe($config, $_POST['home']);

$acknowledge = new Acknowledge();
$acknowledge->Ack = 'Failure';
$acknowledge->SubscribeMode = 'Set New PayPal Subscribe Trial Period';
$acknowledge->ShortMessage = 'New Trial Period = '.$_POST['trial_period'].' months.';
$acknowledge->home = $_POST['home'];
$acknowledge->vendor_id = (int) $_POST['vendor_id'];
# echo "<pre>\$acknowledge = "; var_dump($acknowledge); echo PHP_EOL."</pre>";

$trialPeriod = (int) $_POST['trial_period'];
//
if (is_numeric($_POST['trial_period']) == false) {
	$acknowledge->LongMessage = "New Trial Period input is not a number.";
	$fmSubscribe->redirect((array) $acknowledge, 'fault.php');
	exit;
}
//
if ($trialPeriod < 2 || $trialPeriod > 12) {;
	$acknowledge->LongMessage = "New Trial Period must be in the range of 2 to 12.";
	$fmSubscribe->redirect((array) $acknowledge, 'fault.php');
	exit;
}
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
$response = $fmSubscribe->updateRecurringPaymentsProfileTrialPeriod($vendor->vendor_PP_ProfileID, $_POST['trial_period']);
if ($response->Ack == $acknowledge->Ack) {	# Ack = Failure, we hit an error while updating the PayPal Recurring Payments Profile Status
	$response->vendor = serialize($fmSubscribe->getVendorShortID($acknowledge->vendor_id));	
	$fmSubscribe->redirect((array) $response, 'fault.php');
	exit;	
}

$response->vendor = serialize($fmSubscribe->getVendorShortID($acknowledge->vendor_id));
$fmSubscribe->redirect((array) $response, 'normal.php');

?>
