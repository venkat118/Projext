<?php
    include '../Entity/Paper.php';

    class ViewAuthorPapersController{
        public function __construct(){
        }
        function passViewPaperPara($username , $status, $search){
            $Paper = new Paper();
            $resultArray = $Paper -> retrieveAuthorPaper($username, $status, $search);
            return $resultArray;
        } 
    }
?>