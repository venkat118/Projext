<?php
    include'../Controller/doAllPapersController.php';
    $doAllPaperControl = new doAllPapersController();
    $Allpapers = $doAllPaperControl -> passPaperPara();
?>
<html>
    <?php
        if($Allpapers){
    ?>
    <table border="1px solid black">
        <th>Paper ID</th>
        <th>Paper Title</th>
        <th>Authors</th>
        <th>Reviewed By</th>
        <?php
            foreach($Allpapers as $Paper){
                echo "<tr>";
                echo "<td>".$Paper[0]."</td>";
                echo "<td>".$Paper[1]."</td>";
                echo "<td>".$Paper[2]."</td>";
                echo "<td>".$Paper[3]."</td>";
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