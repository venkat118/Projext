<?php
    function displayLogin($arrayResult){
        if($arrayResult){
            session_start();
            $_SESSION["userID"] = $arrayResult['userID'];
            $_SESSION["username"] = $arrayResult['userName'];
            $_SESSION["fullname"] = $arrayResult['FullName'];
            $_SESSION["role"] = $arrayResult['role'];

            switch ($_SESSION["role"]){
                case "Admin":
                    header('Location: ../Html/AdminLogin.html');
                    break;
                case "Author":
                    header('Location: ../Html/AuthorLogin.html');
                    break;
                case "Conference Chair":
                    header('Location: ../Html/ConferenceLogin.html');
                    break;
                case "Reviewer":
                    header('Location: ../Html/ReviewerLogin.html');
                    break;
                default:
                    header('Location: ../Html/Login.html');
            }
        }else{
            header('Location: ../Html/Login.html');
        }
    }
    
    include'../Controller/doLoginController.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $loginType = $_POST['loginType'];

    $myArray = [$username, $password, $loginType];
    $loginControl = new loginController();
    $arrayResult = $loginControl -> passLoginPara($myArray);
    displayLogin($arrayResult);
?>