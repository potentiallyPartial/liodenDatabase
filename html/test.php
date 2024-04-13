<!DOCTYPE html>

<html>
<body>

<?php
function NCL(){
    echo " $usrInput is a NCL they can be found in explore\n";
    echo "Dev: the Id for the base is $bseId\n";
}

function Custom(){
    echo "Your base: $usrInput is a custom base.\n";
    echo "Dev: the Id for the base is $bseId\n";
}

function BreedOnly(){
    echo "Your base: $usrInput is a BreedOnly base.\n";
    echo "Dev: the Id for the base is $bseId\n";
}

function Combo(){
    echo "Your base: $usrInput is a Combo base.\n";
    echo "Dev: the Id for the base is $bseId\n";
}

function Applicator(){
    echo "Your base: $usrInput is a Applicator base.\n";
    echo "Dev: the Id for the base is $bseId\n";
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
    Custom();
    break;

  case Breed Only:
    BreedOnly();
    break;

  case Combo:
    Combo();
    break;

  case NCL:
    NCL();
    break;

  case Applicator:
    Applicator();
    break;

  default:
    Error();
}
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