<?php

  session_start();

  require '..\classes\Question.php';
  require '..\classes\User.php';
  require '..\classes\SystemActor.php';
  require_once '..\classes\Fcatory.php';
  $user = Factory::getUser(2) ;



  if(isset($_POST['logout'])){
    $user->logout();
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
      
      if(isset($_POST['confirm'])){
        
        $quest = new Question();

        $questionText = strip_tags(addslashes(stripslashes($_POST['questionText'])));
        $questionTag  = strip_tags(addslashes(stripslashes($_POST['questionTags'])));

        $quest->setQuestion($questionText);
        $quest->setTag($questionTag);
        $quest->setUserID($_SESSION['ID']);
        $user->askQuestion($quest);
      }

      $sys = new SystemActor();
      $questions = $sys->ShowQuestionUser($_SESSION['ID']);
      for ($i=0; $i < count($questions); $i++) { 
        $remove = "remove".$i;
        $view = "view".$i;

        if(isset($_POST[$remove])){
          $questID = $questions[$i]->ID;
          $user->removeQuestion($questID);
        }

        if(isset($_POST[$view])){
          $SpecialistID = $questions[$i]->specialist_ID;
          header("Location:SpRate.php?SPID=".$SpecialistID);
        }

      }

      if(isset($_POST['clear'])){
        $user->clearQuestions($_SESSION['ID']);
      }
  }
?>

<!DOCTYPE html>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Ask Specialist</title>
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
                  <p class="nav-text">Custom menu text</p>
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
         <div id="head">
            <div class="line">
               <h1>Ask</h1>
            </div>
         </div>
         <div id="content">
         <div class="s-12 l-7 center">
         <form class="customform" method="post">
          <h2>Ask Question</h2>
          <input name='questionTags' type='text' placeholder="Tags" required="">
          <textarea name='questionText' placeholder="What is Your Question" rows="4" style="resize:none" required=""></textarea>
          <div class="s-12 l-2 right"><input type="submit" name="confirm" value="Confirm"></div>
         </form>
          </div>
            <h2>Asked Questions</h2>
            <br>
          <div class="s-12 l-7 center style-2" style="height: 500px; width:1000px; overflow-y: scroll; ">
          <?php
             //require 'C:\xampp\htdocs\project_messi\classes\SystemActor.php';
             $sys = new SystemActor();
             $questions = $sys->ShowQuestionUser($_SESSION['ID']);
             for ($i=0; $i < count($questions); $i++) { 
                $remove = "remove".$i;
                $view = "view".$i;
                  echo '
                  <form class="customform" action="" method="post">
                  <div class="s-12 l-9 center" style="color:black; border:1px solid black; border-radius:4px;">
                      <p style="font-size:20px">
                      <span style="color: red; font-weight:bold;">Tag '.($i+1).':</span> '.$questions[$i]->tag.'
                      </p>
                      <p style="font-size:20px">
                      <span style="color: red; font-weight:bold;">Q'.($i+1).':</span>'.$questions[$i]->question.'
                      </p>
                      <br>
                      '; if($questions[$i]->answer){ echo '
                      <span style="color: red; font-weight:bold;">A'.($i+1).':</span>
                      <div class="s-5 m-5 l-10 center">
                      <textarea readonly style="font-size:15px; resize:none;" rows="4">
                      '.$questions[$i]->answer.'
                      </textarea>
                      </div>
                      ';} echo '
                      <br>
                      <div class="s-5 m-5 l-7 center">
                      <input type="submit" name="'.$remove .'" value="Remove Question">
                      ';
                      if($questions[$i]->answer){ echo'
                      <input type="submit" name="'.$view .'" value="View Specialist Profile">
                      ';} echo '           
                      </div>
                      <br>           
                  </div>
                  <br>
                   </form>
                   ';
                    }
           ?>
          </div>
          <br>
          <form class="customform" method="post">
          <div class="s-12 l-2 center">
            <input type="submit" name="clear" value="Clear" onclick="return confirm('Are You Sure ?!')">
          </div>
          </form>
          

          <div class="s-12 l-8 center">
          <form class="customform" method="POST"> 
              <br> <br> <br> <hr>
              <h2> Search </h2>
              <div class="s-12 l-8 center">
              <input type="text" name="tag" placeholder="Search with Tags ...">
              </div>
              <div class="s-12 l-3 center">
              <input type="submit" name="searchquestion" value="Search">
              </div>
          </form>
          </div>
          <br>
          <div class="s-12 l-7 center style-2" style="height: 270px; width:1000px; overflow-y: scroll; ">
          <?php
             //require 'C:\xampp\htdocs\project_messi\classes\SystemActor.php';
          if(isset($_POST['searchquestion'])){
             $user = new User();

             $questions1 = $user->searchQuestion($_POST['tag']);
             for ($i=0; $i < count($questions1); $i++) { 
                echo '
                  <form class="customform" action="" method="post">
                  <div class="s-12 l-9 center" style="color:black; border:1px solid black; border-radius:4px;">
                      <p style="font-size:20px">
                      <span style="color: red; font-weight:bold;">Q'.($i+1).':</span>'.$questions1[$i]->question.'
                      </p>
                      <br>
                      <span style="color: red; font-weight:bold;">A'.($i+1).':</span>
                      <div class="s-5 m-5 l-10 center">
                      <textarea readonly style="font-size:15px; resize:none;" rows="4">
                      '.$questions1[$i]->answer.'
                      </textarea>
                      </div>
                      <br>
                      <br>           
                  </div>
                  <br>
                   </form>
                   ';
                    }
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