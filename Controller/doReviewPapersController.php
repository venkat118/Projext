<?php
    include '../Entity/Paper.php';
    class reviewPapersController{
        public function __construct()
        {
        }
        function passViewReviewPaperPara($paperID, $rating, $review, $userID){
            $Paper = new Paper();
            $result = $Paper -> reviewPaper($paperID, $rating, $review, $userID);
            return $result;
        }
    }
?>