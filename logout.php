<?php
session_start();
unset($_SESSION['fb_id']);
unset($_SESSION['uname']);
unset($_SESSION['email']);

session_destroy();
header("location:index.php");
?>