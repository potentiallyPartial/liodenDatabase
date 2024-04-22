<!DOCTYPE html>

<html>
<header>
  <link rel="stylesheet" href="css/output.css">
</header>
<body>

<?php
// turn on error reporting
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
  Rareity = $Rareity. <br>

  The two lions you breed need to have these components between them for a chance to get this base.
  ";

}
elseif ($bseType == "Combo"){
// statment for geting first gorup of posable perents
  $comboSt = $conn->prepare("Select cmb_1-1, cmb_1-2, cmb_1-3, cmb_1-4, cmb_1-5, cmb_1-6, cmb_1-7 from combo where bse_id=?");
  $comboSt->bind_param("i", $bseId);

  $comboSt->execute();

  $result = $comboSt->get_result();
  $data = $result->fetch_all(MYSQLI_ASSOC);

  $g1Out = "";
// loop to add them to g1Out
  foreach ($data as &$group1) {
    if ($group1) {
        $g1Out .= $group1;
        $g1Out .= ", ";
    }
}
/*
  $comboSt->bind_result($cmd11, $cmd12, $cmd13, $cmd14, $cmd15, $cmd16, $cmd17);
  $comboSt->fetch();
*/
  $comboSt->close();

  // statment for geting second set of parents
  $comboSt = $conn->prepare("Select cmb_2-1, cmb_2-2, cmb_2-3, cmb_2-4, cmb_2-5, cmb_2-6, cmb_2-7 from combo where bse_id=?");
  $comboSt->bind_param("i", $bseId);

  $comboSt->execute();

  $comboSt->bind_result($cmd21, $cmd22, $cmd23, $cmd24, $cmd25, $cmd26, $cmd27);
  $comboSt->fetch();

  $result = $comboSt->get_result();
  $data = $result->fetch_all(MYSQLI_ASSOC);

  $g2Out = "";
// loop for adding results into g2Out
  foreach ($data as &$group2) {
    if ($group2) {
        $g2Out .= $group2;
        $g2Out .= ", ";
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

  //formating output

 $divider = "<br> Group Two: <br>";

 $endCap = "<br> Some combos can only be done when certan condions are met. If this base has conditoins they will show up here: <br> $cmdCond";

  $output = "$usrInput is a Combo base you need to breed a lion with a base from group one with a lion form group 2 to get this base. <br>Group One Lions: <br>";

  $output .= $g1Out;
  $output .= $divider;
  $output .= $g2Out;
  $output .= $endCap;
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

  $aptSt->close();

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