
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath); ?>

<!-- Header -->
<?php

// Create variables
$player1 = 'null';
$player2 = 'null';
$player3 = 'null';
$player4 = 'null';
$player5 = 'null';
$player6 = 'null';
$player7 = 'null';
$player8 = 'null';
$xptemp=$_POST['xp-award'];
$numplayerstemp=$_POST['numplayers'];
$player1temp=$_POST['player1'];
$player2temp=$_POST['player2'];
$player3temp=$_POST['player3'];
$player4temp=$_POST['player4'];
$player5temp=$_POST['player5'];
$player6temp=$_POST['player6'];
$player7temp=$_POST['player7'];
$player8temp=$_POST['player8'];
$alltemp=$_POST['all'];
$xp=htmlentities(trim(addslashes($xptemp)));
$numplayers=htmlentities(trim(addslashes($numplayerstemp)));
$player1=htmlentities(trim(addslashes($player1temp)));
$player2=htmlentities(trim(addslashes($player2temp)));
$player3=htmlentities(trim(addslashes($player3temp)));
$player4=htmlentities(trim(addslashes($player4temp)));
$player5=htmlentities(trim(addslashes($player5temp)));
$player6=htmlentities(trim(addslashes($player6temp)));
$player7=htmlentities(trim(addslashes($player7temp)));
$player8=htmlentities(trim(addslashes($player8temp)));
$all=htmlentities(trim(addslashes($alltemp)));
$xp = round($xp / $numplayers);
//Execute the query

if ($all == 1){
	$sql = "UPDATE world SET pc_xp = pc_xp + $xp WHERE type LIKE 'player character' AND active=1";
	if ($dbcon->query($sql) === TRUE) {
		?>
	<script type="text/javascript">
	window.location.href = 'lvlprocess.php';
	</script>
	<?php
		die();
	}
	else {
			echo "Error: " . $sql . "<br>" . $dbcon->error;
	}
}
else {
	$sql = "UPDATE world SET pc_xp = pc_xp + $xp WHERE title LIKE '$player1' OR title LIKE '$player2' OR title LIKE '$player3' OR title LIKE '$player4' OR title LIKE '$player5' OR title LIKE '$player6' OR title LIKE '$player7' OR title LIKE '$player8'";
	if ($dbcon->query($sql) === TRUE) {
		?>
	<script type="text/javascript">
	window.location.href = 'lvlprocess.php';
	</script>
	<?php
		die();
	}
	else {
			echo "Error: " . $sql . "<br>" . $dbcon->error;
	}
}



?>
