<?php
    include '../Controller/doViewAuthorPapersController.php';
    session_start();
    $username = $_SESSION["username"];
    $status = "viewAll";
    $search = "";
    if(isset($_GET['status']) || isset($_GET['search'])){
        $status = $_GET['status'];
        $search = $_GET['search'];
    }
    $viewAuthorPaperControl = new ViewAuthorPapersController();
    $authorPapers = $viewAuthorPaperControl -> passViewPaperPara($username , $status, $search);
?>
<html>
    <head>
        <title>Author's Paper</title>
        <script>
            function edit(){
                var paperID = document.getElementById('paperID').value;
                console.log(paperID);
                return paperID;
            }
        </script>


    <link rel="stylesheet" href="../Css/Main.css">
    <link rel="stylesheet" href="../Css/viewPaper.css">
    

    <?php
        if($authorPapers){
    ?>

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
                My Papers
            </p>


    
    <form action="../Boundary/viewAuthorPapersBoundary.php" method="GET">
        <select name="status">
            <option value="viewAll">View All</option>
            <option value="Bidding" <?php if((isset($_GET['status'])) && ($_GET['status'] == "Bidding")){echo "selected";}?>>Bidding</option>
            <option value="Reviewing"<?php if((isset($_GET['status'])) && ($_GET['status'] == "Reviewing")){echo "selected";}?>>Reviewing</option>
            <option value="Pending Approval"<?php if((isset($_GET['status'])) && ($_GET['status'] == "Pending Approval")){echo "selected";}?>>Pending Approval</option>
            <option value="Approved"<?php if((isset($_GET['status'])) && ($_GET['status'] == "Approved")){echo "selected";}?>>Approved</option>
        </select>

        <input type="text" name = "search" id = "search">
        <input type="submit" value = "Search">
    </form>

    <table class="styled-table">
        <thead>
        <th>Paper ID</th>
        <th>Paper Title</th>
        <th>Status</th>
        <th>Ratings</th>
        <th>Reviewed By</th>
        <th>Author</th>
        <th>CoAuthor</th>
        <th>2nd CoAuthor</th>
    </thead>
        <?php
            foreach($authorPapers as $Paper){
                $check = false;
                if(empty($Paper[3])){
                    $Paper[3] = "Nil";
                }
                if(!empty($_SESSION['fullname'])){
                    if($_SESSION['fullname'] == $Paper[3] && $Paper[4] == "Pending Approval"){
                        $check = True;
                    }
                }
                $download = "../Uploads/" . $Paper[5];
                echo "<tr>";
                echo "<td>".$Paper[0]."</td>";
                echo "<td>".$Paper[1]."</td>";
                echo "<td>".$Paper[4]."</td>";
                switch($Paper[6]){
                    case 1:
                        $rating = "&#9733;";
                        break;
                    case 2:
                        $rating = "&#9733;&#9733;";
                        break;
                    case 3:
                        $rating = "&#9733;&#9733;&#9733;";
                        break;
                    case 4:
                        $rating =  "&#9733;&#9733;&#9733;&#9733;";
                        break;
                    case 5:
                        $rating = "&#9733;&#9733;&#9733;&#9733;&#9733;";
                        break;
                }
                echo "<td>$rating</td>";
                echo "<td>".$Paper[3]."</td>";
                echo "<td>".$Paper[2]."</td>";
                echo "<td>".$Paper[7]."</td>";
                echo "<td>".$Paper[8]."</td>";
                echo "<td><a href='$download'download>Download</a></td>";
                if($Paper[4] == "Pending Approval"){
                    echo "<td><a href='../Boundary/viewRatingReviewBoundary.php?paperID=$Paper[0]&paperTitle=$Paper[1]&rating=$rating&review=$Paper[9]&check=$check'>View Reviews</a></td>";
                }
                echo "</tr>";
            }
        ?>
    </table>
    </div>
    </div>
    <?php
        }
        else{
            if(!empty($GET['status'])){
                echo"<p>You have no available " . $_GET['status'] ." papers for viewing</p>";
            }
            else{
                echo "<p>You have no available papers for viewing</p>";
            }
        }
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
    ?>
    
</html>