<?php

   session_start();
   require '..\classes\Person.php';
   require '..\classes\SystemActor.php';

   $logout = new Person();
   if(isset($_POST['logout'])){
      $logout->logout();
   }

?>

<!DOCTYPE html>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Home</title>
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
         <!-- CAROUSEL -->  	
         <div id="carousel">
            <div id="owl-demo" class="owl-carousel owl-theme" style="height: 600px; overflow: hidden;">
              
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
         <div id="first-block">
         <div class="line">
               <h2>FeedBack</h2>
               <br>
               <div class="margin style-2" style="overflow-y: scroll; height: 300px">
                  <?php 
                    require_once "..\classes\SystemActor.php";
                    $sys = new SystemActor();
                    $feed = $sys->showFeedback();
                    for ($i= count($feed)-1; $i >= 0 ; $i--) {
                     echo '
                       <form class="customform" action="" method="post">
                  <div class="s-12 l-9 center" style="color:black; border:1px solid black; border-radius:4px;">
                      <p style="font-size:20px">
                        <span style="color: black; font-weight:bold;">
                          FeedBack '.($i+1).':
                        </span>
                      </p>
                      <br>
                      <div class="s-5 m-5 l-10 center">
                         <textarea readonly style="font-size:15px; resize:none;" rows="2">
                         '. $feed[$i]->message .'
                         </textarea>
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
         	        
         <!-- SECOND BLOCK --> 	
         <div id="second-block">
               <div class="s-12 l-8 center">
                  <h2 style="color:white;">Rankings</h2>
                    <br>
                    <div class="margin style-2" style="height: 300px; overflow-y:scroll;">
                    <?php 
                    require_once "..\classes\SystemActor.php";
                    $sys = new SystemActor();
                    $specialists = $sys->showSpRank();
                    for ($i=0; $i < count($specialists); $i++) { 
                      echo '
                        <form class="customform" action="">
                        <div class="s-12 l-9 center" style="color:black; border:1px solid white; border-radius:4px;">
                      <br>
                      <div>
                      <p style="font-size:20px">
                        <span style="color: white; font-weight:bold;">'.($i+1).': </span> 
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
         });	
          
      </script> 
   </body>
</html>