<?php
    if(!empty($_POST)){
        include '../Controller/doSubmitPaperController.php';
        $File = $_FILES['file'];
        $title = $_POST['title'];
        $author = $_POST['authorName'];
        $coAuthor = null;
        $coAuthor2 = null;
        if(isset($_POST['CoAuthor'])){
            $coAuthor = $_POST['CoAuthor'];
        }
        if(isset($_POST['CoAuthor2'])){
            $coAuthor2 = $_POST['CoAuthor2'];
        }

        $submitPaperControl = new submitPaperController();
        $result = $submitPaperControl -> passSubmitPaperPara($title, $author, $coAuthor, $coAuthor2, $File);
        echo $result;
        echo "<a href='../Boundary/viewAuthorPapersBoundary.php'>View all my papers</a>";
    }
    else{
?>
<html>
    <head>
    </head>
    <body>
        <form action="../Boundary/submitPaperBoundary.php" method="POST" enctype="multipart/form-data">
            Paper Title: <input type="text" name="title" id="title" required><br><br>
            Author: <input type="text" name="authorName" id="authorName" value="<?php session_start(); echo $_SESSION["fullname"]?>" readonly><br><br>
            Co Author: <input type="text" name="CoAuthor" id="CoAuthor"><br><br>
            2nd Co Author: <input type="text" name="CoAuthor2" id="CoAuthor2"><br><br>
            Upload your paper here:<br><br>
            <input type="file" name="file"><br><br>
            <input type="submit" value="submit paper">
        </form>
    </body>
</html>
<?php
    }
?>