
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath); ?>


<!-- Header -->
<?php
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.php";
include_once($headpath);

for ($i=0; $i < 60; $i++) { 
	# code...


$worldtitle = "SELECT title FROM npcs WHERE type LIKE 'first' ORDER BY rand() LIMIT 1";
$titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
	$first = $row['title'];
}
$worldtitle = "SELECT title FROM npctraits WHERE type LIKE 'last' ORDER BY rand() LIMIT 1";
$titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
	$last = $row['title'];
}
$worldtitle = "SELECT title FROM npctraits WHERE type LIKE 'race' ORDER BY rand() LIMIT 1";
$titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
	$race = $row['title'];
}
$worldtitle = "SELECT title FROM npctraits WHERE type LIKE 'personality' ORDER BY rand() LIMIT 1";
$titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
	$personality = $row['title'];
}
$worldtitle = "SELECT title FROM npctraits WHERE type LIKE 'deity' ORDER BY rand() LIMIT 1";
$titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
	$deity = $row['title'];
}
$worldtitle = "SELECT title FROM npctraits WHERE type LIKE 'district' ORDER BY rand() LIMIT 1";
$titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
	$district = $row['title'];
}
$worldtitle = "SELECT title FROM npctraits WHERE type LIKE 'job' ORDER BY rand() LIMIT 1";
$titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
	$job = $row['title'];
}
$worldtitle = "SELECT title FROM npctraits WHERE type LIKE 'hair' ORDER BY rand() LIMIT 1";
$titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
	$hair = $row['title'];
}
$worldtitle = "SELECT title FROM npctraits WHERE type LIKE 'eyes' ORDER BY rand() LIMIT 1";
$titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
	$eyes = $row['title'];
}
$name = $first.' '.$last;
$body = $hair.' hair, '.$eyes.' eyes. '.$personality;
//Execute the query
$sql = "INSERT INTO world(title,type,body,npc_race,npc_location,npc_deity,npc_title,worlduser,code)
				VALUES('$name','npc','$body','$race','$district','$deity','$job','$loguser','')";

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
