<?php
require_once 'PPBootStrap.php';
require_once 'FMSubscribe.php';

# $billingStartDate = date("Y-m-d").'T'.date("H:i:s").'Z';

# echo "\$billingStartDate = $billingStartDate".PHP_EOL;


$address1 = new AddressType();      # vendor_id = 543
$address1->Name = 'Pete Mackie';
$address1->Street1 = '4200 N.W. Columbia Ave';
$address1->CityName = 'Portland';
$address1->StateOrProvince = 'OR';
$address1->Country = 'US';
$address1->PostalCode = '97229-2952';

$address2 = new AddressType();      # vendor_id = 563
$address2->Name = 'Sam Subscribe';
$address2->Street1 = '1234 Anywhere St.';
$address2->CityName = 'Pudunksville';
$address2->StateOrProvince = 'WA';
$address2->Country = 'US';
$address2->PostalCode = '98123';

$address3 = new AddressType();      # vendor_id = 563
$address3->Name = 'New Person';
$address3->Street1 = '2010 S.W. Broadway';
$address3->CityName = 'Portland';
$address3->StateOrProvince = 'OR';
$address3->Country = 'US';
$address3->PostalCode = '97123';

# $home = 'http://localhost/subscr/index.php';    # Most any URL so that I can instantiate the FMSubscribe class
$home = 'http://ppal.farmmade.us/index.php';    # Most any URL so that I can instantiate the FMSubscribe class

$profileID = 'I-4J2RKGY62BB7';  $vendor_id = 536;   # 

# * FarmMade Subscribe Sandbox Test Account: petes@myfarm.com / 3ka7wp10

# Get Recurring PaymentsProfile Details: returns information about a PayPal Recurring Payments profile.
//
echo "<pre>\$config = "; var_dump($config); 
echo "\$home = "; var_dump($home); echo "</pre>";
# $fmSubscribe = new FMSubscribe($config, $home);
# echo "<pre>\$fmSubscribe = "; var_dump($fmSubscribe); echo "</pre>";
# exit;
	
try {
	$fmSubscribe = new FMSubscribe($config, $home);
	$rpProfileDetails = $fmSubscribe->getRecurringPaymentsProfileDetails($profileID);
	# $test = get_class($rpProfileDetails);
	# echo "\$rpProfileDetails class = ".get_class($rpProfileDetails).PHP_EOL;
	echo "Get Recurring PaymentsProfile Details: \$rpProfileDetails = ".PHP_EOL; var_dump($rpProfileDetails);
} catch (Exception $ex) {
	$msg = getExceptionMessage($ex);
	echo "getRecurringPaymentsProfileDetails Exception = "; print_r($msg);
}
exit;
//

#  Manage Recurring Payments Profile Status: operation cancels, suspends, or reactivates a recurring payments profile. 
//
try {
	$fmSubscribe = new FMSubscribe($config, $home);
	# There are three actions that can be performed on a recurring payaments profile
	# $action = 'Cancel';
	$action = 'Suspend';
	# $action = 'Reactivate';
	$result = $fmSubscribe->manageRecurringPaymentsProfileStatus($profileID, $action);
	echo "Manage Recurring Payments Profile Status: \$result = ".PHP_EOL; var_dump($result);
} catch (Exception $ex) {
	$msg = getExceptionMessage($ex);
	echo "manageRecurringPaymentsProfileStatus Exception = "; print_r($msg);
}
exit;
//

#   Cancel Recurring Payments Profile
//
try {
	$fmSubscribe = new FMSubscribe($config, $home);
	$result = $fmSubscribe->cancelRecurringPaymentsProfile($vendor_id);      # API method call takes a `vendor_id`, where all other methods require a ProfileID paramter
	echo "Cancel Recurring Payments Profile: \$result = ".PHP_EOL; var_dump($result);
} catch (Exception $ex) {
	$msg = getExceptionMessage($ex);
	echo "Cancel Recurring Payments Profile Exception = "; print_r($msg);
}
exit;
//

#   Update Recurring Payments Profile Address
/*
try {
	$fmSubscribe = new FMSubscribe($config, $home);
	$response = $fmSubscribe->updateRecurringPaymentsProfileAddress($profileID, $address3);
	echo "Update Recurring Payments Profile Address: \$response = "; var_dump($response);
} catch (Exception $ex) {
	$msg = getExceptionMessage($ex);
	echo "Update Recurring Payments Profile Address Exception = "; print_r($msg);
}
exit;
*/

#   Update Recurring Payments Profile Trial Period
/*
try {
	$trialBillingCycles = 5;
	$fmSubscribe = new FMSubscribe($config, $home);
	$response = $fmSubscribe->updateRecurringPaymentsProfileTrialPeriod($profileID, $trialBillingCycles);
	echo "Update Recurring Payments Profile Trial Period: \$response = "; var_dump($response);
} catch (Exception $ex) {
	$msg = getExceptionMessage($ex);
	echo "Update Recurring Payments Profile Trial Period Exception = "; print_r($msg);
}
exit;
*/

# Update Vendor Profile Data in the `vendor` database table
#   Note: this test has nothing to do with PayPal Recurriing Payments I/O
/*
	# Default data for restore
	$profileData = new stdClass();
	$profileData->PayerID = 'GWLZ64Z6XE5DY';
	$profileData->PayerEmail = 'jim@abccorp.com';
	$profileData->ProfileID = 'I-TKGD5YFEEFEN';
	$profileData->ProfileStatus = 'Active';
	$profileData->ProfileStartDate = '2013-11-07';
	$profileData->PayerCountry = 'US';
	$profileData->vendor_is_subscription_fee = true;
	$profileData->vendor_id = 563;

	# Default data for for database update testing
	$profileDataTest = new stdClass();
	$Id does not
	
	DataTest->PayerID = 'me';
	$profileDataTest->PayerEmail = 'jim@abccorp.com';
	$profileDataTest->ProfileID = 'ProfileID';
	$profileDataTest->ProfileStatus = 'ProfileStatus';
	$profileDataTest->ProfileStartDate = '2013-11-06';
	# $profileDataTest->ProfileStartDate = null;
	$profileDataTest->PayerCountry = 'CA';
	$profileDataTest->vendor_is_subscription_fee = false;
	$profileDataTest->vendor_id = 563;

	$fmSubcribe = new FMSubscribe($config);
	$rowCount = $fmSubcribe->updateVendorProfileData($profileData);
	printf("Updated %1d rows. Update Vendor Profile Data finished.\n", $rowCount);
exit;
*/


# Get the Vendor Info from the `vendor` database table.
# There are two method call options, short and all (Info)
#   FMSubscribe::getVendorShort test and # FMSubscribe::getVendorInfo testa
/*
	$vendor_id = '543';
	$vendor_id = '563'; $profileID = 'I-TKGD5YFEEFEN';
	$fmSubcribe = new FMSubscribe($config $home);
	$vendorInfo = $fmSubcribe->getVendorShort($profileID);
	echo "getVendorShort: \$vendorInfo = "; var_dump($vendorInfo); echo PHP_EOL;
	$vendorInfo = $fmSubcribe->getVendorInfo($vendor_id);
	echo "getVendorInfo: \$vendorInfo = "; var_dump($vendorInfo);

exit;
*/

# FMSubscribe::initLogSubscribe and FMSubscribe::insertLogSubscribe method call tests
/*
	$profileID = 'I-TKGD5YFEEFEN';
	$fmSubcribe = new FMSubscribe($config);
	$logSubscribe = $fmSubcribe->initLogSubscribe($profileID, 'InitLogSubscribe Test');
	echo "initLogSubscribe: \$logSubscribe = "; var_dump($logSubscribe); echo PHP_EOL;
	$fmSubcribe->insertLogSubscribe($logSubscribe, $errorType);
	echo "insertLogSubscribe finished".PHP_EOL;
exit;
*/

# FMSubscribe::initLogSubscribe and FMSubscribe::logRecurringPaymentsFailure method call tests

	$profileID = 'I-TKGD5YFEEFEN';
	$errorType = new ErrorType();
	$errorType->ShortMessage = 'Short message';
	$errorType->LongMessage = 'Long message';
	$errorType->ErrorCode = '86534';
	$errorType->SeverityCode = 'Severe';
	# $errorType->ErrorParameters = '';
	
	$fmSubcribe = new FMSubscribe($config);
	$logSubscribe = $fmSubcribe->initLogSubscribe($profileID, 'LogRecurringPaymentsFailure Test');
	$logSubscribe->rpAck = 'Failure';  # Simulation parameter
	echo "initLogSubscribe: \$logSubscribe = "; var_dump($logSubscribe); echo PHP_EOL;
	$response = $fmSubcribe->logRecurringPaymentsFailure($logSubscribe, $errorType);
	echo "logRecurringPaymentsFailure finished, \$response = "; var_dump($response);
exit;



/**
 *  Format PayPal Recurring Payment (subscription) exception messages for return to FarmMade website multivendor code.
 * 
 *  @param Exception $ex
 *  √
 */
function getExceptionMessage(Exception $ex) {
	var_dump($ex);      
	$msg = array('ex_message' => '', 'ex_detailed_message' => '', 'ex_type' => 'Unknown');
	$msg['ex_message'] = $ex->getMessage();
	$msg['ex_type']  = get_class($ex);
	# $file = $ex->getFile();   echo "\$file = $file".PHP_EOL;
	# $line = getLine();        echo "\$line = $line".PHP_EOL;
	
	if($ex instanceof PPConnectionException) {
		$msg['ex_detailed_message'] = "Error connecting to " . $ex->getUrl();
	} else if($ex instanceof PPMissingCredentialException || $ex instanceof PPInvalidCredentialException) {
		$msg['ex_detailed_message'] = $ex->errorMessage();
	} else if($ex instanceof PPConfigurationException) {
		$msg['ex_detailed_message'] = "Invalid configuration. Please check your configuration file.";
	}
	return $msg;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
	<head>
		<title></title>
	</head>
	<body>
	</body>
</html>
