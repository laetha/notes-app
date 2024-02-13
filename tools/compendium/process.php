
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
$sql = "INSERT INTO compendium(title,type,body,npc_location,npc_faction,npc_deity)
				VALUES('$name','$type','$body','$npclocation','$npcfaction','$npcdeity')";

        if ($dbcon->query($sql) === TRUE) {
					include('success.php');
					include('import.php');
        }
				else {
            echo "Error: " . $sql . "<br>" . $dbcon->error;
        }
//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
