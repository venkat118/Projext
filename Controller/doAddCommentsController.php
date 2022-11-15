<?php
    include '../Entity/Comment.php';
    class addCommentsController{
        public function __construct()
        {
            
        }
        function passAddCommentsPara($userID, $paperID, $comment){
            $Comment = new Comment();
            $result = $Comment -> addComments($userID, $paperID, $comment);
            return $result;
        }
    }
?>