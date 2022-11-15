<?php
    include '../Entity/Comment.php';
    class viewCommentsController{
        public function __construct()
        {
            
        }
        function passViewCommentPara($paperID){
            $Comment = new Comment();
            $resultArray = $Comment -> retrievePaperComments($paperID);
            return $resultArray;
        }
    }
?>