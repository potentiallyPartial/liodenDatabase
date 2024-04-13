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