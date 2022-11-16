<?php
    include '../Controller/doViewReviewPaperController.php';

    session_start();
    $fullName = $_SESSION['fullname'];
    $search = "";
    if(!empty($_POST)){
        $search = $_POST['search'];
    }
    $viewReviewControl = new viewReviewPaperController();
    $resultArray = $viewReviewControl -> passViewReviewPaperPara($fullName, $search);
    if($resultArray){
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
        View Paper Reviews
    </p>
            <form action="../Boundary/viewReviewPapersBoundary.php" method="POST">
                <input type="text" name="search">
                <input type="submit" value="Search">
            </form>
            <table class="styled-table">
                <th>Paper ID</th>
                <th>Paper Title</th>
                <th>Authors</th>
                <th>Status</th>
                <th>Download</th>
                <th>Review</th>
                <?php
                foreach($resultArray as $Paper){
                    $download = "/Uploads/" . $Paper[4];
                    echo "<tr>";
                    echo "<td>$Paper[0]</td>";
                    echo "<td>$Paper[1]</td>";
                    echo "<td>$Paper[2]</td>";
                    echo "<td>$Paper[3]</td>";
                    echo "<td><a href='$download' download>Download</a></td>";
                    echo "<td><a href='../Boundary/reviewPapersBoundary.php?paperID=$Paper[0]&paperTitle=$Paper[1]&download=$download'>Review Paper</a></td>";
                    echo "</tr>";
                }
                ?>
            </table>

            </div>
            </div>

        </body>
    </html>
<?php
    }else{
        echo "<p>There are no papers available for reviewing, Bid for a paper first!</p>"; 
    }
?>
