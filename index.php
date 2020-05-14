<?php

	require 'classes\Person.php';
    require 'classes\Database.php';

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
	   session_start();
	   $username = strip_tags(addslashes(stripslashes($_POST['username'])));
	   $password = strip_tags(addslashes(stripslashes($_POST['password'])));
	   $_SESSION['username'] = $username;
	   $_SESSION['password'] = $password;
	   $db = new Database();
	   $log = new Person();
	   $conn = $db->connect();
	   $log->login( $username , $password , $conn);
	   
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Login</title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Awesome Login Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Meta tag Keywords -->
<!-- css files -->
<link rel="icon" href="img/exercise.jpg">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" /> <!-- Style-CSS --> 
<link rel="stylesheet" href="css/font-awesome.css"> <!-- Font-Awesome-Icons-CSS -->
<!-- //css files -->
<!-- web-fonts -->
<link href="//fonts.googleapis.com/css?family=Philosopher:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,vietnamese" rel="stylesheet">
<!-- //web-fonts -->
</head>
<body>
<div data-vide-bg="video/social2">
	<div class="center-container">
		<!--header-->
		<div class="header-w3l">
			<h1>Live Healthy Login</h1>
		</div>
		<!--//header-->
		<!--main-->
		<div class="main-content-agile">
			<div class="wthree-pro">
				<h2>Login</h2>
			</div>
			<div class="sub-main-w3">	
				<form action="" method="post"><br>
					<input placeholder="User Name" name="username" type="text" required="">
					<span class="icon1"><i class="fa fa-user" aria-hidden="true"></i></span><br><br>
					<input  placeholder="Password" name="password" type="password" required="">
					<span class="icon2"><i class="fa fa-unlock" aria-hidden="true"></i></span>
					<div class="rem-w3">
						<span class="check-w3"><input type="checkbox" onclick="return alert('m4 hftkerha ana 7or :P');" />Remember Me</span>
						<a href="#" onclick="return alert('E3ml account gedid m3ndna4 el option dah :)');">Forgot Password?</a><br><br>
						<a href="userForm/register.php" style="margin-right: 38%;">Sign Up as User</a><br><br>
						<a href="spForm/register.php" style="margin-right: 35%">Specialist Request</a>
						<div class="clear"></div>
					</div>
					<div class="navbar-right social-icons"> 
							<ul>
								<li><a href="#" class="fa fa-facebook icon-border facebook" onclick="return alert('L2 dol Mnzr :D');"> </a></li>
								<li><a href="#" class="fa fa-twitter icon-border twitter" onclick="return alert('L2 dol Mnzr :D');"> </a></li>
								<li><a href="#" class="fa fa-google-plus icon-border googleplus" onclick="return alert('L2 dol Mnzr :D');"> </a></li> 
								<li><a href="#" class="fa fa-pinterest icon-border rss" onclick="return alert('L2 dol Mnzr :D');"> </a></li>
							</ul>  
						</div>
					<input type="submit" value="Login">

				</form>
			</div>
		</div>
		<!--//main-->
		<!--footer-->
		<div class="footer">
			<p>&copy; 2019 Live Healthy Login. All rights reserved</p>
		</div>
		<!--//footer-->
	</div>
</div>
<!-- js -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script src="js/jquery.vide.min.js"></script>
<!-- //js -->
</body>
</html>