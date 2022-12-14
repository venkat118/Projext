<?php
    session_start();
    if(!empty($_POST)){
        include '../Controller/doReviewPapersController.php';
        $paperID = $_POST['paperID'];
        $rating = $_POST['rating'];
        $review = $_POST['review'];
        $userID = $_SESSION['userID'];
        $reviewPaperControl = new reviewPapersController();
        $result = $reviewPaperControl ->passViewReviewPaperPara($paperID, $rating, $review, $userID);
        echo $result;

        switch($_SESSION['role']){
            case "Admin":
                echo "<br><a href='/Html/AdminLogin.html'>Back to Home</a>";
                break;
            case "Conference Chair":
                echo "<br><a href='/Html/ConferenceLogin.html'>Back to Home</a>";
                break;
            case "Author":
                echo "<br><a href='/Html/AuthorLogin.html'>Back to Home</a>";
                break;
            case "Reviewer":
                echo "<br><a href='/Html/ReviewerLogin.html'>Back to Home</a>";
                break;
        }
    }
    else{
?>
<html>
    <head>
        <link rel="stylesheet" href="../Css/Main.css">
        <link rel="stylesheet" href="../Css/Login.css">
        <link rel="stylesheet" href="../Css/viewPaper.css">
        <script>
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const paperTitle = urlParams.get('paperTitle');
            const paperID = urlParams.get('paperID');
            const download = urlParams.get('download');
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
                Submit Review
            </p>

        <form action="../Boundary/reviewPapersBoundary.php" method="POST">

            <input type="hidden" id="paperID" name="paperID">

            <div class="user-box">
               
            </div>
          
            Paper Title: <label name="title" id="paperTitle"></label><br><br>
            Download the paper here: <a href="" id="downloadPaper" name="downloadPaper" download>Download</a><br><br>
           <div class="user-box">
            Leave your rating here:
            <select name="rating">
                <option value="1">&#9733;</option>
                <option value="2">&#9733;&#9733;</option>
                <option value="3">&#9733;&#9733;&#9733;</option>
                <option value="4">&#9733;&#9733;&#9733;&#9733;</option>
                <option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
            </select>
            </div>
            <div class="user-box">

           
            Leave your review Here:<br>
            <textarea id="review" name="review" rows="4" cols="50" required>
            </textarea>
            </div>

            <div class="user-box">

            <input type="submit" value="Submit your review" class="button-28">

            </div>

        </form>
</div>
</div>


    </body>


    <script>
        document.getElementById("paperTitle").innerHTML= paperTitle;
        document.getElementById('paperID').value = paperID;
        document.getElementById('downloadPaper').href = download;
    </script>
</html>
<?php
    }
?>