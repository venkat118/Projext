<?php
    include '../Entity/UserAccount.php';
    class editUserAccountController{
        public function __construct()
        {
            
        }
        function passEditUserAccountPara($userID, $username, $password, $cpass, $accountType, $fullname, $email){
            if($password == $cpass){
                $useraccount = new UserAccount();
                $result = $useraccount -> editUserAccount($userID, $username, $password, $accountType, $fullname, $email);
                return $result;
            }else{
                return "Password does not match, try editing the account again";
            }
        }
    }
?>