<?php

/*
$logSubscribe = new LogSubscribe();
$logSubscribe->vendor_id =  1244;
echo "\$logSubscribe = "; var_dump($logSubscribe);
*/

/**
 * Table structure for `fmpaypal.log_subscribe` logging database
 */
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

