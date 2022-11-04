<?php
    include'../Controller/doAllPapersController.php';
    $doAllPaperControl = new doAllPapersController();
    $Allpapers = $doAllPaperControl -> passPaperPara();
?>
<html>
    <?php
        if($Allpapers){
    ?>
    <table>
        <th>Paper ID</th>
        <th>Paper Title</th>
        <th>Authors</th>
        <th>Reviewed By</th>
        <?php
            while($row = $Allpapers -> fetch_assoc()){
                echo "<tr>";
                echo "<td>".$row['PaperID']."</td>";
                echo "<td>".$row['Title']."</td>";
                echo "<td>".$row['Author']."</td>";
                echo "<td>".$row['reviewedBy']."</td>";
                echo "</tr>";
            }
        ?>
    </table>
    <?php
        }
        else{
            echo"<p>There are no available papers for viewing</p>";
        }
    ?>
</html>