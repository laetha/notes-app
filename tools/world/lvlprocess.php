
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath); ?>

<!-- Header -->
<?php

$sql = "UPDATE world
SET pc_lvl =
CASE
 			  WHEN pc_xp BETWEEN 300 AND 899 THEN 2
              WHEN pc_xp BETWEEN 900 AND 2699 THEN 3
              WHEN pc_xp BETWEEN 2700 AND 6499 THEN 4
              WHEN pc_xp BETWEEN 6500 AND 13999 THEN 5
              WHEN pc_xp BETWEEN 14000 AND 22999 THEN 6
              WHEN pc_xp BETWEEN 23000 AND 33999 THEN 7
              WHEN pc_xp BETWEEN 34000 AND 47999 THEN 8
              WHEN pc_xp BETWEEN 48000 AND 63999 THEN 9
              WHEN pc_xp BETWEEN 64000 AND 84999 THEN 10
              WHEN pc_xp BETWEEN 85000 AND 99999 THEN 11
              WHEN pc_xp BETWEEN 100000 AND 119999 THEN 12
              WHEN pc_xp BETWEEN 120000 AND 139999 THEN 13
              WHEN pc_xp BETWEEN 140000 AND 164999 THEN 14
              WHEN pc_xp BETWEEN 165000 AND 194999 THEN 15
              WHEN pc_xp BETWEEN 195000 AND 224999 THEN 16
              WHEN pc_xp BETWEEN 225000 AND 264999 THEN 17
              WHEN pc_xp BETWEEN 265000 AND 304999 THEN 18
              WHEN pc_xp BETWEEN 305000 AND 354999 THEN 19
              WHEN pc_xp BETWEEN 355000 AND 9999999999999 THEN 20
         END
              WHERE type LIKE 'player character'";

if ($dbcon->query($sql) === TRUE) {
	?>
<script type="text/javascript">
window.location.href = 'xp.php';
</script>
<?php
	die();
}
else {
		echo "Error: " . $sql . "<br>" . $dbcon->error;
}

?>
