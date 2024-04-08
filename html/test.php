<!DOCTYPE html>

<html>
<body>
<?php 
include "dbCon.php";
 $test = OpenCon();
 CloseCon($test);
?>
this is the base you input: <?php echo $_POST["base"] ?>

</body>
</html>