<?php
    include '../Entity/UserAccount.php';
    class loginController{
        public function __construct() {
        }
        function passLoginPara($arrayLogin){
            $userAccount = new UserAccount();
            $arrayResult = $userAccount -> validateLogin($arrayLogin);
            return $arrayResult;
        }
    }

?>