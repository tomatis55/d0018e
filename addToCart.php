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
    
//$sql = "INSERT INTO varukorg(kundnr,produktnr) VALUES ($_COOKIE[user],$_GET[pnr])";

$user = $_COOKIE['user'];
$productnr = $_GET['pnr'];


$sql = "SELECT Antal FROM Produkt WHERE Produktnr='$productnr'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($row['Antal'] >= 0) {
  $sql = "INSERT INTO Varukorg (kundnr, produktnr) VALUES ('$user', '$productnr')";
  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
// Close connection
$conn->close();
header("Location:/varukorg.php")
?>