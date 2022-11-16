<?php
    class Paper{
        private $paperID;
        private $title;
        private $author;
        private $coauthor;
        private $coauthor2;
        private $reviewed_by;

        private $status;

        public function __construct(){

        }

        function retrievePapers($status, $search){
            include '../dbConnect.php';
            if($status == "viewAll" && empty($search)){
                $sql = 'SELECT * FROM Paper';
            }
            else{
                $sql = "SELECT * FROM Paper WHERE Status = '$status' AND Title LIKE '%$search%'";
            }
            $resultArray = array();
            try{
                $result = mysqli_query($conn , $sql);
                if($result){
                    while($row = mysqli_fetch_assoc($result)){
                        array_push($resultArray, array($row['PaperID'], $row['Title'], $row['Author'], $row['reviewedBy'], $row['Status'], $row['FileName'], $row['Rating'], $row['CoAuthor'], $row['CoAuthor2'], $row['Review']));
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
                $sql = "SELECT * FROM Paper WHERE Author = (SELECT FullName FROM useraccount WHERE userName = '$username') AND (Status = '$status' OR Title LIKE '%$search%')";
            }
            $resultArray = array();
            try{
                $result = mysqli_query($conn , $sql);
                if($result){
                    while($row = mysqli_fetch_assoc($result)){
                        array_push($resultArray, array($row['PaperID'], $row['Title'], $row['Author'], $row['reviewedBy'], $row['Status'], $row['FileName'], $row['Rating'], $row['CoAuthor'], $row['CoAuthor2'], $row['Review']));
                    }
                }
                mysqli_close($conn);
                return $resultArray;
            }catch(Exception $ex){
                return mysqli_error($conn);
            }
        }

        function retrivePaperReviewing($fullName, $search){
            include'../dbConnect.php';
            if(empty($search)){
                $sql = "SELECT * FROM paper WHERE reviewedBy = '$fullName' AND Status = 'Reviewing'";
            }else{
                $sql = "SELECT * FROM paper WHERE reviewedBy = '$fullname' AND Status = 'Reviewing' AND Title LIKE '%$search%'";
            }
            $resultArray = array();
            try{
                $result = mysqli_query($conn , $sql);
                if($result){
                    while($row = mysqli_fetch_assoc($result)){
                        array_push($resultArray, array($row['PaperID'], $row['Title'], $row['Author'], $row['Status'], $row['FileName']));
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

        function deletePaper($paperID){
            include '../dbConnect.php';
            $sql = "DELETE FROM paper WHERE PaperID = '$paperID'";
            try{
                mysqli_query($conn, $sql);
                mysqli_close($conn);
                return "Delete is successful";
            }catch(Exception $ex){
                mysqli_close($conn);
                return "Delete is not successful";
            }
        }

        function reviewPaper($paperID, $rating, $review, $userID){
            include '../dbConnect.php';
            $check = 1;
            $sqlReviewLimit = "SELECT ReviewLimit FROM useraccount WHERE userID = '$userID'";
            $sql = "UPDATE paper SET Rating = '$rating', Review = '$review', Status = 'Pending Approval' WHERE PaperID = '$paperID'";
            $sqlBid = "UPDATE useraccount SET ReviewLimit = (($sqlReviewLimit) - 1) WHERE userID = '$userID'";
            try{
                $result = mysqli_query($conn, $sqlReviewLimit);
                $ReviewLimit = mysqli_fetch_assoc($result);
            }catch(Exception $ex){
                mysqli_close($conn);
                return "The review process is not done and is unsuccessful";
            }
            if ($ReviewLimit['ReviewLimit'] > 0){
                try{
                    mysqli_query($conn, $sql);
                    mysqli_query($conn, $sqlBid);
                    mysqli_close($conn);
                    return "The review process is successful";
                }catch(Exception $ex){
                    mysqli_close($conn);
                    return "The review process is not done and is unsuccessful";
                }
            }
            else{
                return "You have used up your Review Limit";
            }
        }

        function confirmBid($paperID , $fullname){
            include'../dbConnect.php';
            $sql = "UPDATE paper SET reviewedBy = '$fullname', Status = 'Reviewing' WHERE paperID = '$paperID'";
            try{
                mysqli_query($conn, $sql);
                mysqli_close($conn);
                return "Bid is successful";
            }catch(Exception $ex){
                mysqli_close($conn);
                return "Bid is not successful";
            }
        }

        function editRatingReview($paperID, $rating, $review){
            include '../dbConnect.php';
            $sql = "UPDATE paper SET Rating = '$rating', Review = '$review' WHERE PaperID = '$paperID'";
            try{
                mysqli_query($conn, $sql);
                mysqli_close($conn);
                return "Successfully edited ratings and reviews";
            }catch(Exception $ex){
                mysqli_close($conn);
                return "The edit process is unsuccessful";
            }
        }

        function deleteReview($paperID){
            include '../dbConnect.php';
            $sql = "UPDATE paper SET Review = NULL, Status = 'Reviewing' WHERE PaperID = '$paperID'";
            try{
                mysqli_query($conn, $sql);
                mysqli_close($conn);
                return "Successfully deleted the review";
            }catch(Exception $ex){
                mysqli_close($conn);
                return "Unsuccessfully deleted the review";
            }
        }

    }
?>