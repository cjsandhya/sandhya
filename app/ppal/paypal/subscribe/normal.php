<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Subscribe Normal Return</title>
<style>
table {
	border-collapse: collapse;
	margin: auto;
}
<?php
$vendor_id = (int) $_POST['vendor_id'];
# $vendor_id = (int) 563;
?>

td {
	padding: 5px 15px;
}
</style>
</head>
<body>

<?php
	echo "\$vendor_id = "; var_dump($vendor_id); echo '<br><br>';
	
	echo "\$_POST = "; print_r($_POST); echo "<br>";
	echo "\$_REQUEST = "; var_dump($_REQUEST); echo "<br>";
?>
</body>

