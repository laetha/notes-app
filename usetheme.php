<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$filename = $_REQUEST['filename'];
$sql = "UPDATE themes SET current='$filename' WHERE id=1";
if ($dbcon->query($sql) === TRUE) {

}