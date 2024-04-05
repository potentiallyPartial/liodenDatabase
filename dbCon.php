<?php
    function OpenCon()
    {
    $dbhost = "localhoast";
    $dbuser = "Tiamat";
    $dbpass = "5he@ds";
    $db = "lioden";
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname) or die("Connect failed: %s\n". $conn -> error);
    return $conn;
    }
    function CloseCon($conn)
    {
    $conn -> close();
    }
    ?>