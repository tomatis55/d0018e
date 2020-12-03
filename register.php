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

    $conn->autocommit(FALSE);

    $sql = "SELECT `Användarnamn` FROM `Kunder` WHERE Användarnamn='$username'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($username == $row['Användarnamn']){
        $message = "Username is taken";
        echo "<script type='text/javascript'>alert('$message');location.replace('index.php');</script>";
        
    }else{
    
    
    $sql = "UPDATE `Kunder` SET `Användarnamn`='$username',`Lösenord`='$password' WHERE `Kundnr`=$kundnr";
    $result = $conn->query($sql);
    
    if (!$conn->commit()){
        $message = "Error, try again";
        $conn->rollback();
        echo "<script type='text/javascript'>alert('$message');location.replace('index.php');</script>";
        $conn->close();
        
    }else{
        $message = "Successfully registered";
        $conn->close();
        echo "<script type='text/javascript'>alert('$message');location.replace('index.php');</script>";
    }
    

    }

    

?>



</body>
</html>