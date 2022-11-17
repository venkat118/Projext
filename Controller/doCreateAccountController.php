<?php
    include '../Entity/UserAccount.php';
    class createAccountController{
        public function __construct()
        {
            
        }
        function passCreateAccountPara($fullname, $username, $password, $cpass,$email, $roleID){
            if($password == $cpass){
                $user = new UserAccount();
                $result = $user -> createAccount($fullname, $username, $password, $email, $roleID);
                return "$result";
            }else{
                return "password and confirm password is not the same! Create your account again";
            }
        }
    }
?>