<?php
    class UserAccount{
        private $username;
        private $password;
        private $role;
        
        public function __construct() {
        }
        
        function validateLogin($arrayLogin){
            include '../dbConnect.php';
            $username = $arrayLogin[0];
            $password = $arrayLogin[1];
            $sql = "SELECT userName, role FROM useraccount WHERE userName = '$username' AND password = '$password'";
            try{
                $result = mysqli_query($conn , $sql);
                if($result){
                    $row = mysqli_fetch_assoc($result);
                }
                mysqli_close($conn);
                return $row;
            } catch (Exception $ex) {
                return mysqli_error($conn);
            }
        }
    }
?>
