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
                echo "<br><a href='/Html/AdminLogin.html'>Back to Home Page</a>";
                break;
            case "Conference Chair":
                echo "<br><a href='/Html/ConferenceLogin.html'>Back to Home Page</a>";
                break;
            case "Author":
                echo "<br><a href='/Html/AuthorLogin.html'>Back to Home Page</a>";
                break;
            case "Reviewer":
                echo "<br><a href='/Html/ReviewerLogin.html'>Back to Home Page</a>";
                break;
                
        }
    }
    else{
?>
<html>
    <head>
        <script>
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const paperTitle = urlParams.get('paperTitle');
            const paperID = urlParams.get('paperID');
        </script>
    </head>
    <body>
        <form action="/Boundary/confirmBidBoundary.php" method="POST">
            <input type="hidden" id="paperID" name="paperID">
            Are you sure you would like to bid for <label name="title" id="paperTitle"></label><br><br>
            <input type="submit" value="Confirm Bid">
        </form>
    </body>
    <script>
        document.getElementById("paperTitle").innerHTML= paperTitle;
        document.getElementById('paperID').value = paperID;
    </script>
</html>
<?php
    }
?>