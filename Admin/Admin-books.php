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

<?php
require_once "../Authentication_&_Authorization/config.php";

$submit = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $name = $_POST['books_name'];
     $category = $_POST['books_category'];
     $pdf=$_FILES['pdf']['name'];
     $img=$_FILES['image']['name'];
     $pdf_type=$_FILES['pdf']['type'];
     $pdf_size=$_FILES['pdf']['size'];
     $pdf_tem_loc=$_FILES['pdf']['tmp_name'];
     $img_tem_loc=$_FILES['image']['tmp_name'];
     $pdf_store="../data/books/".$pdf;
     $img_store="../data/books_images/".$img;

     echo $pdf_tem_loc;
     echo "<br>";
     echo $img_tem_loc;

     move_uploaded_file($pdf_tem_loc,$pdf_store);
     move_uploaded_file($img_tem_loc,$img_store);
     $sql = "INSERT INTO `e-book`.`books` (`name`, `category`, `pdf_name`, `date_time`,`book_img`) VALUES ('$name', '$category', '$pdf', current_timestamp(), '$img');";

    

     if($conn -> query($sql)){
          $submit = "Submit Successfull!";
        }
        else{
          $submit = "Error : $sql <br> $con->error";
        }
        
        // Close the database conection
        $conn->close();    

header("Refresh:0");
}
?>


<!-- Books Form -->
<section class="container my-5 py-5">
 <center> <a href="./Admin-login.php" class="btn btn-secondary">Add Playlist</a> </center>

<h1 class="h3 mb-3 fw-normal text-center">Books Upload</h1>
<h5 class="h6 mb-3 fw-normal text-center"><?php echo $submit ?></h5>

<form action="./Admin-books.php" method="post" enctype="multipart/form-data">
<div class="mx-5 px-5 py-1">
  <label for="exampleFormControlInput1" class="form-label">Enter Book Name</label>
  <input type="text" name="books_name" class="form-control" id="exampleFormControlInput1" required>
</div>
<div class="mx-5 px-5 py-1">
  <label for="exampleFormControlInput1" class="form-label">Enter Book Category</label>
  <input type="text" name="books_category" class="form-control" id="exampleFormControlInput1" required>
</div>
<div class="mx-5 px-5 py-1">
  <label for="formFile" class="form-label">Books input</label>
  <input class="form-control" type="file" name="pdf" id="formFile" accept="application/pdf" required/>
</div>
<div class="mx-5 px-5 py-1 my-2">
  <label for="formFile" class="form-label">Books Images input example</label>
  <input class="form-control" type="file" name="image" id="formFile" accept="image/png, image/gif, image/jpeg" required/>
</div>
<div class="mx-5 px-5 py-3">
<input type="submit" class="btn btn-primary mx-auto" value="submit">
</div>
     </form>
</section>


<!-- Books Table Section --> 
<section class="container my-5">
<table class="table table-striped mb-5">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      <th scope="col">Category</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>

<?php
require_once "../Authentication_&_Authorization/config.php";

$sql = "SELECT id, name, category FROM books";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
     echo '<tr>
      <th scope="row">'.$row["id"].'</th>
      <td>'. $row["name"].'</td>
      <td>'. $row["category"].'</td>
      <td><a href="./Admin-book-delete.php?id='.$row["id"].'" class="btn btn-danger">Delete</a></td>
      
      </tr>';


  }
} 
$conn->close();

?>
    
  </tbody>
</table>

</section>


