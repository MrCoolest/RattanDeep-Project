<?php
// This File is for Database Configration


define('DB_SERVER','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','e-book');

//Try Coonectiog to the Database

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

//Check the Connection
if($conn == false){
     dir("Error : Cannot Connect to the Server!");
}

?>