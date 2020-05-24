<?php

   require '..\classes\Specialist.php';
   require '..\classes\SystemActor.php';
   session_start();
   
   $sp = new Specialist();
   $sp->setSpID($_SESSION['username'],$_SESSION['password']);
   $_SESSION['ID'] = $sp->getID();
   $sp->getData($_SESSION['ID']);

   if(isset($_POST['logout'])){
      $sp->logout();
   }

?>

<!DOCTYPE html>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Home</title>
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
         <!-- CAROUSEL -->  	
         <div id="carousel">
            <div id="owl-demo" class="owl-carousel owl-theme" style="height:600px; overflow: hidden;">
               <?php
            
            $sy = new SystemActor();
            $ads = $sy->showAdvertisement();
            for ($i=0; $i <count($ads) ; $i++) { 
              echo '<div class="item">
                  <img src="../img/'.$ads[$i]->companyName.'.jpg" alt="">    
                  <div class="carousel-text">
                     <div class="line">
                        <div class="s-12 l-9">
                           <h2>'.$ads[$i]->companyName.'</h2>
                        </div>
                        <div class="s-12 l-9">
                           <p>'.$ads[$i]->description.' Advertisement</p>
                        </div>
                     </div>
                  </div>
               </div>';
                }
               ?>
                  </div>
               </div>
               
         <!-- FIRST BLOCK --> 	
         <div id="first-block"  style="display: none;">
            <div class="line">
               <div class="margin">
               <div class="s-0 m-3 l-3 margin-bottom"></div>
                  <div class="s-12 m-6 l-6 margin-bottom noti">
                     <h1>New <span style="color: red; border: 1px solid black; padding: 0 5px 0 5px; border-radius: 5px; font-weight: bold;"><a class="newQ" href="questions.php" style="color: red;"><?php require_once '..\classes\SystemActor.php'; $sy = new SystemActor(); $questions = $sy->showNewQuestions(); echo count($questions); ?></a></span> Questions</h1>
                  </div>
               <div class="s-0 m-3 l-3 margin-bottom"></div>
               </div>
            </div>
         </div>
         <!-- SECOND BLOCK --> 	
         <div id="second-block">
            <div class="line">
               <div class="margin-bottom">
                  <div class="margin">
                     <article class="s-12 l-8 center">
                        <h1>Own Rating:</h1>
                        <p class="margin-bottom" style="font-size: 100px;"><?php echo $sp->getRating()." Pts"; ?></p>
                         			
                     </article>
                  </div>
               </div>
            </div>
         </div>
         <!-- Rank --> 	
         <div id="third-block" class="style-2">
            <div class="line">
               <h2>Rankings</h2>
               <br>
               <div class="margin">
                  <div class="s-12 m-6 l-12 style-2" style="  height: 300px; overflow-y: scroll; color: black; margin: 10px; ">
                   <?php 
                       require_once "..\classes\SystemActor.php";
                       $sys = new SystemActor();
                       $specialists = $sys->showSpRank();
                       for ($i=0; $i < count($specialists); $i++) { 
                         echo '
                          <form class="customform" action="">
                     <div class="s-12 l-9 center" style="color:black; border:1px solid black; border-radius:4px;">
                         <br>
                         <div>
                         <p style="font-size:20px">
                           <span style="color: black; font-weight:bold;">'.($i+1).': </span> 
                           '. $specialists[$i]->username .' '. $specialists[$i]->rating . ' pts
                         </p>
                         </div>
                         <br>           
                     </div>
                     <br>
                      </form>';
                       }
                      ?>
                  </div>
               </div>
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
           $("#owl-demo").owlCarousel({
           	slideSpeed : 300,
           	autoPlay : true,
           	navigation : false,
           	pagination : false,
           	singleItem:true
           });
           $("#owl-demo2").owlCarousel({
           	slideSpeed : 300,
           	autoPlay : true,
           	navigation : false,
           	pagination : true,
           	singleItem:true
           });
           
           $(this).mouseenter(function(){
               $("#first-block").slideDown(3000);
           });

           function LoopForever(){
               $(this).mouseenter(function(){
               $('.newQ').fadeOut(500);
               $('.newQ').fadeIn(500);
               
           });
           }
           var interval = self.setInterval(function(){LoopForever()},);
         });	
          
      </script> 
   </body>
</html>