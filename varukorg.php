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
    <a href="rocks.php" target="_blank" class="w3-bar-item w3-button">Rocks</a>
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
    <p class="w3-left">Varukorg</p>
    <p class="w3-right">
    <a href="varukorg.php">
      <i class="fa fa-shopping-cart w3-margin-right w3-xlarge"></i>
    </a>
      <i class="fa fa-search"></i>
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
    $k = $_COOKIE['user'];
    $sql = "SELECT * FROM Varukorg,Produkt WHERE Varukorg.Kundnr=$k AND Varukorg.Produktnr=Produkt.Produktnr ";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) { ?>
    
      <tr>
        <td> <?php echo $row["Produktnamn"]?> </td>
        <td> <?php echo $row["Beskrivning"]?> </td>
        <td> <?php echo $row["Pris"]?> </td>
        <td> <?php echo $row["AvrRating"]?> </td>
        <td> <img src="<?php echo $row['imgurl']?>" style='width:200px;height:150px'> </td>
    </tr>
    
    <?php
    }
    $conn->close();

  ?>
</table>

</div>

</body>
</html>