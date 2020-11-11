<!DOCTYPE html>
<?php
  $cookie_name = "user";
  if(isset($_COOKIE[$cookie_name]) == FALSE){
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
  
    //$sql = "SELECT MAX(Kundnr) FROM Kunder";
    $sql = "INSERT INTO Kunder() VALUES()";
    $result = $conn->query($sql);
    $last_id = $conn->insert_id;
    //echo $last_id;
    
    //$x = $result->fetch_assoc();
    echo $last_id;
    //$x = $result["Kundnr"];
    
    $cookie_value = $x[0];
    setcookie($cookie_name, $cookie_value, time() + (86400), "/"); // 86400 = 1 day
  
    $conn->close();
  }else{
    echo "Jag är här <br>";
  }
  
?>
<html>
<body>

<?php
echo "Hello world!<br>";
echo $_COOKIE[$cookie_name];
?>

</body>
</html>