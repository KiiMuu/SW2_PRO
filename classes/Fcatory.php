<?php
    require_once 'Person.php';
 
    class Factory {

        public static function getUser($t){
            if ($t==0){
                return new Admin();
            }else if ($t==1){
                return new specialist();
            }else if ($t==2){
                return new User();
            }
        }

    }

?>