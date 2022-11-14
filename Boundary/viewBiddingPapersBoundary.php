<?php
    include '../Controller/doAllPapersController.php';
    $allPaperControl = new doAllPapersController();
    $resultArray = $allPaperControl -> passPaperPara('Bidding');
    if($resultArray){
?>
<html>
    <head>
    </head>
    <body>
        <table border= 1px solid black>
            <th>Paper ID</th>
            <th>Paper Title</th>
            <th>Author</th>
            <th>Status</th>
            <th>Download</th>
            <th>Bid Paper</th>
            <?php
            foreach($resultArray as $Paper){
                $download = "/Uploads/". $Paper[5];
                echo "<tr>";
                echo "<td>$Paper[0]</td>";
                echo "<td>$Paper[1]</td>";
                echo "<td>$Paper[2]</td>";
                echo "<td>$Paper[4]</td>";
                echo "<td><a href='$download' download>Download Paper</a></td>";
                echo "<td><a href='/Boundary/confirmBidBoundary.php?paperID=$Paper[0]&paperTitle=$Paper[1]'>Bid Paper</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </body>
</html>
<?php
    }
    else{
        echo "<p>There are no available papers for bidding!</p>";
    }
?>