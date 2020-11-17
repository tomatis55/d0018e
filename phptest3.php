<!DOCTYPE html>
<?php

if(!isset($_COOKIE['user'])){
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

    $sql = "SELECT * FROM Kunder ORDER BY Kundnr DESC LIMIT 1";
    $result = $conn->query($sql);
    $x = $result->fetch_assoc();


    $cookie_name = "user";
    $cookie_value = $x[Kundnr];
    setcookie($cookie_name, $cookie_value, time() + (86400), "/"); // 86400 = 1 day

    $sql = "INSERT INTO `Kunder`() VALUES ()";
    $result = $conn->query($sql);
        
    $conn->close();

}


?>

<html>
<body>

<?php

echo $_COOKIE['user'];
/*if (isset($_COOKIE) == TRUE){
    echo $_COOKIE[cookie_name];
}*/

?>
</body>
</html>