<?php
   require_once "../classes/Admin.php";
   $admin = new Admin();

   if($_GET){
      $name = $_GET['NAME'];
      $ut = $_GET['UT'];
      $id = $_GET['ID'];
   }else{
      echo "mesh sha3'ala ya mawlana";
   }

   if(isset($_POST["removeU"])){
      $admin->removeUser($id);
      header("Location:Control.php");
   }
   
   if(isset($_POST["makeUAdmin"])){
      $admin->makeUAdmin($id);
      header("Location:Control.php");
   }

  if(isset($_POST["makeSAdmin"])){
      $admin->makeSAdmin($id);
      header("Location:Control.php");
   }

   if(isset($_POST["removeS"])){
      $admin->removeSpecialist($id);
      header("Location:Control.php");
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
         <div id="content" class="left-align contact-page">
            <?php
              if($ut == 2){
               require_once '../classes/User.php';
               $user = new User();
               $user->getData($id);

                  echo '<div class="s-9 l-7 center" style="margin-top: 30px; border: 1px solid black ; padding-top: 50px; border-radius: 6px; width: 700px ; height:450px">
                      <form class="customform" action="" method="POST">
                      <div class="s-12 l-9 center">
                        <div class="s-1 l-1 " style="float: left;" ><label>Name</label></div>
                           <label class="" style="float: right;">'. $user->getName().'</label>
                           <br>
                           <br>
                           <div class="s-1 l-1 " style="float: left;"><label>Age</label></div>
                           <label  style="float: right;">'. $user->getAge() .'</label>
                           <br>
                           <br>
                           <div class="s-1 l-1 " style="float: left;" ><label>Phone</label></div>
                           <label class="" style="float: right;">'. $user->getPhone().'</label>
                           <br>
                           <br>
                           <div class="s-1 l-1 " style="float: left;"><label>Email</label></div>
                           <label  style="float: right;">'. $user->getMail() .'</label>
                           <br>
                           <br>
                           <div class="s-1 l-1 " style="float: left;" ><label>Weight</label></div>
                           <label class="" style="float: right;">'. $user->getWeight().'</label>
                           <br>
                           <br>
                           <div class="s-1 l-1 " style="float: left;" ><label>Height</label></div>
                           <label class="" style="float: right;">'. $user->getHeight().'</label>
                           <br>
                           <br>
                           </div>
                        <div class="s-5 m-5 l-3 center">
                          <input type="submit" name="makeUAdmin" value="Make Admin">

                          <input type="submit" name="removeU" value="Remove User">
                        </div>
                     </form>
               </div>
              ';
            } else if($ut == 3) {
              require_once '../classes/Specialist.php';
              $sp = new Specialist();
              $sp->getData($id);

                echo '<div class="s-9 l-7 center" style="margin-top: 30px; border: 1px solid black ; padding-top: 50px; border-radius: 6px; width: 700px ; height:470px">
                    <form class="customform" action="" method="POST">
                    <div class="s-12 l-9 center">
                      <div class="s-1 l-1 " style="float: left;" ><label>Name</label></div>
                         <label class="" style="float: right;">'. $sp->getName().'</label>
                         <br>
                         <br>
                         <div class="s-1 l-1 " style="float: left;"><label>Age</label></div>
                         <label  style="float: right;">'. $sp->getAge() .'</label>
                         <br>
                         <br>
                         <div class="s-1 l-1 " style="float: left;" ><label>Phone</label></div>
                         <label class="" style="float: right;">'. $sp->getPhone().'</label>
                         <br>
                         <br>
                         <div class="s-1 l-1 " style="float: left;"><label>Email</label></div>
                         <label  style="float: right;">'. $sp->getMail() .'</label>
                         <br>
                         <br>
                         <div class="s-1 l-1 " style="float: left;"><label>Rating</label></div>
                         <label  style="float: right;">'. $sp->getRating() .'</label>
                         <br>
                         <br>
                         <div class="s-1 l-1 " style="float: left;"><label>Qualifications</label></div>
                         <div class="s-3 l-3 right" style="color:white;">
                                  <button>
                                    <a style="color:white" href = "../spForm/uploads/' . $sp->getName() .'.pdf">
                                      Download CV
                                    </a>
                                  </button>
                                 </div>
                         <br>
                         <br>
                         </div>
                      <div class="s-5 m-5 l-3 center">
                        <input type="submit" name="makeSAdmin" value="Make Admin">
                        <input type="submit" name="removeS" value="Remove Specialist">
                      </div>
                   </form>
             </div>
              ';
            }
         ?>
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