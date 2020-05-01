<?php

   session_start();
   require '..\classes\Admin.php';
   require_once '..\classes\SystemActor.php';
   require '..\fpdf181\fpdf.php';
   require_once '..\classes\Fcatory.php';
   $Adm = Factory::getUser(0) ;
  
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $sys = new SystemActor();
    $reports = $sys->ShowReport();

    for ($i=0; $i < count($reports); $i++){

     $Accept = "Accept".$i;
     $Refuse = "Refuse".$i;
     $PDF = "Pdf".$i;

     if (isset($_POST[$PDF])) {
       header("Location:../classes/PDF.php?RER=".$reports[$i]->question_ID);
     }

     if (isset($_POST[$Accept])) {
       
       $Adm->acceptReport($reports[$i]->ID ,$reports[$i]->question_ID);
     }

     if (isset($_POST[$Refuse])) {
       $Adm->refuseReport($reports[$i]->ID);
     }
    }
  }
   
   if(isset($_POST['logout'])){
      $Adm->logout();
   }

?>
<!DOCTYPE html>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Reports</title>
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
               <h1>Reports</h1>
            </div>
         </div>
         <div id="content">
            <div class="line">
          </div>
          <div class="s-12 l-9 center style-2" style="overflow-y:scroll; height:700px; width:1000px;">
          	<?php
             $sys = new SystemActor();
             $reports = $sys->ShowReport();
             for ($i=0; $i < count($reports); $i++) {
                $Accept = "Accept".$i;
                $Refuse = "Refuse".$i;
                $PDF = "Pdf".$i;
                  echo '
                  <form class="customform" action="" method="post">
                  <div class="s-12 l-9 center" style="color:black; border:1px solid black; border-radius:4px;">
                      <p style="font-size:20px">
                      <span style="color: red; font-weight:bold;">User Id :  </span>'.$reports[$i]->user_ID.'<br>
                      <span style="color: red; font-weight:bold;">User name :  </span>'.$sys->getUsername($reports[$i]->user_ID).'<br>
                      <span style="color: red; font-weight:bold;">specialists Id :  </span>'.$reports[$i]->specialist_ID.'<br>
                      <span style="color: red; font-weight:bold;">specialists name :  </span>'.$sys->getSpecialistname($reports[$i]->specialist_ID).'<br>
                      </p>
                      <br>
                      <div class="s-5 m-5 l-7 center">
                      <input type="submit" name="'.$PDF .'" value="PDF download">
                      <input type="submit" name="'.$Accept .'" value="Accept Report">
                      <input type="submit" name="'.$Refuse .'" value="Refuse Report">
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