<?php include 'C:\xampp\htdocs\rd_proj\base_\links.php' ?>

<?php
// This Script is to Handel to Login

// session_start();

// If The user is Already login

if(isset($_SESSION['username'])){
     header("location:/rd_proj/");
     exit;
}
require_once "config.php";

$username = $password = "";
$err = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
     if(empty(trim($_POST["email"])) || empty(trim($_POST["passwd"])) ){
          $err = "Please Enter Email and Password";
     }
     else{
          $username =  trim($_POST["email"]);
          $password =  trim($_POST["passwd"]);
        
     }

     if(empty($err)){
          $sql = "SELECT user_id, name , email, password FROM sign_up WHERE email = ?";
          $stmt = mysqli_prepare($conn, $sql);

          mysqli_stmt_bind_param($stmt, 's', $param_email);
          $param_email = $username;
          if(mysqli_stmt_execute($stmt)){
               mysqli_stmt_store_result($stmt);
               if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_result($stmt, $id, $name ,$email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                         if(password_verify($password, $hashed_password)){
                              //This means the password is correct
                              // session_start();
                              $_SESSION["username"] = $email; 
                              $_SESSION["id"] = $id; 
                              $_SESSION["name"] = $name; 
                              $_SESSION["loggedin"] = true; 

                              //Redirect to user the welcome page
                              header("location:../index.php");
                              
                         } 
                         else{
                              // /header("location:./login.php");
                              $err = "Email-id & Password is not Matching!";
                    }
                    }
               }
               else{
                   // header("location:./login.php");
                   $err = "User is not Registered!";

          }
          }

     }
}

?>
<?php 
include '../base_/main.php' ?>



<Style>
body {
  display: flex;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}

.form-signin .checkbox {
  font-weight: 400;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

    </style>


    
<main class="form-signin my-5">
  <form class="my-5 py-5" action="./login.php" method="post">
 
    <h1 class="h3 mb-3 fw-normal text-center">Login</h1>
    <h5 class="h6 mb-3 fw-normal text-center"><?php echo $err ?></h5>

    <div class="form-floating py-1">
      <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" required>
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating  py-1">
      <input type="password" class="form-control" id="floatingPassword" name="passwd" placeholder="Password" required>
      <label for="floatingPassword">Password</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
    
  </form>
</main>
