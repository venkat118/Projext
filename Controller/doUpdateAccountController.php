<?php
    include '../Entity/UserAccount.php';
    session_start();
    class updateAccountController{
        public function __construct()
        {
            
        }

        function passUpdateAccountPara($username , $password, $confirmPass, $email, $bidLimit){
            if($password == $confirmPass){
                $Account = new UserAccount();
                $userID = $_SESSION['userID'];
                $Account -> updateAccount($userID, $username, $password, $email, $bidLimit);
            }
            else{
                return 2;
            }
        }
    }
?>