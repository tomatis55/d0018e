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
<div class="w3-main" style="margin-left:250px">
  
  <!-- Top header -->
  <header class="w3-container">
   <p class="w3-right">
     <a href="varukorg.php">
      <i class="fa fa-shopping-cart w3-margin-right w3-xlarge"></i>
    </a>
    </p>
  
  <div class="w3-margin-top">

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
 
  $sql = "SELECT * FROM Kunder WHERE Kundnr='$_COOKIE[user]'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

if ($_COOKIE['user'] != $row['Användarnamn']) { ?>   
    <label for="logout">Logged in as <?php echo $row['Användarnamn'];?></label>
    <form action="/logout.php" method="post" name="logout" enctype="multipart/form-data">
    <input type="submit" value="Logout">
<?php
} else {?>
    <p> viewing as visitor</p>
<?php
}
?>

</div>
  <h1> Order history </h1>
<table>
<tr>
  <tH>OrderNr</th>
  <tH>Sum</th>
  <tH>Products</th>
 </tr>



  <?php
    $sql = "SELECT * FROM Beställning WHERE KundNr='$_COOKIE[user]'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) { 
        $orderNr = $row['OrderNr'];
        //$sql2 = "SELECT * FROM Beställningar WHERE OrderNr='$orderNr'";
        $sql2 = "SELECT Beställningar.ProduktNr ,Produkt.Produktnamn
                 FROM Beställningar INNER JOIN Produkt ON Produkt.ProduktNr = Beställningar.ProduktNr
                 WHERE OrderNr='$orderNr'";
        $result2 = $conn->query($sql2);
        ?>
        <tr>  
            <td> <?php echo $row["OrderNr"]?> </td>
            <td> <?php echo $row["Summa"]?> kr </td>
            <td> 
            <?php 
            while($innerRow = $result2->fetch_assoc()) { ?> 
                <a href="product.php?pnr=<?php echo $innerRow['ProduktNr']?>"> <?php echo $innerRow['Produktnamn']?> </a>
            <?php 
            } ?>
            </td>    
    <?php 
    } ?>
    </tr>
    </table>
</div>

</body>
</html>
