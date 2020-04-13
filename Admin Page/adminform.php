<?php

   require '..\classes\admin.php';
   session_start();

   $admin = new admin();
   
   if($_SERVER['REQUEST_METHOD'] == "POST"){

    $admin->setName(strip_tags(addslashes(stripslashes($_POST['username']))));
    $admin->setPassword(strip_tags(addslashes(stripslashes($_POST['password']))));
    $admin->setPhone(strip_tags(addslashes(stripslashes($_POST['phone']))));
    $admin->setMail(strip_tags(addslashes(stripslashes($_POST['email']))));
    $admin->setAge(strip_tags(addslashes(stripslashes($_POST['age']))));

    $admin->addNewAdmin($admin);
    
   }

   if(isset($_POST['logout'])){  
    $admin->logout();
   }

?>

<!DOCTYPE html>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Edit Profile</title>
      <link rel="icon" href="img/exercise.jpg">
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
        background: url("../img/exercise1.jpg") no-repeat fixed center center / 100% auto rgba(0, 0, 0, 0);
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
                     <a href="adminHome.php">Live <br /><strong>Healthy</strong></a>
                  </div>                  
                  <p class="nav-text">Custom menu text</p>
                  <div class="top-nav s-12 l-5">
                     <ul class="right top-ul chevron">
                        <li><a href="adminHome.php">Home</a>
                        </li>
                        <li><a href="Control.php">Control</a>
                        </li>
                        <li><a href="Filter.php">Users Filter</a>
                        </li>
     
                     </ul>
                  </div>
                  <ul class="s-12 l-2">
                     <li class="logo hide-s hide-m">
                        <a href="adminHome.php">Live <br /><strong>Healthy</strong></a>
                     </li>
                  </ul>
                  <div class="top-nav s-12 l-5">
                     <ul class="top-ul chevron">
                        <li><a href="Reports.php">Questions</a>
                        </li>
                        <li><a href="Advertisement.php">Advertisement</a>
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
         <div id="content">
          <div class="s-12 l-4 center">      
             <form class="customform" action="" method="post">
                      <label class="label" style="float: left;">UserName:</label>
                      <input type="text" name="username" style="float: right;" required=""/>
                      <br><br>
                      <label class="label" style="float: left;">Password:</label>
                      <input type="text" name="password" style="float: right;" required=""/>
                      <br><br>
                      <label class="label" style="float: left;">Age:</label>
                      <input type="number" name="age" style="float: right;" min="20" max="80" required=""/>
                      <br><br>
                      <label class="label" style="float: left;">Phone:</label>
                      <input type="number" name="phone" style="float: right;" required="" maxlength="11" min="01000000000" />
                      <br><br>
                      <label class="label" style="float: left;">Email:</label>
                      <input type="Email" name="email" style="float: right;" required=""/>
                      <br>
                      <br>
                      <div class="s-12 l-3 " style="float: right;">
                        <input type="submit" value="Add" />
                      </div>
               </form>
             
            </div>
            </div>
            
         
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