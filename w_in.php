<?php
session_start();
$ans = array();

if(!isset($_SESSION["admin"]) || $_SESSION["admin"]==false)
{
	header("location:index.php");
}

if(isset($_POST["submit"]))
{
	include "connection.php";
	if($link)
	{
		$max_reg = escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_POST["max_reg"])));
		$ename = trim(escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_POST["ename"]))));
		$evenue = escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_POST["evenue"])));
		$edate = escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_POST["edate"])));
		$etime = escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_POST["etime"])));
		$message = escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_POST["msg"])));
		$eid = escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_POST["eid"])));
		$number = intval(escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_POST["no_of_rules"]))));
		$rules = array();
		if($ename==''||$ename==null)
		{
			echo "<script>alert('insertion failed ..possibly name is empty...rolling back');</script>";
			exit();
		}
		$rules[0] = '';
		for($i=1;$i<=$number;$i++)
		{
			$rules[$i] = escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_POST["member" . $i])));
			if($rules[$i]==''||$rules[$i]==null)
				break;
		}
		
		$check = mysqli_query($link,"select count(*) from workshops where wid = '$eid'");
		$exist = mysqli_fetch_array($check);
		if($exist[0]==0)
		{
			//echo"<script>alert('hello');</script>";
			$start = mysqli_query($link,"BEGIN");
			$s = mysqli_query($link,"SET autocommit=0;");		//Transaction starts
			if(!$start || !$s)
			{
				echo "<script>alert('Transaction could not be started !!!');</script>";
				exit();
			}
			
				$q1 = "insert into workshops (wname,wdate,wtime,wvenue,wdesc,max_reg) values('$ename','$edate','$etime','$evenue','$message','$max_reg')";
				$res1 = mysqli_query($link,$q1);
				if(!$res1)
				{
					mysqli_query($link,"ROLLBACK");
					echo "<script>alert('insertion failed ..possibly name is repeating....rolling back');</script>";
					exit();
				}
				for($j=1;$j<=$number;$j++)
				{
					
					//$rule = escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_POST["member".$j])));
					$rule = $rules[$j];
					//echo "<script>alert('Rule '".$rule.");</script>";
					$q2 = mysqli_query($link,"insert into instructors (wname,instructor) values('$ename','$rule')");
					if(!$q2)
					{
						mysqli_query($link,"ROLLBACK");
						echo "<script>alert('instructor insertion failed ..rolling back...');</script>";
						exit();
					}
					
				}
			mysqli_query($link,"COMMIT");
			echo "<script>alert('workshops Registered Successfully...".$ename."');</script>";
			mysqli_close($link);
		}
		else if($exist[0]==1)
		{
			mysqli_query($link,"BEGIN");		//Transaction starts
				
				$q2 = "delete from instructors where wname=(select distinct wname from workshops where wid='$eid')";
				$q1 = "update workshops set wname='$ename',wdate='$edate',wtime='$etime',wvenue='$evenue',wdesc='$message',max_reg='$max_reg' where wid='$eid'";
				$res2 = mysqli_query($link,$q2);
				$res1 = mysqli_query($link,$q1);
				if(!$res2)
				{
					mysqli_query($link,"ROLLBACK");
					echo "<script>alert('sadfasd');</script>";
					exit();
				}
				if(!$res1)
				{
					mysqli_query($link,"ROLLBACK");
					echo "<script>alert('updation failed....rolling back');</script>";
					exit();
				}
				
				
				for($i=1;$i<=$number;$i++)
				{
					$rule = escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_POST["member".$i])));
					$q2 = mysqli_query($link,"insert into instructors (wname,instructor) values('$ename','$rule')");
					if(!$q2)
					{
						mysqli_query($link,"ROLLBACK");
						echo "<script>alert('Instructor updation failed ..rolling back...');</script>";
						exit();
					}
				}
			mysqli_query($link,"COMMIT");
			echo "<script>alert('Workshop updated Successfully...');</script>";
			mysqli_close($link);
		}
		else
		{
			echo "<script>alert('More than one instance of event...');</script>";
		}
	}
	
}
?>


<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>DBMS &mdash; Event Management System</title>
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
<script>
$(document).ready(function(){
	$("li#update1").click(function(){
		$("#up_form").css("display","block");
		$("#menu").hide();
	});
});

</script>
	</head>
	<body>
	<?php
		if(isset($_POST["sub_update"]))
		{	
			include "connection.php";

			if($link)
			{
				
				$event = escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_POST["ename"])));
				$eid = intval(escapeshellcmd(preg_replace('/(\/|-|_)/','',htmlspecialchars($_POST["eid"]))));
				$res = mysqli_query($link,"select * from workshops where wname='$event' or wid='$eid'");
				$ans = mysqli_fetch_assoc($res);
				$ename = $ans['wname'];
				
				if($eid>0)
					$q1 = "select instructor from instructors where wname=(select wname from workshops where wid='$eid')";
				else
					$q1 = "select instructor from instructors where wname='$ename'";
				
				$res2 = mysqli_query($link,$q1);
				if($res2)
				{
					echo '<script type="text/javascript">window.onload=function(){
						var container = document.getElementById("rules");
					';
					$i=1;
					while($rule=mysqli_fetch_array($res2))
					{
						echo 'container.appendChild(document.createTextNode("Instructor " +'.$i.'));
							var input = document.createElement("input");
							input.type = "text";
							input.name = "member" + "'.$i.'";
							input.value= "'.$rule[0].'";
							input.className="form-control";
							container.appendChild(input);';
						$i++;
					}
					$no_rules = $i - 1;
					echo '}
					
					</script>';
				}
			}
		}
	
	
	
	?>
	<div class="gtco-loader"></div>
	
	<div id="page">
	<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 text-right gtco-contact">
							<form class="form-inline" action="w_in.php" method="post" style="display:none;" id="up_form">
								  <div class="form-group">
									<label for="ename">Workshop Name:</label>
									<input type="text" name="ename" style="height:30px; width:200px; font-size:15px; color:white;" class="form-control input-lg" id="ename">
								  </div>
								  <div class="form-group">
									<label for="pwd">or Workshop ID:</label>
									<input type="number" name="eid" style="height:30px; width:200px; font-size:15px; color:white;" class="form-control input-lg">
								  </div>
								  <button type="submit" name="sub_update" style="height:30px; font-size:15px; padding-top:3px;" class="btn btn-default input-sm">Update</button>
								  
								 <!-- <a href="#" class="btn btn-white btn-lg btn-outline" style="height:30px; font-size:15px; padding-top:3px;" >Sign Up</a>-->
							</form>
				</div>
			</div>
			<div class="row" id="menu">
				<div class="col-sm-4 col-xs-12">
					<div id="gtco-logo"><a href="index.html">DBMS <em>Register Workshops</em></a></div>
				</div>
				<div class="col-xs-8 text-right menu-1">
					<ul>
						<li><a href="index.php">Home</a></li>
						
					
							
						<li><a href="#reg">Register</a></li>
							
						
						
					</ul>
				</div>
			</div>
			
		</div>
	</nav>

	<header id="gtco-header" class="gtco-cover gtco-cover-xs" role="banner" style="background-image:url(images/img_bg_1.jpg);">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div class="display-t">
						<div class="display-tc">
							<h1 class="animate-box" data-animate-effect="fadeInUp">DBMS</h1>
							<h2 class="animate-box" data-animate-effect="fadeInUp">Workshop Registration </h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	
	<div id="reg"class="gtco-section">
		<div class="gtco-container">
			<div class="row row-pb-md">
			<div class="col-md-3 animate-box">
			</div>
				<div class="col-md-6 animate-box">
					<h3>Please fill the details about Workshop</h3>
					<form action="w_in.php" method="post">
						<div class="row form-group">
							<div class="col-md-12">
								<input type="hidden" id="eid" name="eid" class="form-control" value="<?php if(isset($ans['wid'])) echo $ans['wid'];  ?>" placeholder="Name of Workshop" readonly>
							</div>
							
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Name of Workshop</label>
								<input type="text" id="name" name="ename" class="form-control" value="<?php if(isset($ans['wname'])) echo $ans['wname'];  ?>" placeholder="Name of Workshop">
							</div>
							
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Venue</label>
								<input type="text" id="name" name="evenue" class="form-control" value="<?php if(isset($ans['wvenue'])) echo $ans['wvenue'];  ?>" placeholder="Venue">
							</div>
							
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Date</label>
								<input type="date" id="name" name="edate" class="form-control" value="<?php if(isset($ans['wdate'])) echo $ans['wdate'];  ?>" placeholder="Date">
							</div>
							
						</div>
						
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Time</label>
								<input type="time" id="name" name="etime" class="form-control" value="<?php if(isset($ans['wtime'])) echo $ans['wtime'];  ?>" placeholder="time">
							</div>
							
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="email">Max Registrations</label>
								<input type="number" id="max_reg" name="max_reg" class="form-control" value="<?php if(isset($ans['max_reg'])) echo $ans['max_reg'];  ?>" placeholder="Max Registrations">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="message">Message</label>
								<textarea name="msg" id="message" cols="30" rows="7" class="form-control" placeholder="Description"> <?php if(isset($ans['wdesc'])) echo $ans['wdesc'];  ?></textarea>
							</div>
						</div>
						
						<input type="hidden" class="form-control" value="<?php if(!isset($no_rules))
																					$no_rules=0;	
																					echo $no_rules;
																		?>" name="no_of_rules" id="no_of_rules"> 
						<div class="row form-group">
						
							<div id="rules" class="col-md-12">
								
									
										
									
									
									
										
									
							</div>
							
						</div>
						<div class="form-group">
							<input type="button" class="btn" id="rules_btn" value="Add Instructor" onclick="addFields()" >
							<input type="button" class="btn" id="rules_btn1" value="Remove Instructor" onclick="removeFields()"><br>
							<input type="submit" value="Submit" name="submit" class="btn btn-primary btn-lg">
						</div>

					</form>		
				</div>
				
			</div>
			</div>
			
		</div>
	</div>


	<footer id="gtco-footer" role="contentinfo">
		<div class="gtco-container">
			

			<div class="row copyright">
				<div class="col-md-12">
					<p class="pull-left">
						<small class="block">Event Management</small> 
					</p>
					<p class="pull-right">
						<ul class="gtco-social-icons pull-right">
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-linkedin"></i></a></li>
							<li><a href="#"><i class="icon-dribbble"></i></a></li>
						</ul>
					</p>
				</div>
			</div>

		</div>
	</footer>
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

        <script type='text/javascript'>
        function addFields(){
            // Number of inputs to create
            var number = document.getElementById("no_of_rules").value;
            // Container <div> where dynamic content will be placed
            var container = document.getElementById("rules");
			
            // Clear previous contents of the container
			var n = 0;
            if(number=='')
				n = 1;
			else
				n = parseInt(number) + 1;
			
			
			document.getElementById("no_of_rules").value = n;
                // Append a node with a random text
                container.appendChild(document.createTextNode("Instructor " + n));
                // Create an <input> element, set its type and name attributes
                var input = document.createElement("input");
                input.type = "text";
                input.name = "member" + n;
				input.className="form-control";
                container.appendChild(input);
                // Append a line break 
              //  container.appendChild(document.createElement("br"));
            
			//container.appendChild(document.createTextNode("Rule " + (i+1)));
                // Create an <input> element, set its type and name attributes
             
        }
		function removeFields(){
			var number = document.getElementById("no_of_rules").value;
            // Container <div> where dynamic content will be placed
            var container = document.getElementById("rules");
			
            // Clear previous contents of the container
			var n = 0;
            if(number=='' || parseInt(number)==0)
				n = 0;
			else 
				n = parseInt(number) - 1;
			document.getElementById("no_of_rules").value = n;
			 container.removeChild(container.lastChild);
			 container.removeChild(container.lastChild);
		}
    </script>
	</body>
</html>

