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
<nav class="w3-sidebar w3-bar-block w3-collapse w3-top" style="z-index:0;width:250px; background-color:peru" id="mySidebar">
  <div class="w3-container w3-display-container w3-padding-16" style="font-weight:bold;background-color:peru">
    <h3 class="w3-wide">
    	<b><a href="index.php" target="_self" class="w3-bar-item w3-button">ROCKS & GUNS</a>
    </h3>
  </div>
  <div class="w3-padding-64 w3-large" style="background-color:peru">
    <a href="https://www.google.com/search?q=rocks&sxsrf=ALeKk02CCiTNfyj9Pb2nFmnbUhHib7Ba6Q:1604929023005&source=lnms&tbm=isch&sa=X&ved=2ahUKEwj_8LjCyvXsAhVumIsKHQn7BDEQ_AUoAXoECBIQAw&biw=1411&bih=728&dpr=1.82" target="_blank" class="w3-bar-item w3-button">Rocks</a>
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
    <p class="w3-left">Rocks</p>
    <p class="w3-right">
    <a href="varukorg.php">
      <i class="fa fa-shopping-cart w3-margin-right w3-xlarge"></i>
    </a>
      <i class="fa fa-search"></i>
    </p>
  </header>

<table>
<tr>
  <tH>Product</th>
  <tH>Price</th>
  <tH>Stock</th>
  <th>Rating</th>
  <th>Picture</th>
</tr>


  <!-- Product grid -->
  <?php
  
    $sql = "SELECT * FROM `Produkt` WHERE Produkt.Kategori='rock'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) { ?>
    
      <tr>
        <td> <a href="product.php?pnr=<?php echo $row['Produktnr']?>"> <?php echo $row["Produktnamn"]?> </a> </td>
        <td> <?php echo $row["Pris"]?> kr</td>
        <td> <?php echo $row["Antal"]?> </td>
        <td> <?php echo $row["AvrRating"]?>/5*</td>
        <td> <img src="<?php echo $row['imgurl']?>" style='width:200px;height:150px'> </td>
        <?php
        if ($row["Antal"] < 1){?>
          <td> <button type="button" disabled>Add to cart</button></td>

        <?php
        }else{?>
          <td> <button onclick="document.location='removeFromStock.php?pnr=<?php echo $row['Produktnr']?>&target=addToCart.php&amount=1'"> Add to cart</button></td>
        <?php  
        }
        ?>

        

        <!-- REMOVE PRODUCT BUTTON FOR ADMIN ONLY!!-->
        <?php
          if($_COOKIE["user"] == '0'){?>
           <td> <button  onclick="document.location='removeitem.php?pnr=<?php echo $row['Produktnr']?>'" style= "background-color:#cc0000"> REMOVE PRODUCT</button></td>

            

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