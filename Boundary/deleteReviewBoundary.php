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
    <head>
    <link rel="stylesheet" href="../Css/Main.css">
        <link rel="stylesheet" href="../Css/Login.css">
    <head>

    <body>
    <div class="headerC">
            <p>
                The Best Paper Reviews
            </p>
        </div>
    
        <div class="parent">
    
            <div class="bodyC">
               
    
            <p>
               Confirm Delete Review
            </p>

        <form action="../Boundary/deleteReviewBoundary.php" method="POST">
           
        <input type="hidden" name="paperID" value= <?php echo $paperID?>>
        <div class="user-box">
        Are you sure you would like to delete your review for the paper <?php echo $paperTitle?>?
        </div>
        <div class="user-box">

        <input type="submit" value="Delete Review" class="button-28">
        </div>
        </form>
    </body>
</html>
<?php
    }
?>