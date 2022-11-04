<?php
    include'../Controller/doLoginController.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $loginType = $_POST['loginType'];

    $myArray = [$username, $password, $loginType];
    $loginControl = new loginController();
    $arrayResult = $loginControl -> passLoginPara($myArray);
    
    if($arrayResult){
        session_start();
        $_SESSION["username"] = $arrayResult['username'];
        $_SESSION["role"] = $arrayResult['role'];
    }
?>
<html>

</html>