<!DOCTYPE html>
<?php

if($_COOKIE["user"] == '0'){?>
  <style>
    body{background-color:#659DBD}

  </style>
<?php
}else{?>
  <style>
    body{background-color:#228B22}
  </style>
<?php
}
?>
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
<title>ROCKS&GUNS</title>
<meta charset="UTF-8">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  .w3-sidebar a{ font-family: "Roboto"}
  h1,h2,h3,h4,h5,h6,.w3-container{font-family: "Montserrat", sans-serif}
  th, td {padding: 15px;}
  </style>
<body class="w3-content" style="max-width:1200px" >

<!--Sidebar/menu-->
<nav class="w3-sidebar w3-bar-block w3-collapse w3-top" style="z-index:3;width:250px; background-color:peru" id="mySidebar">
  <div class="w3-container w3-display-container w3-padding-16" style="font-weight:bold;background-color:peru">
    <h3 class="w3-wide">
    	<b><a href="index.php" target="_self" class="w3-bar-item w3-button">ROCKS & GUNS</a>
    </h3>
  </div>
  <div class="w3-padding-64 w3-large" style="font-weight:bold;background-color:peru">
    <a href="rocks.php" target="_self" class="w3-bar-item w3-button">Rocks</a>
    <a href="guns.php" target="_self" class="w3-bar-item w3-button">Guns</a>
    <?php
      if ($_COOKIE['user'] == '0'){?>
        <a href="admin.php" target="_self" class="w3-bar-item w3-button">Admin</a>

    
    <?php    
      }
    ?>
  </div>
</nav>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:250px" >

  <!-- Top header -->
  <header class="w3-container w3-xlarge">
    <p class="w3-left">Your order</p>
    <p class="w3-right">
    <a href="shoppingCart.php">
      <i class="fa fa-shopping-cart w3-margin-right w3-xlarge"></i>
    </a>
    </p>
  </header>

<table>
<tr>
  <tH>PRODUKTNAMN</th>

  <tH>BESKRIVNING</th>
  <tH>PRIS</th>
  <th>BETYG</th>
  <th>BILD</th>
</tr>


  <!-- Product grid -->
  <?php
    $conn->query("START TRANSACTION");

    $k = $_COOKIE['user'];
    $sql = "SELECT * FROM Varukorg,Produkt WHERE Varukorg.Kundnr=$k AND Varukorg.Produktnr=Produkt.Produktnr ";
    $result1 = $conn->query($sql);
    while($row = $result1->fetch_assoc()) { ?>
    
      <tr>
        <td> <?php echo $row["Produktnamn"]?> </td>
        <td> <?php echo $row["Beskrivning"]?> </td>
        <td> <?php echo $row["Pris"]?> </td>
        <td> <?php echo $row["AvrRating"]?> </td>
        <td> <img src="<?php echo $row['imgurl']?>" style='width:200px;height:150px'> </td>
    </tr>
    
    <?php
    }
  ?>



</table>
<!-- räkna ut summa och antal-->
<?php
      $sql = "SELECT SUM(Produkt.Pris) as Summa, COUNT(*) as Antal FROM Varukorg, Produkt WHERE Varukorg.Kundnr = '$k' AND Varukorg.Produktnr = Produkt.Produktnr";
      $result2 = $conn->query($sql);
      $row = $result2->fetch_assoc();
      $sum = $row['Summa'];
      $count = $row['Antal']
    ?>

    <table style=width:100%>
    <tr>
      <td> Number of Products: </td>
      <td> <?php echo $count?> </td>
      <td> Total Price: </td>
      <td> <?php echo $sum?> kr</td>
    </tr>


    <?php
    

  ?>
</table>

</div>




<?php 



$adress = $_POST['address'];
$postnr = $_POST['zip'];
$ort = $_POST['city'];
$email = $_POST['email'];
$name = $_POST['firstname'];
$sql ="INSERT INTO `Beställning`(`KundNr`, `Summa`, `Adress`, `Postnr`, `Postort`, `Email`, `Namn`) VALUES ('$k', '$sum', '$adress', '$postnr', '$ort', '$email', '$name')";
echo "<script type='text/javascript'>alert('$sql');location.replace('index.php');</script>";
$result3 = $conn->query($sql);

if(!$result3){
  echo "<script type='text/javascript'>alert('$sql');location.replace('index.php');</script>";
  
}

$sql = "SELECT Ordernr FROM Beställning ORDER BY Ordernr DESC LIMIT 1";
$result4 = $conn->query($sql);
$x = $result4->fetch_assoc();

$sql = "SELECT * FROM Varukorg,Produkt WHERE Varukorg.Kundnr=$k AND Varukorg.Produktnr=Produkt.Produktnr ";

$result5 = $conn->query($sql);

$result6 = TRUE;
while($row = $result5->fetch_assoc()) {
  if($result6){
    $sql = "INSERT INTO `Beställningar`(`OrderNr`, `ProduktNr`) VALUES ($x[Ordernr],$row[Produktnr])";
    $result6 = $conn->query($sql);
  }
}

// empty shopping basket

$sql = "DELETE FROM `Varukorg` WHERE kundnr= $k";
$result7 = $conn->query($sql);

if(!$result1){
  $message = "result1";
  echo "<script type='text/javascript'>alert('$message');location.replace('index.php');</script>";
}
if(!$result2){
  $message = "result2";
  echo "<script type='text/javascript'>alert('$message');location.replace('index.php');</script>";
}
if(!$result3){
  $message = "result3";
  echo "<script type='text/javascript'>alert('$message');location.replace('index.php');</script>";
}

if(!$result4){
  $message = "result4";
  echo "<script type='text/javascript'>alert('$message');location.replace('index.php');</script>";
}
if(!$result5){
  $message = "result5";
  echo "<script type='text/javascript'>alert('$message');location.replace('index.php');</script>";
}
if(!$result6){
  $message = "result6";
  echo "<script type='text/javascript'>alert('$message');location.replace('index.php');</script>";
}
if(!$result7){
  $message = "result7";
  echo "<script type='text/javascript'>alert('$message');location.replace('index.php');</script>";
}


if ($result1 && $result2 && $result3 && $result4 && $result5 && $result6 && $result7){
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

?>


</body>
</html>