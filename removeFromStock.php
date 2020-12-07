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


$target = $_GET['target'];

if($_COOKIE["user"] == '0'){
    if($target == "addToCart.php"){
        $produktnr = $_GET['pnr'];
        $amount = $_GET['amount'];
    }else{
        $amount = -$_POST['amount'];
        $produktnr = $_POST['pnr'];
    }
}else{
    $produktnr = $_GET['pnr'];
    $amount = $_GET['amount'];
}

$conn->autocommit(FALSE);

$sql ="SELECT `Antal` FROM `Produkt` WHERE Produktnr=$produktnr";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if($amount > $row['Antal']){
    $sql ="UPDATE `Produkt` SET Antal=0 WHERE Produktnr=$produktnr";
    $result = $conn->query($sql);

}else{
    $sql ="UPDATE `Produkt` SET Antal= Antal-$amount WHERE Produktnr=$produktnr";
    $result = $conn->query($sql);
}


if (!$conn->commit()){
    $message = "Error, try again";
    $conn->rollback();
    $conn->close();
    echo "<script type='text/javascript'>alert('$message');location.replace('index.php');</script>";
}



$conn->close();


if ($_COOKIE["user"] == '0'){
    if($target=='addToCart.php'){
        header("Location:/$target?&pnr=$produktnr");
    }else{
        header("Location:/$target");
    }
}else{
    header("Location:/$target?&pnr=$produktnr");
}




?>


<html>
<body>



</body>
</html>