<?php
 
session_start();  
require_once("./include/fgcontactform.php");
$formproc = new FGContactForm();
# For better security. Get a random string from this link: http://tinyurl.com/randstr and put it here
$formproc->setFormRandomKey('CnRrspl1FyEylUj');
$subscribeURL = $formproc->payPalSubscribe();

# echo "<pre>";
# echo PHP_EOL."<pre>\$website = ".$formproc->website.PHP_EOL;
# echo "count \$_POST = ".count($_POST).PHP_EOL;
# echo "\$_POST = "; var_dump($_POST); echo PHP_EOL;
# echo "\$home = ".$formproc->home.PHP_EOL;
# echo "\$subscribeURL = ".$subscribeURL.PHP_EOL;
# echo "</pre>";

$vendor_id = isset($_SESSION['vendor_id']) ? $_SESSION['vendor_id'] : '';

$trial_period = isset($_SESSION['trial_period']) ? $_SESSION['trial_period'] : 2;
$processForm = false;
if (count($_POST)) {
	if (isset($_POST['submitUpdateSeller'])) {		# Enter or Update Seller ID post
		$vendor_id = $_SESSION['vendor_id'] = $_POST['vendor_id'];
		# echo "Update Seller post: \$vendor_id = $vendor_id<br>";
	}
	if (isset($_POST['submitUpdateStatus'])) {		# Display Subscription Profile post
		$postData = array ('action' => $_POST['action'], 'home' => $formproc->home, 'website' => $formproc->website, 'vendor_id' => $vendor_id);
		# echo "<pre>Update Status post: \$postData = "; print_r($postData); echo "</pre>";
		$webpage = 'ManageStatus.php';
		$processForm = true;
	}
	if (isset($_POST['submitTrialPeriod'])) {		# Set Trial Period (months) post
		$trial_period = $_SESSION['trial_period'] = $_POST['trial_period'];
		$postData = array ('trial_period' => $_POST['trial_period'], 'home' => $formproc->home, 'website' => $formproc->website, 'vendor_id' => $vendor_id);
		$webpage = 'UpdateTrial.php';
		$processForm = true;
	}
	if(isset($_POST['submitAddress'])) {			# Update PayPal Subscription Address
		$postData = array('Name' => $_POST['Name'], 'Street1' => $_POST['Street1'], 'Street2' => $_POST['Street2'], 'CityName' => $_POST['CityName'], 
			'StateOrProvince' => $_POST['StateOrProvince'], 'Country' => $_POST['Country'], 'PostalCode' => $_POST['PostalCode'],
			'home' => $formproc->home, 'website' => $formproc->website, 'vendor_id' => $vendor_id);
		# echo "<pre>Update PayPal Subscription Address: \$postData = "; print_r($postData); echo "</pre>";
		$webpage = 'UpdateAddress.php';
		$processForm = $formproc->processForm();
	}	
} 
# echo "<pre>\$_SESSION = "; var_dump($_SESSION); echo "</pre>";
$_SESSION['home'] = $formproc->home;
//
if ($processForm) {
	$formproc->redirect($postData, $webpage);
} else {
//
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title>FarmMade PayPal Subscribe</title>
        <link rel="STYLESHEET" type="text/css" href="contact.css" />
        <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
		<style>
		table {
			border-collapse: collapse;
			margin: auto;
		}
		td {
			padding: 10px 10px;
		}
		</style>
	</head>
	<body>
		<b>Enter or Update Seller ID</b>
		<form method="POST" action="index.php">
			<input type='hidden' name='submitUpdateSeller' id='SaveSeller' value='1'/>
			<!-- Seller ID: <input type=input name="vendor_id" value="<?php echo "good";?>"><br> -->
			Seller ID: <input type=input name="vendor_id" value=""><br>
			<input type=submit name="Button" value="Save Seller ID">
		</form>
		<br>

		<table align="left">
			<tr valign="top" >
				<td>
					<b>Subscription Profile</b><br>
					<a href="<?='/ppal/paypal/subscribe/SetExpressCheckout.php'?>">Create Subscription Profile</a>
					<br><br><br>
					<b>Display Subscription Profile</b><br>
					<a href="<?=$subscribeURL.'GetDetails.php'?>">Get Subscription Profile</a>
					<br><br><br>
					<b>Manage PayPal Subscription Status</b><br>
					<!-- <form method="POST" action="<?=$subscribeURL.'ManageStatus.php' ?>"> -->
					<form method="POST" action="index.php">
						<input type='hidden' name='submitUpdateStatus' id='SaveSeller' value='1'/>
						Select PayPal Subscription action:<br>
						<!-- ><select name="action" value="<?=$action?>" > -->
						<select name="action">
						<option value="Suspend">Suspend</option>
						<option value="Reactivate">Reactivate</option>
						<option value="Cancel">Cancel</option>
						</select>
						<br>
						<input type=submit name="Button" value="Update Subscripiton Status">
					</form>
					<br>
					<b>Force Subscription Profile Cancel</b><br>
					<a href="<?=$subscribeURL.'CancelSubscribe.php'?>">Cancel Subscription Profile</a>
					<br><br><br>
					<b>Set Trial Period</b> (<i>months</i>)
					<form method="POST" action="index.php">
						<input type='hidden' name='submitTrialPeriod' id='trial_period' value='1'/>
						Trial Period:<input type=inputstyle="width: 20px" name="trial_period" value="<?=$trial_period?>"><br>
						<input type=submit  name="Button" value="Set New Trial Period">
					</form>
				</td>
				<td>
					<!-- Form Code Start -->
					<form id='contactus' action='<?=$formproc->getSelfScript();?>' method='post' accept-charset='UTF-8'>
						<fieldset >
							<legend>Update PayPal Subscription Address</legend>

							<input type='hidden' name='submitAddress' id='submitAddress' value='1'/>
							<input type='hidden' name='<?php echo $formproc->getFormIDInputName(); ?>' value='<?php echo $formproc->getFormIDInputValue(); ?>'/>
							<input type='text'  class='spmhidip' name='<?php echo $formproc->getSpamTrapInputName(); ?>' />

							<div class='short_explanation'><font color="red">*</font> required fields</div>

							<div><span class='error'><?=$formproc->getErrorMessage();?></span></div>
							<div class='container'>
							    <label for='Name' >Name:<font color="red">*</font></label><br/>
							    <input type='text' name='Name' id='Name' value='<?=$formproc->safeDisplay('Name')?>' maxlength="50" /><br/>
							    <span id='contactus_Name_errorloc' class='error'></span>
							</div>
							<div class='container'>
							    <label for='Street1' >Address:<font color="red">*</font></label><br/>
							    <input type='text' name='Street1' id='Street1' value='<?=$formproc->safeDisplay('Street1')?>' maxlength="250" /><br/>
							    <span id='contactus_Street1_errorloc' class='error'></span>
							</div>
							<div class='container'>
							    <input type='text' name='Street2' id='Street2' value='<?=$formproc->safeDisplay('Street2')?>' maxlength="250" /><br/>
							    <span id='contactus_Street2_errorloc' class='error'></span>
							</div>
							<div class='container'>
							    <label for='CityName' >City:<font color="red">*</font></label><br/>
							    <input type='text' name='CityName' id='CityName' value='<?php echo $formproc->safeDisplay('CityName') ?>' maxlength="150" /><br/>
							    <span id='contactus_CityName_errorloc' class='error'></span>
							</div>
							<div class='container'>
							    <label for='StateOrProvince' >State or Province:<font color="red">*</font> <i>(two characters)</i></label><br/>
							    <input type='text' name='StateOrProvince' id='StateOrProvince' value='<?=$formproc->safeDisplay('StateOrProvince')?>' maxlength="100" /><br/>
							    <span id='contactus_StateOrProvince_errorloc' class='error'></span>
							</div>
							<div class='container'>
							    <label for='Country' >Country:<font color="red">*</font> <i>(two characters)</i></label><br/>
							    <input type='text' name='Country' id='Country' value='<?=$formproc->safeDisplay('Country')?>' maxlength="100" /><br/>
							    <span id='contactus_Country_errorloc' class='error'></span>
							</div>
							<div class='container'>
							    <label for='PostalCode' >Zip / Postal Code:<font color="red">*</font></label><br/>
							    <input type='text' name='PostalCode' id='PostalCode' value='<?=$formproc->safeDisplay('PostalCode')?>' maxlength="20" /><br/>
							    <span id='contactus_PostalCode_errorloc' class='error'></span>
							</div>
							<div class='container'>
							    <input type='submit' name='Submit' value='Update Address' />
							</div>
						</fieldset>
					</form>
				</td>
			</tr>
		</table>
		<!-- client-side Form Validations:
		Uses the excellent form validation script from JavaScript-coder.com-->

		<script type='text/javascript'>
		// <![CDATA[
		    var frmvalidator  = new Validator("contactus");
		    frmvalidator.EnableOnPageErrorDisplay();
		    frmvalidator.EnableMsgsTogether();
		    frmvalidator.addValidation("Name","req","Please provide your name.");
			frmvalidator.addValidation("Name","maxlen=32");
		    frmvalidator.addValidation("Street1","req","Please provide your street address.");
			frmvalidator.addValidation("Street1","maxlen=200");
			frmvalidator.addValidation("Street2","maxlen=200");
		    frmvalidator.addValidation("CityName","req","Please provide a valid city name.");
			frmvalidator.addValidation("CityName","maxlen=120");
		    frmvalidator.addValidation("StateOrProvince","req","Please provide a valid State or Province.");
			frmvalidator.addValidation("StateOrProvince","regexp=^[A-Z]{2,}$","Upper case for State or Province.");
			frmvalidator.addValidation("StateOrProvince","maxlen=2");
		    frmvalidator.addValidation("Country","req","Please provide a valid Countrhy.");
			frmvalidator.addValidation("Country","regexp=^[A-Z]{2,}$","Upper case for Country.");
			frmvalidator.addValidation("Country","maxlen=2");
		    frmvalidator.addValidation("PostalCode","req","Please provide a valid Zip / Postal Code.");
			frmvalidator.addValidation("PostalCode","maxlen=15");
		// ]]>
		</script>
	</body>
</html>
<?php } ?>
