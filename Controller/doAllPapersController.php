<?php
    include '../Entity/Paper.php';
    class doAllPapersController {
        public function __construct(){      
        }
        function passPaperPara($status){
            $Paper = new Paper();
            $resultRecords = $Paper -> retrievePapers($status);
            return $resultRecords; 
        }
    }
?>