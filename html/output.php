<!DOCTYPE html>

<html>
<header>
  <link rel="stylesheet" href="css/output.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
</header>
<body>

<?php
// turn on error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/*
Things that need fixing:
Mobola base gives no base / empty error
*/

// make conection with my sql server
require_once('dbCon.php');
OpenCon();
/*
$conn = new mysqli("localhost","Tiamat","5he@ds","lioden");

// Check connection
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}

else{
  //echo "connected";
}
  */
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

 // close the first statment
 $stmt->close();

?>

<?php
// turn on error reporting
error_reporting(E_ALL);

// Statments for base types, curently formated as If else chain rather than switch as switch prevents program from runing unsure why.

if ($bseType == "Custom"){
  $output = "Your base: $usrInput is a custom base. It can be applied via Oasis";
}

elseif ($bseType == "Breed Only"){

  // structure of each statment. Step one prepare statmetn to get nessasary infromation.
  $breedSt = $conn->prepare("Select bse_color, bse_shade, bse_gradent, bse_rareity, bse_notes from bases where bse_id=?");
  // bind base id goten in prevous method
  $breedSt->bind_param("i", $bseId);

  // run and bind vars

  $breedSt->execute();

  $breedSt->bind_result($bseColor, $bseShade, $bseGradent, $bseRareity, $bsenotes);
  $breedSt->fetch();


  //close statment when done 

  $breedSt->close();

  // determining base rearty as the specal 'S' rairity requires a diffrent output. Then seting the output var to the required output

  if ($bseRareity == "S"){
    $output = "$usrInput is an specal Breed Only Base. <br>
    They can only appear on cubs bred from at least one parent with that specific Special base. This base can also be found, $bsenotes.
    ";
  }
  
  else{
    $output = "
    $usrInput is an Breed Only Base. <br>
    The components of this base are: <br>
    Color = $bseColor. <br>
    Shade = $bseShade. <br>
    Gradent = $bseGradent. <br>
    Rareity = $bseRareity. <br>
  
    The two lions you breed need to have these components between them for a chance to get this base.
    ";
  }

  // prototype for expanding base
  /*
  if ($bseRareity == "C") {$Rareity = "Common";}
  elseif ($bseRareity == "U") {$Rareity = "Uncommon";}
  elseif ($bseRareity == "R") {$Rareity = "Rare";}
  elseif ($bseRareity == "S") {$Rareity = "Special";}
  else {$Rareity == "Error in if else."}\
*/


}

elseif ($bseType == "Combo"){
 
// set up and run first statment
$comboSt = $conn->prepare("SELECT cmb1_1, cmb1_2, cmb1_3, cmb1_4, cmb1_5, cmb1_6, cmb1_7 FROM combo WHERE bse_id=?");
$comboSt->bind_param("i", $bseId);
$comboSt->execute();
$result = $comboSt->get_result();
$d1Out = $result->fetch_assoc();
$comboSt->close();

// set up and run second statment
$comboSt = $conn->prepare("SELECT cmb2_1, cmb2_2, cmb2_3, cmb2_4, cmb2_5, cmb2_6, cmb2_7 FROM combo WHERE bse_id=?");
$comboSt->bind_param("i", $bseId);
$comboSt->execute();
$result = $comboSt->get_result();
$d2Out = $result->fetch_assoc();
$comboSt->close();

// set up and run statment to get the condition
$comboSt = $conn->prepare("SELECT cmb_cond FROM combo WHERE bse_id=?");
$comboSt->bind_param("i", $bseId);
$comboSt->execute();
$comboSt->bind_result($cmbCond);
$comboSt->fetch();
$comboSt->close();

// statment for retreaveing the base name
$comboSt = $conn->prepare("SELECT bse_name FROM bases WHERE bse_id=?");
$comboSt->bind_param("i", $baseId);

// run loop to get base names
$g1names = [];
foreach ($d1Out as $key => $baseId) {
    if ($baseId !== NULL) {
        $comboSt->execute();
        $comboSt->bind_result($idToName);
        $comboSt->fetch();
        $g1names[] = $idToName;
    }
}

// run loop to get base 2 names
$g2names = [];
foreach ($d2Out as $key => $baseId) {
    if ($baseId !== NULL) {
        $comboSt->execute();
        $comboSt->bind_result($idToName);
        $comboSt->fetch();
        $g2names[] = $idToName;
    }
}

// close the base name query
$comboSt->close();

// format data into output statment by apending the var
$output = "$usrInput is a Combo base you need to breed a lion with a base from group one with a lion from group 2 to get this base.<br>Group One Lions:<br>";
$output .= implode(", ", $g1names) . "<br>"; 
$output .= "Group Two Lions:<br>"; 
$output .= implode(", ", $g2names) . "<br>";
$output .= "If there are any other requirments they will be listed here:<br>"; 
$output .= "$cmbCond";


}
elseif ($bseType == "NCL"){
  $output = " $usrInput is a NCL they can be found in explore.";
}
elseif ($bseType == "Applicator"){

  $appSt = $conn->prepare("Select apc_name, apc_event, apc_time, apc_location, apc_cost, apc_notes from applicator where bse_id=?");
  $appSt->bind_param("i", $bseId);
  
  $appSt->execute();

  $appSt->bind_result($apcName, $apcEvent, $apcTime, $apcLocation, $apcCost, $apcNotes);
  $appSt->fetch();

  $appSt->close();

  $output = "
  $usrInput is an Applcator Base. <br>
  It can be purchesed during the $apcEvent that hapens during the month of $apcTime. <br>
  You can get the base from $apcLocation. <br>
  The cost will be: $apcCost.<br>
  Aditonal notes: $apcNotes
  ";
  
}

elseif ($bseType == "Exclusive"){
  $output = "$usrInput is an NCL Exclusive base. <br> This base can be found as a NCL with a Dramboat king or passed down if one of the parents has this base.";
}

//error reporting for non caught arguments
else{
  $output = "You either provided a base that does not exist or entred a blank feild.";
}
?> 

<!-- Html for the output statment -->
<div class="contaner">
  <h1> The Results Are In! </h1>
<!-- echo results from statments -->
<p>
  <?php echo "$output"; ?>
</P>

<form action="index.php"  class="cent">
<input type="submit" value="Ask about another Base.">
</form>

</div>
</body>
</html>