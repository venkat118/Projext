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
        <link rel="stylesheet" href="../Css/Main.css">
        <link rel="stylesheet" href="../Css/Login.css">
    </head>
    <body>

    <div class="headerC">
        <p>
            The Best Paper Reviews
        </p>
    </div>

    <div class="parent">
      

        <div class="bodyC">

            <p>
                Submit New Paper
            </p>
                
         <form action="../Boundary/submitPaperBoundary.php" method="POST" enctype="multipart/form-data">
            <div class="user-box">
                <input type="text" name="title" id="title" placeholder=" Paper Title" required>  
            </div>
            <div class="user-box">
                <input type="text" name="authorName" id="authorName" value="<?php session_start(); echo $_SESSION["fullname"]?>" readonly>
            </div>
            <div class="user-box">
               <input type="text" name="CoAuthor" id="CoAuthor" placeholder="Co Author">
            </div>
            <div class="user-box">
                <input type="text" name="CoAuthor2" id="CoAuthor2" placeholder="Co Author 2">
            </div>
            <div class="user-box">
                Upload your paper here:  <input type="file" name="file" placeholder="Upload you file here"><br><br>
            </div>

            <div class="user-box">
                <input type="submit" value="Submit paper" class="button-28">
            </div>


           
        </form>

        <div class="user-box">
            <input type="button" value="Back" class="button-28">
        </div>

    </div>
    </div>

    </body>
</html>
<?php
    }
?>