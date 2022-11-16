<?php
    include '../Entity/Paper.php';
    class viewReviewPaperController{
        public function __construct()
        {
            
        }
        function passViewReviewPaperPara($fullName , $search){
            $Paper = new Paper();
            $resultArray = $Paper -> retrivePaperReviewing($fullName, $search);
            return $resultArray;
        }

    }
?>