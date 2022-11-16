<?php
    include '../Entity/UserAccount.php';
    class retrievePasswordController{
        public function __construct()
        {
            
        }
        function passRetrievePasswordPara($userID){
            $useracount = new UserAccount();
            $password = $useracount -> retrievePassword($userID);
            return $password;
        }
    }
?>