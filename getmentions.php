<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$mentionList = array();
$sql = "SELECT title,id FROM notes WHERE lineage NOT LIKE '%-1515-%'";
$sqldata = mysqli_query($dbcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
  $notemention = '@'.$row['title'];
  array_push($mentionList, $notemention, $row['id']);
}

$sql = "SELECT title,id FROM notes WHERE lineage LIKE '%-1515-%'";
$sqldata = mysqli_query($dbcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
  $tagname = '#'.$row['title'];
  array_push($mentionList, $tagname, $row['id']);
}


echo json_encode($mentionList);

?>