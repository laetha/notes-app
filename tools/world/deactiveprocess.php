
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$title =$_REQUEST['title'];
$type = $_REQUEST['type'];
$worlduser = $_REQUEST['worlduser'];


$sql = "UPDATE world SET active = 0 WHERE title LIKE '$title' AND type LIKE '$type' AND worlduser LIKE '$worlduser'";

        if ($dbcon->query($sql) === TRUE) {

        }
				else {

        }

//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
