<?php include 'C:\xampp\htdocs\rd_proj\base_\links.php' ?>


<?php include '../base_/main.php' ?>

<?php 
//include './Admin_authentication.php' ?>



<?php
     $json = file_get_contents('../Json/context.json');

     //Decode JSON
     $json_data = json_decode($json,true);
     

$username = trim($json_data["context"]["Admin"]);
//echo $username;

if(isset($_SESSION['username']) && $_SESSION['username'] !== $username){
      header("location:../Authentication_&_Authorization/login.php");
      exit;
}

?>

<?php require_once "../Authentication_&_Authorization/config.php";
 
$submit = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
     $name = $_POST['playlist_name'];
     $link = $_POST['playlist_link'];
     $category = $_POST['playlist_category'];
     $sql = "INSERT INTO `e-book`.`playlist` (`name`, `link`, `category`, `date_time`) VALUES ('$name', '$link', '$category', current_timestamp());";


if($conn -> query($sql)){
  
  $submit = true; 
}
else{
  echo "Error : $sql <br> $con->error";
}

// Close the database conection
$conn->close();  

$name = $link = $category = $sql = "";
header("Refresh:0");
}
?>


<!-- Youtube form link -->
<section class="container my-5 py-5">
 <center> <a href="./Admin-books.php" class="btn btn-secondary">Add Books</a> </center>
<h1 class="h3 mb-3 fw-normal text-center">Youtube link</h1>
<form action="./Admin-login.php" method="post">
<div class="mx-5 px-5 py-1">
  <label for="exampleFormControlInput1" class="form-label">Enter Name</label>
  <input type="text" name="playlist_name" class="form-control" id="exampleFormControlInput1" required>
</div>
<div class="mx-5 px-5 py-1">
  <label for="exampleFormControlInput1" class="form-label">Paste link</label>
  <input type="text" name="playlist_link" class="form-control" id="exampleFormControlInput1" required>
</div>

<div class="mx-5 px-5 py-3">
<select class="form-select" name="playlist_category" aria-label="Default select example">
  <option selected disabled>Select Cartegory</option>
  <option value="Computer Networking">Computer Networking</option>
  <option value="BlockChain">BlockChain</option>
  <option value="Accounts">Accounts</option>
  <option value="Managements">Managements</option>
  <option value="Programming">Pogramming</option>
</select>
</div>
<div class="mx-5 px-5 py-3">
<input type="submit" class="btn btn-primary mx-auto" value="submit">
</div>
</form>

</section>




<!-- Video Table Section -->
<section class="container my-5">
<table class="table table-striped mb-5">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      <th scope="col">Link</th>
      <th scope="col">Category</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>

<?php
require_once "../Authentication_&_Authorization/config.php";

$sql = "SELECT id, name, link, category FROM playlist";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
     echo '<tr>
      <th scope="row">'.$row["id"].'</th>
      <td>'. $row["name"].'</td>
      <td>'. $row["link"].'</td>
      <td>'. $row["category"].'</td>
      <td><a href="./Admin-video-delete.php?id='.$row["id"].'" class="btn btn-danger">Delete</a></td>
      
      </tr>';


  }
} 
$conn->close();

?>
    
  </tbody>
</table>

</section>

<?php 
// include '../base_/footer.php' 

?>
