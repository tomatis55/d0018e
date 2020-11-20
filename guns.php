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
<title>W3.CSS Template</title>
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
    <a href="https://www.google.com/search?q=guns&tbm=isch&ved=2ahUKEwjO_trSyvXsAhXPBXcKHSeHAngQ2-cCegQIABAA&oq=guns&gs_lcp=CgNpbWcQAzIFCAAQsQMyBQgAELEDMgIIADICCAAyAggAMgIIADICCAAyAggAMgIIADICCAA6BAgjECc6BAgAEEM6BwgAELEDEENQyiZY2ypgoC1oAHAAeACAAVOIAaUCkgEBNJgBAKABAaoBC2d3cy13aXotaW1nwAEB&sclient=img&ei=IUapX47qBs-L3AOnjorABw&bih=728&biw=1411" target="_blank" class="w3-bar-item w3-button">Guns</a>
    <?php
      if ($_COOKIE['user'] == '0'){?>
        <a href="admin.php" target="_self" class="w3-bar-item w3-button">Admin</a>

    
    <?php    
      }
    ?>
   </div>
</nav>

<!-- Top menu on small screens 
<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
  <div class="w3-bar-item w3-padding-24 w3-wide">LOGO</div>
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidebar on small screens 
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:250px" >

  <!-- Push down content on small screens
  <div class="w3-hide-large" style="margin-top:83px"></div>
  
  <!-- Top header -->
  <header class="w3-container w3-xlarge">
    <p class="w3-left">Guns</p>
    <p class="w3-right">
    <a href="varukorg.php">
      <i class="fa fa-shopping-cart w3-margin-right w3-xlarge"></i>
    </a>
      <i class="fa fa-search"></i>
    </p>
  </header>

  <!-- Image header -->
<!--div class="w3-display-container w3-container">
    <img src="/w3images/jeans.jpg" alt="Jeans" style="width:100%">
    <div class="w3-display-topleft w3-text-white" style="padding:24px 48px">
      <h1 class="w3-jumbo w3-hide-small">New arrivals</h1>
      <h1 class="w3-hide-large w3-hide-medium">New arrivals</h1>
      <h1 class="w3-hide-small">COLLECTION 2016</h1>
      <p><a href="#jeans" class="w3-button w3-black w3-padding-large w3-large">SHOP NOW</a></p>
    </div>
  </div>-->

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
  
    $sql = "SELECT * FROM `Produkt` WHERE Produkt.Kategori='gun'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) { ?>
    
      <tr>
        <td> <?php echo $row["Produktnamn"]?> </td>
        <td> <?php echo $row["Beskrivning"]?> </td>
        <td> <?php echo $row["Pris"]?> </td>
        <td> <?php echo $row["AvrRating"]?> </td>
        <td> <img src="<?php echo $row['imgurl']?>" style='width:200px;height:150px'> </td>
        <td> <button onclick="document.location='addToCart.php?pnr=<?php echo $row['Produktnr']?>'"> Add to cart</button></td>

        <!-- REMOVE PRODUCT BUTTON FOR ADMIN ONLY!!-->
        <?php
          if($_COOKIE["user"] == '0'){?>
            <td> <button onclick="document.location='removeitem.php?pnr=<?php echo $row['Produktnr']?>'" style= "background-color:#cc0000"> REMOVE PRODUCT</button></td>
          <?php
          }?>

    </tr>
    
    <?php
    }
    $conn->close();

  ?>
</table>
 
</div>

</body>
</html>
