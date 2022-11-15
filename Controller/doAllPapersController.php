<?php
    include '../Entity/Paper.php';
    class doAllPapersController {
        public function __construct(){      
        }
        function passPaperPara($status, $search){
            $Paper = new Paper();
            $resultRecords = $Paper -> retrievePapers($status, $search);
            return $resultRecords; 
        }
    }
?>