<?php

/**
* 
*/

class Database{
	
	/* Start class's functions */	

	public function edit($tableName , $set){
		$conn = $this->connect();

		$q = "UPDATE $tableName SET $set";

		$result = mysqli_query($conn , $q);
	}


	public function AdminSearch($name){
		$conn = $this->connect();
		
		$sql = "SELECT * FROM `users` WHERE username = '$name'";
		$res = mysqli_query($conn,$sql);
		$val = array();
		
		$i =0;
		while ($ret = mysqli_fetch_object($res)) {
			$val[$i] = $ret;
			$i++;
		}
		return $val;
	}

	public function all($table){ // takes table name and returns all the date in that table
		$conn = $this->connect();
		$sql = "SELECT * FROM $table";
		$res = mysqli_query($conn,$sql);
		$val = array();
		$i =0;
		while ($ret = mysqli_fetch_object($res)) {
			$val[$i] = $ret;
			$i++;
		}
		return $val;
	}


	public function searchForUserName($username){
		$conn = $this->connect();

		$q1 = "SELECT username FROM users WHERE username = '$username' ";
		$result1 = mysqli_query($conn , $q1);
		$ar1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
		
		if(empty($ar1)){

		$q2 = "SELECT username FROM request WHERE username = '$username'";
		$result2 = mysqli_query($conn , $q2);
		$ar2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
		
		return $ar2;
		
		} else {
        	return $ar1;
		}
	}
	
	public function connect(){

		$conn = mysqli_connect('localhost' , 'root' , '' , 'livehealthy');

		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}

		return $conn;
	}

	public function remove($id,$table) {
		$conn = $this->connect();
		
		if($table == "user"){
			$sql3 = "DELETE FROM questions WHERE user_ID = '$id'";
			$res3 = mysqli_query($conn,$sql3);
		} else if($table == "specialists"){
			$sql3 = "UPDATE questions SET answer = NULL , specialist_ID = NULL WHERE specialist_ID = '$id'";
			$res3 = mysqli_query($conn,$sql3);
		}
		
		$sql2 = "DELETE FROM `users` WHERE ID = '$id'";
		$res2 = mysqli_query($conn,$sql2);
		
		$sql1 = "DELETE FROM $table WHERE ID = '$id'";
		$res1 = mysqli_query($conn,$sql1);
	}

	#####################################
	// Admin Functions
	#####################################

	public function addNewAdmin($admin){

		$name = $admin->getName();
		$pass = $admin->getPassword();
		$age = $admin->getAge();
		$email = $admin->getMail();
		$phone = $admin->getPhone();

		$conn = $this->connect();

		$q = "INSERT INTO admin (username , password , age , phone , Email) VALUES ('$name' , '$pass' , '$age' , '$phone' , '$email')";

		$result = mysqli_query($conn,$q);

		$returned = $this->getAdminID($name,$pass);
		$ID = $returned['ID'];

		$q1 = "INSERT INTO users (ID , username , Password , User_type) VALUES ('$ID' , '$name' , '$pass' , 1)";

		
		$result1 = mysqli_query($conn , $q1);
	}

	public function getAdminID($username,$password){
		$conn = $this->connect();

		$q ="SELECT ID FROM `admin` WHERE `username` = '$username' AND `password` = '$password'";
		$result = mysqli_query($conn, $q);
		$returned = mysqli_fetch_array($result,MYSQLI_ASSOC);

		return $returned;
	}

	public function addAdv($value,$description)
	{
		$conn = $this->connect();
		$sql = "INSERT INTO advertisement (`companyName`,`description`) VALUES ('$value','$description')";
		$res = mysqli_query($conn,$sql);
	}

	public function removeAdv($name)
	{
		$conn = $this->connect();
		$sql = "DELETE FROM `advertisement` WHERE companyName = '$name'";
		$res = mysqli_query($conn,$sql);
	}
	
	public function getUsers(){
		$conn = $this->connect();

		$q ="SELECT * FROM users ";
		$result = mysqli_query($conn, $q);
		$returned= [];

		while($row = $result->fetch_array())
		{	
		$returned[$row['ID']]['ID']= $row['ID'];
		$returned[$row['ID']]['username']= $row['username'];
		$returned[$row['ID']]['User_type']= $row['User_type'];
		}
		return $returned;
	}
	public function getUsersType($UsertypeNum){
		$conn = $this->connect();
		$q ="SELECT * FROM users  WHERE User_type = '$UsertypeNum' ";
		$result = mysqli_query($conn , $q);
		$returned= [];

		while($row = $result->fetch_array())
		{	
		$returned[$row['ID']]['ID']= $row['ID'];
		$returned[$row['ID']]['username']= $row['username'];
		$returned[$row['ID']]['User_type']= $row['User_type'];
		}
		return $returned;
	}

	public function updateUserType($UsertypeNum,$username){
		$conn = $this->connect();

		$q = "UPDATE users SET User_type = '$UsertypeNum' WHERE 	username = '$username' ";

		$result = mysqli_query($conn , $q);
	}

	#####################################
	// User Functions
	#####################################

	public function addUser($addUser){

		
		$username = $addUser->getName(); 
		$password = $addUser->getPassword();
		$age = $addUser->getAge(); 
		$phone = $addUser->getPhone();
		$email = $addUser->getMail(); 
		$weight = $addUser->getWeight();
		$height = $addUser->getHeight();

		$conn = $this->connect();
		
		$q = "INSERT INTO user (Username , Password , age , phone , email , weight , height) VALUES ('$username' , '$password' , '$age' , '$phone' , '$email' , '$weight' , '$height')";
		
		$result = mysqli_query($conn , $q);
		
		$returned = $this->getUserID($username,$password);
		$ID = $returned['ID'];

		$q1 = "INSERT INTO users (ID , username , Password , User_type) VALUES ('$ID' , '$username' , '$password' , 2)";

		
		$result1 = mysqli_query($conn , $q1);
	}
	
	public function getUserID($username,$password){
		$conn = $this->connect();

		$q ="SELECT ID FROM `user` WHERE `Username` = '$username' AND `Password` = '$password'";
		$result = mysqli_query($conn, $q);
		$returned = mysqli_fetch_array($result,MYSQLI_ASSOC);

		return $returned;
	}
	
	public function getUserData($id){
		
		$conn = $this->connect();

		$q ="SELECT * FROM `user` WHERE `ID` = '$id'";
		$result = mysqli_query($conn, $q);
		$returned = mysqli_fetch_array($result,MYSQLI_ASSOC);

		return $returned;
	}

	public function updateWeight($weight,$id){
		$conn = $this->connect();

		$q = "UPDATE user SET weight = '$weight' WHERE ID = '$id' ";

		$result = mysqli_query($conn , $q);
	}

	#####################################
	// Specialist Functions
	#####################################

	public function addSpecialist($acceptedReq){
		$ID = $acceptedReq->getID();
		$username = $acceptedReq->getName(); 
		$password = $acceptedReq->getPassword();
		$age = $acceptedReq->getAge(); 
		$phone = $acceptedReq->getPhone();
		$email = $acceptedReq->getMail(); 
		
		$conn = $this->connect();
		
		$q = "INSERT INTO specialists (username , password , age , phone , Email) VALUES ('$username' , '$password' , '$age' , '$phone' , '$email')";
		
		$result = mysqli_query($conn , $q);

		$returned = $this->getSpID($username,$password);
		$ID = $returned['ID'];

		$q1 = "INSERT INTO users (ID , username , password ,User_type) VALUES ('$ID' , '$username' , '$password' , 3)";

		$result1 = mysqli_query($conn , $q1);
	}

	public function getSpID($username,$password){
		$conn = $this->connect();

		$q ="SELECT ID FROM `specialists` WHERE `username` = '$username' AND `password` = '$password'";
		$result = mysqli_query($conn, $q);
		$returned = mysqli_fetch_array($result,MYSQLI_ASSOC);

		return $returned;
	}

	public function getSPData($id){
		$sp = new Specialist();

		$conn = $this->connect();

		$q ="SELECT * FROM `specialists` WHERE `ID` = '$id'";
		$result = mysqli_query($conn, $q);
		$returned = mysqli_fetch_array($result,MYSQLI_ASSOC);

		return $returned;
	}

	#####################################
	// Request & Feedback Functions
	#####################################


	public function allrequest($tableName){
		
		$conn = $this->connect();
		$sql = "SELECT * FROM " . $tableName;
		$res = mysqli_query($conn,$sql);
		$val = array();
		$i =0;
		while ($ret = mysqli_fetch_object($res)) {
			$val[$i] = $ret;
			$i++;
		}
		return $val;
	}

	public function sendFeedback($feedback){
		$message = $feedback->getMessage();

		$conn = $this->connect();

		$q = "INSERT INTO feedbacktable (message) VALUES ('$message')";
		mysqli_query($conn , $q);
	}

	public function addrequest($request){
		$username = $request->getName(); 
		$password = $request->getPassword();
		$age = $request->getAge(); 
		$phone = $request->getPhone();
		$email = $request->getMail(); 
			
		$conn = $this->connect();
		
		$q = "INSERT INTO request (username , password , age , phone , email) VALUES ('$username' , '$password' , '$age' , '$phone' , '$email')";
		
		$result = mysqli_query($conn , $q);
	}

	public function deleterequest($request){
		$username = $request->getName();
		$pass = $request->getPassword();

		$conn = $this->connect();

		$q = "DELETE FROM request WHERE request.username = '$username' AND request.password = '$pass'";
		mysqli_query($conn , $q);
	}

	public function updateRate($SpID,$rate){
		$conn = $this->connect();

		$q ="SELECT rating FROM `specialists` WHERE `ID` = '$SpID'";
		$result = mysqli_query($conn, $q);
		$returned = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$oldrate = $returned['rating'];
		$newrate = (($oldrate + $rate)/2);

		$q = "UPDATE `specialists` SET `rating`= '$newrate' WHERE `ID` = '$SpID'";
		mysqli_query($conn, $q);
	}

	public function allSpRank(){
		$conn = $this->connect();

		$q = "SELECT `username`, `rating` FROM `specialists` ORDER BY `rating` DESC";
		$res = mysqli_query($conn,$q);
		$val = array();
		$i =0;
		while ($ret = mysqli_fetch_object($res)) {
			$val[$i] = $ret;
			$i++;
		}
		return $val;
	}

	#####################################
	// Question Functions
	#####################################


	 public function showQuestionsHome() {

		$conn = $this->connect();
		 
		$q = "SELECT * FROM questions WHERE answer like '%'";
        $res = mysqli_query($conn,$q);
		 
		$i = 0;
		$value = array();
		while ($ret= mysqli_fetch_object($res)) {
			$value[$i] = $ret;
			$i++;
		}
		return $value;
	}

	public function showNewQuestions(){

		$conn = $this->connect();

		$q = "SELECT * FROM questions WHERE answer IS NULL";
        $res = mysqli_query($conn,$q);
		
		$i = 0;
		$value = array();
		while ($ret= mysqli_fetch_object($res)) {
			$value[$i] = $ret;
			$i++;
		}
		return $value;
	}

	public function showQuestionsUser($userID){

		$conn = $this->connect();

		$q = "SELECT * FROM questions WHERE user_ID = $userID";
        $res = mysqli_query($conn,$q);
		 
		$i = 0;
		$value = array();
		while ($ret= mysqli_fetch_object($res)) {
			$value[$i] = $ret;
			$i++;
		}
		return $value;
	}

		public function search($name,$table,$key){

		$conn = $this->connect();
		$sql = "SELECT * FROM $table WHERE $key = '$name'";
		$res = mysqli_query($conn,$sql);
		$val = array();
		$i =0;
		while ($ret = mysqli_fetch_object($res)) {
			$val[$i] = $ret;
			$i++;
		}
		return $val;
	}

	public function addQuestion($quest){
		$questiontext = $quest->getQuestion();
		$questiontag = $quest->getTag();
		$userid = $quest->getUserID();

		$conn = $this->connect();

		$q = "INSERT INTO questions (question , tag , user_ID) VALUES ('$questiontext', '$questiontag' , '$userid')";
		mysqli_query($conn , $q);
	}

	public function answerQuestion($quest){
		$answer = $quest->answer;
		$questionID = $quest->ID;
		$SP_ID = $quest->specialist_ID;

		$conn = $this->connect();

		$q = "UPDATE `questions` SET `answer`= '$answer',`specialist_ID`= '$SP_ID' WHERE `ID` = '$questionID'";
		mysqli_query($conn, $q);

	}
	public function removeQuestion($questionid){
		$conn = $this->connect();

		$q = "DELETE FROM `questions` WHERE `questions`.`ID` = '$questionid'";
		mysqli_query($conn, $q);
	}
	
	public function clearQuestions($id){
		$conn = $this->connect();
		$q = "DELETE FROM `questions` WHERE `questions`.`user_ID` = '$id'";
		mysqli_query($conn, $q);	
	}

	public function ReportQuestion($Sp_ID , $QU_ID , $User_ID){
		$conn = $this->connect();
		$q = "INSERT INTO `report` ( specialist_ID	, question_ID , user_ID) VALUES ('$Sp_ID' , '$QU_ID' , '$User_ID')";
		mysqli_query($conn , $q);
	}
	public function showReportuser(){
		$conn = $this->connect();
		$q = "SELECT * FROM `report`";
		$database_query = mysqli_query($conn , $q);
		$i = 0;
		$value = array();
		while ($ret= mysqli_fetch_object($database_query)) {
			$value[$i] = $ret;
			$i++;
		}
		return $value;
	}

	public function getUsernamedatabase($id){
		$conn = $this->connect();
		$q = "SELECT 	Username FROM `user` WHERE ID = $id ";
		$database_query = mysqli_query($conn , $q);
		$value = array();
		$ret= mysqli_fetch_object($database_query);
		return $ret->Username;
	}
	public function getSpecialistnamedatabase($id){
		$conn = $this->connect();
		$q = "SELECT 	Username FROM `specialists` WHERE ID = $id ";
		$database_query = mysqli_query($conn , $q);
		$value = array();
		$ret= mysqli_fetch_object($database_query);
		return $ret->Username;
	}
	public function getQuestiondatabase($id){
		$conn = $this->connect();
		$q = "SELECT 	question FROM `questions` WHERE ID = $id ";
		$database_query = mysqli_query($conn , $q);
		$ret= mysqli_fetch_object($database_query);
		return $ret->question;
	}

	public function DeleteReport($id){
		$conn = $this->connect();
		$q = "DELETE FROM `report` WHERE ID = $id";
		$database_query = mysqli_query($conn , $q);
	}

	#####################################
	#####################################

	/* End class's functions*/	
}