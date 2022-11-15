<?php
    class Comment{
        private $userID;
        private $paperID;
        private $comments;

        public function __construct()
        {
            
        }

        function addComments($userID, $paperID, $comment){
            include '../dbConnect.php';
            $sql = "INSERT INTO comments (PaperID, UserID, Comment) VALUES('$paperID', '$userID', '$comment')";
            try{
                mysqli_query($conn, $sql);
                return "Successfully posted comments";
            }catch(Exception $ex){
                return "Unsuccessfully posted comments";
            }
        }

        function retrievePaperComments($paperID){
            include'../dbConnect.php';
            $sql = "SELECT Comment, userName FROM comments INNER JOIN useraccount ON comments.userID = useraccount.userID WHERE PaperID = '$paperID'";
            $resultArray = array();
            try{
                $result = mysqli_query($conn, $sql);
                if($result){
                    while($row = mysqli_fetch_assoc($result)){
                        array_push($resultArray, array($row['Comment'], $row['userName']));
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