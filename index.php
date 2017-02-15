<?php
		session_start();
		include "connection.php";
		$registered = false;
		$updated = false;
		if(!isset($_SESSION['loggedin']))
			$_SESSION["loggedin"]=false;
	//	$_SESSION["uname"]="";
	//	$_SESSION['fb_id']='';
		$events = 0;
		$workshops = 0;
		$registrations = 0;
		$count = 0;
	
	
?>
<?php
if(isset($_POST['login']))
{
	if($link)
	{
		$mail = escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_POST['email1'])));
		$password = escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_POST['password1'])));
		$res = mysqli_fetch_array(mysqli_query($link,"select email,pname from participants where email='$mail' and pwd='$password'"));
		if($res[0]==$mail)
		{
			$_SESSION["loggedin"]=true;
			$_SESSION["uname"]=$res[1];
			$_SESSION["email"]=$mail;
		}
		if($mail=='' || $mail= null || $password='' || $password= null)
		{
			$_SESSION["loggedin"]=false;
			header("location:index.php");
		}
		
		
	}
}

?>
<!DOCTYPE HTML>
<html>
	<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>DBMS Project</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- <link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet"> -->
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="css/themify-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
<style>
.profile{
	color:white;
	font-size:20px;
}
.messg{
	height:50px;
	width:80px;
	text-align: center;
	display:none;
}
.events{
	height:275px;
	width:300px;
}
</style>
</head>
<body>
<?php
if($link)
	{
		//echo "<script>alert('link');</script>";
		$no_e = mysqli_fetch_array(mysqli_query($link,"select count(*) from events"));
		$no_w = mysqli_fetch_array(mysqli_query($link,"select count(*) from workshops"));
		$no_p = mysqli_fetch_array(mysqli_query($link,"select count(*) from participants"));
		//$no_e = mysqli_fetch_array(mysqli_query($link,"select count(*) from events"));
		if(isset($_GET['i']))
		{
			$id = base64_decode(escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_GET['i']))));
			$res = mysqli_query($link,"select count(*) from participants where fbid='$id'");
			$val = mysqli_fetch_array($res);
			//echo "<script>alert('$val[0]');</script>";
			if($val[0]>0)
			{
				$_SESSION["loggedin"] = true;
				//$res2 = mysqli_fetch_array($link,"select pname from participants where fbid='$id'");
				//$n = mysqli_fetch_array($res2);
				$_SESSION["uname"]=base64_decode(escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_GET['n']))));
				$_SESSION["email"]=base64_decode(escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_GET['e']))));
				$_SESSION["fb_id"]= $id;
			}
			else
			{
				$_SESSION["uname"] = base64_decode(escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_GET['n']))));
				$_SESSION["email"]=base64_decode(escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_GET['e']))));
				$_SESSION["fb_id"]= $id;
				echo "<script>alert('please complete the registration form ...');</script>";
			}
		}
		
		//$imaqe = "images/profile.jpg";
		if(isset($_POST['register'])&&$_SESSION["loggedin"] != true)
		{
			
				$name = escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_POST["pname"])));
				$email = trim(escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_POST["pemail"]))));
				$mobile = escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_POST["contact"])));
				$gender = escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_POST["gender"])));
				$pay_method = escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_POST["payment"])));
				$college = escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_POST["college"])));
				$pwd1 = escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_POST["pwd1"])));
				$pwd2 = escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_POST["pwd1"])));
				if(isset($fb_id))
				$fb_id = $id;
				if($pwd1!=$pwd2)
				{
					exit();
				}
				$check = mysqli_fetch_array(mysqli_query($link,"select count(*) from participants where email='$email'"));
				if(isset($_SESSION['fb_id']))
					$fb_id = $_SESSION['fb_id'];
				//echo "<script>alert('$fb_id');</script>";
				if($check[0]==0)
				{
					//echo "<script>alert('new');</script>";
					if(!isset($fb_id))
						$fb_id='';
					$res = mysqli_query($link,"call register_p('$name','$pwd1','$gender','$mobile','$email','$fb_id','$pay_method')");
					if($res)
					{
						$registered = true;
						$_SESSION["loggedin"]=true;
						$_SESSION["uname"]=$name;
						$_SESSION["email"]=$email;
						//$_SESSION['fb_id']=$id;
					}
				}
				else if($check[0]==1)
				{
					if(!isset($fb_id))
						$fb_id = '';
					$res = mysqli_query($link,"call update_p('$name','$pwd1','$gender','$mobile','$email','$fb_id','$pay_method')");
					if($res)
					{
						echo "<script>alert('updated');</script>";
						$updated = true;
						$_SESSION["loggedin"]=true;
						$_SESSION["uname"]=$name;
						$_SESSION["email"]=$email;
						//$_SESSION['fb_id']='';
					}
				}
				else;
			
			
			$uname = $_SESSION["uname"];
		}
		$events = $no_e[0];
		$workshops = $no_w[0];
		$registrations = $no_p[0];
		$count = 10000;
	}
?>
<!-- FB loGIN 	---------------------------------------------------------------------------------------------------------------------->	
<script>
function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);

	//alert("hellooooo");
    if (response.status === 'connected') {


		FB.api('/me', { locale: 'en_US', fields: 'id, name, email' },
		  function(response1) {
			var i = response1.id;
			var n = response1.name;
			var e = response1.email;
			var str = "http://dbms.almafiesta.com/index.php?i="+btoa(i)+"&&n="+btoa(n)+"&&e="+btoa(e);
			window.open(str,"_self");
		  }
		);
		//alert(name);
	  //

    } else if (response.status === 'not_authorized') {
		//alert("hellooooo1");
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
	 // alert("hellooooo2");
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }
</script>	

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '321260998259631',
      xfbml      : true,
	  cookie	 : true,
      version    : 'v2.5'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<script>
FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
});
</script>
<script>

function checkLoginState() {
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
}
</script>

<!-- FB loGIN 	---------------------------------------------------------------------------------------------------------------------->	
	<div class="gtco-loader"></div>
	
	<div id="page">
	<nav class="gtco-nav" role="navigation">
	<?php if(!isset($_SESSION["loggedin"])||$_SESSION["loggedin"]==false) : ?>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 text-right gtco-contact">
					<ul class="">
						<li>
							<form class="form-inline" action="index.php" method="post">
								  <div class="form-group">
									<label for="email" style="color:white;">Email:</label>
									<input type="email" style="height:30px; width:200px; font-size:15px; color:white;" class="form-control input-lg" name="email1" id="email">
								  </div>
								  <div class="form-group">
									<label for="pwd" style="color:white;">Password:</label>
									<input type="password" style="height:30px; width:200px; font-size:15px; color:white;" class="form-control input-lg" name="password1" id="pwd">
								  </div>
								  <input type="submit" name="login" style="height:30px; font-size:15px; padding-top:3px;" value="LogIn" class="btn btn-info">
								  <div class="fb-login-button" scope="public_profile,email" onlogin="checkLoginState();" data-max-rows="10" data-size="large" data-show-faces="false" data-auto-logout-link="false" style="font-size:28px">fb login</div>
								  								
								 <!-- <a href="#" class="btn btn-white btn-lg btn-outline" style="height:30px; font-size:15px; padding-top:3px;" >Sign Up</a>-->
							</form>
								
						</li>
						
						
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<div id="gtco-logo"><a href="index.php">DBMS</a></div>
				</div>
				<div class="col-xs-8 text-right menu-1">
					<ul>
						<li class="active"><a href="index.php">Home</a></li>
							<li class="has-dropdown">
							<a href="">Menu</a>
							<ul class="dropdown">
								<li><a href="#gtco-subscribe">Register</a></li>
								<li><a href="events.php">Events</a></li>
								<li><a href="workshops.php">Workshops</a></li>
								
							</ul>
						</li>
					
					</ul>
				</div>
			</div>

		</div>
	</nav>

	<header id="gtco-header" class="gtco-cover" role="banner" style="background-image:url(images/img_bg_1.jpg);">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-left">
					<div class="display-t">
						<div class="display-tc">
							<h1 class="animate-box" data-animate-effect="fadeInUp">Welcome to Event Management System</h1>
							<h2 class="animate-box" data-animate-effect="fadeInUp">Designed <em>by</em> <a href="" target="_blank">Avdhesh Kumar</a> and <a href="">Kanisque Meena</a></h2>
							<p class="animate-box" data-animate-effect="fadeInUp"></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<?php elseif($_SESSION["loggedin"]==true): ?>
					<div class="gtco-container">
					<div class="row">
						<div class="col-md-12 text-right gtco-contact">
							<ul class="">
								<?php if(isset($_SESSION['fb_id'])):?>
								<h2 class="animate-box profile" data-animate-effect="fadeInUp"><?php echo $uname; ?> <?php echo '<img src="'.'http://graph.facebook.com/'.$_SESSION['fb_id'].'/picture?type=square'.'" align="'.middle.'">' ;?>
								<?php endif;?>				
								</h2>
							</ul>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4 col-xs-12">
							<div id="gtco-logo"><a href="index.php">DBMS</a>
							<?php if(isset($_SESSION["admin"]) && $_SESSION["admin"]==true):?>
							<h3 style="color:RED">ADMIN</H3></a></div>
							<?php endif; ?>
						</div>
						<div class="col-xs-8 text-right menu-1">
							<ul>
								<li class="active"><a href="">Home</a></li>
								<li class="has-dropdown">
									<a href="">Menu</a>
									<ul class="dropdown">
										<li><a href="events.php">Events</a></li>
										<li><a href="workshops.php">Workshops</a></li>
										<li><a href="register.php">Register</a></li>
										<?php if(isset($_SESSION["admin"]) && $_SESSION["admin"]==true):?>
										<li><a href="e_in.php">Add E</a></li>
										<li><a href="w_in.php">Add W</a></li>
										<?php endif; ?>
										<li><a href="logout.php">Logout</a></li>
									</ul>
								</li>
							</ul>
						</div>
					</div>

				</div>
			</nav>

			<header id="gtco-header" class="gtco-cover" role="banner" style="background-image:url(images/img_bg_1.jpg);">
				<div class="overlay"></div>
				<div class="gtco-container">
					<div class="row">
						<div class="col-md-12 col-md-offset-0 text-left">
							<div class="display-t">
								<div class="display-tc">
									<h1 class="animate-box" data-animate-effect="fadeInUp">Welcome to Event Management System</h1>
									<!--h2 class="animate-box" data-animate-effect="fadeInUp">Free HTML5 Bootstrap Templates Made <em>by</em> <a href="http://gettemplates.co/" target="_blank">GetTemplates.co</a></h2-->
									<p class="animate-box" data-animate-effect="fadeInUp"><a href="#" class="btn btn-white btn-lg btn-outline">Get In Touch</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>
	<?php endif; ?>
	<div id="gtco-features-3">
		<div class="gtco-container">
			<div class="gtco-flex">
				<div class="feature feature-1 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-inner">
						<span class="icon">
							<i class="ti-announcement"></i>
						</span>
						<h3>Announcdement</h3>
						<p>Winners to get Free STAR NIGHT passes </p>
						<p></p>
					</div>
				</div>
				<div class="feature feature-2 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-inner">
						<span class="icon">
							<i class="ti-announcement"></i>
						</span>
						<h3>Announcdement</h3>
						<p>Registration for Events is Open. </p>
						<p></p>
					</div>
				</div>
				<div class="feature feature-3 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-inner">
						<span class="icon">
							<i class="ti-timer"></i>
						</span>
						<h3>Timer</h3>
						<span id="countdown" style="color:white;"></p>
						<p></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="gtco-counter" class="gtco-section">
		<div class="gtco-container">

			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading animate-box">
					<h2>Fun Facts</h2>
					<p>We are proud of our wonderful record</p>
				</div>
			</div>

			<div class="row">
				
				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInLeft">
					<div class="feature-center">
						<span class="icon">
							<i class="ti-settings"></i>
						</span>
						<span class="counter js-counter" data-from="0" data-to="<?php echo $workshops; ?>" data-speed="5000" data-refresh-interval="50">1</span>
						<span class="counter-label">Workshops</span>

					</div>
				</div>
				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInLeft">
					<div class="feature-center">
						<span class="icon">
							<i class="ti-face-smile"></i>
						</span>
						<span class="counter js-counter" data-from="0" data-to="<?php echo $registrations; ?>" data-speed="5000" data-refresh-interval="50">1</span>
						<span class="counter-label">Registrations</span>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInLeft">
					<div class="feature-center">
						<span class="icon">
							<i class="ti-briefcase"></i>
						</span>
						<span class="counter js-counter" data-from="0" data-to="<?php echo $events; ?>" data-speed="5000" data-refresh-interval="50">1</span>
						<span class="counter-label">Events</span>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInLeft">
					<div class="feature-center">
						<span class="icon">
							<i class="ti-time"></i>
						</span>
						<span class="counter js-counter" data-from="0" data-to="<?php echo $count; ?>" data-speed="5000" data-refresh-interval="50">1</span>
						<span class="counter-label">Expected Footfall</span>

					</div>
				</div>
					
			</div>
		</div>
	</div>
	
<?php if(!isset($_SESSION["loggedin"])||$_SESSION["loggedin"]==false) : ?>
	<div id="gtco-subscribe">
		<div class="gtco-container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2>Register</h2>
					<?php 
					if(isset($id))
					{
						echo "Please complete the form ...";
					}
					?>
				</div>
			</div>
			<div class="row animate-box">
			<div class="col-md-3">
			</div>
				<div class="col-md-6">
					<form action="index.php" method="post">
						<div class="row form-group">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<label class="sr-only" for="name">Name</label>
								<?php if(isset($_SESSION["uname"])):?>
								<input type="text" id="pname" name="pname" class="form-control" placeholder="Your firstname" value="<?php echo $_SESSION["uname"]?>" readonly required="" title="firstname lastname">
								<?php else: ?>
								<input type="text" id="pname" name="pname" class="form-control" placeholder="Your firstname" required="" title="firstname lastname">
								<?php endif; ?>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-2">
							</div>
							<div class="col-md-8" id="id_pmail">
								<label class="sr-only" for="email">Email</label>
								<?php if(isset($_SESSION["uname"])):?>
								<input type="email" id="pemail" name="pemail" class="form-control" value="<?php echo $_SESSION["email"]?>" readonly placeholder="Your email address" required="">
								<?php else:?>
								<input type="email" id="pemail" name="pemail" class="form-control" placeholder="Your email address" required="">
								<?php endif; ?>
							</div>
							<div class="col-md-2">
										<div class="alert alert-success fade in messg">
										  ok!
										</div>
										<div class="alert alert-danger fade in messg">
										  *
										</div>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<label class="sr-only" for="email">Password</label>
								<input type="password" id="pwd1" pattern=".{7,}" title="7 characters minimum" name="pwd1" class="form-control" placeholder="Password" required="">
							</div>
							
						</div>
						<div class="row form-group">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<label class="sr-only" for="email">Password(Confirm)</label>
								<input type="password" id="pwd2" name="pwd2" class="form-control" placeholder="Password (confirm)" required="" onblur="validate_pwd()">
							</div>
							<div class="col-md-2">
										<div class="alert alert-success fade in messg" id="pass">
										  ok!
										</div>
										<div class="alert alert-danger fade in messg" id="fail">
										  wrong
										</div>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<label class="sr-only" for="contact">Contact </label>
								<input type="text" id="contact" name="contact" pattern=".{10,11}" class="form-control" placeholder="Mobile" required="">
<!--fb_id -->					<input type="hidden" id="fb_id" name="fb_id" class="form-control" value="<?php echo $_SESSION["fb_id"]; ?>" required="">
							</div>
							<div class="col-md-2">
										<div class="alert alert-success fade in messg">
										  ok!
										</div>
										<div class="alert alert-danger fade in messg">
										  *
										</div>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<label class="sr-only" for="college">College </label>
								<input type="text" id="college" name="college" class="form-control" placeholder="college" required="">
							</div>
							<div class="col-md-2">
										<div class="alert alert-success fade in messg">
										  ok!
										</div>
										<div class="alert alert-danger fade in messg">
										  *
										</div>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<label class="sr-only" for="gender">Gender </label>
								<select class="form-control" id="gender" name="gender">
									<option value="m" style="appearance:none; -moz-appearance:none;-webkit-appearance:none;background-color:#303841;" selected>Male</option>
									<option value="f" style="appearance:none; -moz-appearance:none;-webkit-appearance:none;background-color:#303841;">Female</option>
									<option value="o" style="appearance:none; -moz-appearance:none;-webkit-appearance:none;background-color:#303841;">Other</option>
								  </select>
							</div>
							<div class="col-md-2">
										<div class="alert alert-success fade in messg">
										  ok!
										</div>
										<div class="alert alert-danger fade in messg">
										  *
										</div>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<label class="sr-only" for="payment">Payment Method </label>
								<select class="form-control" id="payment" name="payment">
									<option value="Online" style="appearance:none; -moz-appearance:none;-webkit-appearance:none;background-color:#303841;" selected>Online</option>
									<option value="offline" style="appearance:none; -moz-appearance:none;-webkit-appearance:none;background-color:#303841;">Offline</option>
									
								  </select>
							</div>
							<div class="col-md-2">
										<div class="alert alert-success fade in messg">
										  ok!
										</div>
										<div class="alert alert-danger fade in messg">
										  *
										</div>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
							<input type="submit" name="register" value="Register" class="btn btn-primary btn-lg">
							</div>
						</div>

					</form>	
				</div>
			</div>
		</div>
	</div>

<?php endif; ?>	
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- countTo -->
	<script src="js/jquery.countTo.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>
	<script>
		var end = new Date('11/15/2016 10:1 AM');

			var _second = 1000;
			var _minute = _second * 60;
			var _hour = _minute * 60;
			var _day = _hour * 24;
			var timer;

			function showRemaining() {
				var now = new Date();
				var distance = end - now;
				if (distance < 0) {

					clearInterval(timer);
					document.getElementById('countdown').innerHTML = 'EXPIRED!';

					return;
				}
				var days = Math.floor(distance / _day);
				var hours = Math.floor((distance % _day) / _hour);
				var minutes = Math.floor((distance % _hour) / _minute);
				var seconds = Math.floor((distance % _minute) / _second);

				document.getElementById('countdown').innerHTML = days + 'D ';
				document.getElementById('countdown').innerHTML += hours + 'H ';
				document.getElementById('countdown').innerHTML += minutes + 'M ';
				document.getElementById('countdown').innerHTML += seconds + 'S';
			}

			timer = setInterval(showRemaining, 1000);
</script>
<script>
function validate_pwd()
{
	if(document.getElementById("pwd1").value === document.getElementById("pwd2").value && document.getElementById("pwd1").value.length>0)
	{
		document.getElementById("pass").style.display = "block";
		document.getElementById("fail").style.display = "none";
	}
	else
	{
		document.getElementById("fail").style.display = "block";
		document.getElementById("pass").style.display = "none";
	}
}
</script>
</body>
</html>