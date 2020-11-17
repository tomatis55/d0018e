<!DOCTYPE html>


<html>
<title>ROCKS&GUNS</title>
<meta charset="UTF-8">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body{background-color:#228B22}
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
  
 	
  </header>
</div>

<div class="w3-display-container w3-container">
 	<form action="/insert.php" method="post" style="margin-left:250px" enctype="multipart/form-data">
     <label for="name">Product name:</label><br>
      <input type="text" id="name" name="name"><br>
  
      <label for="price">Price:</label><br>
      <input type="number" id="price" name="price"><br>
  
      <label for="description">Description:</label><br>
      <input type="text" id="description" name="description"><br><br>

      <label for="Category">Category:</label>
      <select id="category" name="category">
          <option value="rock">Rock</option>
          <option value="gun">Gun</option></select><br><br>
      
      <label for="Image">Image:</label>
      <input type="file" accept="image/*" name="fileToUpload" id="fileToUpload"><br><br>
      
    	<button type="submit">Submit</button>
	</form> 


</body>
</html>
