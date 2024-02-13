
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$encounter = $_REQUEST['encounter'];
$worlduser = $_REQUEST['worlduser'];
$encLabel = $_REQUEST['encLabel'];
$encLabel=htmlentities(trim(addslashes($encLabel)));
$dungeon = $_REQUEST['dungeon'];
$dungeon=htmlentities(trim(addslashes($dungeon)));

//$type = 'encounter';
$sqlcompendium = "INSERT INTO `fights`(title,worlduser,encLabel,dungeon)
                  VALUES ('$encounter','$worlduser','$encLabel','$dungeon')";


        if ($dbcon->query($sqlcompendium) === TRUE) {
        }
				else {
        }

//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
