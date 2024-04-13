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