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
table tr:hover{
	color:#707B98;
}
.borderless td, .borderless th .borderless tr,{
    border: none;
}
</style>
</head>
<body>

	<div class="gtco-loader"></div>
	
	<div id="page">
	<nav class="gtco-nav" role="navigation">
					<div class="gtco-container">
					<div class="row">
						<div class="col-md-12 text-right gtco-contact">
							<ul class="">
														
								<?php if(isset($_SESSION['fb_id'])):?>								
								<h2 class="animate-box profile" data-animate-effect="fadeInUp"><?php echo $uname; ?> <?php echo '<img src="'.'http://graph.facebook.com/'.$_SESSION['fb_id'].'/picture?type=square'.'" align="'.middle.'">' ;?>
								<?php endif; ?>			
									</h2>
							</ul>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4 col-xs-12">
							<div id="gtco-logo"><a href="index.php">Events</a></div>
						</div>
						<div class="col-xs-8 text-right menu-1">
							<ul>
								<li class="active"><a href="index.php">Home</a></li>
								<li class="has-dropdown">
									<a href="">Menu</a>
									<ul class="dropdown">
										
										<li><a href="index.php#gtco-subscribe">Register</a></li>
										<li><a href="logout.php">Logout</a></li>
									</ul>
								</li>
							</ul>
						</div>
					</div>

				</div>
			</nav>
			<header id="gtco-header" class="gtco-cover" role="banner">
				<div class="overlay"></div>
				<div class="gtco-container">
					<div class="row">
						<div class="col-md-12 col-md-offset-0 text-left">
							<div class="display-t"  style="padding-top:140px;">

							
								<table class="table table-hover borderless" style="background-color:#707B98; color:white;border-radius: 25px;">
								  <thead>
									<tr>
									  <th>#</th>
									  <th>Attribute</th>
									  <th>Value</th>
									</tr>
								  </thead>
								  <tbody>
								  <?php 
										include "connection.php";
										$ev = escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_GET["e"])));
										if(!$link)
											header("location:index.php");
										$res = mysqli_query($link,"select ename,edate,etime,evenue,max_reg,tot_reg,edesc from events where ename='$ev'");
										$i=0;
										$k = array("Event","Date","Time","Venue","Maximum Registration","Total Registrations");
										$ans=mysqli_fetch_array($res);
										for($i=0;$i<6;$i++):
										
								  ?>
									<tr>
									  <th scope="row"><?php echo $i+1 ;?></th>
									  <td><?php echo $k[$i] ;?></td>
									  <td><?php echo $ans[$i] ;?></td>
									</tr>
									<?php endfor; ?>
									</table>
									<table class="table table-hover"   style="background-color:#707B98; color:white;border-radius: 25px;">
										<thead>
										<tr >
										  <th colspan="3" style="text-align:center;">DESSCRIPTION</th>
										  
										</tr>
										</thead>
									<tr>
									  
									  <td colspan="3"  style="text-align:center;"><p><?php echo $ans[$i];?></p></td>
									</tr>
									</table>
									
									<table class="table table-hover"   style="background-color:#707B98; color:white;border-radius: 25px;">
										<thead>
										<tr >
										  <th colspan="3" style="text-align:center;">RULES</th>
										</tr>
										</thead>
									<tr>
									<?php 
											if(!$link)
												header("location:index.php");
											$res = mysqli_query($link,"select rule from rules where ename='$ev'");
											while($ans=mysqli_fetch_assoc($res)):						
									?>
									<tr>
									  <td colspan="3"  style="text-align:center;"><?php echo $ans['rule']; ?></td>
									</tr>
									<?php endwhile; ?>
									</tbody>
									</table>
								
							</div>
						</div>
					</div>
				</div>
			</header>


	
	
	
	


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

</script>
</body>
</html>