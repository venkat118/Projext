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
    </head>
    <?php
        if($authorPapers){
    ?>
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
    <table border="1px solid black">
        <th>Paper ID</th>
        <th>Paper Title</th>
        <th>Authors</th>
        <th>Reviewed By</th>
        <th>Status</th>
        <th>Download</th>
        <th>Edit</th>
        <th>Delete</th>
        <?php
            foreach($authorPapers as $Paper){
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
                echo "<td><a href='../Boundary/editPapersBoundary.php?paperTitle=$Paper[1]&paperID=$Paper[0]&author=$Paper[2]' id='edit'>Edit Paper</a></td>";
                echo "<td><a href='../Boundary/deletePapersBoundary.php?paperTitle=$Paper[1]&paperID=$Paper[0]'>Delete Paper</a></td>";
                echo "</tr>";
            }
        ?>
    </table>
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