<?php

/**
* 
*/
class Question {
	
	/*Properates*/
	
	private $ID;
	private $question;
	private $answer;
	private $tag;
	private $user_ID;
	private $specialist_ID;

###################################
###################################

	/* Start set functions*/

	public function setQuestion($quest){
		$this -> question = $quest;
	}

	public function setAnswer($answer){
		$this -> answer= $answer;
	}

	public function setTag($tag){
		$this -> tag = $tag;
	}

	public function setUserID($user_ID){
		$this -> user_ID= $user_ID;
	}

	public function setSpecialist_ID($specialist_ID){
		$this -> specialist_ID = $specialist_ID;
	}
	/* End set functions */

########################################
########################################
	
	/* Start get functions*/

	public function getID(){
		return $this -> ID;
	}

	public function getQuestion(){
		return $this -> question;
	}

	public function getAnswer(){
		return $this -> answer;
	}

	public function getTag(){
		return $this -> tag;
	}

	public function getUserID(){
		return $this -> user_ID;
	}

	public function getSpecialist_ID(){
		return $this -> specialist_ID;
	}
	/* End get functions */
}