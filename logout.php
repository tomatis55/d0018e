<!DOCTYPE html>

<html>
<body>


<?php
 setcookie('user', "", time() - 3600, "/");
 header("Location:/index.php");
?>
</body>
</html>