<!DOCTYPE html>
<html>
<body>

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


  <!-- Product grid -->
  <?php
    $sql = "SELECT * FROM Produkt";
    $result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "id: " . $row["Pris"]. " - Name: " . $row["Productname"]. " " . $row["AvrRating"]. "<br>";
    
} else {
  echo "fuck off";
}
    
    ?>
    <?php
    
    $conn->close();
  ?>


</body>
</html>