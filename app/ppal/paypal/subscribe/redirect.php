<?php
# ----------------------------------
# Note:	this PHP module is here to enable HTML redirect navigation of the PayPal Subscribe 
#       test site. This PHP module may not be required when the PayPal Subscribe module is
#       deployed on the FarmMade website.
# ----------------------------------
function redirect($ack, $webpage) {
	$home = 'http://' . $_SERVER['SERVER_NAME'].'/subscr/';
	$ack_jason = urlencode (json_encode($ack));
	
	# Folloiwng performs a cURL HTML redirect
	$url = $home.$webpage; 				# HTML redirect URL
	# echo "\$url = $url<br>";
	# return;
	$post_fields = 'ack='.$ack_jason;	# HTML redirect form Fields
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
	$result = curl_exec($ch);
	curl_close($ch); 
}	
?>