<?php
    class Paper{
        private $paperID;
        private $title;
        private $author;
        private $coauthor;
        private $coauthor2;
        private $reviewed_by;

        public function __construct(){

        }

        function retrievePapers($status){
            include '../dbConnect.php';
            if($status == "viewAll"){
                $sql = 'SELECT * FROM Paper';
            }
            else{
                $sql = "SELECT * FROM Paper WHERE Status = '$status'";
            }
            $resultArray = array();
            try{
                $result = mysqli_query($conn , $sql);
                if($result){
                    while($row = mysqli_fetch_assoc($result)){
                        array_push($resultArray, array($row['PaperID'], $row['Title'], $row['Author'], $row['reviewedBy']));
                    }
                }
                mysqli_close($conn);
                return $resultArray;
            }catch(Exception $ex){
                return mysqli_error($conn);
            }
        }

        function retrieveAuthorPaper($username , $status){
            include'../dbConnect.php';
            if($status == "viewAll"){
                $sql = "SELECT * FROM Paper WHERE Author = (SELECT FullName FROM useraccount WHERE userName = '$username')";
            }
            else{
                $sql = "SELECT * FROM Paper WHERE Author = (SELECT FullName FROM useraccount WHERE userName = '$username') AND Status = '$status'";
            }
            $resultArray = array();
            try{
                $result = mysqli_query($conn , $sql);
                if($result){
                    while($row = mysqli_fetch_assoc($result)){
                        array_push($resultArray, array($row['PaperID'], $row['Title'], $row['Author'], $row['reviewedBy']));
                    }
                }
                mysqli_close($conn);
                return $resultArray;
            }catch(Exception $ex){
                return mysqli_error($conn);
            }
        }
    }
?>