<?php 
    function OpenCon()
    {
    $dbhost = "dragonsDen";
    $dbuser = "Tiamat";
    $dbpass = "5he@ds";
    $db = "lioden";
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname) or die("Connect failed: %s\n". $conn -> error);
    return $conn;
    echo "All good";
    }
    function CloseCon($conn)
    {
    $conn -> close();
    }

    $test = OpenCon();
    
    CloseCon($test);
?>