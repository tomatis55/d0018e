<!DOCTYPE html>

<html>
<body>


<?php
if ($_POST[uname] == "admin" and $_POST[psw]=="admin"){
  header("Location:/admin.php");
} else{
  header("Location:/index.php");
}
?>
</body>
</html>