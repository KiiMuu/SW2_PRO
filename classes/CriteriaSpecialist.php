<?php
require_once 'Criteria.php';
require_once '../classes/Admin.php';

// Implement the interface
// This will work
class CriteriaSpecialist  implements Criteria
{
    public function meetCriteria() {
        $adminObj=new Admin;
        $specialists =$adminObj->getUsersType(3); 
       return $specialists;
    }

}