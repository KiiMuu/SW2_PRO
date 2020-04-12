<?php
	require '..\classes\User.php';
	session_start();
	$reg = new User();
	$reg->registeration();
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
   		$username = strip_tags(addslashes(stripslashes($_POST['username'])));
   		$password = strip_tags(addslashes(stripslashes($_POST['password'])));
   		$_SESSION['username'] = $username;
   		$_SESSION['password'] = $password;
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Live Healthy Form</title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Freight Shipping Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Meta tag Keywords -->
<link rel="icon" href="img/exercise.jpg">
<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- js -->
<script src="js/jquery-2.2.3.min.js"></script> 
<!-- //js -->
<!-- web-fonts -->
<link href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Poller+One" rel="stylesheet">
<!-- //web-fonts --> 
</head>
<body>
	<!-- banner --> 
	<div class="video" data-vide-bg="video/ship"> 
	<div class="center-container">
	    <div class="w3ls-agileinfo">
		
          <h1> Live Healthy Form </h1>
		  </div>
		 <div class="bg-agile">
		 
			<h2>User Form</h2>
			<div class="login-form">			
				<form action="" method="post">
					<input type="text"  name="username" placeholder="User name" required="" maxlength="30" />
					<input type="password"  name="password" placeholder="Password" required="" maxlength="30" />
					<input type="number"  name="age" placeholder="Age" required="" min="10" max="100" />
					<input type="number"  name="phone" placeholder="Phone Number" required="" maxlength="11" min="01000000000" />
					<input type="email"  name="email" placeholder="Email" required="" />
					<input type="number"  name="height" placeholder="Height" required="" min="75" max="210" />
					<input type="number"  name="weight" placeholder="Weight" required="" min="35" max="300" />
					<input type="submit" value="Submit">
				</form>	
			</div>	
		</div>
	<script src="js/jquery.vide.min.js"></script>
	<!-- //banner --> 
	 <!--copyright-->
		<div class="copy w3ls">
		    <p>&copy; 2017. Live Healthy Form . All Rights Reserved</p>
	    </div>
	<!--//copyright-->
	</div>	
	</div>	
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
</body>
</html>