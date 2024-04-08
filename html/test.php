<!DOCTYPE html>

<html>
<body>

<?php 
include "dbCon.php"
$con = OpenCon();
/*
CloseCon($con);
*/
?>

this is the base you input: <?php echo $_POST["base"] ?>

</body>
</html>