<?php include 'C:\xampp\htdocs\rd_proj\base_\links.php' ?>

<?php
     $json = file_get_contents('../Json/context.json');

     //Decode JSON
     $json_data = json_decode($json,true);
     // print_r($json_data["context"]["Username"]);

$username = trim($json_data["context"]["Admin"]);
//echo $username;

if(isset($_SESSION['username']) && $_SESSION['username'] !== $username){
      header("location:../Authentication_&_Authorization/login.php");
      exit;
}

?>