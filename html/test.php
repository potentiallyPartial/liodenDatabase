<!DOCTYPE html>

<html>
<body>

<?php
// make conection with my sql server
$conn = new mysqli("localhost","Tiamat","5he@ds","lioden");

// Check connection
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}

else{
  //echo "connected";
}
?>

<?php
// get user input from form in index.php
$usrInput = $_POST["base"];

//prepare statment to get bse id / type
$stmt = $conn->prepare("Select bse_id, bse_type from bases where bse_name=?");
$stmt->bind_param("s", $usrInput);

//run the statment / bind vars / get vars
 $stmt->execute();
 $stmt->bind_result($bseId, $bseType);

 $stmt->fetch();
 // ifElse for handling diffrent base Types
?>
<?php
if ($bseType == "Custom"){
  echo "Your base: $usrInput is a custom base.\n";
  echo "<br>";
  echo "Dev: the Id for the base is $bseId\n";
}
elseif ($bseType == "Breed Only"){
  echo "Your base: $usrInput is a BreedOnly base.\n";
  echo "<br>";
  echo "Dev: the Id for the base is $bseId\n";
}
elseif ($bseType == "Combo"){
  echo "Your base: $usrInput is a Combo base.\n";
  echo "<br>";
  echo "Dev: the Id for the base is $bseId\n";
}
elseif ($bseType == "NCL"){
  echo " $usrInput is a NCL they can be found in explore\n";
  echo "<br>";
  echo "Dev: the Id for the base is $bseId\n";
}
elseif ($bseType == "Applicator"){
  echo "Your base: $usrInput is a Applicator base.\n";
  echo "<br>";
  echo "Dev: the Id for the base is $bseId\n";
}
else{
  echo "There is a un caught statment in the switch statment";
}
?> 
<!-- echo results from statments -->
<p>

</P>

<?php mysqli_close($conn); ?>
</body>
</html>