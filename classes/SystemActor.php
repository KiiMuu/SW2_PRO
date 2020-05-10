<?php

/**
* 
*/

class SystemActor {
		

	/* Start class's functions */	

		// $body this is the code HTML if need send any things for (HTML)
    public function SendEmail($to,$subject,$body,$attachment='') {
      
      require_once('phpmailer.php');
      $from = "livehealthy20150@gmail.com";           // that is eamil the site <<<<<<<<<<<<<<<<<<<<<<<<<<
      ini_set("SMTP","ssl://smtp.gmail.com"); // this thing for gmail (SMTP) => this is protocol for gmail
      ini_set("smtp_port","465");             // this thing for gmail        
      $fromName="XXXXX Adminstration";        #########################
      $mail = new PHPMailer(true);            // the true param means it will throw exceptions on errors, which we need to catch

      $mail->IsSMTP(); // telling the class to use SMTP

      try {
          $mail->Host       = "smtp.gmail.com";     // SMTP server
          $mail->SMTPDebug  = 1;                    // enables SMTP debug information (for testing)
          $mail->SMTPAuth   = true;                 // enable SMTP authentication
          $mail->SMTPSecure = 'ssl';
          $mail->Port       = 465;                  // set the SMTP port for the GMAIL server
          $mail->Username   = "livehealthy20150@gmail.com"; // SMTP account username <<<<<<<<<<<<<<<<<<<<<<<<<<
          $mail->Password   = "20150healthylive";               // SMTP account password <<<<<<<<<<<<<<<<<<<<<<<<<<
 
          $mail->AddAddress($to, $to);
          $mail->SetFrom($from, $from);
          //$mail->AddReplyTo($from, $fromName);
          $mail->Subject = $subject;
          //$mail->AltBody = $body; // optional - MsgHTML will create an alternate automatically
          $mail->MsgHTML($body);
          $mail->CharSet='utf-8';
          //$mail->AddAttachment('images/phpmailer.gif');      // attachment
          //$mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
          $mail->Send();
          echo "<p>Message Sent OK</p>";
          //echo $e->getMessage(); //Boring error messages from anything else!
      }

      catch (phpmailerException $e) {
          echo $e->errorMessage(); //Pretty error messages from PHPMailer
      } 
    }

	public function showQuestionHome(){
    require_once 'Database.php';
    $db = new Database();
    return $db->showQuestionsHome();
	}

  public function showNewQuestions(){
    require_once 'Database.php';
    $db = new Database();
    return $db->showNewQuestions();
  }

  public function ShowQuestionUser($id){
    require_once 'Database.php';
    $db = new Database();
    return $db->ShowQuestionsUser($id);
  }

  public function ShowRequest(){
    require_once 'Database.php';
    $db = new Database();
    $val = $db->allrequest('request');
    return $val;
  }

  public function showFeedback(){
    require_once 'Database.php';
    $db = new Database();
    $val = $db->allrequest('feedbacktable');
    return $val;

  }

  public function showSpRank(){
    require_once 'Database.php';
    $db = new Database();
    $Sparray = $db->allSpRank();
    return $Sparray;
  }

	public function ShowReport(){
    require_once 'Database.php';
    $db = new Database();
    return $db->showReportuser();
  }

  public function getUsername($id){
    require_once 'Database.php';
    $db = new Database();
    return $db->getUsernamedatabase($id);
  }

  public function getSpecialistname($id){
    require_once 'Database.php';
    $db = new Database();
    return $db->getSpecialistnamedatabase($id);
  }

  public function getQuestion($id){
    require_once 'Database.php';
    $db = new Database();
    return $db->getQuestiondatabase($id);
  }
	
  public function showAdvertisement(){
    require_once 'Database.php';
    $db = new Database();
    return $db->all("advertisement");
  }

	/* End class's functions*/	
}