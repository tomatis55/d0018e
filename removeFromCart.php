<!DOCTYPE html>
<?php
    echo $_GET['pnr'];

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
    echo "Connected successfully<br>";
    
$user = $_COOKIE['user'];
$productnr = $_GET['pnr'];
$sql = "SELECT * FROM `Varukorg` WHERE kundnr= $user AND Produktnr = $productnr LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows != 0) {

  $sql = "DELETE FROM `Varukorg` WHERE kundnr= $user AND Produktnr = $productnr LIMIT 1";

  if ($conn->query($sql) === TRUE) {
      echo "Record removed successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }


  $sql = "UPDATE `Produkt` SET Antal= Antal+1 WHERE Produktnr=$productnr";
  $conn->query($sql);
}

// Close connection
$conn->close();
header("Location:/shoppingCart.php")
?>