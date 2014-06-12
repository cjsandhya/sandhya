<?php session_start(); ?>
<?php echo '<pre>'; echo "setsession: \$_SESSION = "; print_r($_SESSION); echo '</pre>';?>
<?php
$test = new stdClass();
$test->a = 'a';
$test->b = 1;

$userName = "Pete";
$_SESSION['svUserName'] = $userName;
$_SESSION['test'] = $test;
# $_SESSION['vendor_id'] = 543;

?>
<html>
	<head>
	<title>Set value in Session</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	</head>
	<body>
		The Session variable has been set with value: <?php echo $userName; ?>
		<br>
		<a href="readsession.php">Read Back Value</a>
	</body>
</html>
