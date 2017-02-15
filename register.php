<?php
		session_start();
		if(!isset($_SESSION["loggedin"])||$_SESSION["loggedin"]==false)
			header("location:index.php");

?>
<!doctype>
<html>
<head>
<?php
if(isset($_POST["submit"]))
{
	include "connection.php";
	$email = $_SESSION['email'];
	$res2 = mysqli_query($link,"select pid from participants where email='$email'");
	//echo "<script>alert('$email');</script>";
	$res1 = mysqli_query($link,"Select wid,wname from workshops");
	$pid = mysqli_fetch_array($res2);
	while($names = mysqli_fetch_array($res1))
	{
		//echo "<script>alert('$names[0].$names[1]');</script>";
		if(isset($_POST['w'.$names[0]]))
		{	
			//echo "<script>alert('$names[1]');</script>";
			$res = mysqli_query($link,"insert into workshop_reg(pid,wid) values('$pid[0]','$names[0]')");
		}
	}
	
	$res3 = mysqli_query($link,"select eid,ename from events");
	while($names1 = mysqli_fetch_array($res3))
	{
		//echo "<script>alert('$names1[0].$names1[1]');</script>";
		if(isset($_POST['e'.$names1[0]]))
		{	
			//echo "<script>alert('$names1[0]');</script>";
			$res = mysqli_query($link,"insert into parti_events(pid,eid) values('$pid[0]','$names1[0]')");
		}
	}
	echo '<script>alert("Registered Successfully");</script>';
//	foreach($a as $key => $val)
//	{
//		$res = mysqli_query($link,"insert into parti_events(pid,eid) values()");
//	}

	
}


?>
<style>

h1{
  font-size: 30px;
  color: #fff;
  text-transform: uppercase;
  font-weight: 300;
  text-align: center;
  margin-bottom: 15px;
}
table{
  width:100%;
  table-layout: fixed;
}
.tbl-header{
  background-color: rgba(255,255,255,0.3);
 }
.tbl-content{
  height:300px;
  overflow-x:auto;
  margin-top: 0px;
  border: 1px solid rgba(255,255,255,0.3);
}
th{
  padding: 20px 15px;
  text-align: left;
  font-weight: 500;
  font-size: 12px;
  color: #fff;
  text-transform: uppercase;
}
td{
  padding: 15px;
  text-align: left;
  vertical-align:middle;
  font-weight: 300;
  font-size: 12px;
  color: #fff;
  border-bottom: solid 1px rgba(255,255,255,0.1);
}


/* demo styles */

@import url(http://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
body{
  background: -webkit-linear-gradient(left, #25c481, #25b7c4);
  background: linear-gradient(to right, #25c481, #25b7c4);
  font-family: 'Roboto', sans-serif;
}
section{
  margin: 50px;
}


/* follow me template */
.made-with-love {
  margin-top: 40px;
  padding: 10px;
  clear: left;
  text-align: center;
  font-size: 10px;
  font-family: arial;
  color: #fff;
}
.made-with-love i {
  font-style: normal;
  color: #F50057;
  font-size: 14px;
  position: relative;
  top: 2px;
}
.made-with-love a {
  color: #fff;
  text-decoration: none;
}
.made-with-love a:hover {
  text-decoration: underline;
}


/* for custom scrollbar for webkit browser*/

::-webkit-scrollbar {
    width: 6px;
} 
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
} 
::-webkit-scrollbar-thumb {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
}
</style>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
		<script src="js/bootstrap-checkbox.js"></script>
		<script src="dist/js/bootstrap-checkbox.js"></script>
		<script src="dist/js/bootstrap-checkbox.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.1.0.min.js" defer></script>
  <script src="dist/js/bootstrap-checkbox.min.js" defer></script>
<script>
// '.tbl-content' consumed little space for vertical scrollbar, scrollbar width depend on browser/os/platfrom. Here calculate the scollbar width .
$(window).on("load resize ", function() {
  var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
  $('.tbl-header').css({'padding-right':scrollWidth});
}).resize();
</script>
</head>

<section>
<script>
$(':checkbox').checkboxpicker();

</script>
  <a href="index.php"><input type="button" class="btn" value="HOME"></button></a>
  <h1>Register for Events and Workshop</h1>
  <form action="register.php" method="post">
  <div class="tbl-header">
   
    <table cellpadding="0" cellspacing="0" border="0">
      <thead>
        <tr>
          <th>#</th>
          <th>Event</th>
          <th>Register</th>
        </tr>
      </thead>
    </table>
  </div>

	  <div class="tbl-content">
		<table cellpadding="0" cellspacing="0" border="0" style="font-size:35px;">
		  <tbody>
			<?php 
				include "connection.php";
				if(!$link)
				{
					echo "<script>alert('Server Unreachable... ');</script>";
					exit();
				}
				$res = mysqli_query($link,"Select eid,ename from events");
				//$res2 = mysqli_query($link,"Select eid,pid from reg_for_events where pid=(select pid from participants email=".$_SESSION['email'].")");
				$i=0;			
				while($ans=mysqli_fetch_array($res)):
				$i++;
			?>
			<tr>
			  <td><?php echo $i; ?></td>
			  <td><?php echo $ans[1]; ?></td>
			  <td><?php  echo '<input type="checkbox" class="form-control" id="'.$ans[0].'" name="e'.$ans[0].'" value="yes">';
			  ?></td>
			</tr>
			<?php endwhile; ?>
		  </tbody>
		</table>
	</div>
	<br>
  <div class="tbl-header">
   
    <table cellpadding="0" cellspacing="0" border="0">
      <thead>
        <tr>
          <th>#</th>
          <th>Workshops</th>
          <th>Register</th>
        </tr>
      </thead>
    </table>
  </div>
	  <div class="tbl-content">
		<table cellpadding="0" cellspacing="0" border="0" style="font-size:35px;">
		<tr colspan="4"><td></td></tr>
		  <tbody>
			<?php 
				include "connection.php";
				if(!$link)
				{
					echo "<script>alert('Server Unreachable... ');</script>";
					exit();
				}
				$res1 = mysqli_query($link,"Select wid,wname from workshops");
				$i=0;			
				while($ans1=mysqli_fetch_array($res1)):
				$i++;
			?>
			<tr>
			  <td><?php echo $i; ?></td>
			  <td><?php echo $ans1[1]; ?></td>
			  <td><?php echo '<input type="checkbox" class="form-control" id="'.$ans1[0].'" name="w'.$ans1[0].'" value="yes">'; ?></td>
			</tr>
			<?php endwhile; ?>
		  </tbody>
		</table>
		</div>
	<input type="submit" class="btn btn-success btn-primary btn-block" name="submit" id="submit">
  </form>
</section>


<!-- follow me template -->

</body>
</html>