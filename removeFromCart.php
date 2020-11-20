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
//$sql = "INSERT INTO Varukorg (kundnr, produktnr) VALUES ('$user', '$productnr')";
$sql = "DELETE FROM `Varukorg` WHERE kundnr= $user AND Produktnr = $productnr LIMIT 1";

if ($conn->query($sql) === TRUE) {
    echo "Record removed successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

// Close connection
$conn->close();
header("Location:/varukorg.php")
?>