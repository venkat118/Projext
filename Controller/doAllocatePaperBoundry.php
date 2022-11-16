<?php
    include '../Entity/Paper.php';
    session_start();

    class allocatePaperController{
        public function __construct()
        {

        }

        function allocatePaperPara($paperID,$status){
            $Paper = new Paper();
            $update = $Paper -> allocatePaper($paperID, $status);
            return $update;
        }
    }
?>