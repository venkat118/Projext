<?php
    include '../Entity/Paper.php';
    class doAllPapersController {
        public function __construct(){      
        }
        function passPaperPara(){
            $Paper = new Paper();
            $resultRecords = $Paper -> retrievePapers();
            return $resultRecords; 
        }
    }
?>