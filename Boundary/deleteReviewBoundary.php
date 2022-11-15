<?php
    session_start();
    if(!empty($_POST)){
        include '../Controller/doDeleteReviewController.php';
        $paperID = $_POST['paperID'];
        $deleteReviewControl = new deleteReviewController();
        $result = $deleteReviewControl -> passDeleteReviewPara($paperID);
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
    }
    else if(!empty($_GET)){
        $paperID = $_GET['paperID'];
        $paperTitle = $_GET['paperTitle'];

?>
<html>
    <body>
        <form action="../Boundary/deleteReviewBoundary.php" method="POST">
            <input type="hidden" name="paperID" value= <?php echo $paperID?>>
            Are you sure you would like to delete your review for the paper <?php echo $paperTitle?>?<br><br>
            <input type="submit" value="Delete Review">
        </form>
    </body>
</html>
<?php
    }
?>