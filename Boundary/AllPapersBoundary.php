<?php
    include'../Controller/doAllPapersController.php';
    
    $status = "viewAll";
    if(isset($_GET['status'])){
        $status = $_GET['status'];
    }
    $doAllPaperControl = new doAllPapersController();
    $Allpapers = $doAllPaperControl -> passPaperPara($status);
?>
<html>
    <head>
    </head>
    <body>
        <form action="../Boundary/AllPapersBoundary.php" method="GET">
            <select name="status">
                <option value="viewAll">View All</option>
                <option value="Bidding" <?php if((isset($_GET['status'])) && ($_GET['status'] == "Bidding")){echo "selected";}?>>Bidding</option>
                <option value="Reviewing"<?php if((isset($_GET['status'])) && ($_GET['status'] == "Reviewing")){echo "selected";}?>>Reviewing</option>
                <option value="Pending Approval"<?php if((isset($_GET['status'])) && ($_GET['status'] == "Pending Approval")){echo "selected";}?>>Pending Approval</option>
                <option value="Approved"<?php if((isset($_GET['status'])) && ($_GET['status'] == "Approved")){echo "selected";}?>>Approved</option>
            </select>
            <input type="submit" value = "Filter">
        </form>
        <?php
            if($Allpapers){
        ?>
        <table border="1px solid black">
            <th>Paper ID</th>
            <th>Paper Title</th>
            <th>Authors</th>
            <th>Reviewed By</th>
            <th>Staus</th>
            <th>Download</th>
            <?php
                foreach($Allpapers as $Paper){
                    if(empty($Paper[3])){
                        $Paper[3] = "Nil";
                    }
                    $download = "../Uploads/" . $Paper[5];
                    echo "<tr>";
                    echo "<td>".$Paper[0]."</td>";
                    echo "<td>".$Paper[1]."</td>";
                    echo "<td>".$Paper[2]."</td>";
                    echo "<td>".$Paper[3]."</td>";
                    echo "<td>".$Paper[4]."</td>";
                    echo "<td><a href='$download'download>Download</a></td>";
                    echo "</tr>";
                }
            ?>
        </table>
        <?php
            }
            else{
                echo"<p>There are no available " . $_GET["status"] . " papers for viewing</p>";
            }
        ?>
    </body>
</html>