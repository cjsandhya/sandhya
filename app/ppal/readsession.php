<?php session_start(); echo '<pre>'; echo "\$_SESSION = "; print_r($_SESSION); echo '</pre>';?>
<html>
	<head>
		<title>Read Value from Session</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	</head>
	<body>
		The value held in Session "svUserName" is: <?php echo $_SESSION['svUserName']; ?>
		<br>
		<?php $_SESSION['vendor_id'] = 1024;?>
		<a href="setsession.php">Home</a>
	</body>
</html>