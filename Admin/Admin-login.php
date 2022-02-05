<?php include 'C:\xampp\htdocs\rd_proj\base_\links.php' ?>


<?php include '../base_/main.php' ?>



<?php
     $json = file_get_contents('../Json/context.json');

     //Decode JSON
     $json_data = json_decode($json,true);
     // print_r($json_data["context"]["Username"]);

$username = trim($json_data["context"]["Admin"]);


if(isset($_SESSION['username']) && !$_SESSION['username'] === $username){
    header("location:../Authentication_&_Authorization/login.php");
    exit;
}

?>


<div class="my-5 py-5">
  <label for="exampleFormControlInput1" class="form-label">Email address</label>
  <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>




<?php 
// include '../base_/footer.php' 

?>
