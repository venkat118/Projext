<?php
    include '../Controller/doViewAuthorPapersController.php';
    session_start();
    $username = $_SESSION["username"];
    $viewAuthorPaperControl = new ViewAuthorPapersController();
    $authorPapers = $viewAuthorPaperControl -> passViewPaperPara($username);
?>
<html>
    <?php
        if($authorPapers){
    ?>
    <table border="1px solid black">
        <th>Paper ID</th>
        <th>Paper Title</th>
        <th>Authors</th>
        <th>Reviewed By</th>
        <?php
            foreach($authorPapers as $Paper){
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