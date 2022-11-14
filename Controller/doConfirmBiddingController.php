<?php
    include '../Entity/Paper.php';
    class confirmBiddingController{
        public function __construct()
        {
            
        }
        function passBiddingPara($paperID , $fullname){
            $Paper = new Paper();
            $result = $Paper -> confirmBid($paperID, $fullname);
            return $result;
        }
    }
?>