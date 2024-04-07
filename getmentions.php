<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$mentionList = array();
$sql = "SELECT title,id FROM notes";
$sqldata = mysqli_query($dbcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
  $notemention = '@'.$row['title'];
  array_push($mentionList, $notemention, $row['id']);
}

$sql = "SELECT title,id FROM world WHERE worlduser LIKE 'tarfuin'";
$sqldata = mysqli_query($dndcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
  $dndmention = '#'.$row['title'];
  array_push($mentionList, $dndmention, $row['id']);
}


echo json_encode($mentionList);

?>