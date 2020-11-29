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

    $row = $result->fetch_assoc();
    echo "id: " . $row["Pris"]. " - Name: " . $row["Produktnamn"]. " AvrRating: " . $row["AvrRating"]. "<br>";
    

    echo "2";

    $sql = "SELECT * FROM Varukorg";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    echo $row['produktnr'];
    
    
    $conn->close();
  ?>


</body>
</html>