<?php
    include '../Controller/doViewReviewPaperController.php';

    session_start();
    $fullName = $_SESSION['fullname'];
    $viewReviewControl = new viewReviewPaperController();
    $resultArray = $viewReviewControl -> passViewReviewPaperPara($fullName);
    if($resultArray){
?>
    <html>
        <head>
        </head>
        <body>
            <table border= 1px solid black>
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
        </body>
    </html>
<?php
    }else{
        echo "<p>There are no papers available for reviewing, Bid for a paper first!</p>"; 
    }
?>
