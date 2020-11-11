<!DOCTYPE html>
<html>
<body>
<?php

$servername = "utbweb.its.ltu.se";
$username = "991205";
$password = "123456";
$dbname = "db991205";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully <br>";



$sql = "SELECT Längd FROM test1 WHERE Namn='Oskar'";
$result = $conn->query($sql);
$x = $result->fetch_assoc();
echo "Oskars längd: " .$x["Längd"];


$conn->close();
?>
</body>
</html>