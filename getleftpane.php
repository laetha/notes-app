<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$tocArray = array();
$folders = "SELECT * FROM notes ORDER BY lineage ASC";
$folderdata = mysqli_query($dbcon, $folders) or die('error getting data');
while($row =  mysqli_fetch_array($folderdata, MYSQLI_ASSOC)) {
  $rowid = $row['id'];
  array_push($tocArray, $row['lineage'], $row['title']);
}
echo json_encode($tocArray);
?>