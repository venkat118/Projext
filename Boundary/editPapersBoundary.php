<?php
    include '../Controller/doEditPaperController.php';
    session_start();
    if(!empty($_POST)){
        $paperID = $_POST['paperID'];
        $title = $_POST['title'];
        $coAuthor = $_POST['coAuthor'];
        $coAuthor2 = $_POST['coAuthor2'];
        $File = $_FILES["file"];

        $editPaperControl = new editPaperController();
        $result  = $editPaperControl -> passEditPaperPara($paperID, $title, $coAuthor, $coAuthor2, $File);
        echo "$result";

        switch($_SESSION['role']){
            case "Admin":
                echo "<a href='../Html/AdminLogin.html'>Back to Home</a>";
                break;
            case "Conference Chair":
                echo "<a href='../Html/ConferenceLogin.html'>Back to Home</a>";
                break;
            case "Author":
                echo "<a href='../Html/AuthorLogin.html'>Back to Home</a>";
                break;
            case "Reviewer":
                echo "<a href='../Html/ReviewerLogin.html'>Back to Home</a>";
                break;
        }
    }
?>
<html>
    <head>
        <script>
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const paperTitle = urlParams.get('paperTitle');
            const paperID = urlParams.get('paperID');
            const author = urlParams.get('author');
        </script>
    <head>
    <body>
        <form action="../Boundary/editPapersBoundary.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="paperID" name="paperID">
            Paper Title: <input type="text" name="title" id="title"><br><br>
            Author: <input type="text" name="author" id="author" readonly><br><br>
            CoAuthor: <input type="text" name="coAuthor" id="coAuthor"><br><br>
            CoAuthor 2: <input type="text" name="coAuthor2" id="coAuthor2"><br><br>
            Upload your file here:<br><br>
            <input type="file" name="file" id="file"><br><br>
            <input type="submit" value="Edit your paper">
        </form>
    </body>
    <script>
        document.getElementById('title').value = paperTitle;
        document.getElementById('author').value = author;
        document.getElementById('paperID').value = paperID;
    </script>
</html>