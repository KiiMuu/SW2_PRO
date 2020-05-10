<?php

   require '..\classes\User.php';
   session_start();
   $user = new User();
   $user->getData($_SESSION['ID']);
   
   if(isset($_POST['logout'])){
      $user->logout();
   }
   if(isset($_POST['edit'])){
      header("Location:editProfile.php");
   }
   if(isset($_POST['delete'])){
      $user->DeleteAccount($user);
      $user->logout();
      header("Location:..\index.php");
   }

?>

<!DOCTYPE html>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Profile</title>
      <link rel="stylesheet" href="css/components.css">
      <link rel="stylesheet" href="css/icons.css">
      <link rel="stylesheet" href="css/responsee.css">
      <link rel="stylesheet" href="owl-carousel/owl.carousel.css">
      <link rel="stylesheet" href="owl-carousel/owl.theme.css"> 
      <!-- CUSTOM STYLE -->
      <link rel="stylesheet" href="css/template-style.css"> 
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
      <style type="text/css">
         body {
        background: url("../img/exercise.jpg") no-repeat fixed center center / 100% auto rgba(0, 0, 0, 0);
          }
         .style-2::-webkit-scrollbar-track
         {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            border-radius: 10px;
            background-color: #F5F5F5;
         }

         .style-2::-webkit-scrollbar
         {
            width: 12px;
            background-color: #F5F5F5;
         }

         .style-2::-webkit-scrollbar-thumb
         {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: black;
         }
      </style>
      <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
      <script type="text/javascript" src="js/jquery-ui.min.js"></script>    
   </head>
   <body class="size-1140">
      <!-- TOP NAV WITH LOGO -->  
       <header>
         <nav>
            <div class="line">
               <div class="top-nav">              
                  <div class="logo hide-l">
                     <a href="userHome.php">Live <br /><strong>Healthy</strong></a>
                  </div>                  
                  <p class="nav-text">Custom menu text</p>
                  <div class="top-nav s-12 l-5">
                     <ul class="right top-ul chevron">
                        <li><a href="userHome.php">Home</a>
                        </li>
                        <li><a href="Schedule.php">Schedule</a>
                        </li>
                     
                     </ul>
                  </div>
                  <ul class="s-12 l-2">
                     <li class="logo hide-s hide-m">
                        <a href="userHome.php">Live <br /><strong>Healthy</strong></a>
                     </li>
                  </ul>
                  <div class="top-nav s-12 l-5">
                     <ul class="top-ul chevron">
                        <li><a href="AskSpecialist.php">Questions</a>
                        </li>
                     
                        <li><a href="Profile.php"><?php echo $_SESSION['username']; ?></a>
                        </li>
                        <li><a><form action="" method="post"><input type="submit" name="logout" value="LOGOUT" style="background: none; border: none; color: white; cursor:pointer;"></form></a>
                        </li>
                     </ul> 
                  </div>
               </div>
            </div>
         </nav>
      </header>
      <section>
         <div id="head">
            <div class="line">
               <h1>Profile</h1>
            </div>
         </div>
         <div id="content" class="left-align contact-page">
            <div class="line">
               <div class="margin">
                 <h2 align="center">Account Information</h2>
                  <div class="s-12 l-7 center">
                     <br>
                     <form class="customform" action="" method="post">
                        <div class="s-12 l-7 center" style="float: left;" ><label>Name</label></div>
                        <label class="" style="float: right;"><?php echo $_SESSION['username']; ?></label>
                        <br>
                        <br>
                        <br>
                        <div class="s-12 l-7 center" style="float: left;" ><label>Password</label></div>
                        <label class="" style="float: right;"><?php echo $_SESSION['password']; ?></label>
                        <br>
                        <br>
                        <br>
                        <div class="s-12 l-7 center" style="float: left;"><label>Age</label></div>
                        <label  style="float: right;"><?php echo $user->getAge(); ?></label>
                        <br>
                        <br>
                        <br>
                        <div class="s-12 l-7 center" style="float: left;"><label>Height</label></div>
                        <label  style="float: right;"><?php echo $user->getHeight(); ?></label>
                        <br>
                        <br>
                        <br>
                        <div class="s-12 l-7 center" style="float: left;"><label>Weight</label></div>
                        <label  style="float: right;"><?php echo $user->getWeight(); ?></label>
                        <br>
                        <br>
                        <br>
                        <div class="s-12 l-7 center" style="float: left;"><label>Phone</label></div>
                        <label  style="float: right;"><?php echo $user->getPhone(); ?></label>
                        <br>
                        <br>
                        <br>
                        <div class="s-12 l-7 center" style="float: left;"><label>Email</label></div>
                        <label  style="float: right;"><?php echo $user->getMail(); ?></label>
                        <br> 
                        <br>
                        <br>
                        <div class="s-12 l-3 center">
                           <input type="submit" name="edit" value="Edit" />
                           <input type="submit" name="delete" value="Delete" onclick="return confirm('Are you Want to delete you Account')" />
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <!-- MAP -->	
      </section>
      <!-- FOOTER -->   
      <footer>
         <div class="line">
            <div class="s-12 l-6">
               <p>Copyright 2019, Vision Design - graphic zoo
               </p>
            </div>
            <div class="s-12 l-6">
               <p class="right">
                  <a class="right" href="http://www.myresponsee.com" title="Responsee - lightweight responsive framework">Design and coding by Responsee Team</a>
               </p>
            </div>
         </div>
      </footer>
      <script type="text/javascript" src="js/responsee.js"></script> 
      <script type="text/javascript" src="owl-carousel/owl.carousel.js"></script>   
      <script type="text/javascript">
         jQuery(document).ready(function($) {  
           $("#owl-demo2").owlCarousel({
           	slideSpeed : 300,
           	autoPlay : true,
           	navigation : false,
           	pagination : true,
           	singleItem:true
           });
         });	
          
      </script>  
   </body>
</html>