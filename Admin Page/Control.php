<?php

   session_start();

   require '..\classes\admin.php';
   require_once '..\classes\SystemActor.php';
   require_once '..\classes\Request.php';

   $admin = new Admin();

   if(isset($_POST['logout'])){
      $admin->logout();
   }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //something posted

      if(isset($_POST['addAdmin'])){
        header("Location:adminform.php");
      }

      if(isset($_POST['searchButton'])){
        $object = $admin->search($_POST['searchText']);
        if(!empty($object[0])){
          $name = $object[0]->username;
          $ut = $object[0]->User_type;
          $id = $object[0]->ID;
          header("Location:SearchResult.php?NAME=$name&UT=$ut&ID=$id");
        }else{
          echo '<script type="text/javascript">
                  alert("This person not found");
              </script>';
        }
      }

      $sy = new SystemActor();
      $req = $sy->showRequest();

      for ($s=0; $s < count($req); $s++) { 
        $request = new Request();
        $h = "hire".$s;
        $r = "refuse".$s;
        
      if (isset($_POST[$h])) {
        
        $request->setName($req[$s]->username); 
        $request->setPassword($req[$s]->password);
        $request->setAge($req[$s]->age);
        $request->setPhone($req[$s]->phone);
        $request->setMail($req[$s]->email);
        
        $admin->hireSpecialist($request);
      } 
      if (isset($_POST[$r])) {
        $request->setName($req[$s]->username); 
        $request->setPassword($req[$s]->password);
        $request->setAge($req[$s]->age);
        $request->setPhone($req[$s]->phone);
        $request->setMail($req[$s]->email);
        
       $admin->refuseSpecialist($request);
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Control</title>
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
      <section>
         <div id="head">
            <div class="line">
               <h1>Control</h1>
            </div>
         </div>
         <div id="content">
         <div class="s-8 l-6 center">
         <form class="customform" method="POST"> 
         <div class="s-8 l-7 center">
         <input type="submit" name="addAdmin" value="Add New Admin">
         </div>
         <br>
          <input type="text" name="searchText">
          <div class="s-5 l-2 right" >
          <input type="submit" name="searchButton" value = "Search">
          </div>
          </form>
         </div>
         <div class="line">
               <h2>Requests</h2>
            </div>
            <div class="s-12 l-7 center style-2" style="height: 500px; overflow-y: scroll; " >
            	<ul style="list-style-type: none;">
            		<?php
                  require_once "..\classes\SystemActor.php";
                  $sys = new SystemActor();
                  $reqs = $sys->showRequest();

                  for ($i=0; $i < count($reqs); $i++) { 
                  $hire = "hire".$i;
                  $refuse = "refuse".$i;
                    
                    echo '<li><div class="s-9 l-7 center" style="margin-top: 30px; border: 1px solid black ; padding: 10px ; border-radius: 6px; width: 700px ;height:300px"  >
                            <form class="customform" action="" method="POST">
                            <div class="s-12 l-9 center">
                              <div class="s-1 l-1 " style="float: left;" ><label>Name</label></div>
                                 <label class="" style="float: right;">'.$reqs[$i]->username.'</label>
                                 <br>
                                 <br>
                                 <br>
                                 <div class="s-1 l-1 " style="float: left;"><label>Age</label></div>
                                 <label  style="float: right;">'.$reqs[$i]->age.'</label>
                                 <br>
                                 <br>
                                 <br>
                                 <div class="s-1 l-1 " style="float: left;"><label>Email</label></div>
                                 <label  style="float: right;">'.$reqs[$i]->email.'</label>
                                 <br> 
                                 <br>
                                 <br>
                                 <div class="s-1 l-1 " style="float: left;"><label>Qualifications</label></div>
                                 <div class="s-3 l-3 right" style="color:white;">
                                  <button>
                                    <a style="color:white" href = "../spForm/uploads/' . $reqs[$i]->username .'.pdf">
                                      Download CV
                                    </a>
                                  </button>
                                 </div>
                                 
                                 <br> 
                                 <br>
                                 <br>
                                 </div>
                              <div class="s-5 m-5 l-3 left">
                              <input type="submit" name="'.$hire.'" value="Hire" style="margin-left: 100px">
                              </div>
                              <div class="s-5 m-5 l-3 right">
                              <input type="submit" name="'.$refuse.'" value="Refuse" style="margin-left: -200px"> 
                              </div>
                           </form>
                     </div>
                  </li>';
                  }

                ?>
            </ul>
           
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