<?php
    class Roles{
        private $roleName;
        private $desc;
        public function __construct()
        {
            
        }
        function retrieveRoles($search){
            include"../dbConnect.php";
            if($search){
                $sql = "SELECT * FROM roles WHERE role LIKE '%$search%'";
            }else{
                $sql = "SELECT * FROM roles";
            }
            $resultArray = array();
            try{
                $result = mysqli_query($conn, $sql);
                if($result){
                    while($row = mysqli_fetch_assoc($result)){
                        array_push($resultArray, array($row['roleID'], $row['role'], $row['Description']));
                    }
                }
                mysqli_close($conn);
                return $resultArray;
            }catch(Exception $ex){
                return "Retrieval has failed";
            }
        }

        function editRoles($roleID, $accountType, $desc){
            include '../dbConnect.php';
            $sql = "UPDATE roles SET role = '$accountType', Description = '$desc' WHERE roleID = '$roleID'";
            try{
                mysqli_query($conn, $sql);
                mysqli_close($conn);
                return "Update account type is a success";
            }catch(Exception $ex){
                mysqli_close($conn);
                return "Update account is not successful";
            }
        }
    }
?>