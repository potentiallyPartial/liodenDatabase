<!DOCTYPE html>

<html>
<body>

this is the base you input: <?php echo $_POST["base"] ?>

<?php 
$servername = "dragonsDen";
$username = "Tiamat";
$password = "5he@ds";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>

</body>
</html>