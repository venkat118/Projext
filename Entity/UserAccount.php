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
            $sql = "SELECT userName, roleID, FullName, userID FROM useraccount WHERE userName = '$username' AND password = '$password' AND roleID = '$role'";
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

        function createAccount($fullname, $username, $password, $email, $roleID){
            include'../dbConnect.php';
            $sql = "INSERT INTO useraccount (FullName, userName, password, Email, roleID)
                    VALUES('$fullname', '$username', '$password', '$email', '$roleID')";
            try{
                mysqli_query($conn, $sql);
                mysqli_close($conn);
                return "Account has successfully created";
            }catch(Exception $ex){
                mysqli_close($conn);
                return "Account creation is not succcessful";
            }
        }

        function retrieveUserAccount($search){
            include '../dbConnect.php';
            if(empty($search)){
                $sql = "SELECT * FROM useraccount";
            }
            else{
                $sql = "SELECT * FROM useraccount WHERE userName LIKE '%$search%'";
            }
            $resultArray = array();
            try{
                $result = mysqli_query($conn, $sql);
                if($result){
                    while($row = mysqli_fetch_assoc($result)){
                        array_push($resultArray, array($row['userID'], $row['FullName'], $row['userName'], $row['Email'], $row['role']));
                    }
                }
                mysqli_close($conn);
                return $resultArray;
            }catch(Exception $ex){
                return "Unsuccessful retrival";
            }
        }

        function retrievePassword($userID){
            include '../dbConnect.php';
            $sql = "SELECT password FROM useraccount WHERE userID = '$userID'";
            try{
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $password = $row['password'];
                mysqli_close($conn);
                return $password;
            }catch(Exception $ex){
                mysqli_close($conn);
                return "Retrieval of the password failed";
            }
        }

        function editUserAccount($userID, $username, $password, $accountType, $fullname, $email){
            include'../dbConnect.php';
            $sql = "UPDATE useraccount SET userName = '$username', FullName = '$fullname', role = '$accountType', Email = '$email', password = '$password'
                    WHERE userID = '$userID'";
            try{
                mysqli_query($conn, $sql);
                mysqli_close($conn);
                return "Update account is successful";
            }catch(Exception $ex){
                mysqli_close($conn);
                return "Update account has failed";
            }
        }
    }
?>
