<?php

   require '..\classes\User.php';
    require '..\classes\SystemActor.php';
   session_start();

   $user = new User();
   $user->setUserID($_SESSION['username'],$_SESSION['password']);
   $_SESSION['ID'] = $user->getID();
   
   if(isset($_POST['logout'])){  
      $user->logout();
   }

   if(isset($_POST['sendFeedback']) && $_POST['feedback'] !=""){
      $user = new User();
      $message = strip_tags(addslashes(stripslashes($_POST['feedback'])));
      $user -> sendFeedback($message);
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
               <h2>Questions</h2>
               <br>
               <div class="s-12 l-7 center style-2" style="height: 500px; width:1000px; overflow-y: scroll; ">
                  <?php

                  
                  $sys = new SystemActor();
                  
                  $questions = $sys->ShowQuestionHome();

                  for ($i=0; $i < count($questions); $i++) { 
                     $view = "viewProfile".$i;
                     $answer = "Answer".$i;
                     $report = "Report".$i;
                       echo '
                  <form class="customform" action="" method="post">
                  <div class="s-12 l-9 center" style="color:black; border:1px solid black; border-radius:4px;">
                      <p style="font-size:20px">
                      <span style="color: red; font-weight:bold;">Tag '.($i+1).':</span> '.$questions[$i]->tag.'
                      </p>
                      <p style="font-size:20px">
                      <span style="color: red; font-weight:bold;">Q'.($i+1).':</span> '.$questions[$i]->question.'
                      </p>
                      <br>
                      <span style="color: red; font-weight:bold;">A'.($i+1).':</span>
                      <div class="s-5 m-5 l-10 center">
                         <textarea readonly style="font-size:15px; resize:none;" rows="4">
                         '.$questions[$i]->answer.'
                         </textarea>
                      </div>

                      <br>           
                  </div>
                  <br>
                   </form>
                   ';
                         }
                  ?>
               </div>
            </div>
         </div>
         <!-- SECOND BLOCK -->   
         <div id="second-block">
            <div class="line">
               <h1 style="color: white;">Feedback</h1>
               <br>
               <form class="customform" action="" method="POST">            
                  <textarea name="feedback" rows="10" cols="80" placeholder="Your Opinion ...." style="resize:none"></textarea>
               <div class="s-12 l-2 center">
                   <input type="submit" name="sendFeedback" value="Send Feedback">
               </div>
               <br>
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