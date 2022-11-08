<?php
    include '../Entity/Paper.php';
    class submitPaperController{
        public function __construct(){
        }

        function passSubmitPaperPara($title, $author, $coAuthor, $coAuthor2, $File){
            $target_dir = "../Uploads/";
            $target_file = $target_dir . basename($File["name"]);
            $fileType = strtolower(pathinfo($target_file , PATHINFO_EXTENSION));

            if(file_exists($target_file)){
                return "file exist";
            }

            if($fileType != "docx" && $fileType != "pdf"){
                return "only word and pdf documents are allowed";
            }

            if($uploadOk = 1){
                if(move_uploaded_file($File["tmp_name"], $target_file)){
                    $Paper = new Paper();
                    $result = $Paper -> submitAuthorPaper($title , $author, $coAuthor, $coAuthor2, $File['name']);
                    return $result;
                }else{
                    return "error in uploading";
                }
            }
        }

    }
?>