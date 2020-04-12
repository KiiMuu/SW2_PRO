<?php

	require '..\classes\Specialist.php';
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$register = new Specialist();
   		
   		$username = strip_tags(addslashes(stripslashes($_POST['username'])));
   		$password = strip_tags(addslashes(stripslashes($_POST['password'])));
		$age  	  = strip_tags(addslashes(stripslashes($_POST['age'])));
		$phone	  = strip_tags(addslashes(stripslashes($_POST['phone'])));
		$email    =	strip_tags(addslashes(stripslashes($_POST['email'])));

		$name = $register->search($username);
		
		if($username == $name['username']){
			echo '<script type="text/javascript">
					alert("*Username is Exist please enter another one");
					document.location="register.php";
	 			</script>';
		}else {
			require_once '..\classes\Request.php';
			$req = new Request();
				$req->setName($username);
				$req->setPassword($password);
				$req->setAge($age);
				$req->setPhone($phone);
				$req->setMail($email);

    			$fileName=$_FILES['upfile']['tmp_name'];//path of the file 
    			$fileType=$_FILES['upfile']['type']; // type of the file
    			
    			if(empty($fileName)){
		        	echo '<script type="text/JavaScript">
		        		alert("There are no name to the file");
		        		document.location="register.php";
		         	</script>';
		    	}
		        else if($fileType == 'image/jpeg'){
		            echo '<script type="text/JavaScript">
		        			alert("this type is not allowed");
		        			document.location="register.php";
		        			</script>';
		            die("sorry");
		        } else {

		        	$open = opendir('uploads');
	    			move_uploaded_file($fileName, "uploads/".$username.".pdf");
	    			closedir($open);
		        
					$register->sendrequest($req);
			
					echo '<script type="text/javascript">
						alert("Your request has been sent , We will send for you a confirmation message if you have been accepted or not");
						document.location="http://localhost/project-sa2/index.php";	
					</script>';
			}
		}
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
		 
			<h2>Specialist Form</h2>
			<div class="login-form">			
				<form action="" method="post" enctype="multipart/form-data">
					<input type="text"  name="username" placeholder="User name" required=""  maxlength="30" />
					<input type="password"  name="password" placeholder="Password" required="" maxlength="30" />
					<input type="number"  name="age" placeholder="Age" required="" min="20" max="80" />
					<input type="number"  name="phone" placeholder="Phone Number" required="" maxlength="11" min="01000000000" />
					<input type="email"  name="email" placeholder="Email" required="" />
					<div class="s-3 l-3" style="color:white;">Please upload your CV</div>
					<input type="file" name="upfile" required="" style="color:white;">
					<input type="submit" value="Submit">
				</form>	
			</div>	
		</div>
	<script src="js/jquery.vide.min.js"></script>
	<!-- //banner --> 
	 <!--copyright-->
	 	<br>
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