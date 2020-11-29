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
td,tr,a,p{font-family: "Montserrat", sans-serif}
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
  <header class="w3-container w3-xlarge">
    <p class="w3-left"></p>
    <p class="w3-right">
    <a href="varukorg.php">
      <i class="fa fa-shopping-cart w3-margin-right w3-xlarge"></i>
    </a>
      <i class="fa fa-search"></i>
    </p>
  </header>

  <?php
  
    $productNr = $_GET['pnr'];
    $sql = "SELECT * FROM Produkt WHERE Produkt.ProduktNr='$productNr'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

  ?>
<div style="padding:25px"> 

 <img style="float: right; width:350px;height:262px" src="<?php echo $row['imgurl']?>">
    <h2 style="text-align:center"> <?php echo $row['Produktnamn']?> </h2>
    <table style="margin-left: auto; margin-right: auto">
      <tr>
        <td>Price: <?php echo $row['Pris'] ?> kr &nbsp&nbsp&nbsp&nbsp </td>
        <td>Stock: <?php echo $row['Antal']?>    &nbsp&nbsp&nbsp&nbsp </td>
        <td>Average Rating: <?php echo $row['AvrRating']?>/5*&nbsp;</td>
      </tr>
    </table>
    <p style="height:150px"><?php echo $row['Beskrivning']?></p>
    <table>
      <tr>
        <td style="width: 300px;"><strong>Comment</strong></td>
        <td style="width: 200px;"><strong>User</strong></td>
        <td style="width: 25px;"><strong>User Rating</strong></td>
      </tr>

    <?php
    $sql = "SELECT * FROM Kommentarer WHERE Kommentarer.ProduktNr='$productNr'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) { ?>
      <tr>
        <td style="width: 300px;"><?php echo $row['Kommentar']?></td>
        <td style="width: 200px;"><?php echo $row['Kundnr']?></td>
        <td style="width: 25px;"><?php echo $row['UserRating']?>/5*</td>
        <?php
          if($_COOKIE["user"] == '0'){?>
            <td> <button onclick="document.location='removeComment.php?knr=<?php echo $row['KommentarNr']?>&pnr=<?php echo $productNr?>'" style= "background-color:#cc0000"> REMOVE COMMENT</button></td>
          <?php
          }?>
      </tr>
    <?php } ?>
    </table>
<br>
    <form method="post" action="/addComment.php?pnr=<?php echo $productNr ?>" >
        <label for="fname">Comment:</label>
        <input type="text" id="comment" name="comment"><br>
        <label for="vol">Rating (between 1 and 5):</label>
        <input type="range" id="rating" name="rating" min="1" max="5"><br>
        <input type="submit" value="Submit Comment">
    </form> 

</div>
  <!-- End page content -->
</div>

</body>
</html>
