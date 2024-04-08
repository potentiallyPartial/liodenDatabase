<?php
    function OpenCon()
    {
    $dbhost = "dragonsDen";
    $dbuser = "Tiamat";
    $dbpass = "5he@ds";
    $db = "lioden";

    // atempt to make connection
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
    echo "All good";
    return $conn;
    }
    function CloseCon($conn)
    {
    $conn -> close();
    }
    ?>