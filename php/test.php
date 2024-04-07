<?php 
    include 'dbCon.php';
    $conn = OpenCon();
    echo "Connected Successfully";
    echo "$conn";
    CloseCon($conn);
    echo "test";
    ?>