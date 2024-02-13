
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath); ?>

<!-- Header -->
<?php
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.php";
include_once($headpath);

// Create variables
$nametemp=$_POST['name'];
$typetemp=$_POST['type'];
$bodytemp=$_POST['body'];
$id=$_POST['editid'];
$npcfactiontemp=$_POST['npc-faction'];
$npclocationtemp=$_POST['npc-location'];
$npcdeitytemp=$_POST['npc-deity'];
$name=htmlentities(trim(addslashes($nametemp)));
$type=htmlentities(trim(addslashes($typetemp)));
$body=htmlentities(trim(addslashes($bodytemp)));
$npclocation=htmlentities(trim(addslashes($npclocationtemp)));
$npcfaction=htmlentities(trim(addslashes($npcfactiontemp)));
$npcdeity=htmlentities(trim(addslashes($npcdeitytemp)));

//Execute the query
$sql = "UPDATE compendium
SET title = '$name', type = '$type', body = '$body',  npc_deity = '$npcdeity', npc_location = '$npclocation', npc_faction = '$npcfaction'
WHERE id = $id;";

        if ($dbcon->query($sql) === TRUE) {
					include('edit-modal.php');
					include('compendium.php');
        }
				else {
            echo "Error: " . $sql . "<br>" . $dbcon->error;
        }

//Footer
 ?>
