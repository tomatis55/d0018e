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

$conn->query("START TRANSACTION");

$sql ="SELECT `Antal` FROM `Produkt` WHERE Produktnr=$produktnr";
$result1 = $conn->query($sql);
$row = $result1->fetch_assoc();

echo "test1<br>";

if ($row['Antal'] == 0 && $target == "addToCart.php") {
    $target = "shoppingCart.php";
}

if($amount > $row['Antal']){
    $sql ="UPDATE `Produkt` SET Antal=0 WHERE Produktnr=$produktnr";
    $result2 = $conn->query($sql);
    echo "test2<br>";

}else{
    $sql ="UPDATE `Produkt` SET Antal= Antal-$amount WHERE Produktnr=$produktnr";
    $result3 = $conn->query($sql);
    echo "test3<br>";
}



if (($result1 && $result2 && !$result3) || ($result1 && !$result2 && $result3)){
    echo "Commit";
    $conn->query("COMMIT");
    $conn->close();
} else {
    echo "error";
    $message = "Error, try again";
    $conn->query("ROLLBACK");
    $conn->close();
    echo "<script type='text/javascript'>alert('$message');location.replace('index.php');</script>";
}



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