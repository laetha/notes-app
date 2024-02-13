
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
$active = 1;

$date=htmlentities(trim(addslashes($datetemp)));
$entry=htmlentities(trim(addslashes($entrytemp)));
$coord=htmlentities(trim(addslashes($coordtemp)));
$map=htmlentities(trim(addslashes($maptemp)));
$worlduser=htmlentities(trim(addslashes($worldusertemp)));

//Execute the query
if ($map == 1){
	$sql = "INSERT INTO mapfeatures(coord,text)
					VALUES('$coord','$entry')";

	        if ($dbcon->query($sql) === TRUE) {
						?>
	<script type="text/javascript">
	window.location.href = 'campaign-log.php';
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
$sql = $dbcon->prepare("INSERT INTO campaignlog(date,entry,active,coord,worlduser)
				VALUES (?, ?, ?, ?, ?)");

				$sql->bind_param("sssss",$date,$entry,$active,$coord,$worlduser);
				if ($sql->execute()) {
					?>
<script type="text/javascript">
window.location.href = 'campaign-log.php';
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
