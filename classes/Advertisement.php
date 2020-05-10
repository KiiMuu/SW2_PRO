<?php

/**
* 
*/
class Advertisement{
	
	/*Properates*/

	
	private $companyname;
	private $ID;
	private $description;

	###############################
	// Start set function
	###############################
	
	

	public function setCompanyName($company){
		$this->companyname = $company;
	}
	public function setID($id){
		$this->ID = $id;
	}
	public function setDescription($description){
		$this->description = $description;
	}
	
	##############################
	// Start get function	
	##############################

	

	public function getcompanyname(){
		return $this->companyname;
	}
	public function getID(){
		return $this->ID;
	}
	public function getDescription(){
		return $this->description;
	}



	public function __get($prop){
		echo 'The Property [ ' . $prop . '] Is Not Found Or Accessible<br>';
	}

	public function __set($prop,$value){
		echo 'The Property [ ' . $prop . '] Is Not Found Or Accessible<br>'. 'and you cannot assign this value [ ' . $value . ' ] to it';
	}
}