<?php
    session_start();
    if(!empty($_POST)){
        include '../Controller/doAddCommentsController.php';
        $paperID = $_POST['paperID'];
        $userID = $_POST['userID'];
        $comment = $_POST['comments'];

        $addCommentControl = new addCommentsController();
        $result = $addCommentControl -> passAddCommentsPara($userID, $paperID, $comment);
        echo $result;

        switch($_SESSION['role']){
            case "Admin":
                echo "<br><br><a href='/Html/AdminLogin.html'>Back to Home Page</a>";
                break;
            case "Conference Chair":
                echo "<br><br><a href='/Html/ConferenceLogin.html'>Back to Home Page</a>";
                break;
            case "Author":
                echo "<br><br><a href='/Html/AuthorLogin.html'>Back to Home Page</a>";
                break;
            case "Reviewer":
                echo "<br><br><a href='/Html/ReviewerLogin.html'>Back to Home Page</a>";
                break;
                
        }
    }else {
?>
<html>
    <head>
        <link rel="stylesheet" href="../Css/Main.css">
        <link rel="stylesheet" href="../Css/Login.css">
        <script>
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const userID = urlParams.get('userID');
            const paperID = urlParams.get('paperID');
        </script>
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
                Comment On Paper
            </p>

        <form action="../Boundary/addCommentsBoundary.php" method="POST">
            <input type="hidden" name="paperID" id="paperID">
            <input type="hidden" name="userID" id="userID">
            <div class="user-box">

            Write your comments here: <br>
            <textarea name="comments" rows="7" cols="50">
            </textarea>

        </div>
            <div class="user-box">

            <input type="submit" value="Post Comment" class="button-28">
            </div>
        </form>

        </div>
        </div>

    </body>
    <script>
        document.getElementById('paperID').value = paperID;
        document.getElementById('userID').value = userID;
    </script>
</html>
<?php
    }
?>