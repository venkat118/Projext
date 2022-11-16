<?php
    session_start();
    include '../Controller/doCreateAccountController.php';
    if(!empty($_POST)){
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $cpass = $_POST['cpass'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        $createAccountControl = new createAccountController();
        $result = $createAccountControl -> passCreateAccountPara($fullname, $username, $password, $cpass,$email, $role);
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
    }else{
?>
<?php
   
   ?>
   <html>
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
                   Create New Account
               </p>
                   
            <form action="../Boundary/createAccountBoundary.php" method="POST" enctype="multipart/form-data">
                <div class="user-box">
                   <input type="text" name="fullname" id="fullname" placeholder="Full Name" required>  
               </div>

                <div class="user-box">
                   <input type="text" name="username" id="username" placeholder="Username" required>  
               </div>
              
               <div class="user-box">
                  <input type="password" name="password" id="password" placeholder="Password">
               </div>
   
               <div class="user-box">
                   <input type="password" name="cpass" placeholder="Confirm Password" id="cpass">
               </div>
   
               <div class="user-box">
                   <input type="email" name="email" placeholder="Email" id="email"><br><br>
               </div>
              
               <div class="user-box">
                   
                   <p>
                       User Type
                   </p>
   
               <select id="types" name="role" aria-placeholder="User Type">
                   <option value="Conference Chair">
                       Conference Chair
                   </option>
                   <option value="Author">
                       Author
                   </option>
                   <option value="Reviewer">
                       Reviewer
                   </option>
               </select>
               
       </div>
   
               <div class="user-box">
                   <input type="submit" value="Create Account" class="button-28">
               </div>
   
   
              
           </form>
   
           <div class="user-box">
               <input type="button" value="Back" class="button-28">
           </div>
   
       </div>
       </div>
   
       </body>
   </html>
   <?php
       
   ?>
<?php
    }
?>