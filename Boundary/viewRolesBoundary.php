<?php
    session_start();
    include'../Controller/doViewRolesBoundary.php';
    $search="";
    if(!empty($_POST)){
        $search = $_POST['search'];
    }
    $viewRoleControl = new viewRolesController();
    $arrayResult = $viewRoleControl -> passViewRolesPara($search);
    if($arrayResult){
?>
<html>
    <head>
    </head>
    <body>
        <form action="/Boundary/viewRolesBoundary.php" method="POST">
            <input type="text" name="search">
            <input type="submit" value="Search">
        </form>
        <table border= 1px solid black>
            <th>Role ID</th>
            <th>Account Type</th>
            <th>Description</th>
            <?php
            foreach($arrayResult as $role){
                echo "<tr>";
                echo "<td>$role[0]</td>";
                echo "<td>$role[1]</td>";
                echo "<td>$role[2]</td>";
                echo "<td><a href='/Boundary/editRoleBoundary.php?roleID=$role[0]&accountType=$role[1]&desc=$role[2]'>Edit Account Type</a></td>";
            }
            ?>
        </table>
    </body>
</html>
<?php
    switch($_SESSION['role']){
        case 1:
            echo "<a href='/Html/AdminLogin.html'>Back to Home</a>";
            break;
        case 2:
            echo "<a href='/Html/AuthorLogin.html'>Back to Home</a>";
            break;
        case 3:
            echo "<a href='/Html/ConferenceLogin.html'>Back to Home</a>";
            break;
        case 4:
            echo "<a href='/Html/ReviewerLogin.html'>Back to Home</a>";
            break;
    }   
    }else{
        echo "<p>There are no account types! Create one first</p>";
    }
?>