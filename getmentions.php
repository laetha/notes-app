<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$mentionList = array();
$sql = "SELECT title,id FROM notes";
$sqldata = mysqli_query($dbcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
  array_push($mentionList, $row['title'], $row['id']);
}
echo json_encode($mentionList);

?>