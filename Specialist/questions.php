<?php

   session_start();
   require '..\classes\Specialist.php';
   require_once '..\classes\Fcatory.php';
   $sp = Factory::getUser(1) ;
   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      
      require_once '..\classes\SystemActor.php';
      $sys = new SystemActor();
      $questions = $sys->showNewQuestions();

      for($i = 0;$i< count($questions);$i++){
         $ans = "Answer".$i;
         $answertext = "Text".$i;
         $rep = "Report".$i;

         if(isset($_POST[$ans])){
            $answerText = strip_tags(addslashes(stripslashes($_POST[$answertext])));

            $questions[$i]->specialist_ID = $_SESSION['ID'];
            $questions[$i]->answer = $answerText;
            $sp->answerQuestion($questions[$i]);
         }

         if(isset($_POST[$rep])){
           $sp->report($_SESSION['ID'] , $questions[$i]->ID , $questions[$i]->user_ID);
         }

      }
   }

   if(isset($_POST['logout'])){
      $sp->logout();
   }

?>

<!DOCTYPE html>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Questions</title>
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
               <h1>Questions</h1>
            </div>
         </div>
         <div id="content" style="padding-bottom: 200px;">
            <div class="line">
               <div class="margin">
                  <div class="s-12 l-7 center style-2" style="height: 500px; width:1000px; overflow-y: scroll; ">
                     <?php
                    
                     require_once '..\classes\SystemActor.php';
                     require_once '..\classes\Database.php';
                     
                     $sys = new SystemActor();
                     $db = new Database();
                     
                     $questions = $sys->showNewQuestions();
                     for ($i=0; $i < count($questions); $i++) { 

                        $userID = $questions[$i]->user_ID;
                        $userData = $db->getUserData($userID);

                        $answertext = "Text". $i;
                        $answer = "Answer". $i;
                        $view = "View". $i;
                        $report = "Report". $i;
                        $viewClass = "viewPro".$i;
                        $divClass = "userPro".$i;

                          echo '
                        <form class="customform" method="POST" action="">
                          <div class="s-12 l-12 center">
                              <p style="font-size:20px">
                              <span style="color: red; font-weight:bold;">Tag '.($i+1).':</span>'.$questions[$i]->tag.'
                              </p>
                              <p style="font-size:20px">
                              <span style="color: red; font-weight:bold;">Q'.($i+1).':</span>'.$questions[$i]->question.'
                              </p>
                              <textarea name="'. $answertext .'" placeholder="Your Answer .." rows="4" style="resize:none;">
                              </textarea>
                              <div class="s-5 m-6 l-8 '.$divClass.'" style="border:1px solid black; background-color:#888; border-radius:4px; color:black; padding:10px; margin:0 0 10px 170px; display:none;" >
                                 <label style="float:left;">UserName: </label><span style="color:white;">'.$userData["Username"].'</span><br>
                                 <label style="float:left;">Age: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</label><span style="color:white;">'.$userData["age"].'</span><br>
                                 <label style="float:left;">Weight: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><span style="color:white">'.$userData["weight"].'</span><br>
                                 <label style="float:left;">Height: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><span style="color:white">'.$userData["height"].'</span><br>
                                 <label style="float:left;">Phone: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><span style="color:white">'.$userData["phone"].'</span><br>
                                 <label style="float:left;">Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><span style="color:white">'.$userData["email"].'</span><br>
                              </div>
                              <input type="submit" name="'.$answer.'" value="Answer">
                              <input type="button" name="'.$view .'" value="View User Profile" class="'.$viewClass.'">
                              <input type="submit" name="'.$report .'" value="Report" style="color:red;">
                           </div>
                        </form>
                           <script type="text/javascript">
                                 jQuery(document).ready(function($) {  

                                   $(".'.$viewClass.'").click(function(){
                                    $(".'.$divClass.'").slideDown(2000);
                                   });
                                   $(".'.$divClass.'").dblclick(function(){
                                    $(".'.$divClass.'").slideUp(1000);
                                   });
                                 });   
                                  
                              </script> ';
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
               <p>Copyright 2016, Vision Design - graphic zoo
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