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

if($_GET['id']=='admin'){
    $produktnr = $_POST['produktnr'];
}else{
    $produktnr = $_GET['pnr'];
}


$sql = "SELECT Kategori FROM `Produkt` WHERE Produktnr=$produktnr";
$result = $conn->query($sql);
$x = $result->fetch_assoc();




$sql = "DELETE FROM Varukorg WHERE Produktnr = '$produktnr'";
$result = $conn->query($sql);
$sql = "DELETE FROM Kommentarer WHERE Produktnr = '$produktnr'";
$result = $conn->query($sql);
$sql = "DELETE FROM Produkt WHERE Produktnr = '$produktnr'";
$result = $conn->query($sql);
$conn->close();

if($_GET['id']=='admin'){
    header("Location:/admin.php");
}elseif($x['Kategori']=='rock'){
    header("Location:/rocks.php"); 

}else{
    header("Location:/guns.php"); 
}



/*
if($_POST[id]=='admin'){
    header("Location:/admin.php"); 
}elseif($x[Kategori]=='rocks'){
    header("Location:/rocks.php"); 

}else{
    header("Location:/guns.php");
}
*/
/*
if($x[Kategori]=='rocks'){
    header("Location:/rocks.php"); 

}else{
    header("Location:/guns.php");
}

*/
?>


<html>
<body>



</body>
</html>