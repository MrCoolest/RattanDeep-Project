<?php include 'C:\xampp\htdocs\rd_proj\base_\links.php' ?>

<?php include '../base_/main.php' ?>





<?php
     if(!(isset($_SESSION['loggedin'])) && $_SESSION['loggedin'] != true){

     header("location: ../index.php");
}

?>


<!-- Dispaly videos links -->
<section class="container m-5 p-5">
<?php
require_once "../Authentication_&_Authorization/config.php";

$sql = "SELECT id, name, link, category FROM playlist";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
     echo '<div class="card">
     <div class="card-body">
     <h5 class="card-title">'.$row["name"].'</h5>
     <h6 class="card-subtitle mb-2 text-muted">'.$row["category"].'</h6>
     <a href="'.$row["link"].'" target="_blank" class="card-link">View</a>
     </div>
     </div>';

    // echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["link"]. "<br>";

     }
} 
$conn->close();

?>

</section>







<?php //include '../base_/footer.php' ?>
