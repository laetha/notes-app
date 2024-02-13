
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath); ?>


<!-- Header -->
<?php
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.php";
include_once($headpath);


$worldtitle = "SELECT * FROM world WHERE type LIKE 'npc' AND worlduser LIKE 'tarfuin'";
$titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
	$id = $row['id'];
	$jpgurl = 'uploads/'.$row['title'].'.jpg';
	$pngurl = 'uploads/'.$row['title'].'.png';
	if (file_exists($jpgurl)){
		$newname = $row['title'];
	  }
	  else if (file_exists($pngurl)){
		$newname = $row['title'];
	  }
	  else {
		$last = substr($row['title'], strpos($row['title'], " ") + 1);
		$world1title = "SELECT name FROM npcs WHERE type LIKE 'first' ORDER BY rand() LIMIT 1";
$title1data = mysqli_query($dbcon, $world1title) or die('error getting data');
while($row1 =  mysqli_fetch_array($title1data, MYSQLI_ASSOC)) {
	$first = $row1['name'];

}
	$newname = $first.' '.$last;
	  }
	//Execute the query
$sql = "UPDATE world SET title='$newname' WHERE id LIKE '$id'";

if ($dbcon->query($sql) === TRUE) {
			
}
		else {
	echo "Error: " . $sql . "<br>" . $dbcon->error;
}
}


		
//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
