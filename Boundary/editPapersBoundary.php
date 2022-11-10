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
           Edit paper
       </p>
        <form action="../Boundary/editPapersBoundary.php" method="POST" enctype="multipart/form-data">

            <div class="user-box">
                <input type="text" name="title" id="title" placeholder=" Paper Title" required>  
            </div>
            <div class="user-box">
                <input type="text" name="author" id="author" placeholder="Author Name" readonly>
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
            <a href="">
             <input type="button" value="Back" class="button-28">
            </a>
        </div>

        </div>
        </div>
    </body>
    <script>
        document.getElementById('title').value = paperTitle;
        document.getElementById('author').value = author;
        document.getElementById('paperID').value = paperID;
    </script>
</html>