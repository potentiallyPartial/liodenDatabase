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

/*else{
  echo "connected";
}*/
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

 // switch for handling diffrent base Types
 /*
switch ($usrInput){
  case Custom:
    break;
  case Breed Only:
    break;
  case Combo:
    break;
  case NCL:
    break;
  default:
}
*/

 //close conection after processing
 mysqli_close();
?> 
<!-- echo results from statments -->
the base you submited is: <?php echo "$usrInput"; ?> <br>
this base is a: <?php echo "$bseType"; ?>
and it's ID is <?php echo "$bseId"; ?>
</body>
</html>