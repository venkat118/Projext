<?php
    include '../Entity/Paper.php';

    class ViewAuthorPapersController{
        public function __construct(){
        }
        function passViewPaperPara($username){
            $Paper = new Paper();
            $resultArray = $Paper -> retrieveAuthorPaper($username);
            return $resultArray;
        } 
    }
?>