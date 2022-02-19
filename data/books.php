<?php include 'C:\xampp\htdocs\rd_proj\base_\links.php' ?>

<?php include '../base_/main.php' ?>





<?php
     if(!(isset($_SESSION['loggedin'])) && $_SESSION['loggedin'] != true){

     header("location: ../index.php");
}

?>


<style>
     .card{
          display : inline-block;
          margin : 2rem;
          height : 20rem;
          
     }
     .card img{
          height : 10rem;
     }
</style>

<!-- Dispaly videos links -->
<section class="container m-5 p-5">
<?php
require_once "../Authentication_&_Authorization/config.php";

$sql = "SELECT id, name,category, pdf_name, book_img FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
     echo '<div class="card" style="width: 18rem;">
     <img class="card-img-top" src="./books_images/'.$row["book_img"].'" alt="">
     <div class="card-body">
       <h5 class="card-title" title="'.$row["name"].'">'. substr($row["name"], 0, 15).'...</h5>
       
       <a target="_blank" href="./books/'.$row["pdf_name"].'" class="btn btn-primary">Read</a>
     </div>
   </div>';

//     echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["link"]. "<br>";

     }
} 
$conn->close();

?>

</section>







<?php //include '../base_/footer.php' ?>
