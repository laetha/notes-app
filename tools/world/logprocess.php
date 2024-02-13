
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath); ?>

<!-- Header -->
<?php

// Create variables
$datetemp=$_POST['logdate'];
$entrytemp=$_POST['logentry'];
$coordtemp=$_POST['logcoord'];
$maptemp=$_POST['logmap'];
$worldusertemp=$_POST['worlduser'];
$maptypetemp=$_POST['maptype'];

$active = 1;

$date=htmlentities(trim(addslashes($datetemp)));
$entry=htmlentities(trim(addslashes($entrytemp)));
$coord=htmlentities(trim(addslashes($coordtemp)));
$map=htmlentities(trim(addslashes($maptemp)));
$worlduser=htmlentities(trim(addslashes($worldusertemp)));
$maptype=htmlentities(trim(addslashes($maptypetemp)));


//Execute the query
if ($map == 1){
	$sql = "INSERT INTO mapfeatures(coord,text,active,maptype)
					VALUES('$coord','$entry','$active','$maptype')";

	        if ($dbcon->query($sql) === TRUE) {
						?>
	<script type="text/javascript">
	<?php
	if ($maptype == 'city'){
	?>

	window.location.href = 'map.php';

	<?php }
	else { ?>

	window.location.href = 'map-region.php';

	<?php } ?>
	</script>
	<?php
	          die();
	        }
					else {
	            echo "Error: " . $sql . "<br>" . $dbcon->error;
	        }
	//Footer

}
else {
$sql = $dbcon->prepare("INSERT INTO campaignlog(date,entry,active,coord,worlduser,maptype)
				VALUES (?, ?, ?, ?, ?, ?)");

				$sql->bind_param("ssssss",$date,$entry,$active,$coord,$worlduser,$maptype);
				if ($sql->execute()) {
					?>
<script type="text/javascript">
<?php
if ($maptype == 'city'){
	?>

	window.location.href = 'map.php';

	<?php }
	else { ?>

	window.location.href = 'map-region.php';

	<?php } ?>
</script>
<?php
          die();
        }
				else {
            echo "Error: " . $sql . "<br>" . $dbcon->error;
        }
//Footer

}
?>
