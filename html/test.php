<!DOCTYPE html>

<html>
<body>

<?php

$mysqli = new mysqli("localhost","Tiamat","5he@ds","lioden");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

else{
  echo "connected";
}

$usrInput = $_POST["base"];
$bseType

?> 

the base you submited is: <?php echo "$usrInput" ?> <br>
this base is a: <?php echo "$bseType" ?>
</body>
</html>