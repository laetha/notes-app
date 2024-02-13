
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath); ?>

<!-- Header -->
<?php
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.php";
include_once($headpath);

// Create variables
$texttemp=$_POST['body'];
$coordtemp=$_POST['coord'];
$id=$_POST['editid'];
$text=htmlentities(trim(addslashes($texttemp)));
$coord=htmlentities(trim(addslashes($coordtemp)));

echo 'ID='.$id;
echo 'COORD='.$id;
echo 'TEXT='.$id;


//Execute the query
$sql = "UPDATE mapfeatures SET text = '$text' WHERE id = $id;";

if ($dbcon->query($sql) === TRUE) {
	?>
	<script>
		window.location.replace("master.php");
	</script>
	<?php
}
else {
echo "Error: " . $sql . "<br>" . $dbcon->error;
}

//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
