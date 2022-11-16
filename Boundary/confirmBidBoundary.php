<?php
    session_start();
    if(!empty($_POST)){
        include'../Controller/doConfirmBiddingController.php';
        $paperID = $_POST['paperID'];
        $confirmBiddingControl = new confirmBiddingController();
        $result = $confirmBiddingControl -> passBiddingPara($paperID, $_SESSION['fullname']);
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
    else{
?>
<html>
    <head>
    <link rel="stylesheet" href="../Css/Main.css">
        <link rel="stylesheet" href="../Css/Login.css">
        <script>
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const paperTitle = urlParams.get('paperTitle');
            const paperID = urlParams.get('paperID');
        </script>
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
               Confirm Bid
            </p>

        <form action="/Boundary/confirmBidBoundary.php" method="POST">
            <input type="hidden" id="paperID" name="paperID">

            <div class="user-box">

           
            Are you sure you would like to bid for <label name="title" id="paperTitle"></label>
            
            </div>
            <div class="user-box">
            <input type="submit" value="Confirm Bid" class="button-28">
            </div>
        </form>

            </div>
        </div>
    </body>
    <script>
        document.getElementById("paperTitle").innerHTML= paperTitle;
        document.getElementById('paperID').value = paperID;
    </script>

    
</html>
<?php
    }
?>