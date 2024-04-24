<!DOCTYPE html>

<html>
<header>
  <link rel="stylesheet" href="css/output.css">
</header>
<body>

<?php
// turn on error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

 // close the first statment
 $stmt->close();

?>

<?php
error_reporting(E_ALL);
 // ifElse for handling diffrent base Types


if ($bseType == "Custom"){
  $output = "Your base: $usrInput is a custom base. <br> Dev: the Id for the base is $bseId";
}

elseif ($bseType == "Breed Only"){

  $breedSt = $conn->prepare("Select bse_color, bse_shade, bse_gradent, bse_rareity from bases where bse_id=?");
  $breedSt->bind_param("i", $bseId);

  $breedSt->execute();

  $breedSt->bind_result($bseColor, $bseShade, $bseGradent, $bseRareity);
  $breedSt->fetch();

  $breedSt->close();

  /*
  if ($bseRareity == "C") {$Rareity = "Common";}
  elseif ($bseRareity == "U") {$Rareity = "Uncommon";}
  elseif ($bseRareity == "R") {$Rareity = "Rare";}
  elseif ($bseRareity == "S") {$Rareity = "Special";}
  else {$Rareity == "Error in if else."}\
*/

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
elseif ($bseType == "Combo"){
  /*
// statment for geting first gorup of posable perents
  $comboSt = $conn->prepare("Select cmb_1-1, cmb_1-2, cmb_1-3, cmb_1-4, cmb_1-5, cmb_1-6, cmb_1-7 from combo where bse_id=?");
  $comboSt->bind_param("i", $bseId);

  $comboSt->execute();

  $result = $comboSt->get_result();
  $data = $result->fetch_all(MYSQLI_ASSOC);

  $d1Out = array();
// loop to add them to g1Out
  foreach ($data as &$data1) {
    if ($data1) {
        array_push($d1out, $data1);
    }
}
  $comboSt->close();

  // statment for geting second set of parents
  $comboSt = $conn->prepare("Select cmb_2-1, cmb_2-2, cmb_2-3, cmb_2-4, cmb_2-5, cmb_2-6, cmb_2-7 from combo where bse_id=?");
  $comboSt->bind_param("i", $bseId);

  $comboSt->execute();

  $comboSt->bind_result($cmd21, $cmd22, $cmd23, $cmd24, $cmd25, $cmd26, $cmd27);
  $comboSt->fetch();

  $result = $comboSt->get_result();
  $data = $result->fetch_all(MYSQLI_ASSOC);
  $d2Out = array();

// loop for adding results into g2Out
  foreach ($data as &$data2) {
    if ($data2) {
        array_push($d2Out, $data2);
    }
}

  $comboSt->close();

// statment for geting conditions
  $comboSt = $conn->prepare("Select cmd_cond from combo where bse_id=?");
  $comboSt->bind_param("i", $bseId);

  $comboSt->execute();

  $comboSt->bind_result($cmdCond);
  $comboSt->fetch();

  $comboSt->close();

  // loops for translating to baseName

  $g1names = array();
  $g2names = array();

  $comboSt = $conn->prepare("Select bse_name from bases where bse_id=?");

  foreach ($d1Out as $ids){

    $comboSt->bind_param("i", $ids);
    $comboSt->bind_resutl($idToName);
    $comboSt->fetch();

    array_push($g1names, $idToName);

  }

  foreach ($d2Out as $ids){

    $comboSt->bind_param("i", $ids);
    $comboSt->bind_resutl($idToName);
    $comboSt->fetch();

    array_push($g1names, $idToName);

  }

  $comboSt->Close();

  //formating output

 $divider = "<br> Group Two: <br>";

 $endCap = "<br> Some combos can only be done when certan condions are met. If this base has conditoins they will show up here: <br> $cmdCond";

  $output = "$usrInput is a Combo base you need to breed a lion with a base from group one with a lion form group 2 to get this base. <br>Group One Lions: <br>";

  $output .= $g1names;
  $output .= $divider;
  $output .= $g2names;
  $output .= $endCap;
  */

  // Fetching first group of possible parents
$comboSt = $conn->prepare("SELECT cmb1_1, cmb1_2, cmb1_3, cmb1_4, cmb1_5, cmb1_6, cmb1_7 FROM combo WHERE bse_id=?");
$comboSt->bind_param("i", $bseId);
$comboSt->execute();
$result = $comboSt->get_result();
$d1Out = $result->fetch_all(MYSQLI_ASSOC);
$comboSt->close();

// Fetching second set of parents
$comboSt = $conn->prepare("SELECT cmb2_1, cmb2_2, cmb2_3, cmb2_4, cmb2_5, cmb2_6, cmb2_7 FROM combo WHERE bse_id=?");
$comboSt->bind_param("i", $bseId);
$comboSt->execute();
$result = $comboSt->get_result();
$d2Out = $result->fetch_all(MYSQLI_ASSOC);
$comboSt->close();

//var_dump($d2Out);

// Fetching conditions
$comboSt = $conn->prepare("SELECT cmb_cond FROM combo WHERE bse_id=?");
$comboSt->bind_param("i", $bseId);
$comboSt->execute();
$comboSt->bind_result($cmdCond);
$comboSt->fetch();
$comboSt->close();

// Fetching base names
$g1names = array();
$g2names = array();
$comboSt = $conn->prepare("SELECT bse_name FROM bases WHERE bse_id=?");

var_dump($d1Out);

foreach ($d1Out as $row) {
  if ($row == null) {
      continue; // Skip iteration if $row['cmb1_1'] is null
  } else {
      $baseId = $row;
      $comboSt->bind_param("i", $baseId);
      $comboSt->execute();
      $comboSt->bind_result($idToName);
      $comboSt->fetch();
      $g1names[] = $idToName;
  }
}

var_dump($g1names);

foreach ($d2Out as $row) {
    $baseId = $row; // Assuming cmb2_1 is the base ID, adjust as needed
    $comboSt->bind_param("i", $baseId);
    $comboSt->execute();
    $comboSt->bind_result($idToName);
    $comboSt->fetch();
    $g2names[] = $idToName;
}

//var_dump($g2names);

$comboSt->close();

// Formatting output
$output = "$usrInput is a Combo base you need to breed a lion with a base from group one with a lion from group 2 to get this base.<br>Group One Lions:<br>";
$output .= implode(" ", $g1names) . "<br>"; // Added separator
$output .= "Group Two Lions:<br>"; // Added header for Group Two Lions
$output .= implode(" ", $g2names) . "<br>"; // Added separator
$output .= "$cmdCond";

}
elseif ($bseType == "NCL"){
  $output = " $usrInput is a NCL they can be found in explore. <br> Dev: the Id for the base is $bseId";
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
else{
  $output = "You either provided a base that does not exist or entred a blank feild.";
}
?> 

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