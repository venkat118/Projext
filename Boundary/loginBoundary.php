<?php
    function displayLogin($arrayResult){
        if($arrayResult){
            session_start();
            $_SESSION["userID"] = $arrayResult['userID'];
            $_SESSION["username"] = $arrayResult['userName'];
            $_SESSION["fullname"] = $arrayResult['FullName'];
            $_SESSION["role"] = $arrayResult['roleID'];

            switch($_SESSION['role']){
                case 1:
                    header('Location:/Html/AdminLogin.html');
                    break;
                case 2:
                    header('Location:/Html/AuthorLogin.html');
                    break;
                case 3:
                    header('Location:/Html/ConferenceLogin.html');
                    break;
                case 4:
                    header('Location:/Html/ReviewerLogin.html');;
                    break;
            } 
        }
        else{
            header('Location: ../Html/Login.html');
        }
        
        
    }



    
    include'../Controller/doLoginController.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $loginType = $_POST['role'];

    $myArray = [$username, $password, $loginType];
    $loginControl = new loginController();
    $arrayResult = $loginControl -> passLoginPara($myArray);
    displayLogin($arrayResult);
?>