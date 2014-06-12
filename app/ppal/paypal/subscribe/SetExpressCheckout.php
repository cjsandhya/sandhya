<?php
//die(__FILE__);
//require_once 'PPBootStrap.php';
//require_once 'FMSubscribe.php';

session_start();

//custom code for Magento
$_SESSION['home'] = 'http://localhost/sandhya';
$_SESSION['vendor_id'] = '546';

/*	For testing.
if (!is_null($_SESSION['vendor_id'])) {
	echo "<pre>";
	echo "\$_SESSION['vendor_id'] = ".$_SESSION['vendor_id'].PHP_EOL;
	echo "\$_SESSION['home'] = ".$_SESSION['home'].PHP_EOL;
	echo "</pre> ";
}
*/



/*  Autoloader file */
 class PPAutoloader {
	 	private static $map = array (
  'abstractrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'abstractresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'activationdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'additionalfeetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'addresstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'addressverifyreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'addressverifyrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'addressverifyresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'airlineitinerarytype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'apicredentialstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'attributecontainertestclass' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/tests/PPMessageTest.php',
  'attributetestclass' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/tests/PPMessageTest.php',
  'auctioninfotype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'authorizationinfotype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'authorizationrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'authorizationresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'authsignature' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/auth/PPAuth.php',
  'bankaccountdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'basicamounttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'baupdaterequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'baupdateresponsedetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'baupdateresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'billagreementupdatereq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'billingagreementdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'billingapprovaldetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'billingperioddetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'billingperioddetailstype_update' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'billoutstandingamountreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'billoutstandingamountrequestdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'billoutstandingamountrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'billoutstandingamountresponsedetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'billoutstandingamountresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'billuserreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'billuserrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'billuserresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'bmbuttonsearchreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'bmbuttonsearchrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'bmbuttonsearchresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'bmcreatebuttonreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'bmcreatebuttonrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'bmcreatebuttonresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'bmgetbuttondetailsreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'bmgetbuttondetailsrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'bmgetbuttondetailsresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'bmgetinventoryreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'bmgetinventoryrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'bmgetinventoryresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'bmlofferinfotype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'bmmanagebuttonstatusreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'bmmanagebuttonstatusrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'bmmanagebuttonstatusresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'bmsetinventoryreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'bmsetinventoryrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'bmsetinventoryresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'bmupdatebuttonreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'bmupdatebuttonrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'bmupdatebuttonresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'businessinfotype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'businessownerinfotype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'buttonsearchresulttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'buyerdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'buyerdetailtype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'cancelpermissionsrequest' => 'vendor/paypal/paypal-permissions-sdk-php-ea09fea/lib/services/Permissions/Permissions.php',
  'cancelpermissionsresponse' => 'vendor/paypal/paypal-permissions-sdk-php-ea09fea/lib/services/Permissions/Permissions.php',
  'cancelrecoupreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'cancelrecouprequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'cancelrecoupresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'completerecoupreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'completerecouprequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'completerecoupresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'configuration' => 'vendor/paypal/paypal-permissions-sdk-php-ea09fea/samples/Configuration.php',
  'coupledbucketstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'coupledpaymentinfotype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'createbillingagreementreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'createbillingagreementrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'createbillingagreementresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'createmobilepaymentreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'createmobilepaymentrequestdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'createmobilepaymentrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'createmobilepaymentresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'createrecurringpaymentsprofilereq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'createrecurringpaymentsprofilerequestdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'createrecurringpaymentsprofilerequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'createrecurringpaymentsprofileresponsedetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'createrecurringpaymentsprofileresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'creditcarddetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'creditcardnumbertypetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'devicedetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'discounttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'displaycontroldetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'doauthorizationreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'doauthorizationrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'doauthorizationresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'docancelreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'docancelrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'docancelresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'docapturereq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'docapturerequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'docaptureresponsedetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'docaptureresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'dodirectpaymentreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'dodirectpaymentrequestdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'dodirectpaymentrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'dodirectpaymentresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'doexpresscheckoutpaymentreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'doexpresscheckoutpaymentrequestdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'doexpresscheckoutpaymentrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'doexpresscheckoutpaymentresponsedetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'doexpresscheckoutpaymentresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'domobilecheckoutpaymentreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'domobilecheckoutpaymentrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'domobilecheckoutpaymentresponsedetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'domobilecheckoutpaymentresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'dononreferencedcreditreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'dononreferencedcreditrequestdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'dononreferencedcreditrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'dononreferencedcreditresponsedetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'dononreferencedcreditresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'doreauthorizationreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'doreauthorizationrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'doreauthorizationresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'doreferencetransactionreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'doreferencetransactionrequestdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'doreferencetransactionrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'doreferencetransactionresponsedetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'doreferencetransactionresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'douatpauthorizationreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'douatpauthorizationrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'douatpauthorizationresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'douatpexpresscheckoutpaymentreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'douatpexpresscheckoutpaymentrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'douatpexpresscheckoutpaymentresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'dovoidreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'dovoidrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'dovoidresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'ebayitempaymentdetailsitemtype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'enhancedcancelrecouprequestdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'enhancedcheckoutdatatype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'enhancedcompleterecouprequestdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'enhancedcompleterecoupresponsedetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'enhanceddatatype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'enhancedinitiaterecouprequestdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'enhanceditemdatatype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'enhancedpayerinfotype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'enhancedpaymentdatatype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'enhancedpaymentinfotype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'enterboardingreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'enterboardingrequestdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'enterboardingrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'enterboardingresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'errordata' => 'vendor/paypal/paypal-permissions-sdk-php-ea09fea/lib/services/Permissions/Permissions.php',
  'errorparameter' => 'vendor/paypal/paypal-permissions-sdk-php-ea09fea/lib/services/Permissions/Permissions.php',
  'errorparametertype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'errortype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'executecheckoutoperationsreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'executecheckoutoperationsrequestdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'executecheckoutoperationsrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'executecheckoutoperationsresponsedetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'executecheckoutoperationsresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'externalpartnertrackingdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'externalremembermeoptindetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'externalremembermeoptoutreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'externalremembermeoptoutrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'externalremembermeoptoutresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'externalremembermeownerdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'externalremembermestatusdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'faultmessage' => 'vendor/paypal/paypal-permissions-sdk-php-ea09fea/lib/services/Permissions/Permissions.php',
  'flightdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'flowcontroldetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'fmfdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'formatterfactory' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/formatters/FormatterFactory.php',
  'fundingsourcedetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getaccesspermissiondetailsreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getaccesspermissiondetailsrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getaccesspermissiondetailsresponsedetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getaccesspermissiondetailsresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getaccesstokenrequest' => 'vendor/paypal/paypal-permissions-sdk-php-ea09fea/lib/services/Permissions/Permissions.php',
  'getaccesstokenresponse' => 'vendor/paypal/paypal-permissions-sdk-php-ea09fea/lib/services/Permissions/Permissions.php',
  'getadvancedpersonaldatarequest' => 'vendor/paypal/paypal-permissions-sdk-php-ea09fea/lib/services/Permissions/Permissions.php',
  'getadvancedpersonaldataresponse' => 'vendor/paypal/paypal-permissions-sdk-php-ea09fea/lib/services/Permissions/Permissions.php',
  'getauthdetailsreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getauthdetailsrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getauthdetailsresponsedetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getauthdetailsresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getbalancereq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getbalancerequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getbalanceresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getbasicpersonaldatarequest' => 'vendor/paypal/paypal-permissions-sdk-php-ea09fea/lib/services/Permissions/Permissions.php',
  'getbasicpersonaldataresponse' => 'vendor/paypal/paypal-permissions-sdk-php-ea09fea/lib/services/Permissions/Permissions.php',
  'getbillingagreementcustomerdetailsreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getbillingagreementcustomerdetailsrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getbillingagreementcustomerdetailsresponsedetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getbillingagreementcustomerdetailsresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getboardingdetailsreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getboardingdetailsrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getboardingdetailsresponsedetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getboardingdetailsresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getexpresscheckoutdetailsreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getexpresscheckoutdetailsrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getexpresscheckoutdetailsresponsedetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getexpresscheckoutdetailsresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getincentiveevaluationreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getincentiveevaluationrequestdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getincentiveevaluationrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getincentiveevaluationresponsedetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getincentiveevaluationresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getmobilestatusreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getmobilestatusrequestdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getmobilestatusrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getmobilestatusresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getpaldetailsreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getpaldetailsrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getpaldetailsresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getpermissionsrequest' => 'vendor/paypal/paypal-permissions-sdk-php-ea09fea/lib/services/Permissions/Permissions.php',
  'getpermissionsresponse' => 'vendor/paypal/paypal-permissions-sdk-php-ea09fea/lib/services/Permissions/Permissions.php',
  'getrecurringpaymentsprofiledetailsreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getrecurringpaymentsprofiledetailsrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getrecurringpaymentsprofiledetailsresponsedetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'getrecurringpaymentsprofiledetailsresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'gettransactiondetailsreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'gettransactiondetailsrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'gettransactiondetailsresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'identificationinfotype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'identitytokeninfotype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'incentiveapplieddetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'incentiveappliedtotype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'incentiveapplyindicationtype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'incentivebuckettype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'incentivedetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'incentivedetailtype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'incentiveinfotype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'incentiveitemtype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'incentiverequestdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'infosharingdirectivestype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'initiaterecoupreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'initiaterecouprequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'initiaterecoupresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'installmentdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'instrumentdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'invoiceitemtype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'ippcredential' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/auth/IPPCredential.php',
  'ippformatter' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/formatters/IPPFormatter.php',
  'ipphandler' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/handlers/IPPHandler.php',
  'ippthirdpartyauthorization' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/auth/IPPThirdPartyAuthorization.php',
  'itemtrackingdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'managependingtransactionstatusreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'managependingtransactionstatusrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'managependingtransactionstatusresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'managerecurringpaymentsprofilestatusreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'managerecurringpaymentsprofilestatusrequestdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'managerecurringpaymentsprofilestatusrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'managerecurringpaymentsprofilestatusresponsedetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'managerecurringpaymentsprofilestatusresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'masspayreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'masspayrequestitemtype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'masspayrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'masspayresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'measuretype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'merchantdatatype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'merchantpullinfotype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'merchantpullpaymentresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'merchantpullpaymenttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'merchantstoredetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'mobileidinfotype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'mockoauthdatastore' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/auth/AuthUtil.php',
  'oauthconsumer' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/auth/PPAuth.php',
  'oauthdatastore' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/auth/PPAuth.php',
  'oauthexception' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/auth/PPAuth.php',
  'oauthrequest' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/auth/PPAuth.php',
  'oauthserver' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/auth/PPAuth.php',
  'oauthsignaturemethod' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/auth/PPAuth.php',
  'oauthsignaturemethod_hmac_sha1' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/auth/PPAuth.php',
  'oauthsignaturemethod_plaintext' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/auth/PPAuth.php',
  'oauthsignaturemethod_rsa_sha1' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/auth/PPAuth.php',
  'oauthtoken' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/auth/PPAuth.php',
  'oauthutil' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/auth/PPAuth.php',
  'offercouponinfotype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'offerdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'optiondetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'optionselectiondetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'optiontrackingdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'optiontype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'orderdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'otherpaymentmethoddetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'payerinfotype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'paymentdetailsitemtype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'paymentdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'paymentdirectivestype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'paymentinfotype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'paymentiteminfotype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'paymentitemtype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'paymentrequestinfotype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'paymenttransactionsearchresulttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'paymenttransactiontype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'paypalapiinterfaceserviceservice' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceServiceService.php',
  'permissionsservice' => 'vendor/paypal/paypal-permissions-sdk-php-ea09fea/lib/services/Permissions/PermissionsService.php',
  'personalattributelist' => 'vendor/paypal/paypal-permissions-sdk-php-ea09fea/lib/services/Permissions/Permissions.php',
  'personaldata' => 'vendor/paypal/paypal-permissions-sdk-php-ea09fea/lib/services/Permissions/Permissions.php',
  'personaldatalist' => 'vendor/paypal/paypal-permissions-sdk-php-ea09fea/lib/services/Permissions/Permissions.php',
  'personnametype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'phonenumbertype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'ppapicontext' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/common/PPApiContext.php',
  'ppapiservice' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/PPAPIService.php',
  'ppapiservicetest' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/tests/PPAPIServiceTest.php',
  'pparrayutil' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/common/PPArrayUtil.php',
  'ppauthenticationhandler' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/handlers/PPAuthenticationHandler.php',
  'ppbaseservice' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/PPBaseService.php',
  'ppbaseservicetest' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/tests/PPBaseServiceTest.php',
  'ppcertificateauthhandler' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/handlers/PPCertificateAuthHandler.php',
  'ppcertificatecredential' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/auth/PPCertificateCredential.php',
  'ppcertificatecredentialtest' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/tests/PPCertificateCredentialTest.php',
  'ppconfigmanager' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/PPConfigManager.php',
  'ppconfigmanagertest' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/tests/PPConfigManagerTest.php',
  'ppconfigurationexception' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/exceptions/PPConfigurationException.php',
  'ppconfigurationexceptiontest' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/tests/PPConfigurationExceptionTest.php',
  'ppconnectionexception' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/exceptions/PPConnectionException.php',
  'ppconnectionexceptiontest' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/tests/PPConnectionExceptionTest.php',
  'ppconnectionmanager' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/PPConnectionManager.php',
  'ppconnectionmanagertest' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/tests/PPConnectionManagerTest.php',
  'ppconstants' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/PPConstants.php',
  'ppcredentialmanager' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/PPCredentialManager.php',
  'ppcredentialmanagertest' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/tests/PPCredentialManagerTest.php',
  'ppgenericservicehandler' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/handlers/PPGenericServiceHandler.php',
  'pphttpconfig' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/PPHttpConfig.php',
  'pphttpconnection' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/PPHttpConnection.php',
  'ppinvalidcredentialexception' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/exceptions/PPInvalidCredentialException.php',
  'ppinvalidcredentialexceptiontest' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/tests/PPInvalidCredentialExceptionTest.php',
  'ppipnmessage' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/ipn/PPIPNMessage.php',
  'ppipnmessagetest' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/tests/PPIPNMessageTest.php',
  'pplogginglevel' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/PPLoggingManager.php',
  'pploggingmanager' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/PPLoggingManager.php',
  'pploggingmanagertest' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/tests/PPLoggingManagerTest.php',
  'ppmerchantservicehandler' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/handlers/PPMerchantServiceHandler.php',
  'ppmessage' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/PPMessage.php',
  'ppmessagetest' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/tests/PPMessageTest.php',
  'ppmissingcredentialexception' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/exceptions/PPMissingCredentialException.php',
  'ppmissingcredentialexceptiontest' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/tests/PPMissingCredentialExceptionTest.php',
  'ppmodel' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/common/PPModel.php',
  'ppnvpformatter' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/formatters/PPNVPFormatter.php',
  'ppopenidaddress' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/auth/openid/PPOpenIdAddress.php',
  'ppopenidaddresstest' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/tests/openid/PPOpenIdAddressTest.php',
  'ppopeniderror' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/auth/openid/PPOpenIdError.php',
  'ppopenidhandler' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/handlers/PPOpenIdHandler.php',
  'ppopenidsession' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/auth/openid/PPOpenIdSession.php',
  'ppopenidsessiontest' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/tests/openid/PPOpenIdSessionTest.php',
  'ppopenidtokeninfo' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/auth/openid/PPOpenIdTokeninfo.php',
  'ppopenidtokeninfotest' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/tests/openid/PPOpenIdTokeninfoTest.php',
  'ppopeniduserinfo' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/auth/openid/PPOpenIdUserinfo.php',
  'ppopeniduserinfotest' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/tests/openid/PPOpenIdUserinfoTest.php',
  'ppplatformservicehandler' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/handlers/PPPlatformServiceHandler.php',
  'ppreflectionutil' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/common/PPReflectionUtil.php',
  'pprequest' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/PPRequest.php',
  'pprestcall' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/transport/PPRestCall.php',
  'ppsignatureauthhandler' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/handlers/PPSignatureAuthHandler.php',
  'ppsignaturecredential' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/auth/PPSignatureCredential.php',
  'ppsignaturecredentialtest' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/tests/PPSignatureCredentialTest.php',
  'ppsoapformatter' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/formatters/PPSOAPFormatter.php',
  'ppsubjectauthorization' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/auth/PPSubjectAuthorization.php',
  'pptokenauthorization' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/auth/PPTokenAuthorization.php',
  'pptransformerexception' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/exceptions/PPTransformerException.php',
  'ppuseragent' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/common/PPUserAgent.php',
  'pputils' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/PPUtils.php',
  'pputilstest' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/tests/PPUtilsTest.php',
  'ppxmlmessage' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/PPXmlMessage.php',
  'receiverinfotype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'recurringpaymentsprofiledetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'recurringpaymentssummarytype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'referencecreditcarddetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'refreshtokenstatusdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'refundinfotype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'refundtransactionreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'refundtransactionrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'refundtransactionresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'remembermeidinfotype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'requestenvelope' => 'vendor/paypal/paypal-permissions-sdk-php-ea09fea/lib/services/Permissions/Permissions.php',
  'requestpermissionsrequest' => 'vendor/paypal/paypal-permissions-sdk-php-ea09fea/lib/services/Permissions/Permissions.php',
  'requestpermissionsresponse' => 'vendor/paypal/paypal-permissions-sdk-php-ea09fea/lib/services/Permissions/Permissions.php',
  'responseenvelope' => 'vendor/paypal/paypal-permissions-sdk-php-ea09fea/lib/services/Permissions/Permissions.php',
  'reversetransactionreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'reversetransactionrequestdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'reversetransactionrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'reversetransactionresponsedetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'reversetransactionresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'riskfilterdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'riskfilterlisttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'scheduledetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'sellerdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'senderdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'setaccesspermissionsreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'setaccesspermissionsrequestdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'setaccesspermissionsrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'setaccesspermissionsresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'setauthflowparamreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'setauthflowparamrequestdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'setauthflowparamrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'setauthflowparamresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'setcustomerbillingagreementreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'setcustomerbillingagreementrequestdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'setcustomerbillingagreementrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'setcustomerbillingagreementresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'setdatarequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'setdataresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'setexpresscheckoutreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'setexpresscheckoutrequestdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'setexpresscheckoutrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'setexpresscheckoutresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'setmobilecheckoutreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'setmobilecheckoutrequestdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'setmobilecheckoutrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'setmobilecheckoutresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'shippingoptiontype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'simplecontainertestclass' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/tests/PPMessageTest.php',
  'simpletestclass' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/tests/PPMessageTest.php',
  'subscriptioninfotype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'subscriptiontermstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'taxiddetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'threedsecureinfotype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'threedsecurerequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'threedsecureresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'transactionsearchreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'transactionsearchrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'transactionsearchresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'tupletype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'uatpdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'updateaccesspermissionsreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'updateaccesspermissionsrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'updateaccesspermissionsresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'updateauthorizationreq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'updateauthorizationrequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'updateauthorizationresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'updaterecurringpaymentsprofilereq' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'updaterecurringpaymentsprofilerequestdetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'updaterecurringpaymentsprofilerequesttype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'updaterecurringpaymentsprofileresponsedetailstype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'updaterecurringpaymentsprofileresponsetype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'userselectedoptiontype' => 'vendor/paypal/paypal-merchant-sdk-php-4f570f5/lib/services/PayPalAPIInterfaceService/PayPalAPIInterfaceService.php',
  'xmltoarray' => 'vendor/paypal/paypal-sdk-core-php-2ee73c7/lib/PPUtils.php',
);

		public static function loadClass($class) {
	        $class = strtolower(trim($class, '\\'));

    	    if (isset(self::$map[$class])) {
            	require dirname(__FILE__) . '/' . self::$map[$class];
        	}
    	}

		public static function register() {
	        spl_autoload_register(array(__CLASS__, 'loadClass'), true);
    	}
}



/* PPBootstrap.php                */



/*
  Include this file in your application. This file sets up the required classloader based on 
  whether you used composer or the custom installer.
*/

/*
 * @constant PP_CONFIG_PATH required if credentoal and configuration is to be used from a file
 * Let the SDK know where the sdk_config.ini file resides.
 */
define("PP_CONFIG_PATH", __DIR__ . '/config');
//echo ( __DIR__ );
//exit;


/*
 * Use PPAutoloader.php
 */
//require 'PPAutoloader.php';
PPAutoloader::register();

define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);
define('BILLING_AGREEMENT', 'FarmMade Shop $5 monthly subscription');
define('CURRENCY_CODE', 'USD');
define('SUBSCRIBE_FEE', 5.00);
define('NO_FEE', 0.00);

/*
 * Load up $config parameter from ~/config/sdk_config.ini and establish
 * PayPal site-woide access parameters.
 */
$config = PPConfigManager::getInstance()->config;
define('USERNAME', $config['acct1.UserName']);
define('PASSWORD', $config['acct1.Password']);
define('SIGNATURE',$config['acct1.Signature']);
# Force logging if a PayPal sandbox is being used
if ($config['mode'] == 'sandbox') {
	$config['log.LogLevel'] = 'WARN';
	$config['log.LogEnabled'] = '1';
}

$magePath = dirname(pathinfo(dirname(__FILE__), PATHINFO_DIRNAME)).DS.'app/etc/local.xml';
/*
# echo "\$config = "; var_dump($config);
foreach ($config as $key => $value) {
	echo "$key = $value<br>";
}
echo "USERNAME = ".USERNAME.'<br>';
echo "PASSWORD = ".PASSWORD.'<br>';
echo "SIGNATURE = ".SIGNATURE.'<br>';
*/

/*  FMSubscribe    */


//require_once 'LogSubscribe.php';
//require_once 'Acknowledge.php';
$doc = new DOMDocument('1.0');
$doc->load($magePath);
define('DB_HOST', $doc->getElementsByTagName('host')->item(0)->nodeValue);
define('DB_USERNAME', $doc->getElementsByTagName('username')->item(0)->nodeValue);
define('DB_PASSWD', $doc->getElementsByTagName('password')->item(0)->nodeValue); 
define('DB_NAME', $doc->getElementsByTagName('dbname')->item(0)->nodeValue);
$doc = null;

/*
echo "DB_HOST = ".DB_HOST.'<br>';
echo "DB_USERNAME = ".DB_USERNAME.'<br>';
echo "DB_PASSWD = ".DB_PASSWD.'<br>';
echo "DB_NAME = ".DB_NAME.'<br>';
*/

# Note: $ipaddress = $_SERVER["REMOTE_ADDR"];

class FMSubscribe {
	private $timeStamp;
	private $config;
	private $mysqli;
	public $home;
	public $website;
	
	const  errorPrefix = 'FMSubscribe object: ';
	# ---- FarmMade PayPal Recurring Payments (Subscribe) Constants...
	const BILLING_FREQUENCY = 1;
	const BILLING_PERIOD = 'Month';
	const BILLING_AMOUNT = '5.00';
	const ZERO_AMOUNT = '0.00';
	const TAX_AMOUNT = '0.00';
	const CURRENCY_CODE = 'USD';
	const TRIAL_BILLING_CYCLES = 2;		# Months
	const TRIAL_AMOUNT = '0.00';
	const MAX_FAILED_PAYMENTS = 3;
	const AUTO_BILL_OUTSTANDING = 'AddToNextBilling';	# Choices are: 'NoAutoBill' and 'AddToNextBilling'
	const HOME_PAGE = 'index.php';	
	const ACK = 'Acknowledge';
	const SUCCESS = 'Success';
	const FAILURE = 'Failure';

	# √	
	public function __construct(Array $config, $home) {
		# error_reporting(0);	# Silence error messages and return them to calling object client
		$this->home = $home;
		$this->website = preg_replace('/'.self::HOME_PAGE.'/', '', $home);
		$this->timeStamp = date("Y-m-d").'T'.date("H:i:s");
		$this->config = $config;
		# $config = PPConfigManager::getInstance()->config;
		# $this->config = array ('mode' => $config['mode'], 'acct1.UserName' => $config['acct1.UserName'],
		#	'acct1.Password' => $config['acct1.Password'],'acct1.Signature' => $config['acct1.Signature']);
		# Database I/O connection
        $this->mysqli = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWD, DB_NAME);
		if (mysqli_connect_errno()) {
			$msg=self::errorPrefix."could not connect: ".mysqli_connect_error();
			throw new Exception($msg);
		}
	}

	function __destruct() {
		$this->mysqli->close();
		$this->mysqli = null;
	}

	/**
	 *	createRecurringPaymentsProfile method creates a PayPal Recurring Payments Profile. You must invoke the
	 * 	CreateRecurringPaymentsProfile API operation for each profile you want to create. The API operation
	 *	creates a profile and an associated billing agreement.
	 *
	 * Note: There is a one-to-one correspondence between billing agreements and PayPal Recurring Payments Profiles. 
	 *  	To associate a PayPal Recurring Payments Profile with its billing agreement, you must ensure that the description in the
	 *  	PayPal Recurring Payments Profile matches the description of a billing agreement. For version 54.0 and later, use 
	 *  	SetExpressCheckout to initiate creation of a billing agreement.
	 *
	 * This code uses Merchant PHP SDK to make API call.
	 *
	 *	@var stdClass $profileData	$profileData object properties are: PayerID, ProfileID, ProfileStatus, ProfileStartDate, PayerCountry, and $vendor_id q
	 *	@var stdClass $vendor		PayPal Recurring Payments Profile parameters in the `vendor` database table
	 *	@var string $Token
	 *
	 *	@return stdClass object 	'Acknowledge::Ack: Success' or 'Acknowledge::Ack: Failure' + SubscribeMode, ShortMessage, LongMessage, and ErrorCode
	 *								Saves PayPal 'ProfileID' and 'ProfileStatus' parameters to FarmMade `vendor` database table
	 *	@throws APIException
	 *
	*/		
	public function createRecurringPaymentsProfile(stdClass $profileData, PayerInfoType $PayerInfo, $vendor, $Token) {
		$acknowledge = new Acknowledge();
		$acknowledge->Ack = self::SUCCESS;
		$acknowledge->SubscribeMode = "CreateRecurringPaymentsProfile";
		$acknowledge->vendor_id = $vendor->vendor_id;
		$acknowledge->vendor = $vendor;
		$logSubscribe = new LogSubscribe();
		$logSubscribe->log_date = $this->timeStamp;
		$logSubscribe->vendor_id = (int) $vendor->vendor_id;
		$logSubscribe->subscribe_mode = $acknowledge->SubscribeMode;
		$logSubscribe->seller_shop_name = $vendor->vendor_shop_name;
		$logSubscribe->seller_name = $vendor->vendor_first_name.' '.$vendor->vendor_last_name;
		$logSubscribe->seller_paypal_address = $PayerInfo->Payer;
		$logSubscribe->seller_PP_PayerID = $PayerInfo->PayerID;
		$logSubscribe->seller_PP_PayerCountry = $PayerInfo->PayerCountry;

		$shippingAddress = new AddressType();
		# $shippingAddress->Name = $PayerInfo->PayerName->FirstName.' '.$PayerInfo->PayerName->LastName;
		$shippingAddress->Name = $vendor->vendor_first_name.' '.$vendor->vendor_last_name;
		$shippingAddress->Street1 = $vendor->vendor_address1;
		$shippingAddress->Street2 = $vendor->vendor_address2;
		$shippingAddress->CityName = $vendor->vendor_city;
		$shippingAddress->StateOrProvince = $vendor->vendor_state_province;
		$shippingAddress->PostalCode = $vendor->vendor_zip_postal;
		$shippingAddress->Country = $PayerInfo->PayerCountry;
			
		# You can include up to 10 PayPal Recurring Payments Profiles per request. The order of the profile details must 
		# match the order of the billing agreement details specified in the SetExpressCheckout request which
		# takes mandatory argument:
		# `billing start date` - The date when billing for this profile begins.
		# Note: The profile may take up to 24 hours for activation.
		$RPProfileDetails = new RecurringPaymentsProfileDetailsType($this->timeStamp.'Z');
		$RPProfileDetails->SubscriberName = $vendor->vendor_first_name.' '.$vendor->vendor_last_name;
		$RPProfileDetails->SubscriberShippingAddress  = $shippingAddress;
		$RPProfileDetails->ProfileReference  = $vendor->vendor_id;
		# echo "\$RPProfileDetails = "; var_dump($RPProfileDetails);

		$activationDetails = new ActivationDetailsType();
		# (Optional) Initial non-recurring payment amount due immediately upon profile creation. 
		# Use an initial amount for enrolment or set-up fees.
		$activationDetails->InitialAmount = new BasicAmountType(self::CURRENCY_CODE, self::ZERO_AMOUNT);

		# Regular payment period for this schedule which takes mandatory params:
		# 	`Billing Period` - Unit for billing during this subscription period. It is one of the following values:
		# 		Day
		# 		Week
		# 		SemiMonth
		# 		Month
		# 		Year
		#	For SemiMonth, billing is done on the 1st and 15th of each month.
		# 	Note: The combination of BillingPeriod and BillingFrequency cannot exceed one year.
		#
		# 	`Billing Frequency` - Number of billing periods that make up one billing cycle.
		#		The combination of billing frequency and billing period must be less than or equal to 
		#		one year. For example, if the billing cycle is Month, the maximum value for billing 
		#		frequency is 12. Similarly, if the billing cycle is Week, the maximum value for billing
		#		frequency is 52.
		#	Note: If the billing period is SemiMonth, the billing frequency must be 1.`
		$paymentBillingPeriod = new BillingPeriodDetailsType();
		$paymentBillingPeriod->BillingFrequency = self::BILLING_FREQUENCY;
		$paymentBillingPeriod->BillingPeriod = self::BILLING_PERIOD;
		$paymentBillingPeriod->TotalBillingCycles = 0;	# Invoice the Farmmade Seller in perpituity 
		$paymentBillingPeriod->ShippingAmount = new BasicAmountType(self::CURRENCY_CODE, self::ZERO_AMOUNT);
		$paymentBillingPeriod->TaxAmount = new BasicAmountType(self::CURRENCY_CODE, self::TAX_AMOUNT);
		$paymentBillingPeriod->Amount = new BasicAmountType(self::CURRENCY_CODE, self::BILLING_AMOUNT);

		$scheduleDetails = new ScheduleDetailsType();
		$scheduleDetails->Description = BILLING_AGREEMENT;
		$scheduleDetails->PaymentPeriod = $paymentBillingPeriod;
		$scheduleDetails->ActivationDetails = $activationDetails;
		# echo "\$scheduleDetails = "; var_dump($scheduleDetails);
		
		# The trial free subscription for 60 days
		$trialBillingPeriod =  new BillingPeriodDetailsType();
		# if (is_null($vendor->vendor_PP_ProfileStatus)) {	# True if FarmMade Seller's first time signup. Create 60 day free trial.....
			$trialBillingPeriod->BillingFrequency = self::BILLING_FREQUENCY;
			$trialBillingPeriod->BillingPeriod = self::BILLING_PERIOD;	# Months
			$trialBillingPeriod->TotalBillingCycles = self::TRIAL_BILLING_CYCLES;
			$trialBillingPeriod->Amount = new BasicAmountType(self::CURRENCY_CODE, self::TRIAL_AMOUNT);
			$trialBillingPeriod->ShippingAmount = new BasicAmountType(self::CURRENCY_CODE, self::TRIAL_AMOUNT);
			$trialBillingPeriod->TaxAmount = new BasicAmountType(self::CURRENCY_CODE, self::TRIAL_AMOUNT);
			$scheduleDetails->TrialPeriod  = $trialBillingPeriod;
		# }

		$scheduleDetails->MaxFailedPayments = self::MAX_FAILED_PAYMENTS;
		$scheduleDetails->AutoBillOutstandingAmount = self::AUTO_BILL_OUTSTANDING;	# Choices are: 'NoAutoBill' and 'AddToNextBilling'

		# `CreateRecurringPaymentsProfileRequestDetailsType` which takes mandatory params:
		#	`PayPal Recurring Payments Profile Details`
		#	`Schedule Details`
		$createRPProfileRequestDetail = new CreateRecurringPaymentsProfileRequestDetailsType();
		$createRPProfileRequestDetail->Token = $Token;	
		$createRPProfileRequestDetail->ScheduleDetails = $scheduleDetails;
		$createRPProfileRequestDetail->RecurringPaymentsProfileDetails = $RPProfileDetails;

		$createRPProfileRequest = new CreateRecurringPaymentsProfileRequestType();
		$createRPProfileRequest->ErrorLanguage = 'en_US';
		$createRPProfileRequest->CreateRecurringPaymentsProfileRequestDetails = $createRPProfileRequestDetail;

		$createRPProfileReq =  new CreateRecurringPaymentsProfileReq();
		$createRPProfileReq->CreateRecurringPaymentsProfileRequest = $createRPProfileRequest;

		# Create service wrapper object:
		#	Create service wrapper object to make API call and loading
		#	$this->config provides array that contains credential and config parameters
		$paypalService = new PayPalAPIInterfaceServiceService($this->config);

		try {
			# Wrap API method calls on the service object with a try catch 
			$createRPProfileResponse = $paypalService->CreateRecurringPaymentsProfile($createRPProfileReq);
			# echo '<pre>'."FMSubscribe::createRecurringPaymentsProfile method:\n\$createRPProfileResponse = "; print_r($createRPProfileResponse); echo '</pre>';
		} catch (Exception $ex) {
			throw new Exception($ex->getMessage());
		}

		$logSubscribe->rpAck = $createRPProfileResponse->Ack;
		if (!is_null($ProfileID = $createRPProfileResponse->CreateRecurringPaymentsProfileResponseDetails->ProfileID))
			$logSubscribe->seller_PP_ProfileID = $profileData->ProfileID = $ProfileID;
		if (!is_null($ProfileStatus = $createRPProfileResponse->CreateRecurringPaymentsProfileResponseDetails->ProfileStatus)) {
			$split = preg_split('/(Profile)/', $ProfileStatus, -1, PREG_SPLIT_DELIM_CAPTURE);
			$logSubscribe->seller_PP_ProfileStatus = $profileData->ProfileStatus = $split[0];
		}
		$profileData->vendor_is_subscription_fee = true;
		$split = preg_split('/T/', $createRPProfileResponse->Timestamp, -1, PREG_SPLIT_DELIM_CAPTURE);
		$logSubscribe->seller_PP_ProfileStartDate = $profileData->ProfileStartDate = $split[0];	
		$logSubscribe->version = $createRPProfileResponse->Version;
		$logSubscribe->build = $createRPProfileResponse->Build;
		$logSubscribe->correlationId = $createRPProfileResponse->CorrelationID;
		$logSubscribe->timestmp = $createRPProfileResponse->Timestamp;
		$this->insertLogSubscribe($logSubscribe);	
		# echo '<pre>'."FMSubscribe::createRecurringPaymentsProfile method:\n\$profileData = "; print_r($profileData); echo '</pre>';

		if ($createRPProfileResponse->Ack != self::SUCCESS) 
			return $this->logRecurringPaymentsFailure($logSubscribe, $createRPProfileResponse->Errors[0]);
		$this->updateVendorProfileData($profileData);
		$acknowledge->vendor = $this->getVendorShortID($acknowledge->vendor_id);
		return $acknowledge;
	}

	/**
	 *	getRecurringPaymentsProfileDetails method returns information about a PayPal Recurring Payments Profile.
	 * 
	 *	@var string $profileID
	 *
	 *	@return stdClass object containing selected PayPal Recurring Payments Profile details
	 *	
	 *	@throws APIException
	 *	√
	 */
	public function getRecurringPaymentsProfileDetails($profileID) {	
		$logSubscribe = $this->initLogSubscribe($profileID, 'GetRecurringPaymentsProfileDetails');
		if (get_class($logSubscribe) == self::ACK)	# We hit an error. 'ProfileID does not exist for this FarmMade Seller'
			return $logSubscribe;	
		# Obtain information about a PayPal Recurring Payments Profile. 
		$getRPPDetailsReqest = new GetRecurringPaymentsProfileDetailsRequestType();

		# (Required) Recurring payments profile ID returned in the CreateRecurringPaymentsProfile response. 
		# 19-character profile IDs are supported for compatibility with previous versions of the PayPal API.
		$getRPPDetailsReqest->ProfileID = $profileID;

		$getRPPDetailsReq = new GetRecurringPaymentsProfileDetailsReq();
		$getRPPDetailsReq->GetRecurringPaymentsProfileDetailsRequest = $getRPPDetailsReqest;

		# Creating service wrapper object:
		# 	Creating service wrapper object to make API call and loading
		#	$this->config provides array that contains credential and config parameters
		$paypalService = new PayPalAPIInterfaceServiceService($this->config);
		try {
		 	# Wrap API method calls on the service object with a try catch
			$getRPPDetailsResponse = $paypalService->GetRecurringPaymentsProfileDetails($getRPPDetailsReq);
		} catch (Exception $ex) {
			echo "getRecurringPaymentsProfileDetails Exception: ";
			var_dump($ex);
			exit;
		}
		$response = $getRPPDetailsResponse->GetRecurringPaymentsProfileDetailsResponseDetails;
		if ($getRPPDetailsResponse->Ack == self::SUCCESS) {
			$ProfileStatus = preg_split('/(Profile)/', $response->ProfileStatus, -1, PREG_SPLIT_DELIM_CAPTURE);
			$BillingStartDate = preg_split('/T/', $response->RecurringPaymentsProfileDetails->BillingStartDate, -1, PREG_SPLIT_DELIM_CAPTURE);
			$logSubscribe->seller_PP_ProfileStatus =  $ProfileStatus[0];
			$logSubscribe->seller_PP_ProfileStartDate = $BillingStartDate[0];			
			$logSubscribe->seller_PP_PayerCountry = $response->RecurringPaymentsProfileDetails->SubscriberShippingAddress->Country;
		} 
		
		$logSubscribe->rpAck = $getRPPDetailsResponse->Ack;
		$logSubscribe->version = $getRPPDetailsResponse->Version;
		$logSubscribe->build = $getRPPDetailsResponse->Build;
		$logSubscribe->correlationId = $getRPPDetailsResponse->CorrelationID;
		$timeStamp = preg_split('/Z/', $getRPPDetailsResponse->Timestamp);
		$logSubscribe->timestmp = $timeStamp[0];
		$this->insertLogSubscribe($logSubscribe);

		if ($getRPPDetailsResponse->Ack != self::SUCCESS) 
			return $this->logRecurringPaymentsFailure($logSubscribe, $getRPPDetailsResponse->Errors[0]);

		$rPPDetails = new stdClass();
		$rPPDetails->vendor_PP_PayerID = $logSubscribe->seller_PP_PayerID;
		$rPPDetails->SubscriberName = $response->RecurringPaymentsProfileDetails->SubscriberName;
		$rPPDetails->vendor_PP_PayerEmail = $logSubscribe->seller_PP_PayerEmail;
		$rPPDetails->ProfileID = $response->ProfileID;
		$rPPDetails->ProfileStatus = $ProfileStatus[0];
		$rPPDetails->SubscribeDate = $response->RecurringPaymentsProfileDetails->BillingStartDate;
		$rPPDetails->vendor_id = $response->RecurringPaymentsProfileDetails->ProfileReference;
		$rPPDetails->AddressType = new stdClass();
		$rPPDetails->AddressType->Name = $response->RecurringPaymentsProfileDetails->SubscriberShippingAddress->Name;
		$rPPDetails->AddressType->Street1 = $response->RecurringPaymentsProfileDetails->SubscriberShippingAddress->Street1;
		$rPPDetails->AddressType->Street2 = $response->RecurringPaymentsProfileDetails->SubscriberShippingAddress->Street2;
		$rPPDetails->AddressType->CityName = $response->RecurringPaymentsProfileDetails->SubscriberShippingAddress->CityName;
		$rPPDetails->AddressType->StateOrProvince = $response->RecurringPaymentsProfileDetails->SubscriberShippingAddress->StateOrProvince;
		$rPPDetails->AddressType->Country = $response->RecurringPaymentsProfileDetails->SubscriberShippingAddress->Country;
		$rPPDetails->AddressType->CountryName = $response->RecurringPaymentsProfileDetails->SubscriberShippingAddress->CountryName;
		$rPPDetails->AddressType->Phone = $response->RecurringPaymentsProfileDetails->SubscriberShippingAddress->Phone;
		$rPPDetails->AddressType->PostalCode = $response->RecurringPaymentsProfileDetails->SubscriberShippingAddress->PostalCode;
		return $rPPDetails;
	}

	/**
	 *	manageRecurringPaymentsProfileStatus method cancels, suspends, or reactivates a PayPal Recurring Payments Profile.
	 *
	 *	@param string $profileID
	 *	@param string $action = 'Cancel', 'Suspend', or 'Reactivate'
	 *	
	 *	@return stdClass object 	'Ack: Success' or 'Ack: Failure' + SubscribeMode, ShortMessage, LongMessage, and ErrorCode
	 *
	 *	@throws APIException
	 *	√
	 */
	public function manageRecurringPaymentsProfileStatus($profileID, $action) {
		$vendor = $this->getVendorShort($profileID);
		$acknowledge = new Acknowledge;
		$acknowledge->Ack = self::SUCCESS;
		$acknowledge->SubscribeMode = "Manage Profile Status: ".$action;
		$acknowledge->home = $this->home;
		$acknowledge->vendor_id = $vendor->vendor_id;
		$acknowledge->vendor = $this->getVendorShort($profileID);
		$logSubscribe = $this->initLogSubscribe($profileID, $acknowledge->SubscribeMode);
		if (get_class($logSubscribe) == self::ACK)	# We hit an error. 'ProfileID does not exist for this FarmMade Seller'
			return $logSubscribe;
		switch ($action) {
			case 'Cancel':
			case 'Suspend':
			case 'Reactivate':
				break;		
			default:	# Sorry......
				$acknowledge->Ack = self::FAILURE;
				$acknowledge->ShortMessage = 'Only allowable Subscribe Status Profile Status changes are: Cancel, Suspend, and Reactivate';
				return $acknowledge;
		}		

		$manageRPPStatusReqestDetails = new ManageRecurringPaymentsProfileStatusRequestDetailsType();
		# Action: (Required) The action to be performed to the PayPal Recurring Payments Profile. Must be one of the following:
		#	Cancel -- Only profiles in Active or Suspended state can be canceled.
		#	Suspend -- Only profiles in Active state can be suspended.
		#	Reactivate -- Only profiles in a suspended state can be reactivated.
		$manageRPPStatusReqestDetails->Action =  $action;

		# ProfileID: (Required) Recurring payments profile ID returned in the CreateRecurringPaymentsProfile response.
		$manageRPPStatusReqestDetails->ProfileID =  $profileID;
	
		$manageRPPStatusReqest = new ManageRecurringPaymentsProfileStatusRequestType();
		$manageRPPStatusReqest->ManageRecurringPaymentsProfileStatusRequestDetails = $manageRPPStatusReqestDetails;

		$manageRPPStatusReq = new ManageRecurringPaymentsProfileStatusReq();
		$manageRPPStatusReq->ManageRecurringPaymentsProfileStatusRequest = $manageRPPStatusReqest;

		# Creating service wrapper object:
		# 	Creating service wrapper object to make API call and loading
		#	$this->config provides array that contains credential and config parameters
		$paypalService = new PayPalAPIInterfaceServiceService($this->config);
		try {
			# Wrap API method calls on the service object with a try catch 
			$manageRPPStatusResponse = $paypalService->ManageRecurringPaymentsProfileStatus($manageRPPStatusReq);
		} catch (Exception $ex) {
				throw new Exception($ex->getMessage());
		}
		# echo "\$manageRPPStatusResponse = "; var_dump($manageRPPStatusResponse);

		$rpProfileDetails = $this->getRecurringPaymentsProfileDetails($profileID);
		# echo "<pre>"; var_dump($rpProfileDetails); echo "</pre>";
		if (isset($rpProfileDetails->Ack))	# We hit an error in the Recurring Payments Profile Details call
			return $rpProfileDetails;
		$profileStatus = $logSubscribe->seller_PP_ProfileStatus = $rpProfileDetails->ProfileStatus; $rpProfileDetails = null;
		$acknowledge->ShortMessage = 'Subscribe Status: '.$profileStatus;

		$logSubscribe->rpAck = $manageRPPStatusResponse->Ack;
		$logSubscribe->version = $manageRPPStatusResponse->Version;
		$logSubscribe->build = $manageRPPStatusResponse->Build;
		$logSubscribe->correlationId = $manageRPPStatusResponse->CorrelationID;
		$timeStamp = preg_split('/Z/', $manageRPPStatusResponse->Timestamp);
		$logSubscribe->timestmp = $timeStamp[0];
		$this->insertLogSubscribe($logSubscribe);

		# Folloiwng updates the `vendor` database table Recurring Payment (Subcscribe) details.
		#	PayPal Reccurring Payment State rules for the `vendor_is_subscription_fee` Boolean flag Seller magagement in the `vendor`database table:
		#		Active:		vendor_is_subscription_fee` is true
		#		Pending:	N/A. This State should never occur withing FarmMade Seller PayPal Reccurring Payment business logic management
		#		Cancelled:	vendor_is_subscription_fee` is true
		#		Expired:	N/A. This PayPal Reccurring payment State should never accur.
		#
		# echo "manageRecurringPaymentsProfileStatus: \$action = $action".PHP_EOL;
		if ($action == 'Cancel') {
			$profileData = new stdClass();
			$profileData->PayerID = $profileData->vendor_PP_PayerEmail = $profileData->ProfileID = $profileData->ProfileStartDate = $profileData->PayerCountry = NULL;
			$profileData->ProfileStatus = 'Cancelled';
			$profileData->vendor_is_subscription_fee = false;	
			$profileData->vendor_id = $logSubscribe->vendor_id;	
			$this->updateVendorProfileData($profileData);
		} else {
			# Update the `vendor` database table `vendor_PP_ProfileStatus` data field
			$vendor_id = $logSubscribe->vendor_id;
			$stmt = $this->mysqli->prepare("UPDATE vendor SET vendor_PP_ProfileStatus=? WHERE vendor_id=?");
			$stmt->bind_param('si', $profileStatus, $vendor_id);
		 	$stmt->execute();
			$rows = $stmt->affected_rows;
			$stmt->free_result();
			$stmt->close();
			# echo "\$rows = $rows".PHP_EOL;
		}
		if ($manageRPPStatusResponse->Ack != self::SUCCESS) {
			$manageRPPStatusResponse->Errors[0]->ShortMessage = $acknowledge->ShortMessage;
			return $this->logRecurringPaymentsFailure($logSubscribe, $manageRPPStatusResponse->Errors[0]);
		}
		return $acknowledge;	
	}

	/**
	 *	Cancel Recurring Payments Profile
	 *		Only Recurring Payments Profiles in Active or Suspended state can be canceled.
	 *		Bills the FarmMade Seller's outstaning subscription amount
	 *
	 *	@param string $profileID
	 *	
	 *	@return stdClass object 	'Ack: Success' or 'Ack: Failure' + SubscribeMode, ShortMessage, LongMessage, and ErrorCode
	 *
	 *	@throws APIException
	 *	√	
	*/
	public function cancelRecurringPaymentsProfile($vendor_id) {
		$acknowledge = new Acknowledge();
		$acknowledge->SubscribeMode = "Cancel PayPal Recurring Payments Subscription";
		$acknowledge->ShortMessage = 'Subscribe Status: ';
		$acknowledge->home = $this->home;
		$acknowledge->vendor_id = $vendor_id;
		$acknowledge->vendor = $this->getVendorShortID($vendor_id);
		$logSubscribe = $this->initLogSubscribe('', $acknowledge->SubscribeMode, $vendor_id);
		if (get_class($logSubscribe) == self::ACK)	# We hit an error. 'ProfileID does not exist for this FarmMade Seller'
			return $logSubscribe;
		$logSubscribe->rpAck = $acknowledge->Ack = self::SUCCESS;
		$profileData = new stdClass();
		$profileData->PayerID = $profileData->vendor_PP_PayerEmail = $profileData->ProfileID = $profileData->ProfileStartDate = $profileData->PayerCountry = $profileData->ProfileStatus = NULL;
		$profileData->vendor_is_subscription_fee = false;	
		$profileData->vendor_id = $logSubscribe->vendor_id;	
		# Look for null Recurring Payment parameters or a previous Recurring Payment cancel
		$profileStatus = $logSubscribe->seller_PP_ProfileStatus;
		if (is_null($profileStatus) || $profileStatus === 'Cancelled') {
			$this->insertLogSubscribe($logSubscribe);
			$profileData->ProfileStatus = 'Cancelled';
			$this->updateVendorProfileData($profileData);	# Cancel any PayPal Recurring Payment parameters in the FarmMade `vendor` database
			if (is_null($profileStatus))
				$acknowledge->ShortMessage .= 'no value';
			else
				$acknowledge->ShortMessage .= $profileStatus;
			return $acknowledge;
		}
		$errorType = new ErrorType;
		$errorType->ShortMessage = $errorType->ErrorCode = $errorType->SeverityCode = $errorType->ErrorParameters = '';
		$errorType->LongMessage = "FammMade website is unable to mangage 'Pending' or 'Expired' Recurring Payments Profile status";
		# The following scenario should never happen. Here only for safe business logic processing.
		if ($profileStatus === 'Pending' || $profileStatus === 'Expired') {
			$logSubscribe->rpAck = self::FAILURE;
			$this->insertLogSubscribe($logSubscribe);
			$errorType->LongMessage = "FammMade website is unable to mangage 'Pending' or 'Expired' Recurring Payments Profile status";
			return $this->logRecurringPaymentsFailure($logSubscribe, $errorType);
		}
		# $logSubscribe->seller_PP_ProfileID = null;
		if (is_null($profileID = $logSubscribe->seller_PP_ProfileID)) {
			$acknowledge->ShortMessage .= $profileStatus;
			$logSubscribe->rpAck = self::FAILURE;
			$this->insertLogSubscribe($logSubscribe);
			$errorType->LongMessage = "Recurring Payments 'ProfileID' value does not exist for the '".$logSubscribe->seller_shop_name."' shop.";
			return $this->logRecurringPaymentsFailure($logSubscribe, $errorType);
		}
		# If we got this far, then the Recurring Payments Profile has to be 'Active' or 'Suspended'
		#	and we can cancel the PayPal Recurring Payment profile.
		/* The following code block is not required.............
		$rpProfileDetails = $this->getRecurringPaymentsProfileDetails($profileID);
		if (isset($rpProfileDetails->Ack))	# We hit an error in the Recurring Payments Profile Details call
			return $rpProfileDetails;
		$profileStatus = $rpProfileDetails->ProfileStatus; $rpProfileDetails = NULL;
		$acknowledge->ShortMessage .= $profileStatus;
		*/
		$result = $this->manageRecurringPaymentsProfileStatus($profileID, 'Cancel'); # Finally, we get to cancel the Recurring Payments Profile
		# if (isset($result->Ack))	# We hit an error in the Recurring Payments ProfileStatus call
		#	return $result;
		$this->insertLogSubscribe($logSubscribe);
		$acknowledge->vendor = $this->getVendorShortID($vendor_id);
		$acknowledge->ShortMessage .= $acknowledge->vendor->vendor_PP_ProfileStatus;
		return $acknowledge;	
	}
	
	/**
	 *	Update Recurring Payments Profile ddress
	 *
	 *	@param string $profileID
	 *	@param string $address 		The Recurring Payments Profile shipping address
	 *	
	 *	@return stdClass object 	'Ack: Success' or 'Ack: Failure' + SubscribeMode, ShortMessage, LongMessage, and ErrorCode
	 *
	 *	@throws APIException
	 *	√	
	*/
	public function updateRecurringPaymentsProfileAddress($profileID, AddressType $address) {
		$acknowledge = new Acknowledge();
		$acknowledge->Ack = self::SUCCESS;
		$acknowledge->SubscribeMode = "Update Recurring Payments Profile Address";
		$acknowledge->home = $this->home;
		$acknowledge->vendor = $vendor = $this->getVendorShort($profileID);
		if (!is_null($vendor))
			$acknowledge->vendor_id = $vendor->vendor_id;
		$logSubscribe = $this->initLogSubscribe($profileID, $acknowledge->SubscribeMode);
		if (get_class($logSubscribe) == self::ACK)	# We hit an error. 'ProfileID does not exist for this FarmMade Seller'
			return $logSubscribe;
		
		$updateRPProfileRequestDetail = new UpdateRecurringPaymentsProfileRequestDetailsType();
		$updateRPProfileRequestDetail->SubscriberName = $address->Name ;
		$updateRPProfileRequestDetail->SubscriberShippingAddress  = $address;

		# profileID - (Required) Recurring payments profile ID returned in the CreateRecurringPaymentsProfile response.
		$updateRPProfileRequestDetail->ProfileID = $profileID;
		
		$updateRPProfileRequest = new UpdateRecurringPaymentsProfileRequestType();
		$updateRPProfileRequest->UpdateRecurringPaymentsProfileRequestDetails = $updateRPProfileRequestDetail;

		$updateRPProfileReq =  new UpdateRecurringPaymentsProfileReq();
		$updateRPProfileReq->UpdateRecurringPaymentsProfileRequest = $updateRPProfileRequest;
		
		# Creating service wrapper object:
		# 	Creating service wrapper object to make API call and loading
		#	$this->config provides array that contains credential and config parameters
		$paypalService = new PayPalAPIInterfaceServiceService($this->config);;
						
		try {
			# Wrap API method calls on the service object with a try catch
			$updateRPProfileResponse = $paypalService->UpdateRecurringPaymentsProfile($updateRPProfileReq);
		} catch (Exception $ex) {
			throw new Exception($ex);
		}
		
		$logSubscribe->rpAck = $updateRPProfileResponse->Ack;
		$logSubscribe->version = $updateRPProfileResponse->Version;
		$logSubscribe->build = $updateRPProfileResponse->Build;
		$logSubscribe->correlationId = $updateRPProfileResponse->CorrelationID;
		$timeStamp = preg_split('/Z/', $updateRPProfileResponse->Timestamp);
		$logSubscribe->timestmp = $timeStamp[0];
		$this->insertLogSubscribe($logSubscribe);
		
		if ($updateRPProfileResponse->Ack != self::SUCCESS) 
			return $this->logRecurringPaymentsFailure($logSubscribe, $updateRPProfileResponse->Errors[0]);
		return $acknowledge;
	}

	/**
	 *	Update Recurring Payments Profile Trial Period
	 *	
	 *	@param string $profileID
	 *	@param string $trialBillingCycles 	The number of months for the new trail period
	 *	
	 *	@return stdClass object 	'Ack: Success' or 'Ack: Failure' + SubscribeMode, ShortMessage, LongMessage, and ErrorCode
	 *
	 *	@throws APIException
	 *	√
	*/
	public function updateRecurringPaymentsProfileTrialPeriod($profileID, $trialBillingCycles) {
		$acknowledge = new Acknowledge();
		$acknowledge->Ack = self::SUCCESS;
		$acknowledge->SubscribeMode = "Update Recurring Payments Profile Trial Period";
		$acknowledge->ShortMessage = 'New trial billing cycles: '.$trialBillingCycles.' months.';
		$acknowledge->home = $this->home;
		$acknowledge->vendor = $vendor = $this->getVendorShort($profileID);
		if (!is_null($vendor))
			$acknowledge->vendor_id = $vendor->vendor_id;
		$logSubscribe = $this->initLogSubscribe($profileID, $acknowledge->SubscribeMode);
		if (get_class($logSubscribe) == self::ACK)	# We hit an error. 'ProfileID does not exist for this FarmMade Seller'
			return $logSubscribe;

		$updateRPProfileRequestDetail = new UpdateRecurringPaymentsProfileRequestDetailsType();
		# profileID - (Required) Recurring payments profile ID returned in the CreateRecurringPaymentsProfile response.
		$updateRPProfileRequestDetail->ProfileID = $profileID;
		
		$updateRPProfileRequest = new UpdateRecurringPaymentsProfileRequestType();
		$updateRPProfileRequest->UpdateRecurringPaymentsProfileRequestDetails = $updateRPProfileRequestDetail;

		$updateRPProfileReq =  new UpdateRecurringPaymentsProfileReq();
		$updateRPProfileReq->UpdateRecurringPaymentsProfileRequest = $updateRPProfileRequest;

		# Regular payment period for this schedule which takes mandatory params:
		# 	`Billing Period` - Unit for billing during this subscription period. It is one of the following values:
		# 		Day
		# 		Week
		# 		SemiMonth
		# 		Month
		# 		Year
		#	For SemiMonth, billing is done on the 1st and 15th of each month.
		# 	Note: The combination of BillingPeriod and BillingFrequency cannot exceed one year.
		#
		# 	`Billing Frequency` - Number of billing periods that make up one billing cycle.
		#		The combination of billing frequency and billing period must be less than or equal to 
		#		one year. For example, if the billing cycle is Month, the maximum value for billing 
		#		frequency is 12. Similarly, if the billing cycle is Week, the maximum value for billing
		#		frequency is 52.
		#	Note: If the billing period is SemiMonth, the billing frequency must be 1.`
		$paymentBillingPeriod = new BillingPeriodDetailsType();
		$paymentBillingPeriod->BillingFrequency = self::BILLING_FREQUENCY;
		$paymentBillingPeriod->BillingPeriod = self::BILLING_PERIOD;
		$paymentBillingPeriod->TotalBillingCycles = 0;	# Invoice the Farmmade Seller in perpituity 
		$paymentBillingPeriod->ShippingAmount = new BasicAmountType(self::CURRENCY_CODE, self::ZERO_AMOUNT);
		$paymentBillingPeriod->TaxAmount = new BasicAmountType(self::CURRENCY_CODE, self::TAX_AMOUNT);
		$paymentBillingPeriod->Amount = new BasicAmountType(self::CURRENCY_CODE, self::BILLING_AMOUNT);
		# $updateRPProfileRequestDetail->PaymentPeriod = $paymentBillingPeriod;		
		
		# The trial free subscription for 60 days
		$trialBillingPeriod =  new BillingPeriodDetailsType();
		$trialBillingPeriod->BillingFrequency = self::BILLING_FREQUENCY;
		$trialBillingPeriod->BillingPeriod = self::BILLING_PERIOD;		# Months
		$trialBillingPeriod->TotalBillingCycles = $trialBillingCycles;	# Number of months
		$trialBillingPeriod->Amount = new BasicAmountType(self::CURRENCY_CODE, self::TRIAL_AMOUNT);
		$trialBillingPeriod->ShippingAmount = new BasicAmountType(self::CURRENCY_CODE, self::TRIAL_AMOUNT);
		$trialBillingPeriod->TaxAmount = new BasicAmountType(self::CURRENCY_CODE, self::TRIAL_AMOUNT);
		$updateRPProfileRequestDetail->TrialPeriod  = $trialBillingPeriod;

		$updateRPProfileRequest = new UpdateRecurringPaymentsProfileRequestType();
		$updateRPProfileRequest->UpdateRecurringPaymentsProfileRequestDetails = $updateRPProfileRequestDetail;

		$updateRPProfileReq =  new UpdateRecurringPaymentsProfileReq();
		$updateRPProfileReq->UpdateRecurringPaymentsProfileRequest = $updateRPProfileRequest;
		
		# Creating service wrapper object:
		# 	Creating service wrapper object to make API call and loading
		#	$this->config provides array that contains credential and config parameters
		$paypalService = new PayPalAPIInterfaceServiceService($this->config);;
		
		# echo "\$updateRPProfileReq = "; var_dump($updateRPProfileReq);
				
		try {
			# Wrap API method calls on the service object with a try catch
			$updateRPProfileResponse = $paypalService->UpdateRecurringPaymentsProfile($updateRPProfileReq);
		} catch (Exception $ex) {
				throw new Exception($ex->getMessage());
		}
		
		$logSubscribe->rpAck = $updateRPProfileResponse->Ack;
		$logSubscribe->version = $updateRPProfileResponse->Version;
		$logSubscribe->build = $updateRPProfileResponse->Build;
		$logSubscribe->correlationId = $updateRPProfileResponse->CorrelationID;
		$timeStamp = preg_split('/Z/', $updateRPProfileResponse->Timestamp);
		$logSubscribe->timestmp = $timeStamp[0];
		$this->insertLogSubscribe($logSubscribe);
		
		return $acknowledge;
	}

	public function getVendorShortID($vendor_id) {
		$result=$this->mysqli->query("SELECT vendor_id, vendor_shop_name, vendor_first_name, vendor_last_name, vendor_paypal_address, vendor_address1,
		vendor_address2, vendor_city, vendor_state_province, vendor_zip_postal, vendor_country, vendor_PP_PayerID, vendor_PP_ProfileID,
		vendor_PP_ProfileStatus, vendor_PP_ProfileStartDate, vendor_PP_PayerCountry FROM vendor WHERE vendor_id='$vendor_id'");
		$vendorShortoObj = $result->fetch_object();
		$result->free();
		return $vendorShortoObj;
	}

	# √
	public function getVendorShort($profileID) {
		$result=$this->mysqli->query("SELECT vendor_id, vendor_shop_name, vendor_first_name, vendor_last_name, vendor_paypal_address, vendor_PP_PayerID, vendor_PP_PayerEmail,
			vendor_PP_ProfileID, vendor_PP_ProfileStatus, vendor_PP_ProfileStartDate, vendor_PP_PayerCountry FROM vendor WHERE vendor_PP_ProfileID='$profileID'");
		$vendorShortoObj = $result->fetch_object();
		$result->free();
		return $vendorShortoObj;
	}

	# √
	public function getVendorInfo($vendor_id) {
		$result=$this->mysqli->query("SELECT vendor_id, vendor_shop_name, vendor_first_name, vendor_last_name, vendor_paypal_address, vendor_address1, vendor_address2, 
			vendor_city, vendor_state_province, vendor_zip_postal, vendor_country, vendor_PP_PayerID, vendor_PP_PayerEmail, vendor_PP_ProfileID, vendor_PP_ProfileStatus,
			vendor_PP_ProfileStartDate, vendor_PP_PayerCountry FROM vendor WHERE vendor_id=$vendor_id");
		$vendorInfoObj = $result->fetch_object();
		$result->free();
		return $vendorInfoObj;
	}

	/**
	 * 	Note: this FMSubscribe::redirect method is here to enable HTML redirect navigation of the
	 *        PayPal Subscribe test site. This class method may not be required when the PayPal
	 *	      Subscribe module is deployed on the FarmMade website.
	 * √
	*/
	public function redirect(array $postData, $webpage) {
		# Folloiwng code performs a cURL HTML redirect
		$url = $this->website.$webpage; 			# HTML redirect URL
		$post_fields = http_build_query($postData);	# HTML redirect data Fields
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
		$result = curl_exec($ch);
		curl_close($ch); 
	}
		
	/**
	 *	Update the PayPal Recurring Payments (Subscribe) data in the FarmMade `vendor` database table
	 *
	 *	@param stdClass $profileData	stdClass object properties are: 
	 *										PayerID, ProfileID, ProfileStatus, ProfileStartDate, PayerCountry, and vendor_id
	 *	@return Number of rows updated. Nominally 1, zero, if no data fields were changed.
	 *	√
	 */
	private function updateVendorProfileData(stdClass $profileData) {
		$stmt = $this->mysqli->stmt_init();	
		$stmt->prepare("UPDATE vendor SET vendor_PP_PayerID=?, vendor_PP_PayerEmail=?, vendor_PP_ProfileID=?, vendor_PP_ProfileStatus=?, vendor_PP_ProfileStartDate=?,
			vendor_PP_PayerCountry=?, vendor_is_subscription_fee=? WHERE vendor_id=?");
		/* The second mysqli_bind_param($stmt, 'ssssssii', ,,,,,,) paarameter is string that contains one
		   or more characters which specify the types for the corresponding bind variables:
			Type specification chars:
			Character	Description
			i			corresponding variable has type integer
			d			corresponding variable has type double
			s			corresponding variable has type string
			b			corresponding variable is a blob and will be sent in packets 

			The number of variables and length of string types must match the parameters in the statement.
		*/
		$bindResult = $stmt->bind_param('ssssssii', $profileData->PayerID, $profileData->PayerEmail, $profileData->ProfileID, $profileData->ProfileStatus, 
			$profileData->ProfileStartDate, $profileData->PayerCountry, $profileData->vendor_is_subscription_fee, $profileData->vendor_id);
		$stmt->execute();
		$rows = $stmt->affected_rows;
		$stmt->close();
		return $rows;
	}

	# √
	private function initLogSubscribe($profileID, $subscribeMode, $vendor_id=null) {
		$acknowledge = new Acknowledge();
		$acknowledge->Ack = self::FAILURE;
		$acknowledge->SubscribeMode = $subscribeMode;
		$acknowledge->home = $this->home;
		$acknowledge->vendor_id = $vendor_id;
		if (!is_null($vendor_id)) {
				if (($vendorInfo = $this->getVendorInfo($vendor_id)) == null) {
				$acknowledge->LongMessage = 'vendor_id \''.$vendor_id.'\' does not exist for this FarmMade Seller';
				return $acknowledge;
			}
		} else {
			if (($vendorInfo = $this->getVendorShort($profileID)) == null) {
				$acknowledge->LongMessage = 'PayPal subscription ProfileID \''.$profileID.'\' does not exist for this FarmMade Seller.';
				return $acknowledge;
			}
		}
		$logSubscribe = new LogSubscribe();
		$logSubscribe->log_date = $this->timeStamp;
		$logSubscribe->vendor_id = (int) $vendorInfo->vendor_id;
		$logSubscribe->subscribe_mode = $subscribeMode;
		$logSubscribe->seller_shop_name = $vendorInfo->vendor_shop_name;
		$logSubscribe->seller_name = $vendorInfo->vendor_first_name.' '.$vendorInfo->vendor_last_name;
		$logSubscribe->seller_paypal_address = $vendorInfo->vendor_paypal_address;
		$logSubscribe->seller_PP_PayerID = $vendorInfo->vendor_PP_PayerID;
		$logSubscribe->seller_PP_PayerEmail = $vendorInfo->vendor_PP_PayerEmail;
		$logSubscribe->seller_PP_ProfileID = $vendorInfo->vendor_PP_ProfileID;
		$logSubscribe->seller_PP_ProfileStatus = $vendorInfo->vendor_PP_ProfileStatus;
		$logSubscribe->seller_PP_ProfileStartDate = $vendorInfo->vendor_PP_ProfileStartDate;
		$logSubscribe->seller_PP_PayerCountry = $vendorInfo->vendor_PP_PayerCountry;
		return $logSubscribe;
	}

	# √
	private function insertLogSubscribe(LogSubscribe $logSubscribe) {
		if (!(bool)$this->config['log.SubscribeEnabled']) 
			return;
		foreach ($logSubscribe as $key => $value) {
			if ($value == null)
				$logSubscribe->$key = '';
		}
		$stmt =  $this->mysqli->stmt_init();
		$stmt->prepare("INSERT INTO log_subscribe (recurring_payment_ack, log_date, vendor_id, subscribe_mode, seller_shop_name, seller_name,
			seller_paypal_address, seller_PP_PayerID, seller_PP_PayerEmail, seller_PP_ProfileID, seller_PP_ProfileStatus, seller_PP_ProfileStartDate, seller_PP_PayerCountry,
			version, build, correlationId, timestmp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		/* The second mysqli_bind_param($stmt, 'sdssssssssssss', ,,,,,,,,,) paarameter is string that contains one
		   or more characters which specify the types for the corresponding bind variables:
			Type specification chars:
			Character	Description
			i			corresponding variable has type integer
			d			corresponding variable has type double
			s			corresponding variable has type string
			b			corresponding variable is a blob and will be sent in packets 

			The number of variables and length of string types must match the parameters in the statement.
		*/
		$stmt->bind_param('ssdssssssssssssss', $logSubscribe->rpAck, $logSubscribe->log_date, $logSubscribe->vendor_id, $logSubscribe->subscribe_mode,
			$logSubscribe->seller_shop_name, $logSubscribe->seller_name, $logSubscribe->seller_paypal_address, $logSubscribe->seller_PP_PayerID,
			$logSubscribe->seller_PP_PayerEmail, $logSubscribe->seller_PP_ProfileID, $logSubscribe->seller_PP_ProfileStatus, $logSubscribe->seller_PP_ProfileStartDate, 
			$logSubscribe->seller_PP_PayerCountry, $logSubscribe->version, $logSubscribe->build, $logSubscribe->correlationId, $logSubscribe->timestmp);
		$stmt->execute(); 
		$rows = $stmt->affected_rows;
		# echo "\$rows = $rows ".PHP_EOL; 
		$stmt->close();
	}
	
	# √
	private function logRecurringPaymentsFailure(LogSubscribe $logSubscribe, ErrorType $errorType) {
		if ($errorType->ErrorParameters == null)
			$errorType->ErrorParameters = '';
		if ((bool)$this->config['log.SubscribeErrorEnabled']) {
			foreach ($logSubscribe as $key => $value) {
				if ($value == null)
					$logSubscribe->$key = '';
			}
			$stmt =  $this->mysqli->stmt_init();
			$stmt->prepare("INSERT INTO log_subscribe_errors (recurring_payment_ack, log_date, vendor_id, subscribe_mode, seller_shop_name, seller_name,
				seller_paypal_address, seller_PP_PayerID, seller_PP_PayerEmail, seller_PP_ProfileID, seller_PP_ProfileStatus, seller_PP_ProfileStartDate, seller_PP_PayerCountry,
				version, build, correlationId, timestmp, shortMessage, longMessage, errorCode, severityCode, errorParameters)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param('ssdsssssssssssssssssss', $logSubscribe->rpAck, $logSubscribe->log_date, $logSubscribe->vendor_id, $logSubscribe->subscribe_mode,
				$logSubscribe->seller_shop_name, $logSubscribe->seller_name, $logSubscribe->seller_paypal_address, $logSubscribe->seller_PP_PayerID,
				$logSubscribe->seller_PP_PayerEmail, $logSubscribe->seller_PP_ProfileID, $logSubscribe->seller_PP_ProfileStatus, $logSubscribe->seller_PP_ProfileStartDate,
				$logSubscribe->seller_PP_PayerCountry, $logSubscribe->version, $logSubscribe->build, $logSubscribe->correlationId, $logSubscribe->timestmp,
				$errorType->ShortMessage, $errorType->LongMessage, $errorType->ErrorCode, $errorType->SeverityCode, $errorType->ErrorParameters);
			$stmt->execute();
			$rows = $stmt->affected_rows;
			# echo "\$rows = $rows ".PHP_EOL; 
			$stmt->close();
		}
		$vendor = $this->getVendorShortID($logSubscribe->vendor_id);
		
		$errorReport = new Acknowledge();
		$errorReport->Ack = $logSubscribe->rpAck;
		$errorReport->SubscribeMode = $logSubscribe->subscribe_mode;
		$errorReport->ShortMessage = $errorType->ShortMessage;
		$errorReport->LongMessage = $errorType->LongMessage;
		$errorReport->ErrorCode = $errorType->ErrorCode;
		$errorReport->home = $this->home;
		$errorReport->vendor_id = $logSubscribe->vendor_id;
		$errorReport->vendor = serialize($this->getVendorShortID($logSubscribe->vendor_id));
		return $errorReport;
	}
}

/*   Acknowledge.php         */

class Acknowledge {
	public $Ack = '';
	public $SubscribeMode = '';
	public $LongMessage = '';
	public $ShortMessage = '';
	public $ErrorCode  = '';
	public $home = '';
	public $vendor_id = '';
	public $vendor;
}

/* Logsubscribe.php       */

class LogSubscribe {
	/**
	 * @access public
	 * @var string
	 */							
	public $rpAck;				# Acknowledge from PayPal Recurring Payments API call
	/**
	 * @access public
	 * @var dateTime
	 */
	public $log_date;			# Date this log_subscribe record as created
	/**
	 * @access public
	 * @var int
	 */
	public $vendor_id;			# Resoured from the FarmMade `vendor` database table
	/**
	 * @access public
	 * @var string
	 */							# One of seven PayPal Recurring Payments (Subscribe) payment workflow modes:
	public $subscribe_mode;		# 	Create, GetDetails, Manage:Action, Cancel, Update Address, Update Trial, and Bill Outstanding
	/**
	 * @access public
	 * @var string
	 */
	public $seller_shop_name;		# FarmMade Seller's shop name is unique
	/**
	 * @access public
	 * @var string
	 */
	public $seller_name;		# Resoured from the FarmMade Seller's PayPal Recurring Payments Profile
	/**
	 * @access public
	 * @var string
	 */
	public $seller_paypal_address;	# Resoured from the FarmMade `vendor` database table	
	/**
	 * @access public
	 * @var string
	 */
	public $seller_PP_PayerID;		# PayPal PayerID, which a unique identifier related to a PayPal Recurring Payments (Subscribe) email address
	/**
	 * @access public
	 * @var string
	 */
	public $seller_PP_PayerEmail;	# PayPal Subscribe email address, linked to the PayerID. Email address can be different from the `vendor_paypal_address' in the `vendor` database table
	/**
	 * @access public
	 * @var string
	 */
	public $seller_PP_ProfileID;	# PayPal Recurring Payments (Subscribe) ProfileID for the FarmMade shop
	/**
	 * @access public
	 * @var string
	 */
	public $seller_PP_ProfileStatus;	# PayPal Recurring Payments (Subscribe) ProfileStatus of Active, Pending, Cancelled, Suspended, or Expire
	/**
	 * @access public
	 * @var dateTime
	 */
	public $seller_PP_ProfileStartDate;  # PayPal Recurring Payments (Subscribe) anniversary date. PayPal monthly subscribe will occur on this date each month after the 60-day trial
	/**
	 * @access public
	 * @var string
	 */
	public $seller_PP_PayerCountry;		# PayPal Recurring Payments (Subscribe) Payer Country, the FarmMade Seller PayPal account country.

	# ----- Following are PayPal Recurring Payment (Subscribe) payment workflow results -----
	/**
	 * @access public
	 * @var string
	 */
	public $version;		# Required by PayPal for technical support
	/**
	 * @access public
	 * @var string
	 */
	public $build;			# Required by PayPal for technical support
	/**
	 * @access public
	 * @var string
	 */
	public $correlationId;	# Required by PayPal for technical support
	/**
	 * @access public
	 * @var dateTime
	 */
	public $timestmp;		# Required by PayPal for technical support
	
	public function __construct() {
		foreach ($this as $key => $value) 
			$this->$key = '';
		$this->log_date = $this->seller_PP_ProfileStartDate = $this->timestmp = '0000-00-00 00:00:00';
		$this->vendor_id = 0;
	}
}
/*                                        */

























/*                                                    */
$fmSubscribe = new FMSubscribe($config, $_SESSION['home']);
//echo $_SESSION['home'] ;
//exit;
/*
 * This code creates a PayPal Express Checkout transaction
 * The PHP code uses the PayPal Merchant PHP SDK to make API calls
 */
//$returnUrl = $fmSubscribe->website."paypal/subscribe/CreateRecurringPaymentsProfile.php";
$returnUrl = "http://localhost/sandhya/vendor/index/my";
$cancelUrl = $fmSubscribe->website."payPalCancel.php" ;

$acknowledge = new Acknowledge();
$acknowledge->Ack = 'Failure';
$acknowledge->SubscribeMode = 'SetExpressCheckout';
$acknowledge->home = $_SESSION['home'];
$acknowledge->vendor_id = $vendor_id = (int) $_SESSION['vendor_id'];
# echo "<pre>\$acknowledge = "; var_dump($acknowledge); echo PHP_EOL."</pre>";


# Check to see if the Seller's `vendor` database table record exists.
$vendor = 546;//$fmSubscribe->getVendorShortID($vendor_id);
# echo "<pre>\$vendor = "; var_dump($vendor); echo "</pre>";
if (is_null($vendor)) {		# Seller's `vendor` database table record does not exist.
	$vendor_found = false;	# This will kill making the PapPal account call
	$acknowledge->ShortMessage = "Seller's Vendor ID: \"$vendor_id\" record is not available.";
	$acknowledge->vendor_id = $vendor_id ;
	$fmSubscribe->redirect((array) $acknowledge, 'fault.php');
	exit;
}	
$acknowledge->vendor = serialize($vendor);

/*
echo '<pre>';
echo "\$returnUrl = $returnUrl".PHP_EOL;
echo "\$cancelUrl = $cancelUrl".PHP_EOL;
echo "\$InvoiceID = $vendor_id".PHP_EOL;
echo '</pre>';
*/

# Total shipping amount
$shippingTotal = new BasicAmountType(CURRENCY_CODE, NO_FEE);
# Total handling amount if any
$handlingTotal = new BasicAmountType(CURRENCY_CODE, NO_FEE);
# Total insurance amount if any
$insuranceTotal = new BasicAmountType(CURRENCY_CODE, NO_FEE);

# Shipping address. We'll leave this empty.
$address = new AddressType();

# Details about recurring (subscribe) payment
$paymentDetails = new PaymentDetailsType();
$itemTotalValue = SUBSCRIBE_FEE;
$taxTotalValue = NO_FEE;

$paymentDetailsItem = new PaymentDetailsItemType();
$paymentDetailsItem->Name = 'FarmMade $5/month subscription fee';
$paymentDetailsItem->Quantity = 1;
$paymentDetailsItem->Tax = new BasicAmountType(CURRENCY_CODE, 0.00);
$paymentDetailsItem->Amount = new BasicAmountType(CURRENCY_CODE, SUBSCRIBE_FEE);
# Indicates whether an item is digital or physical. For digital goods, this field is 
# required and must be set to Physical. It contains one of the following values:
#	Digital
#	Physical
$paymentDetailsItem->ItemCategory = 'Physical';  # Can be set to 'Digital' of 'Physical'
$paymentDetails->PaymentDetailsItem[0] = $paymentDetailsItem;	
$paymentDetails->Custom = $_SESSION['home'];	# A way back to the PayPal Subscribe test website home page.

# For PaypPal Recurring Payments workflow logic testing
 $paymentDetails->InvoiceID = (int) '543';  #`vendor.vendor_id: Pete's Shop #2
// $paymentDetails->InvoiceID = (int) '562';  #`vendor.vendor_id: Sam's Shop
// $paymentDetails->InvoiceID = (int) '563';  #`vendor.vendor_id: Test Shop
//$paymentDetails->InvoiceID = $vendor_id;

# Payment details
$paymentDetails->ShipToAddress = $address;
$paymentDetails->ItemTotal = new BasicAmountType(CURRENCY_CODE, SUBSCRIBE_FEE);
$paymentDetails->TaxTotal = new BasicAmountType(CURRENCY_CODE, NO_FEE);
$paymentDetails->OrderTotal = new BasicAmountType(CURRENCY_CODE, SUBSCRIBE_FEE);

/*
 How you want to obtain payment. When implementing parallel payments, this field is required and must be set 
 to Order. When implementing digital goods, this field is required and must be set to Sale. If the transaction
 does not include a one-time purchase, this field is ignored. It is one of the following values:
	Sale -- This is a final sale for which you are requesting payment (default).
    Authorization -- This payment is a basic authorization subject to settlement with PayPal Authorization and Capture.
    Order -- This payment is an order authorization subject to settlement with PayPal Authorization and Capture.
 */
$paymentDetails->PaymentAction = 'Sale';

$paymentDetails->HandlingTotal = $handlingTotal;
$paymentDetails->InsuranceTotal = $insuranceTotal;
$paymentDetails->ShippingTotal = $shippingTotal;

# echo "\$paymentDetails = "; var_dump($paymentDetails); echo PHP_EOL;

$setECReqDetails = new SetExpressCheckoutRequestDetailsType();
$setECReqDetails->PaymentDetails[0] = $paymentDetails;


# Required: URL to which the buyer is returned if the buyer does not approve the use of PayPal to pay you. 
$setECReqDetails->CancelURL = $cancelUrl;
# Required: URL to which the buyer's browser is returned after choosing to pay with PayPal.
$setECReqDetails->ReturnURL = $returnUrl;

/*
 Determines whether or not PayPal displays shipping address fields on the PayPal pages.
 For digital goods, this field is required, and you must set it to 1. It is one of the following values:
    0 -- PayPal displays the shipping address on the PayPal pages.
    1 -- PayPal does not display shipping address fields whatsoever.
    2 -- If you do not pass the shipping address, PayPal obtains it from the buyer's account profile.
*/
$setECReqDetails->NoShipping = 1;

/*
  (Optional) Determines whether or not the PayPal pages should display the shipping address set by you in this 
  SetExpressCheckout request, not the shipping address on file with PayPal for this buyer. Displaying the 
  PayPal street address on file does not allow the buyer to edit that address. It is one of the following values:
	0 -- The PayPal pages should not display the shipping address.
    1 -- The PayPal pages should display the shipping address.
 */
$setECReqDetails->AddressOverride = 0;

/*
 Indicates whether or not you require the buyer's shipping address on file with PayPal be a confirmed address. 
 For digital goods, this field is required, and you must set it to 0. It is one of the following values:
    0 -- You do not require the buyer's shipping address be a confirmed address.
    1 -- You require the buyer's shipping address be a confirmed address.
*/
$setECReqDetails->ReqConfirmShipping = 0;

# Billing agreement details
$billingAgreementDetails = new BillingAgreementDetailsType('RecurringPayments');
$billingAgreementDetails->BillingAgreementDescription = BILLING_AGREEMENT;
$setECReqDetails->BillingAgreementDetails = array($billingAgreementDetails);

# Display options
$setECReqDetails->cppheaderimage = 'http://ppal.farmmade.us/FarmMadeLogo.jpg';
$setECReqDetails->cppheaderbordercolor = $setECReqDetails->cppheaderbackcolor = '';
$setECReqDetails->cpppayflowcolor = $setECReqDetails->cppcartbordercolor = $setECReqDetails->cpplogoimage = $setECReqDetails->PageStyle = '';
$setECReqDetails->BrandName = 'FarmMade';

// Advanced options
$setECReqDetails->AllowNote = 0;

$setECReqType = new SetExpressCheckoutRequestType();
$setECReqType->SetExpressCheckoutRequestDetails = $setECReqDetails;
$setECReq = new SetExpressCheckoutReq();
$setECReq->SetExpressCheckoutRequest = $setECReqType;

$setECReqType = new SetExpressCheckoutRequestType();
$setECReqType->SetExpressCheckoutRequestDetails = $setECReqDetails;
$setECReq = new SetExpressCheckoutReq();
$setECReq->SetExpressCheckoutRequest = $setECReqType;

# echo "\$setECReq = "; print_r($setECReq); echo PHP_EOL;

# Create service wrapper object:
#	Create service wrapper object to make API call and loading
#	PPConfigManager::getInstance()->config returns array that contains credential and config parameters
$paypalService = new PayPalAPIInterfaceServiceService(PPConfigManager::getInstance()->config);

//print_r(PPConfigManager::getInstance()->config);
//exit;
# echo "\$paypalService = "; var_dump($paypalService); echo PHP_EOL;

try {
	# Wrap API method calls on the service object with a try / catch
	$setECResponse = $paypalService->SetExpressCheckout($setECReq);
//	echo "<pre>";print_r( $setECResponse);
//	exit;
} catch (Exception $ex) {
	echo "SetExpressChecout Exception \$ex = "; var_dump($ex);
	exit;
}

/*
echo '<pre>';
echo PHP_EOL."\$token = ".$setECResponse->Token.PHP_EOL;
echo "SetExpressCheckout.php:\n"; print_r($setECResponse);
echo '</pre>';
*/
//echo "<pre>";print_r($setECResponse);
//exit;
if($setECResponse->Ack =='Success') {
	# Redirect to PayPal 'live' (production)  or 'sandbox' website
	$payPalSite = ($config['mode'] == 'live') ? 'https://www.paypal.com' : 'https://www.sandbox.paypal.com';
	# echo "\$payPalSite = $payPalSite <br>"; 
	$payPalURL = $payPalSite.'/webscr?cmd=_express-checkout&token='.$setECResponse->Token;
	/*	----- Manual link to PayPal website for test and debug purposes -------
	echo" <a href=$payPalURL><b>* Redirect to PayPal to login </b></a><br>";
	*/
	# The following HTML page forces an HTML redirect to our PayPal account in order for the Seller to perform 
	# the RecurringPayment (Subscribe) SetExpressCheckout API
	# Note: when using the above manual link to PayPal website for test and debug purposes,
	#       commment out the following HTML code.
	//
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
	<html>
		<head>
			<title>FarmMade PayPal $5 Monthly Subscribe</title>
			<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
			<meta http-equiv="refresh" content="0;URL= <?php echo $payPalURL ?>">
		</head>
		<body></body>
	</html>
	<?php
	//
} else {
	$acknowledge->ShortMessage = $setECResponse->Errors[0]->ShortMessage;
	$acknowledge->LongMessage = $setECResponse->Errors[0]->LongMessage;
	$acknowledge->ErrorCode = $setECResponse->Errors[0]->ErrorCode;
	$fmSubscribe->redirect((array) $acknowledge, 'fault.php');
}

?>
