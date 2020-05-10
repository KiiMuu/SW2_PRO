<?php
require_once 'Criteria.php';
require_once '../classes/Admin.php';

// Implement the interface
// This will work
class CriteriaUser  implements Criteria
{
    public function meetCriteria() {
        $adminObj=new Admin;
        $users =$adminObj->getUsersType(2); 
       return $users;
    }

}