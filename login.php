<!DOCTYPE html>

<html>
<body>


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

$sql = "SELECT * FROM Kunder WHERE Användarnamn='$_POST[uname]'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_POST[uname] == $row['Användarnamn'] and $_POST[psw]==$row['Lösenord']){
  echo "välkommen";
  echo $row['Kundnr'];

  $cookie_value = $row['Kundnr'];
  setcookie("user", $cookie_value, time() + (86400), "/"); // 86400 = 1 day

  echo $_COOKIE['user'];


  if ($_COOKIE['user'] = 0) {
    header("Location:/admin.php");
  } else {
    header("Location:/index.php");
  }

} else {
  header("Location:/index.php");
}

?>
</body>
</html>