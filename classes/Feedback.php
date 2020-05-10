<?php

/**
* 
*/
class Feedback
{
	/*Properates*/
	private $message;

	###############################
	// Start set function
	###############################
	
	public function setMessage($message){
		$this->message = $message;
	}
	
	##############################
	// Start get function	
	##############################

	public function getMessage(){
		return $this->message;
	}
		
}