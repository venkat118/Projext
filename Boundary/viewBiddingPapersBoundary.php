<?php
    include '../Controller/doAllPapersController.php';
    $search = "";
    if (!empty($_POST)){
        $search = $_POST['search'];
    }
    $allPaperControl = new doAllPapersController();
    $resultArray = $allPaperControl -> passPaperPara('Bidding', $search);
    if($resultArray){
?>
<html>
<head>
    <link rel="stylesheet" href="../Css/Main.css">
    <link rel="stylesheet" href="../Css/viewPaper.css">
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
                View Bidding Papers
            </p>

        <form action="../Boundary/viewBiddingPapersBoundary.php" method="POST">
            <input type="text" name="search">
            <input type="submit" value="Search">
        </form>
        <table class="styled-table">
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
            </div>
        </div>
    </body>
</html>
<?php
    }
    else{
        echo "<p>There are no available papers for bidding!</p>";
    }
?>