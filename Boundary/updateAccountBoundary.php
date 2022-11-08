<?php
    include '../Controller/doUpdateAccountController.php';
    if(!empty($_POST)){
        $username = $_POST['username'];
        $password = $_POST['pass'];
        $confirmPass = $_POST['cpass'];
        $email = $_POST['email'];

        $updateAccountControl = new updateAccountController($username, $password, $confirmPass, $email);
        $result = $updateAccountControl -> passUpdateAccountPara($username, $password, $confirmPass, $email);
        switch($result){
            case 0:
                echo "Update successful";
                break;
            case 1:
                echo "Update unsuccessful";
                break;
            case 2:
                echo "Password is not the same";
                break;
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
    }
    else{
?>
<html>
    <head>
    </head>
    <body>
        <form action="../Boundary/updateAccountBoundary.php" method="POST">
            Username: <input type="text" name="username" id="username" value="<?php echo $_SESSION['username']?>" required><br><br>
            Change Password: <input type="password" name="pass" id="pass"><br><br>
            Confirm Password: <input type="password" name="cpass" id="cpass"><br><br>
            Email: <input type="email" name="email" id="email"><br><br>
            <input type="submit" value="Update Account">
        </form>
    </body>
</html>
<?php
    }
?>