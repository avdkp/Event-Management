<?php
$user = "dbmsproject";
$server ="127.0.0.1";
$passwd = "NULL";
$database = "dbmsproject";
$link = mysqli_connect($server, $user, $passwd, $database);

if (!$link) {
		echo "<script>alert('connection failed !');</script>";
		exit();
}


?>
