<?php
    include '../Entity/Paper.php';

    class ViewAuthorPapersController{
        public function __construct(){
        }
        function passViewPaperPara($username , $status){
            $Paper = new Paper();
            $resultArray = $Paper -> retrieveAuthorPaper($username, $status);
            return $resultArray;
        } 
    }
?>