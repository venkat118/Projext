<?php
    session_start();
    include'../Controller/doAllPapersController.php';
    
    $status = "viewAll";
    $search = "";
    if(isset($_GET['status'])){
        $status = $_GET['status'];
        $search = $_GET['search'];
    }
    $doAllPaperControl = new doAllPapersController();
    $Allpapers = $doAllPaperControl -> passPaperPara($status, $search);
?>
<html>
    <head>
    <link rel="stylesheet" href="../Css/Main.css">
    <link rel="stylesheet" href="../Css/viewPaper.css">
    </head>
    <body>
    <body>
        <div class="headerC">
            <p>
                The Best Paper Reviews
            </p>
        </div>
    
        <div class="parent">
    
            <div class="bodyC">
               
    
            <p>
                View All Papers
            </p>

        <form action="../Boundary/AllPapersBoundary.php" method="GET">
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
        <?php
            if($Allpapers){
        ?>
        <table class="styled-table">
            <th>Paper ID</th>
            <th>Paper Title</th>
            <th>Status</th>
            <th>Ratings</th>
            <th>Reviewed By</th>
            <th>Author</th>
            <th>CoAuthor</th>
            <th>2nd CoAuthor</th>
            <?php
                foreach($Allpapers as $Paper){
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
        <?php
            }
            else{
                if(!empty($_GET['status'])){
                    echo"<p>There are no available " . $_GET["status"] . " papers for viewing</p>";
                }
                else{
                    echo"<p>There are no available papers for viewing</p>";
                }
            }
        ?>
    </body>
</html>