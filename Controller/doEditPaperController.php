<?php
    include '../Entity/Paper.php';
    class editPaperController{
        public function __construct()
        {
            
        }
        function passEditPaperPara($paperID, $title, $coAuthor, $coAuthor2, $File){
            $Paper = new Paper();
            $checkDelete = $Paper -> deleteFileInUploads($paperID);
            if($checkDelete){
                $target_dir = "../Uploads/";
                $target_file = $target_dir . basename($File["name"]);
                $fileType = strtolower(pathinfo($target_file , PATHINFO_EXTENSION));
    
                if(file_exists($target_file)){
                    return "file exist";
                }
    
                if($fileType != "docx" && $fileType != "pdf"){
                    return "only word and pdf documents are allowed";
                }
    
                if(move_uploaded_file($File["tmp_name"], $target_file)){
                    $Paper = new Paper();
                    $result = $Paper -> editPaper($paperID, $title, $coAuthor, $coAuthor2, $File);
                    return $result;
                }else{
                    return "error in uploading";
                }
            }
        }
    }
?>