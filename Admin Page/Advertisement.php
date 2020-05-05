<?php

   session_start();
   require '..\classes\Admin.php';
   require_once '..\classes\SystemActor.php';
   require '..\classes\Advertisement.php';


   if($_SERVER["REQUEST_METHOD"] === "POST"){
    
  $s = new SystemActor();
  $ad = $s->showAdvertisement();
  $admin = new Admin();
  for ($e=0; $e <count($ad) ; $e++) { 
    $rem1 = "rem"+$e;
    if(isset($_POST[$rem1])){
      $name = $ad[$e]->companyName;
      $admin->removeAdvs($name);
    }

  }
  if(isset($_POST['add'])){
    $advv = new Advertisement();
    $advv->setCompanyName(strip_tags(addslashes(stripslashes($_POST['name']))));
    $advv->setDescription(strip_tags(addslashes(stripslashes($_POST['description']))));

    $admin->addAdvs($advv);

  }
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
      <title>Advertisement</title>
      <link rel="stylesheet" href="css/components.css">
      <link rel="stylesheet" href="css/icons.css">
      <link rel="stylesheet" href="css/responsee.css">
      <link rel="stylesheet" href="owl-carousel/owl.carousel.css">
      <link rel="stylesheet" href="owl-carousel/owl.theme.css"> 
      <!-- CUSTOM STYLE -->
      <link rel="stylesheet" href="css/template-style.css"> 
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
      <style>
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
               <h1>Advertiesment Control</h1>
            </div>
         </div>
         <div id=" s-12 l-5 content">
         <form method="POST">
           <table>
           <tr  style="height: 100px; font-size: 30px">
                  <td align="center">Company</td>
                  <td align="center">Control</td>
              </tr>
           <?php

                $ses = new SystemActor();
                $ads = $ses->showAdvertisement();

                for ($i=0; $i <count($ads); $i++) {

                  $rem += $i;

                 echo  '<tr style="height: 100px";>
                  <td align="center"><h1 style="color:black;">'.$ads[$i]->companyName.'</h1></td>';
                 echo '<td align="center"><input type="submit" class="button" name="'.$rem.'" value="Remove"></td>';
                
                 echo '</tr>';
                }
       ?>
           </table>
           </form>
           <div id="content">
           <div class="line">
           <hr>
           <h2>Add Advertisement</h2>
           <hr>
           </div>
            <form class="customform" method="POST" enctype="multipart/form-data">
            <br>
            <div class="s-3 l-3 center">
              <label>CompanyName</label>
              <input type="text" name="name" required="">
              </div>

              <div class="s-3 l-3 center">
              <label>description</label>
              <input type="text" name="description" required="">
              </div>
              <div class="s-3 l-3 center">
              <label>Advertisement Photo</label>
               <input type="file" name="url" required="">
              </div>
              <br>
              <br>
              <br>
              <div class="s-3 l-2 center">
             <input type="submit" name="add" value="Add Advertisement">
             </div>
            </form>
            <hr>
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