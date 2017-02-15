<?php
session_start();
if(isset($_POST['crack']))
{
	if($_POST['uname']=='admin' && $_POST['pwd']=='pwd@123')
	{
		$_SESSION["loggedin"]=true;
		$_SESSION["admin"]=true;
		header("location:../index.php");
	}
}


?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Flat Login Form 3.0</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
<div class="module form-module">
<br>
<br>
<br>
<br>
  <div class="form">
    <h2>Login to your account</h2>
    <form  action="index.php" method="post">
      <input type="text" placeholder="Username" name="uname"/>
      <input type="password" placeholder="Password" name="pwd"/>
      <input type="submit" name="crack" value="submit">
    </form>
  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://codepen.io/andytran/pen/vLmRVp.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
