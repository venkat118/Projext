<?php
    include '../Entity/Paper.php';
    class viewReviewPaperController{
        public function __construct()
        {
            
        }
        function passViewReviewPaperPara($fullName){
            $Paper = new Paper();
            $resultArray = $Paper -> retrivePaperReviewing($fullName);
            return $resultArray;
        }

    }
?>