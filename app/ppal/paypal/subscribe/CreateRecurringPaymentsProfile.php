<?php
require_once 'PPBootStrap.php';
require_once 'FMSubscribe.php';

/*
 We arrive here after the Seller completees their FarmMade Subscribe PayPal sign-up form.
 Here, we preapre to call the CreatRecurringPayments method in the FMSubscribe class by calling
 the GetExpressCheckoutDetails API operation obtains information about the Express Checkout 
 transaction.

 This GetFMSubscribe code module uses the PayPal Merchant PHP SDK to make API call
*/

$acknowledge = new Acknowledge();
$acknowledge->Ack = 'Success';
$acknowledge->SubscribeMode = 'Create Recurring Payments (Subscription) Profile';
# echo "<pre>\$acknowledge = "; var_dump($acknowledge); echo PHP_EOL."</pre>";

# Following 'token' is timestamped token, the value of which was returned by`SetExpressCheckout` response.
$token = trim($_REQUEST['token']);
# For code testing.....
# 	$token = 'EC-6WS641801J991714T';

$getExpressCheckoutDetailsRequest = new GetExpressCheckoutDetailsRequestType($token);

$getExpressCheckoutReq = new GetExpressCheckoutDetailsReq();
$getExpressCheckoutReq->GetExpressCheckoutDetailsRequest = $getExpressCheckoutDetailsRequest;

# Create service wrapper object:
#	Create service wrapper object to make API call and loading.
#	PPConfigManager::getInstance()->config returns array that contains credential and config parameters.
$paypalService = new PayPalAPIInterfaceServiceService($config);

try {
	# Wrap API method calls on the service object with a try catch
	$getECResponse = $paypalService->GetExpressCheckoutDetails($getExpressCheckoutReq);
} catch (Exception $ex) {
	echo "Exception \$ex = "; var_dump($ex);
	exit;
}


$Token = $getECResponse->GetExpressCheckoutDetailsResponseDetails->Token;
$Payer = $getECResponse->GetExpressCheckoutDetailsResponseDetails->PayerInfo->Payer;
$PayerID = $getECResponse->GetExpressCheckoutDetailsResponseDetails->PayerInfo->PayerID;
$PayerName = $getECResponse->GetExpressCheckoutDetailsResponseDetails->PayerInfo->PayerName;
$payerCountry = $getECResponse->GetExpressCheckoutDetailsResponseDetails->PayerInfo->PayerCountry;
$acknowledge->home = $home = $getECResponse->GetExpressCheckoutDetailsResponseDetails->Custom;
$acknowledge->vendor_id = $getECResponse->GetExpressCheckoutDetailsResponseDetails->InvoiceID;

/*	
echo '<pre>';
echo "Ack: ".$getECResponse->Ack.PHP_EOL;	# Nominally: "Success"
echo "Token: ".$token.PHP_EOL;
echo "Payer: ".$Payer.PHP_EOL;
echo "PayerID: ".$PayerID.PHP_EOL;
echo "PayerCountry: ".$payerCountry.PHP_EOL;
echo "\$home: ".$home.PHP_EOL;
echo "\$vendor_id: "; var_dump($vendor_id);
echo '</pre>';
*/
# Note: deal with Ack = Failure return here. Nominal return is Ack = Success
if ($getECResponse->Ack != 'Success') {
	$acknowledge->Ack = $getECResponse->Ack;	# Nominally Ack = 'Failure'
	$acknowledge->ShortMessage = $setECResponse->Errors[0]->ShortMessage;
	$acknowledge->LongMessage = $setECResponse->Errors[0]->LongMessage;
	$acknowledge->ErrorCode = $setECResponse->Errors[0]->ErrorCode;
	$fmSubscribe->redirect($ack, 'fault.php');
	exit;
}

$fmSubscribe = new FMSubscribe($config, $acknowledge->home);
# Check to see if the Seller's `vendor` database table record exists.
$vendor = $fmSubscribe->getVendorShortID($acknowledge->vendor_id);
# echo "<pre>\$vendor = "; var_dump($vendor); echo "</pre>";
if (!is_null($vendor)) {		# Seller's `vendor` database table record does exist.
	# Check for identiacl PayPal Recurring Payments (Subscription) entry
	if ($vendor->vendor_PP_PayerID == $PayerID ) {
		$acknowledge->Ack = 'Failure';
		$acknowledge->ShortMessage = 'Please enter a different Seller\'s PayPal account for your FarmMade PayPal account.';
		$acknowledge->LongMessage = sprintf("Your FarmMade Seller [%s %s] PayPal account: \"%s,\" is already registered.",
		$vendor->vendor_first_name, $vendor->vendor_last_name, $Payer);
		$fmSubscribe->redirect((array) $acknowledge, 'fault.php');
		exit;
	}
}
$acknowledge->vendor_id = $vendor->vendor_id;
$acknowledge->vendor = serialize($vendor);
# We are about to create a new FarmMade PayPal Recurring Payments (Subscription_
# 	First: delete the present PayPal Recurring Payments, if it exists....
if (!is_null($vendor->vendor_PP_ProfileStatus) && $vendor->vendor_PP_ProfileStatus != 'Cancelled') {
	$ackCancel = $fmSubscribe->cancelRecurringPaymentsProfile($vendor->vendor_id);
	if ($ackCancel->Ack != 'Success') {
		$fmSubscribe->redirect((array) $ackCancel, 'fault.php');
		exit;
	} 
}
$profileData = new stdClass();
$profileData->PayerID = $getECResponse->GetExpressCheckoutDetailsResponseDetails->PayerInfo->PayerID;
$profileData->PayerEmail = $getECResponse->GetExpressCheckoutDetailsResponseDetails->PayerInfo->Payer;
$profileData->ProfileID = $profileData->ProfileStatus = $profileData->ProfileStartDate = null;
$profileData->PayerCountry = $getECResponse->GetExpressCheckoutDetailsResponseDetails->PayerInfo->PayerCountry;
$profileData->vendor_id = (int) $vendor->vendor_id;

$createRPProfile = $fmSubscribe->createRecurringPaymentsProfile($profileData, $getECResponse->GetExpressCheckoutDetailsResponseDetails->PayerInfo, $vendor, $Token);
if ($createRPProfile->Ack != 'Success') {	# We failed!
	$fmSubscribe->redirect((array) $createRPProfile, 'fault.php');	
	exit;
}
# echo "<pre>\$createRPProfile = "; var_dump($createRPProfile); echo PHP_EOL.'</pre>';


# Normal return
$acknowledge->vendor = serialize($createRPProfile->vendor);
$fmSubscribe->redirect((array) $acknowledge, 'normal.php');
/*
echo '<pre>';
echo "CreateRecurringPaymentsProfile.php: \$createRPProfile return = "; print_r($createRPProfile);
echo "Next: create a return to: ".$home."/normal.php";
echo '</pre>';
*/
?>