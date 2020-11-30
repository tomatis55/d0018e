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
    die("Connection failed: " . mysqli_connect_error());
}

$produktnr = $_GET['pnr'];
$amount = $_GET['amount'];
$target = $_GET['target'];


$sql ="UPDATE `Produkt` SET Antal= Antal-$amount WHERE Produktnr=$produktnr";
$result = $conn->query($sql);



$conn->close();


header("Location:/$target?&pnr=$produktnr");



?>


<html>
<body>



</body>
</html>