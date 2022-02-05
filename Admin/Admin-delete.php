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

<?php

require_once "../Authentication_&_Authorization/config.php";

$url = $_SERVER['REQUEST_URI'];
$components = parse_url($url);
parse_str($components['query'], $results);
$id =  $results['id'];

// sql to delete a record
$sql = "DELETE FROM playlist WHERE id= $id";

if ($conn->query($sql) === TRUE) {
     header("location:./Admin-login.php");
} else {
     header("location:./Admin-login.php");
}

$conn->close();


?>

