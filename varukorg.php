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

body {
  font-family: Arial;
  font-size: 14px;
  padding: 8px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: peru;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #4CAF50;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}


hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
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
  <header class="w3-container ">

    <p class="w3-left w3-xlarge">Basket</p>
    <p class="w3-right">
    <a href="varukorg.php">
      <i class="fa fa-shopping-cart w3-margin-right w3-xlarge"></i>
    </a>
    </p>
  </header>



<table>
<tr>
  <tH>Product</th>

  <tH>Description</th>
  <tH>Price</th>
  <th>Rating</th>
  <th>Picture</th>
</tr>


  <!-- Product grid -->
  <?php
  if($_GET['pnr']){
    $message = "Uh Oh, the product has run out D:";
    echo "<script type='text/javascript'>alert('$message');</script>";
  }

    $k = $_COOKIE['user'];
    $sql = "SELECT * FROM Varukorg,Produkt WHERE Varukorg.Kundnr=$k AND Varukorg.Produktnr=Produkt.Produktnr ";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) { ?>
    
      <tr>
        <td> <a href="product.php?pnr=<?php echo $row['Produktnr']?>"> <?php echo $row["Produktnamn"]?> </a> </td>
        <td> <?php echo $row["Beskrivning"]?> </td>
        <td> <?php echo $row["Pris"]?> </td>
        <td> <?php echo $row["AvrRating"]?> </td>
        <td> <img src="<?php echo $row['imgurl']?>" style='width:200px;height:150px'> </td>
        <!-- REMOVE FROM CART -->
        <td> <button onclick="document.location='removeFromCart.php?pnr=<?php echo $row['Produktnr']?>'"> Remove from cart</button></td>
    </tr>
    
    <?php
    }
    ?>
    </table>
    <!-- räkna ut summa och antal-->
    <?php
      $sql = "SELECT SUM(Produkt.Pris) as Summa, COUNT(*) as Antal FROM Varukorg, Produkt WHERE Varukorg.Kundnr = '$k' AND Varukorg.Produktnr = Produkt.Produktnr";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
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
    $conn->close();

  ?>
</table>

</div>


<div class="row">
  <div style="margin-left:300px;margin-top:200px; "class="col-75">
    <div class="container">
      <form action="/checkout.php" method="post">
      
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="john@example.com">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="New York">
            <label for="zip">Zip</label>
            <input type="text" id="zip" name="zip" placeholder="10001">
          </div>
        </div>
          
    </div>
        
        <input type="submit" value="Continue to checkout" class="btn">
      </form>
  </div>

  
</div>

</body>
</html>