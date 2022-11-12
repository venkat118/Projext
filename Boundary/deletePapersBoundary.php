<?php
    include '../Controller/doDeletePapersController.php';
    session_start();
    if(!empty($_POST)){
        $paperID = $_POST['paperID'];
        $deletePaperControl = new deletePaperController();
        $result  = $deletePaperControl -> passDeletePara($paperID);
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
        <form action="../Boundary/deletePapersBoundary.php/" method="POST">
            <input type="hidden" id="paperID" name="paperID">
            <p id="warning" name="warning">Are you sure you want to delete </p><br>
            <input type="submit" value="Delete">
        </form>
    </body>
    <script>
        var currentWarn = document.getElementById('warning').innerHTML;
        document.getElementById('warning').innerHTML = currentWarn + paperTitle + "?";
        document.getElementById('paperID').value = paperID;
    </script>
</html>
<?php
    }
?>