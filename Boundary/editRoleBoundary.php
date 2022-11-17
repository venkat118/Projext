<?php
    if(!empty($_POST)){
        include '../Controller/doEditRoleController.php';
        $accountType = $_POST['accountType'];
        $desc = $_POST['desc'];

        $editRoleControl = new editRoleController();
        $result = $editRoleControl -> passEditRolePara($roleID, $accountType, $desc);
        echo $result;
        switch($_SESSION['role']){
            case 1:
                echo "<br><br><a href='/Html/AdminLogin.html'>Back to Home</a>";
                break;
            case 2:
                echo "<br><br><a href='/Html/AuthorLogin.html'>Back to Home</a>";
                break;
            case 3:
                echo "<br><br><a href='/Html/ConferenceLogin.html'>Back to Home</a>";
                break;
            case 4:
                echo "<br><br><a href='/Html/ReviewerLogin.html'>Back to Home</a>";
                break;
        }
    }
    if(!empty($_GET)){
        $roleID = $_GET['roleID'];
        $accountType = $_GET['accountType'];
        $desc = $_GET['desc'];
?>
    <html>
        <head>
        </head>
        <body>
            <form action="/Boundary/editRoleBoundary.php">
                <input type="hidden" name="roleID" value=<?php echo $roleID?>>
                Role: <input type="text" name="accountType" value=<?php echo $accountType?> required><br><br>
                Description:<br><br>
                <textarea name="desc" cols="50" rows="4" required>
<?php echo $desc?>
                </textarea><br><br>
                <input type="submit" value="Finish Edit">
            </form>
        </body>
    </html>
<?php
}
?>