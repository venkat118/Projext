<?php
    session_start();
    if(!empty($_POST)){
        include '../Controller/doEditUserAccountController.php';
        $userID = $_POST['userID'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $cpass = $_POST['cpass'];
        $accountType = $_POST['role'];
        $fullname = $_POST['fullName'];
        $email = $_POST['email'];

        $editUserControl = new editUserAccountController();
        $result = $editUserControl ->passEditUserAccountPara($userID, $username, $password, $cpass, $accountType, $fullname, $email);
        echo $result;

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
    else if(!empty($_GET)){
        include '../Controller/doRetrievePasswordController.php';
        $userID = $_GET['userID'];
        $username = $_GET['username'];
        $account = $_GET['role'];
        $fullname = $_GET['fullName'];
        $email = $_GET['email'];

        $retrievePasswordControl = new retrievePasswordController();
        $password = $retrievePasswordControl -> passRetrievePasswordPara($userID); 

        $roleOptions = ['Conference Chair', 'Author', 'Reviewer'];
?>
<html>
    <form action="../Boundary/editUserAccountBoundary.php" method="POST">
        <input type="hidden" name="userID" value=<?php echo $userID?>>
        Username: <input type="text" name="username" value=<?php echo $username?> required><br><br>
        Password: <input type="password" name="password" value=<?php echo $password?>><br><br>
        Confirm Password: <input name="cpass" type="password" value=<?php echo $password?>><br><br>
        Account Type:
        <Select name="role">
            <?php
                foreach($roleOptions as $option){
                    if($account == $option){
                        echo "<option value='$option' selected>$option</option>";
                    }
                    else{
                        echo "<option value='$option'>$option</option>";
                    }
                }
            ?>
        </Select><br><br>
        Full Name: <input name="fullName" type="text" value=<?php echo $fullname?> required><br><br>
        Email: <input name="email" type="text" value=<?php echo $email?> required><br><br>
        <input type="submit" value="Edit Account">
    </form>
</html>
<?php
    }
?>