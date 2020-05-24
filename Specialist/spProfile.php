<?php

   require '..\classes\Specialist.php';
   session_start();
   $sp = new Specialist();
   $sp->getData($_SESSION['ID']);
   
   if(isset($_POST['logout'])){  
    $sp->logout();
   }

   if(isset($_POST['edit'])){
      header("Location:editProfile.php");
   }
   if(isset($_POST['delete'])){
      $sp->DeleteAccount($sp);
      $sp->logout();
      header("Location:..\index.php");
   }

?>

<!DOCTYPE html>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Profile</title>
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
                     <a href="spHome.php">LIVE <br /><strong>HEALTHY</strong></a>
                  </div>
                                    <div class="top-nav s-12 l-5">
                     <ul class="right top-ul chevron">
                        <li><a href="spHome.php">Home</a>
                        </li>
                        <li><a href="questions.php">Questions</a>
                        </li>
                     </ul>
                  </div>
                  <ul class="s-12 l-2">
                     <li class="logo hide-s hide-m">
                        <a href="spHome.php">LIVE <br /><strong>HEALTHY</strong></a>
                     </li>
                  </ul>

                  <div class="top-nav s-12 l-5">
                     <ul class="top-ul chevron">
                        <li><a href="spProfile.php"><?php echo $_SESSION['username']; ?></a>
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
                      <label class="label">UserName:</label>
                      <label class="info"><?php echo $_SESSION['username']; ?></label>
                      <br><br>
                      <label class="label">Password:</label>
                      <label class="info"><?php echo $_SESSION['password']; ?></label>
                      <br><br>
                      <label class="label">Age:</label>
                      <label class="info"><?php echo $sp->getAge(); ?></label>
                      <br><br>
                      <label class="label">Phone:</label>
                      <label class="info"><?php echo $sp->getPhone(); ?></label>
                      <br><br>
                      <label class="label">Email:</label>
                      <label class="info"><?php echo $sp->getMail(); ?></label>
                      <br><br><br>
                      <div class="s-12 l-3 center">
                         <input type="submit" name="edit" value="Edit">
                         <input type="submit" name="delete" value="Delete" onclick="return confirm('Are you Want to delete you Account')" />
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