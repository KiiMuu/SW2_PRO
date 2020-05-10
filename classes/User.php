<?php 

require 'Account_Management.php';
require_once 'Person.php';
require 'Feedback.php';


class User extends Person implements Account_Management {



	/*Properates*/
	private $weight;
	private $height;

######################################
######################################

	/* Start class's functions */	
	
	
	public function registeration(){
		require_once 'Database.php';
		$db = new Database();
		$user = new User();

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$username = strip_tags(addslashes(stripslashes($_POST['username'])));
			$password = strip_tags(addslashes(stripslashes($_POST['password'])));
			$age  	  = strip_tags(addslashes(stripslashes($_POST['age'])));
			$phone	  = strip_tags(addslashes(stripslashes($_POST['phone'])));
			$email    =	strip_tags(addslashes(stripslashes($_POST['email'])));
			$weight   = strip_tags(addslashes(stripslashes($_POST['weight'])));
			$height   = strip_tags(addslashes(stripslashes($_POST['height'])));

			$name = $user->search($username);

			if($username != $name['username']){

				$user->setName($username);
				$user->setPassword($password);
				$user->setAge($age);
				$user->setPhone($phone);
				$user->setMail($email);
				$user->setWeight($weight);
				$user->setHeight($height);
				
				$db->addUser($user);

				header('Location:..\UserPage\userHome.php');
			}else{
				echo "<script type='text/javascript'>
				         alert('*Username is Exist please enter another one');
      				</script> ";
			}
		}
	}

	public function setUserID($username,$password){
		require_once 'Database.php';
		$db = new Database();
		
		$userarray = $db->getUserID($username,$password);
		$this->setID($userarray['ID']);
	}

	public function getData($id){
		require_once 'Database.php';
		$db = new Database();

		$userarray = $db->getUserData($id);

		$this->setID($id);
		$this->setName($userarray['Username']);
		$this->setPassword($userarray['Password']);
		$this->setPhone($userarray['phone']);
		$this->setMail($userarray['email']);
		$this->setAge($userarray['age']);
		$this->setWeight($userarray['weight']);
		$this->setHeight($userarray['height']);
	}

	public function sendFeedback($message){
		require_once 'Database.php';
		$feedback = new Feedback();
		$db = new Database();
		$feedback->setMessage($message);
		$db->sendFeedback($feedback);
	}

	public function askQuestion($quest){
		require_once 'Database.php';
		$db = new Database();
		$db->addQuestion($quest);
	}

	public function searchQuestion($name){
		require_once 'Database.php';
		$db = new Database();
		return $db->search($name,"questions","tag");
	}

	public function removeQuestion($questID){
		require_once 'Database.php';
		$db = new Database();
		$db->removeQuestion($questID);
	}

	public function clearQuestions($id){
		require_once 'Database.php';
		$db = new Database();
		$db->clearQuestions($id);
	}


	public function updateWeight($weight,$id){
		$db = new Database();
		$db->updateWeight($weight,$id);
	}
	
	/* End class's functions*/	

################################
################################

	/* Start set functions*/

	public function setWeight($weight){
		$this -> weight = $weight;
	}

	public function setHeight($height){
		$this -> height = $height;
	}

	public function setTrainingTable($trainingTable){
		$this -> trainingTable = $trainingTable;
	}

	public function setNutrationTable($nutrationTable){
		$this -> nutrationTable = $nutrationTable;
	}
 
 
	/* End set functions*/

#####################################
#####################################

	/* Start get functions*/


	public function getWeight(){
		return $this -> weight;
	}

	public function getHeight(){
		return $this -> height;
	}

	public function getTrainingTable(){
		return $this -> trainingTable;
	}

	public function getNutrationTable(){
		return $this -> nutrationTable;
	}

	/* End get functions*/

##################################
##################################
	
	/* Start Interface Functions */
	public function editAccount($user,$oldname){
		require_once 'Database.php';
		$db = new Database();

		$username = strip_tags(addslashes(stripslashes($_POST['username'])));
		$password = strip_tags(addslashes(stripslashes($_POST['password'])));
		$age  	  = strip_tags(addslashes(stripslashes($_POST['age'])));
		$phone	  = strip_tags(addslashes(stripslashes($_POST['phone'])));
		$email    =	strip_tags(addslashes(stripslashes($_POST['email'])));
		$weight   = strip_tags(addslashes(stripslashes($_POST['weight'])));
		$height   = strip_tags(addslashes(stripslashes($_POST['height'])));

		$name = $this->search($username);


		if($username != $name['username'] || $username == $oldname){

			$ID = $user->getID();

			$set = "Username = '$username' , Password = '$password' , age = '$age' , phone = '$phone' , email = '$email' , weight = '$weight' , height = '$height' WHERE ID = '$ID' ";
			
			$set2 = "username = '$username' , Password = '$password' WHERE ID = '$ID' ";

			$db->edit("user" , $set );
			$db->edit("users" , $set2 );

			session_destroy();
			
			echo "<script type='text/javascript'>
			         	alert('Your account has been updated successfully.');
			         	document.location = \"http://localhost/project\";
      				</script> ";
		}else{
			echo "<script type='text/javascript'>
			         	alert('*Username is Exist please enter another one');
      				</script> ";
		}
	}

	public function DeleteAccount($user){
		require_once 'Database.php';
		$db = new Database();

		$db->remove($user->getID() ,"user");
	}

	/* End Interface Functions */
}