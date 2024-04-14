<!DOCTYPE html>

<html>
<header>
  <link rel="stylesheet" href="css/output.css">
</header>
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
  $output = "Your base: $usrInput is a custom base. <br> Dev: the Id for the base is $bseId";
}
elseif ($bseType == "Breed Only"){
  $output = "Your base: $usrInput is a BreedOnly base. <br> Dev: the Id for the base is $bseId";
}
elseif ($bseType == "Combo"){
  $output = "Your base: $usrInput is a Combo base. <br> Dev: the Id for the base is $bseId";
}
elseif ($bseType == "NCL"){
  $output = " $usrInput is a NCL they can be found in explore. <br> Dev: the Id for the base is $bseId";
}
elseif ($bseType == "Applicator"){

  $stmt = $conn->prepare("Select apc_name, apc_event, apc_time, apc_location, apc_cost, apc_notes from applicator where bse_id=?");
  $stmt->bind_param("i", $bseId);

  $stmt->execute();
  $stmt->bind_result($apcName, $apcEvent, $apcTime, $apcLocation, $apcCost, $apcNotes);
  $stmt->fetch();

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

<?php mysqli_close($conn); ?>
</body>
</html>