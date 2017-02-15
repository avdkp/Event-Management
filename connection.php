<?php
$user = "dbmsproject";
$server ="166.62.8.16";
$passwd = "L3g3nd@ry@vd";
$database = "dbmsproject";
$link = mysqli_connect($server, $user, $passwd, $database);

if (!$link) {
		echo "<script>alert('connection failed !');</script>";
		exit();
}


?>