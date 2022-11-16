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
            $role = $arrayLogin[2];
            $hashPass = sha1($password);
            $sql = "SELECT userName, role, FullName, userID FROM useraccount WHERE userName = '$username' AND password = '$hashPass' AND role = '$role'";
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

        function updateAccount($userID, $username, $password, $email, $bidLimit){
            include '../dbConnect.php';
            $check = 0;
            if($username){
                $sql= "UPDATE useraccount SET userName = '$username' WHERE userID = '$userID'";
                try{
                    mysqli_query($conn , $sql);
                    $_SESSION['username'] = $username;
                }catch(Exception $ex){
                    $check = 1;
                }
            }
            if($password){
                $sql = "UPDATE useraccount SET password = '$password' WHERE userID = '$userID'";
                try{
                    mysqli_query($conn , $sql);
                }catch(Exception $ex){
                    $check = 1;
                }
            }
            if ($email){
                $sql = "UPDATE useraccount SET Email = '$email' WHERE userID = '$userID'";
                try{
                    mysqli_query($conn , $sql);
                }catch(Exception $ex){
                    $check = 1;
                }
            }
            if($bidLimit){
                $sql = "UPDATE useraccount SET ReviewLimit = $bidLimit WHERE userID = '$userID'";
                try{
                    mysqli_query($conn , $sql);
                }catch(Exception $ex){
                    $check = 1;
                }
            }
            mysqli_close($conn);
            return $check;
        }

        function createAccount($fullname, $username, $password, $email, $role){
            include'../dbConnect.php';
            $hashPass = sha1($password);
            $sql = "INSERT INTO useraccount (FullName, userName, password, Email, role)
                    VALUES('$fullname', '$username', '$hashPass', '$email', '$role')";
            try{
                mysqli_query($conn, $sql);
                mysqli_close($conn);
                return "Account has successfully created";
            }catch(Exception $ex){
                mysqli_close($conn);
                return "Account creation is not succcessful";
            }
        }
    }
?>
