<?php
    include '../Controller/doUpdateAccountController.php';
    if(!empty($_POST)){
        $username = $_POST['username'];
        $password = $_POST['pass'];
        $confirmPass = $_POST['cpass'];
        $email = $_POST['email'];
        $bidLimit = "";
        if(!empty($_POST['bidLimit'])){
            $bidLimit = $_POST['bidLimit'];
        } 

        $updateAccountControl = new updateAccountController();
        $result = $updateAccountControl -> passUpdateAccountPara($username, $password, $confirmPass, $email, $bidLimit);
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
                echo "<a href='/Html/AdminLogin.html'>Back to Home</a>";
                break;
            case "Conference Chair":
                echo "<a href='/Html/ConferenceLogin.html'>Back to Home</a>";
                break;
            case "Author":
                echo "<a href='/Html/AuthorLogin.html'>Back to Home</a>";
                break;
            case "Reviewer":
                echo "<a href='/Html/ReviewerLogin.html'>Back to Home</a>";
                break;
        }
    }
    else{
?>
<!DOCTYPE html>
    <head>
        <link rel="stylesheet" href="../Css/Main.css">
        <link rel="stylesheet" href="../Css/Login.css">
    </head>
    <body>

    <div class="headerC">
        <p>
            The Best Paper Reviews
        </p>
    </div>

    <div class="parent">
       

        <div class="bodyC">

        <p>
            Update particulars
        </p>


        <form action="../Boundary/updateAccountBoundary.php" method="POST">

        <div class="user-box">
            <input type="text" name="username" placeholder="Username" id="username" value="<?php echo $_SESSION['username']?>" required><br><br>
        </div>

        <div class="user-box">    
            <input type="password" name="pass" placeholder="Change Password" id="pass"><br><br>
        </div>
        <div class="user-box">
            <input type="password" name="cpass" placeholder="Confirm Password" id="cpass"><br><br>
        </div>
        <div class="user-box">
            <input type="email" name="email" placeholder=" Email" id="email"><br><br>
        </div>
        <?php
        if($_SESSION['role'] == 'Reviewer'){       
        ?>
        Set Your Bid Limit:<br>
        <div class="user-box">
            <select name="bidLimit">
                <option value="1" selected>1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select><br><br>
        </div>
        <?php
        }
        ?>
       
        <div class="user-box">
        <input type="submit" value="Update Account" class="button-28">
        </div>

        <div class="user-box">
            <input type="button" value="Back" class="button-28">
        </div>      
        </form>

        </div>
        </div>
    </body>

</html>



<?php
    }
?>