<?php
    if(!empty($_POST)){
        
        $paperID = $_POST['paperID'];
        $paperTitle = $_POST['title'];
        $paperRating = $_POST['paperRating'];
        $review = $_POST['review'];
        
        if(!empty($_POST['check'])){
            include '../Controller/doEditRatingReviewController.php';
            $editRatingReviewControl = new editRatingReviewController();
            $result = $editRatingReviewControl -> passEditRatingReviewPara($paperID, $paperRating, $review);
            echo $result;

            session_start();

            switch($_SESSION['role']){
                case "Admin":
                    echo "<br><br><a href='/Html/AdminLogin.html'>Back to Home</a>";
                    break;
                case "Conference Chair":
                    echo "<br><br><a href='/Html/ConferenceLogin.html'>Back to Home</a>";
                    break;
                case "Author":
                    echo "<br><br><a href='/Html/AuthorLogin.html'>Back to Home</a>";
                    break;
                case "Reviewer":
                    echo "<br><br><a href='/Html/ReviewerLogin.html'>Back to Home</a>";
                    break;
            }
        }
        else if (empty($_POST['check'])){
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
                Edit Review
            </p>

        <form action="../Boundary/editRatingReviewBoundary.php" method="POST">
            <input type="hidden" name="check" value="checked">

            <input type="hidden" name="paperID" value=<?php echo $paperID; ?>>

            <input type="hidden" name="title" value=<?php echo $paperTitle; ?>>
            <div class="user-box">
            Paper Title: <label><?php echo $paperTitle; ?></label>
            </div>
            <div class="user-box">
            Leave your rating here:
            <select name="paperRating">
                <option value="1">&#9733;</option>
                <option value="2">&#9733;&#9733;</option>
                <option value="3">&#9733;&#9733;&#9733;</option>
                <option value="4">&#9733;&#9733;&#9733;&#9733;</option>
                <option value="4">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
            </select>
            </div>

            <div class="user-box">
            Leave your review here:<br><br>
            <textarea id="review" name="review" rows="4" cols="50" required>
<?php echo $review?>
            </textarea>
            </div>
            <div class="user-box">
            <input type="submit" value="Change Your Review" class="button-28">
            </div>
        </form>

            </div>
        </div>
    </body>
</html>
<?php
    }
}
?>