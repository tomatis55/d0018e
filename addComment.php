<!DOCTYPE html>
<?php
    $servername = "utbweb.its.ltu.se";
    $username = "990815";
    $password = "990815";
    $dbname = "db990815";
    
    // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if (!$conn) {
      echo "CONNECTION FAILED";
      die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully<br>";
    
    // Lägg till kommentar och raitng i kommentarertabellen i databasen
$user = $_COOKIE['user'];
$productnr = $_GET['pnr'];
$comment = $_POST['comment'];
$userRating = $_POST['rating'];


$sql = "INSERT INTO Kommentarer (Kundnr, Produktnr,Kommentar, UserRating) VALUES ('$user', '$productnr','$comment','$userRating')";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully". "<br>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


// uppdatera avrRating i produkttabllen
// gräv upp alla ratings för produkten
$sql = "SELECT SUM(UserRating) as Summa, COUNT(*) as Antal FROM Kommentarer WHERE Produktnr = $productnr";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// räkna ut average
$Antal = $row['Antal'];
$Summa = $row['Summa'];
$NewAverage = $Summa / $Antal;

// sätt in nya AvrRating
$sql = "UPDATE Produkt SET AvrRating=$NewAverage WHERE ProduktNr = $productnr";
$conn->query($sql);

// Close connection
$conn->close();
header("Location:/product.php?pnr=$productnr")
?>