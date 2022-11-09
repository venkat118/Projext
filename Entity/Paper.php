<?php
    class Paper{
        private $paperID;
        private $title;
        private $author;
        private $coauthor;
        private $coauthor2;
        private $reviewed_by;

        public function __construct(){

        }

        function retrievePapers($status){
            include '../dbConnect.php';
            if($status == "viewAll"){
                $sql = 'SELECT * FROM Paper';
            }
            else{
                $sql = "SELECT * FROM Paper WHERE Status = '$status'";
            }
            $resultArray = array();
            try{
                $result = mysqli_query($conn , $sql);
                if($result){
                    while($row = mysqli_fetch_assoc($result)){
                        array_push($resultArray, array($row['PaperID'], $row['Title'], $row['Author'], $row['reviewedBy'], $row['Status'], $row['FileName']));
                    }
                }
                mysqli_close($conn);
                return $resultArray;
            }catch(Exception $ex){
                return mysqli_error($conn);
            }
        }

        function retrieveAuthorPaper($username , $status, $search){
            include'../dbConnect.php';
            if($status == "viewAll" && empty($search)){
                $sql = "SELECT * FROM Paper WHERE Author = (SELECT FullName FROM useraccount WHERE userName = '$username')";
            }
            else{
                $sql = "SELECT * FROM Paper WHERE Author = (SELECT FullName FROM useraccount WHERE userName = '$username') AND (Status = '$status' OR Title LIKE '%$search')";
            }
            $resultArray = array();
            try{
                $result = mysqli_query($conn , $sql);
                if($result){
                    while($row = mysqli_fetch_assoc($result)){
                        array_push($resultArray, array($row['PaperID'], $row['Title'], $row['Author'], $row['reviewedBy'], $row['Status'], $row['FileName']));
                    }
                }
                mysqli_close($conn);
                return $resultArray;
            }catch(Exception $ex){
                return mysqli_error($conn);
            }
        }

        function submitAuthorPaper($title, $author, $coAuthor, $coAuthor2, $fileName){
            include'../dbConnect.php';
            $sql = "INSERT INTO paper (Title, Author, CoAuthor, CoAuthor2, Status, FileName) VALUES 
            ('$title', '$author', '$coAuthor', '$coAuthor2', 'Bidding','$fileName')";
            try{
                mysqli_query($conn , $sql);
                mysqli_close($conn);
                return "Paper successfully uploaded";
            }catch(Exception $ex){
                return mysqli_error($conn);
            }
        }

        function deleteFileInUploads($paperID){
            include '../dbConnect.php';
            $sql = "SELECT FileName FROM paper WHERE PaperID = '$paperID'";
            try{
                $result = mysqli_query($conn, $sql);
                if($result){
                    $deleteFileName = mysqli_fetch_assoc($result);
                    $status = unlink('../Uploads./' . $deleteFileName['FileName']);
                    if($status){
                        return true;
                    }
                    else{
                        return false;
                    }
                }
            }catch(Exception $ex){
                return false;
            }
        }

        function editPaper($paperID, $title, $coAuthor, $coAuthor2, $File){
            include'../dbConnect.php';
            if(!empty($File)){
                $fileName = $File['name'];
                $sql = "UPDATE paper SET FileName = '$fileName' WHERE PaperID = '$paperID'";
                try{
                    mysqli_query($conn, $sql);
                }catch(Exception $ex){
                    mysqli_close($conn);
                    return "Error in updating the filename";
                }
            }
            if($title){
                $sql = "UPDATE paper SET Title = '$title' WHERE PaperID = '$paperID'";
                try{
                    mysqli_query($conn, $sql);
                }catch(Exception $ex){
                    mysqli_close($conn);
                    return "Error in updating the title";
                }
            }
            if($coAuthor){
                $sql = "UPDATE paper SET CoAuthor = '$coAuthor' WHERE PaperID = '$paperID'";
                try{
                    mysqli_query($conn, $sql);
                }catch(Exception $ex){
                    mysqli_close($conn);
                    return "Error in updating the CoAuthor name";
                }
            }
            if($coAuthor2){
                $sql = "UPDATE paper SET CoAuthor2 = '$coAuthor2' WHERE PaperID = '$paperID'";
                try{
                    mysqli_query($conn, $sql);
                }catch(Exception $ex){
                    mysqli_close($conn);
                    return "Error in updating the second Co Author name";
                }
            }
            mysqli_close($conn);
            return "Update is successful";
        }

    }
?>