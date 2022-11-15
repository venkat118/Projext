<?php
    include '../Controller/doViewComments.php';
    session_start();
    $paperID = $_GET['paperID'];
    $viewCommentControl = new viewCommentsController();
    $resultArray = $viewCommentControl -> passViewCommentPara($paperID);
?>
<html>
    <head>
        <script>
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const paperID = urlParams.get('paperID');
            const paperTitle = urlParams.get('paperTitle');
            const rating = urlParams.get('rating');
            const review = urlParams.get('review');
            const check = urlParams.get('check');
        </script>
    </head>
    <body>
        <form action="/Boundary/editRatingReviewBoundary.php" method="POST">
            <input type="hidden" name="paperID" id="paperID">
            <input type="hidden" name="title" id="title">
            <input type="hidden" name="paperRating" id="paperRating">
            <input type="hidden" name="review" id="paperReview">
            Paper Title: <label id="paperTitle"></label><br><br>
            Rating: <label id="rating"></label><br><br>
            Review:
            <label id="review"></label><br><br>
            <label id="button"></label>
            <?php if(!empty($_SESSION['role'])){?>
                <a id="addComments">Add Comments</a>
            <?php
            }
            ?>
        </form>
        <hr>
        <h1>Comments</h1>
        <?php
        if($resultArray){
            foreach($resultArray as $comment){
                echo "<p>$comment[1]</p>";
                echo "<p>Comment: $comment[0]</p>";
                echo"<hr>";
        }
        }else{
            echo "<p>There are no comments in this seciton, start commenting now!</p>";
        }
        ?>
    </body>
    <script>
        document.getElementById('paperTitle').innerHTML = paperTitle;
        document.getElementById('rating').innerHTML = rating;
        document.getElementById('review').innerHTML = review;
        if(check == 1){
            document.getElementById('button').innerHTML = "<input type='submit' value='Edit Your Ratings & Reviews'>";
        }
        document.getElementById('paperID').value = paperID;
        document.getElementById('title').value = paperTitle;
        document.getElementById('paperRating').value = rating;
        document.getElementById('paperReview').value = review;
        document.getElementById('addComments').href = `/Boundary/addCommentsBoundary.php?paperID=${paperID}&userID=<?php echo $_SESSION['userID']?>`;
    </script>
</html>