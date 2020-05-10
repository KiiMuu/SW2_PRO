<?php
	require_once 'Person.php';
	require 'SystemActor.php';
	require 'Request.php';


class Admin extends Person{
	

	/* Start class's functions */	
	
	public function addNewAdmin($admin){
		require_once 'Database.php';
		$db = new Database();
		$username = $admin->getName();
		$name = $this->search($username);
		if($username != $name['username']){

			$db->addNewAdmin($admin);

			echo "<script type='text/javascript'>
			         alert('$username has been added successfully');
			         document.location = \"http://localhost/project-sa2/AdminPage/Control.php\";
  				</script> ";

			}else{
				echo "<script type='text/javascript'>
				         alert('*Username is Exist please enter another one');
      				</script> ";
			}

		
	}

	public function hireSpecialist($request){
		require_once 'Database.php';
		$db = new Database();
		//$system = new SystemActor();
		$db->addSpecialist($request);
		$db->deleterequest($request);
		//$system->SendEmail($request->getMail(),"Confinmation Message","Congratulations :D .. You are accepted in Live Healthy Web Application",$attachment='');
	}

	public function refuseSpecialist($request){
		require_once 'Database.php';
		$db = new Database();
		//$system = new SystemActor();
		$db->deleterequest($request);
		//$system->SendEmail($request->getMail(),"M3lesh Message","M3lesh :) .. You are not accepted in Live Healthy Web Application",$attachment='');
	}

	public function search($name){
		require_once 'Database.php';
		$db = new Database();
		return $db->AdminSearch($name);
	}
	
	public function removeSpecialist($id){
		require_once 'Database.php';
		$db = new Database();
	    $db->remove($id,"specialists");
	}

	public function makeSAdmin($id){
		require_once 'Database.php';
		require_once 'specialist.php';

		$db = new Database();
		$sp = new Specialist();
		$sp->getData($id);
		$admin = new Admin();
		$admin->setName($sp->getName());
		$admin->setPassword($sp->getPassword());
		$admin->setAge($sp->getAge());
		$admin->setPhone($sp->getPhone());
		$admin->setMail($sp->getMail());

		$db->remove($id,"specialists");
		$db->addNewAdmin($admin);
	}

	public function removeUser($id){
		require_once 'Database.php';
		$db = new Database();
	    $db->remove($id,"user");
	}

	public function makeUAdmin($id){
		require_once 'Database.php';
		require_once 'User.php';

		$db = new Database();
		$user = new User();
		$user->getData($id);
		$admin = new Admin();
		$admin->setName($user->getName());
		$admin->setPassword($user->getPassword());
		$admin->setAge($user->getAge());
		$admin->setPhone($user->getPhone());
		$admin->setMail($user->getMail());

		$db->remove($id,"user");
		$db->addNewAdmin($admin);
	}


	public function acceptReport($reportID , $question_ID){
		require_once 'Database.php';
		$db = new Database();
		$db->DeleteReport($reportID);
		$db->removeQuestion($question_ID);
	}

	public function refuseReport($reportID){
		require_once 'Database.php';
		$db = new Database();
		$db->DeleteReport($reportID);
	}

	public function addAdvs($adv){
		require_once 'Database.php';
		$filename=$_FILES['url']['tmp_name'];//path of the file 
		$fileType=$_FILES['url']['type']; // type of the file
    					
		if($fileType == 'image/jpg' || $fileType == 'image/png'){
			$open=  opendir("../img");
		    move_uploaded_file($filename,"../img/".$adv->getcompanyname().".jpg");
		    closedir($open);
			$db = new Database();
		    $db->addAdv($adv->getcompanyname(),$adv->getDescription());             
		}
		else{
			echo "<script>
					alert('You should upload jpg or png only !!');
				  </script>
			";
		} 
	     
    }

	public function removeAdvs($name){
		require_once 'Database.php';
	    $db = new Database();
	    $db->removeAdv($name);
	}
	
	public function getAllUsers(){
		require_once 'Database.php';
	    $db = new Database();
	   return $db->getUsers();
	}
	public function getUsersType($UsertypeNum){
		require_once 'Database.php';
	    $db = new Database();
	   return $db->getUsersType($UsertypeNum);
	}
	public function updateUserType($UsertypeNum,$username){
		require_once 'Database.php';
		$db = new Database();
		$db->updateUserType($UsertypeNum,$username);
    }
	/* End class's functions*/	
}