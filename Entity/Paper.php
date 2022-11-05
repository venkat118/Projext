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

        function retrievePapers(){
            include '../dbConnect.php';
            $sql = 'SELECT * FROM Paper';
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