<?php
    include '../Entity/Paper.php';
    class deleteReviewController{
        public function __construct()
        {
            
        }
        function passDeleteReviewPara($paperID){
            $Paper = new Paper();
            $result = $Paper -> deleteReview($paperID);
            return $result;
        }
    }
?>