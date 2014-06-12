<?php
/**
 * Of special note, this FMSubscribe class supports the use and application of the following FarmMade database tables:
 * 	`log_subscribe`
 *	`log_subscribe_errors`
 */
require_once 'LogSubscribe.php';
require_once 'Acknowledge.php';
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