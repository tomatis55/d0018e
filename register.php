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
?>

<html>
<body>

<?php
    $kundnr = $_COOKIE['user'];
    $username = $_POST['uname'];
    $password = $_POST['psw'];

    
    $conn->query("START TRANSACTION");
    
    $sql = "SELECT `Användarnamn` FROM `Kunder` WHERE Användarnamn='$username'";
    $result1 = $conn->query($sql);
    $row = $result1->fetch_assoc();
    if ($username == $row['Användarnamn']){
        $message = "Username is taken";
        echo "<script type='text/javascript'>alert('$message');location.replace('index.php');</script>";
        
    }else{
    
    
    $sql = "UPDATE `Kunder` SET `Användarnamn`='$username',`Lösenord`='$password' WHERE `Kundnr`=$kundnr";
    $result2 = $conn->query($sql);
    
    
    if (!($result1 && $result2)){
        $message = "Error, try again";
        $conn->query("ROLLBACK");
        $conn->close();
        echo "<script type='text/javascript'>alert('$message');location.replace('index.php');</script>";
    }else{
        $message = "Successfully registered";
        $conn->query("COMMIT");
        $conn->close();
        echo "<script type='text/javascript'>alert('$message');location.replace('index.php');</script>";
    }
    

    }

    

?>



</body>
</html>