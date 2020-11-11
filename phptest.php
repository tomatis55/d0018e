<!DOCTYPE html>
<html>
<body>

<?php
echo "Hello world!<br>";
$servername = "utbweb.its.ltu.se";
$username = "990815";
$password = "990815";
$dbname = "db990815";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully<br>";

// Test printing a selection from database
$sql = "SELECT age FROM test WHERE name='oskar'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    //echo "NAMN: " . $row["name"]. " ÅLDER: " . $row["age"]. " HEMSTAD: " . $row["home"]. "<br>";
    echo "age: " . $row["age"]. "<br>";
  }
} else {
  echo "0 results";
}

$conn->close();
?>

</body>
</html>