<!DOCTYPE html>
<?php

$servername = "utbweb.its.ltu.se";
$username = "990815";
$password = "990815";
$dbname = "db990815";

// Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  echo "CONNECTION FAILED";
  die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully<br>";

$name = $_POST['name'];
$price = $_POST['price'];
$category = $_POST['category'];
$description = $_POST['description'];

// Attempt insert query execution
$sql = "INSERT INTO `Produkt`(`Produktnamn`, `Pris`, `Kategori`, `Beskrivning`, `AvrRating`, `imgurl`) VALUES ('$name', '$price', '$category', '$description' ,'5', '/images/rock.jpg')";

if($conn->query($sql)){
    //echo "Records added successfully.";
} else{
    //echo "ERROR: Could not able to execute $sql. ";
}
 
// Close connection
$conn->close();
header("Location:/admin.php")
?>