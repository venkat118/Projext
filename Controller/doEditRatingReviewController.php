<?php
    include '../Entity/Paper.php';
    class editRatingReviewController{
        public function __construct()
        {
            
        }
        function passEditRatingReviewPara($paperID, $rating, $review){
            $Paper = new Paper();
            $result = $Paper -> editRatingReview($paperID, $rating, $review);
            return $result;
        }
    }
?>