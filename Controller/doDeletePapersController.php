<?php
    include '../Entity/Paper.php';
    class deletePaperController{
        public function __construct()
        {
            
        }
        function passDeletePara($paperID){
            $Paper = new Paper();
            $check = $Paper ->deleteFileInUploads($paperID);
            if($check){
                $result = $Paper -> deletePaper($paperID);
                return $result;
            }
            else{
                return "Unable to return delete file in Uploads folder";
            }
        }
    }
?>