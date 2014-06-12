<?PHP
/*
    Contact Form from HTML Form Guide

    This program is free software published under the
    terms of the GNU Lesser General Public License.

This program is distributed in the hope that it will
be useful - WITHOUT ANY WARRANTY; without even the
implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.

@copyright html-form-guide.com 2010
*/
require_once("./include/AddressType.php");

class FGContactForm {
    var $receipients;
    var $errors;
    var $error_message;
    var $Name;
    var $Street1;
    var $Street2;
    var $CityName;
    var $StateOrProvince;
    var $Country;
    var $PostalCode;
    private $form_random_key;
	public $website;	# The website's base URL
	public $home;		# The website's home URL
	const HOME_PAGE = 'index.php';
	const HTTP = 'http://';
	const SUBSCRIBE = 'paypal/subscribe/';	# The FarmMade websie PayPal Subscribe code module
	
    public function __construct() {		# Constuct FGContactForm object
        $this->receipients = array();
        $this->errors = array();
        $this->form_random_key = 'HTgsjhartag';								# preg_replace(): removes 'index.php' from the $_SERVER['REQUEST_URI'] URL....
		$this->website = self::HTTP.htmlentities($_SERVER['SERVER_NAME']).preg_replace('/'.self::HOME_PAGE.'/', '', htmlentities($_SERVER['REQUEST_URI']));
		$this->home = $this->website.self::HOME_PAGE;
		# echo "<pre>PayPal Subscribe = ".$this->website.self::SUBSCRIBE.PHP_EOL.'</pre>';
    }

	public function payPalSubscribe() {
		//return //$this->website.self::SUBSCRIBE;
	}

	public function redirect(array $postData, $webpage) {
		$url = $this->website.self::SUBSCRIBE.$webpage; 	
		$query_data = array('home' => $this->home) + $postData;
		$post_fields = http_build_query($query_data);	# HTML redirect data Fields
		/*
		echo "<pre>";
		echo "\$post_fields = $post_fields".PHP_EOL; 
		echo "\$query_data = "; print_r($query_data);
		echo "\$url = $url".PHP_EOL; 
		echo "</pre>";
		return;
		*/
		# Folloiwng performs a cURL HTML redirect
		$url = $this->website.self::SUBSCRIBE.$webpage;  	# HTML redirect URL
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
		$result = curl_exec($ch);
		curl_close($ch); 
	}
	
    public function setFormRandomKey($key) {
        $this->form_random_key = $key;
    }

    public function getSpamTrapInputName() {
        return 'sp'.md5('KHGdnbvsgst'.$this->getKey());
    }

    public function safeDisplay($value_name) {
        if(empty($_POST[$value_name])) {
            return'';
        }
        return htmlentities($_POST[$value_name]);
    }

    public function getFormIDInputName() {
        $rand = md5('TygshRt'.$this->getKey());
        $rand = substr($rand,0,20);
        return 'id'.$rand;
    }

    public function getFormIDInputValue() {
        return md5('jhgahTsajhg'.$this->getKey());
    }

    public function processForm() {
		if(!isset($_POST['submitAddress'])) {
           return false;
        }
        if(!$this->validate()) {
            $this->error_message = implode('<br/>', $this->errors);
            return false;
        }
        $this->collectData();
        return true;
    }

    public function getErrorMessage() {
        return $this->error_message;
    }

    public function getSelfScript() {
        return htmlentities($_SERVER['PHP_SELF']);;
    }
# --------  Private Methods --------
    private function validate() {
        $ret = true;
        # Security validations
        if(empty($_POST[$this->getFormIDInputName()]) ||
          $_POST[$this->getFormIDInputName()] != $this->getFormIDInputValue() ) {
            # The proper error is not given intentionally
            $this->add_error("Automated submission prevention: case 1 failed");
            $ret = false;
        }

        # This is a hidden input field. Humans won't fill this field.
        if(!empty($_POST[$this->getSpamTrapInputName()]) ) {
            # The proper error is not given intentionally
            $this->add_error("Automated submission prevention: case 2 failed");
            $ret = false;
        }

        # Name validations
        if(empty($_POST['Name'])) {
            $this->add_error("Please provide your name.");
            $ret = false;
        } else if(strlen($_POST['Name'])>50) {
            $this->add_error("Name is too big!");
            $ret = false;
        }

        # Adddress, Street1 validation
        if(empty($_POST['Street1'])) {
            $this->add_error("Please provide your first street address entry.");
            $ret = false;
        } else if(strlen($_POST['Street1'])>50) {
            $this->add_error("Your street address entry is too big!");
            $ret = false;
        }
 
        # City validation
        if(empty($_POST['CityName'])) {
            $this->add_error("Please provide your City entry.");
            $ret = false;
        } else if(strlen($_POST['CityName'])>50) {
            $this->add_error("Your City entry is too big!");
            $ret = false;
        }
 
        # State or Providence validation
        if(empty($_POST['StateOrProvince'])) {
            $this->add_error("Please provide your State or Providence entry.");
            $ret = false;
        } else if(strlen($_POST['StateOrProvince'])>2) {
            $this->add_error("Your State or Providence entry is too big!");
            $ret = false;
        }
 
        # Country validation
        if(empty($_POST['Country'])) {
            $this->add_error("Please provide your Country entry.");
            $ret = false;
        } else if(strlen($_POST['Country'])>2) {
            $this->add_error("Your Country entry must be two characters!");
            $ret = false;
        }
 
        # Zip / Postal Code validation
        if(empty($_POST['PostalCode'])) {
            $this->add_error("Please provide your Zip / Postal Code entry.");
            $ret = false;
        } else if(strlen($_POST['PostalCode'])>10) {
            $this->add_error("Your Zip / Postal Code entry is too big!");
            $ret = false;
        }
		return $ret;
    }

    private function stripSlashes($str) {
        if(get_magic_quotes_gpc()) {
            $str = stripslashes($str);
        }
        return $str;
    }
    /*
    sanitize() function removes any potential threat from the
    data submitted. Prevents email injections or any other hacker attempts.
    if $remove_nl is true, newline chracters are removed from the input.
    */
    function sanitize($str, $remove_nl=true) {
        $str = $this->stripSlashes($str);

        if($remove_nl)
        {
            $injections = array('/(\n+)/i',
                '/(\r+)/i',
                '/(\t+)/i',
                '/(%0A+)/i',
                '/(%0D+)/i',
                '/(%08+)/i',
                '/(%09+)/i'
                );
            $str = preg_replace($injections,'',$str);
        }

        return $str;
    }

    # Collects clean data from the $_POST array and keeps in internal variables.
    private function collectData() {
        $this->Name = $this->sanitize($_POST['Name']);
        $this->Street1 = $this->sanitize($_POST['Street1']);
        $this->Street2 = $this->sanitize($_POST['Street2']);
        $this->CityName = $this->sanitize($_POST['CityName']);
        $this->StateOrProvince = $this->sanitize($_POST['StateOrProvince']);
        $this->Country = $this->sanitize($_POST['Country']);
        $this->PostalCode = $this->sanitize($_POST['PostalCode']);
    }

    private function add_error($error) {
        array_push($this->errors,$error);
    }

    private function getKey() {
        return $this->form_random_key.$_SERVER['SERVER_NAME'].$_SERVER['REMOTE_ADDR'];
    }
}

?>