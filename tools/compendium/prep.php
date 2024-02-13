
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$charID = $_REQUEST['id'];
$prepped = $_REQUEST['prepped'];


$sql = "UPDATE characters
SET prepped = '$prepped'
WHERE id = $charID;";

        if ($dbcon->query($sql) === TRUE) {

        }
				else {
        }

//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
