<!DOCTYPE html>

<html>
<body>

<?php
function NCL($bseID, $bseName){
    echo "$bseName is a NCL they can be found in explore\n";
    echo "Dev: the Id for the base is $bseID\n";
}

function Custom($bseID, $bseName){
    echo "Your base: $bseName is a custom base.\n";
    echo "Dev: the Id for the base is $bseID\n";
}

function BreedOnly($bseID, $bseName){
    echo "Your base: $bseName is a BreedOnly base.\n";
    echo "Dev: the Id for the base is $bseID\n";
}

function Combo($bseID, $bseName){
    echo "Your base: $bseName is a Combo base.\n";
    echo "Dev: the Id for the base is $bseID\n";
}

function Applicator($bseID, $bseName){
    echo "Your base: $bseName is a Applicator base.\n";
    echo "Dev: the Id for the base is $bseID\n";
}

function Error(){
    echo "There is a un caught statment in the switch statment";
}
?>

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

 // switch for handling diffrent base Types

switch ($usrInput){
  case Custom:
    Custom($bseId, $usrInput);
    break;

  case Breed Only:
    BreedOnly($bseId, $usrInput);
    break;

  case Combo:
    Combo($bseId, $usrInput);
    break;

  case NCL:
    NCL($bseId, $usrInput);
    break;

  case Applicator:
    Applicator($bseId, $usrInput);
    break;

  default:
    Error();
}
*/
 //close conection after processing
 //
?> 
<!-- echo results from statments -->
the base you submited is: <?php echo "$usrInput"; ?> <br>
this base is a: <?php echo "$bseType"; ?> <br>
and it's ID is <?php echo "$bseId"; ?>

<?php mysqli_close($conn); ?>
</body>
</html>