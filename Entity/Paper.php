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
            include 'dbConnect.php';
            $sql = 'SELECT * FROM Paper';
            try{
                $result = mysqli_query($conn , $sql);
                if($result){
                    $row = mysqli_fetch_assoc($result);
                }
                mysqli_close($conn);
                return $row;
            }catch(Exception $ex){
                return mysqli_error($conn);
            }
        }
    }
?>