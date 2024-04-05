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

<?php 
    include 'dbCon.php';
    $conn = OpenCon();
    echo "Connected Successfully";
    echo "$conn";
    CloseCon($conn);
    echo "test";
    ?>
    
</div>



