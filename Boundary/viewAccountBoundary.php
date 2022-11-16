<?php
    session_start();
    include '../Controller/doViewAccountController.php';
    $search = "";
    if(!empty($_POST)){
        $search = $_POST['search'];
    }
    $viewAccountControl = new viewAccountController();
    $resultArray = $viewAccountControl -> passViewAccountPara($search);
    if($resultArray){
?>
<html>
    <head>
    </head>
    <body>
        <form action="../Boundary/viewAccountBoundary.php" method="POST">
            <input type="text" name="search" id="search">
            <input type="submit" value="Search">
        </form>
        <table border= 1px solid black>
            <th>User ID</th>
            <th>Username</th>
            <th>Role</th>
            <th>Full Name</th>
            <th>Email</th>
            <?php
            foreach($resultArray as $account){
                echo "<tr>";
                echo "<td>$account[0]</td>";
                echo "<td>$account[2]</td>";
                echo "<td>$account[4]</td>";
                echo "<td>$account[1]</td>";
                echo "<td>$account[3]</td>";
                echo "<td><a href='/Boundary/editUserAccountBoundary.php?userID=$account[0]&username=$account[2]&role=$account[4]&fullName=$account[1]&email=$account[3]'>Edit User Account</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </body>
</html>
<?php
    switch($_SESSION['role']){
        case "Admin":
            echo "<br><br><a href='/Html/AdminLogin.html'>Back to Home Page</a>";
            break;
        case "Conference Chair":
            echo "<br><br><a href='/Html/ConferenceLogin.html'>Back to Home Page</a>";
            break;
        case "Author":
            echo "<br><br><a href='/Html/AuthorLogin.html'>Back to Home Page</a>";
            break;
        case "Reviewer":
            echo "<br><br><a href='/Html/ReviewerLogin.html'>Back to Home Page</a>";
            break;
        
    }
}
    else{
        echo "<p>There is no accounts to view at the momment, create an account to view!</p>";
}
?>