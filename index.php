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
if(!isset($_COOKIE['user'])){
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

    $sql = "SELECT * FROM Kunder ORDER BY Kundnr DESC LIMIT 1";
    $result = $conn->query($sql);
    $x = $result->fetch_assoc();


    $cookie_name = "user";
    $cookie_value = $x[Kundnr];
    setcookie($cookie_name, $cookie_value, time() + (86400*30), "/"); // 86400 = 1 day

    $sql = "INSERT INTO `Kunder`() VALUES ()";
    $result = $conn->query($sql);
        
    $conn->close();

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
      <i class="fa fa-search w3-xlarge"></i>
    </p>
  
  <div class="w3-margin-top">
 	<form action="login.php" method="post">
		  <label for="uname"><b>Username</b></label>
    	<input type="text" placeholder="Enter Username" name="uname" required>
    	<label for="psw"><b>Password</b></label>
    	<input type="password" placeholder="Enter Password" name="psw" required>
    	<button type="submit">Login</button>
	</form> 
   
  </header>

  <!-- Image header -->
  <div class="w3-display-container w3-container">
    <img src="https://www.w3schools.com/w3images/jeans.jpg" alt="Picture" style="width:100%">
    <div class="w3-display-topleft " style="padding:30px 48px">
      <h1 class="w3-hide-small">Welcome to Rocks & Guns</h1>
      <h1 class="w3-hide-large w3-hide-medium"></h1>
      <h1 class="w3-hide-small"></h1>
    </div>
  </div>

</div>


  <!-- End page content -->
</div>

</body>
</html>
