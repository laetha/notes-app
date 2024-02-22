<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$bodyID = $_REQUEST['bodyID'];
$noteBody = array();
$sql = "SELECT * FROM notes WHERE id = $bodyID";
$sqldata = mysqli_query($dbcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
  array_push($noteBody, $row['title'], $row['body'], $row['id'], $row['lineage']);
}
echo json_encode($noteBody);

?>