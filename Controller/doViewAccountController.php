<?php
    include '../Entity/UserAccount.php';
    class viewAccountController{
        public function __construct()
        {       
        }
        function passViewAccountPara($search){
            $user = new UserAccount();
            $array = $user -> retrieveUserAccount($search);
            return $array;
        }
    }
?>