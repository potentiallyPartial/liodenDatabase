<!DOCTYPE html>
<html>
<header>
    <link rel="stylesheet" href="style.css">

    <h1>R.G.L</h1>
    <h4> Rat Genetics Lab </h4>
</header>
<body>
<div class="body">
    <p class="cent">Welcome to the R.G.L!<br> We are a group of escaped lab rats who are now using what we learned for <br> <i>EVI-</i> <br>
    Good, we use what we learned for good. <br> Just tell us what base you are looking for and we can find out what you need to get there.</p>
    
<form action="index.php" method="POST" class="cent">
    <input type="text" name="name" placeholder="Enter Base name" list="bases"><br>
    <input type="submit" value="Deploy the Rats!">
    </form>

</div>


echo ("test");
/*
function sqlConect() {
// seting up sql server conection
$serverName = "dragonsDen";
$userName = "Tiamat";
$password = "5he@ds";
$dbName = "lioden";

if(!$mysqli->ping()) {
//make new connection
$conn = new mysqli($servername, $username, $password, $dbName);
}

// test Connection
if ($conn->connect_error) {
    echo "nope";
    die("Connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully";

  echo("connect Run");
}

echo "test";

sqlConect();
*/

<?php
/*
// capture User Input
$usrInput = $_POST["name"];

// Get bse_id from input
$bse = $conn->prepare("SELECT bse_id, bse_type from bases WHERE bse_name='?'");

$bse->bind_param("s",$usrInput);

$bse->execute();

$usrId = $bse["bse_id"];
$usrType = $bse["bse_type"];


// switch to sort type of base
    Switch($usrType) {
        case NCL:
            ncl($usrId);
        case Combo:
            combo($usrId);
        case Applcator:
            applcator($usrId);
        case breed Only:
            breedOnly($usrId);
        default;
            echo "Unknown base";
            throw eror;
    }

    $nclOut;
    $comboOut;
    $appOut;
    $breedOut;

    function ncl($id){
      $nclOut = echo "This Base Can be found In explore.";
    }

    function combo($id){
        $comboOut = echo "nothing here yet"
    }

    function applcator($id){
        $appInfo = $conn->prepare("SELECT apc_name, apc_event, apc_time, apc_location, apc_cost, apc_notes FROM applicator WHERE bse_id = '$id'");

       $appOut = echo "You are looking at an applcator base, the applcator is called "
        . $appInfo["apc_name"]. "\n It can be found in the "
        . $appInfo["apc_event"]. "\n That happens during"
        . $appInfo["apc_time"]. "\n The event store that you can buy it from is"
        . $appInfo["apc_location"]. "\n And it will cost you"
        . $appInfo["apc_cost"]. "\n If there are aditonal info It will be here: "
        . $appInfo["apc_notes"]." ";
    }

    function breedOnly($id){
        $breedInfo = $conn->prepare("SELECT bse_color, bse_shade, bse_gradent, bse_rareity FROM bases WHERE bse_id='$id'");
        $breedOut = echo "These are all the trates you will need to have a chance to breed this Lion.\n Color: "
        . $breedInfo["bse_color"]. "\n Shade: " 
        . $breedInfo["bse_shade"]. "\n Gradent: " 
        . $breedInfo["bse_gradent"]. "\n rareity: " 
        . $breedInfo["bse_rareity"]. "";
    }
*/
?>
<!--
<div class="results">
        <div class="rInner" id="result1">
            <p>
                <?php
/*
                    if ($nclOutput){
                        $nclOutput;
                    } 

                    elseif ($appOutput){
                        $appOutput;

                    }

                    elseif ($breedOut){
                        $breedOut;
                    }

                    elseif ($comboOut){
                        $comboOut;
                    }

                    else{
                        echo "There has been an error."
                    }
                    */
                ?>
            </p>  
        </div>
        <div class="rInner" id="result2">
            <p>

            </p>
        </div>
    </div>

</body>
</html>
                -->
<!--
    1) User Inputs Name of base they are looking for
    2) Sql- Select bse_id, bse_type from bases where bse_name="userinput";
    3) use if else tree based on bse_type return.
    4) if NCL then return text about ncl that can be found in explore.
    5) if Breed only ...
    6) if applcator: SQL- Select apc_name, apc_time, apc_event, apc_cost from Aplcator where bse_id="user selected ID"
    7) if Combo: SQL- Select from combo table, use Id's to return names from Base table.
-->

the base you submited is: <?php echo "$usrInput"; ?> <br>
this base is a: <?php echo "$bseType"; ?> <br>
and it's ID is <?php echo "$bseId"; ?>
<!--
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
-->

Php for combo V2
 
/*

$comboSt = $conn->prepare("SELECT cmb1_1, cmb1_2, cmb1_3, cmb1_4, cmb1_5, cmb1_6, cmb1_7 FROM combo WHERE bse_id=?");
$comboSt->bind_param("i", $bseId);
$comboSt->execute();
$result = $comboSt->get_result();
$d1Out = $result->fetch_all(MYSQLI_ASSOC);
$comboSt->close();


$comboSt = $conn->prepare("SELECT cmb2_1, cmb2_2, cmb2_3, cmb2_4, cmb2_5, cmb2_6, cmb2_7 FROM combo WHERE bse_id=?");
$comboSt->bind_param("i", $bseId);
$comboSt->execute();
$result = $comboSt->get_result();
$d2Out = $result->fetch_all(MYSQLI_ASSOC);
$comboSt->close();

//var_dump($d2Out);


$comboSt = $conn->prepare("SELECT cmb_cond FROM combo WHERE bse_id=?");
$comboSt->bind_param("i", $bseId);
$comboSt->execute();
$comboSt->bind_result($cmdCond);
$comboSt->fetch();
$comboSt->close();


$g1names = array();
$g2names = array();
$comboSt = $conn->prepare("SELECT bse_name FROM bases WHERE bse_id=?");

//var_dump($d1Out);

// Function for turning array from name to numbers
function array_default_key($array) {
  $arrayTemp = array();
  $i = 0;
  foreach ($array as $key => $val) {
      $arrayTemp[$i] = $val;
      $i++;
  }
  return $arrayTemp;
}

$d1OutFix = array_change_key_case($d1Out);

var_dump($d1OutFix);

for ($i = 0; $i <= 7; $i++) {
  if ($d1OutFix[$i] == "NULL") {
    continue; // Skip iteration if $row['cmb1_1'] is null
} else {
    $baseId = $d1OutFix[$i];
    $comboSt->bind_param("i", $baseId);
    $comboSt->execute();
    $comboSt->bind_result($idToName);
    $comboSt->fetch();
    $g1names[] = $idToName;
}
}

$d2OutFix = array_change_key_case($d2Out);

var_dump($d2OutFix);

for ($i = 0; $i <= 7; $i++) {
  if ($d2OutFix[$i] == "NULL") {
    continue; // Skip iteration if $row['cmb1_1'] is null
} else {
    $baseId = $d2OutFix[$i];
    $comboSt->bind_param("i", $baseId);
    $comboSt->execute();
    $comboSt->bind_result($idToName);
    $comboSt->fetch();
    $g1names[] = $idToName;
}
}

//var_dump($g1names);

foreach ($d2Out as $row) {
    $baseId = $row['cmb2_1']; // Assuming cmb2_1 is the base ID, adjust as needed
    $comboSt->bind_param("i", $baseId);
    $comboSt->execute();
    $comboSt->bind_result($idToName);
    $comboSt->fetch();
    $g2names[] = $idToName;
}

//var_dump($g2names);

$comboSt->close();

$output = "$usrInput is a Combo base you need to breed a lion with a base from group one with a lion from group 2 to get this base.<br>Group One Lions:<br>";
$output .= implode(",", $g1names) . "<br>"; 
$output .= "Group Two Lions:<br>"; 
$output .= implode(",", $g2names) . "<br>"; 
$output .= "$cmdCond";
*/