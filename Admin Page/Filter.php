<?php

   session_start();
   require '..\classes\Admin.php';
   require '..\classes\Filter\CriteriaSpecialist.php';
   require '..\classes\Filter\CriteriaUser.php';
   require '..\classes\Filter\CriteriaAdmin.php';

   if(isset($_POST['User_type'])){
      $admin= new Admin;
   $result = $_POST['User_type'];
   $result_explode = explode('|', $result);
   $admin->updateUserType($result_explode[1],$result_explode[0]);
   // echo "username: ". $result_explode[0]."<br />";
   // echo "User_type: ". $result_explode[1]."<br />";
   if(isset($_POST['logout'])){
      $admin= new Admin;
      $admin->logout();
   }
}


?>
<!DOCTYPE html>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Users filter</title>
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
               <h1>Users filter</h1>
            </div>
         </div>
         <div id="content">
            <div class="line">
          </div>
          <div class="s-12 l-9 center style-2" style="overflow-y:scroll; height:700px; width:70%;">
          	<?php
            function DrawUserTable($Persons,$PersonsType){
      
               echo "<table class='table table-striped'>
               <thead class='thead-dar'>
               <tr>
               <td scope='col'>ID</td>
               <td scope='col'>username</td>
               <td scope='col'>User_type</td>
               <td scope='col'>Controlling options</td>
               </tr></thead>";
               // start a table tag in the HTML
              foreach($Persons as $Person){
                $ID=$Person['ID'];
                $username=$Person['username'];
               echo "
                 <tbody>
                 <tr>
                 <form name='updateUserType' method='post' action='Filter.php'>
                 
                    <td>" . $ID. "</td>
                    <td>" . $username. "</td>
                    <td>$PersonsType</td>  
                    <td>
                       <select name='User_type' id='User_type'>
                          <option value='' disabled selected>--Change User Type--</option>
                          <option value='$username|1'>admin</option>
                          <option value='$username|2'>User</option>
                          <option value='$username|3'>Specialist</option>
                       </select>
                       <input type='submit' name='submit' id='submit' value='submit'>
                    </td>
                 
                </form>
                 </tr>";
                 
                   }
                echo "</tbody></table></br>"; //Close the table in HTML
  
             }
               $CriteriaUser =new CriteriaUser;
               $CriteriaSpecialist = new CriteriaSpecialist;
               $CriteriaAdmin = new CriteriaAdmin;
               $allAdmins = $CriteriaAdmin->meetCriteria();
               $allUsers = $CriteriaUser->meetCriteria();
               $allSpecialists = $CriteriaSpecialist->meetCriteria($allUsers);
             echo '<h3>Admin</h3>' ;
             DrawUserTable($allAdmins,'Admin');
             echo '<h3>User</h3>' ;
             DrawUserTable($allUsers,'User');
             echo '<h3>Spectialist</h3>' ;
             DrawUserTable($allSpecialists,'Spectialist');

           ?>
          </div>
         </div>
       </section>
   
      <!-- FOOTER -->   
      <footer>
         <div class="line">
            <div class="s-12 l-6">
               <p>Copyright @
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