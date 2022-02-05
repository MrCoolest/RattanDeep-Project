<?php include 'C:\xampp\htdocs\rd_proj\base_\links.php' ?>

<?php
require_once "config.php";

$name = $email = $password = $cnf_password = "";
$name_err = $email_err = $password_err = $cnf_password_err = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){


     // Check if Username is Empty 
     if(empty(trim($_POST['email']))){
          $email_err = "Email Cannot Be Blank";
     }else{
          $sql = "SELECT user_id From sign_up WHERE email = ?";
          $stmt = mysqli_prepare($conn, $sql);
          if($stmt){
               mysqli_stmt_bind_param($stmt,'s',$param_email);

               //set the value of param_email
               $param_email = trim($_POST['email']);

               //Try to execute this statement
               if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) == 1){
                         $email_err = "This Email is Already in Use!";
                    }
                    else{
                         $email = trim($_POST['email']);
                    }
               }else{
                    echo "Something went wrong";
               }
          }
     }
     mysqli_stmt_close($stmt); 
    

if(empty(trim($_POST['name']))){
     $name_err = "Name cannot be blank";
}else{
     $name = trim($_POST['name']);
}

//Check for Password 

if(empty(trim($_POST['password']))){
     $password_err = "Password Cannot be Blank";
}
elseif(strlen(trim($_POST['password']))<6){
     $password_err = "Password Cannot be lessthan 6 characters";
}
else{
     $password = trim($_POST['password']);
}

//Check for confirm Password 

if(trim($_POST['cnf_password']) != trim($_POST['password'])){
     $cnf_password_err = "Password Should match";
}

// if there where no errors, go ahead and insert into the database 
if(empty($email_err) && empty($password_err) && empty($cnf_password_err)){
     $sql = "INSERT INTO sign_up (name,email, password) VALUES(?, ?, ?)";
     $stmt = mysqli_prepare($conn, $sql);
     if($stmt){
          mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_email, $param_password);

          //set these parameters
          $param_name = $name;
          $param_email = $email;
          $param_password = password_hash($password, PASSWORD_DEFAULT);

          // Try to execute the query
          if(mysqli_stmt_execute($stmt)){
               header("location:../index.php");
          }else{
               echo "Something went wrong... cannot redirect!";
          }
     }
     mysqli_stmt_close($stmt);
}
mysqli_close($conn);
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
<form class="mx-3" action="./sign_up.php" method="post">

    <h1 class="h3 mb-3 fw-normal text-center">Sign Up</h1>

      <div class="form-group py-2">
        <label for="name">Enter Name</label>
        <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" required>
      </div>
      <div class="form-group py-2">
        <label for="Email">Email address</label>
        <input type="email" class="form-control" name="email" id="Email" aria-describedby="emailHelp" required>
      </div>
      <div class="form-group py-2">
        <label for="Password">Password</label>
        <input type="password" class="form-control" name="password" id="Password" required>
      </div>
      <div class="form-group py-2">
        <label for="cnf_Password">Confirm Password</label>
        <input type="password" class="form-control" name="cnf_password" id="cnf_Password" required>
      </div>


    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign_up</button>
    
  </form>
</main>




