<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$autoquery = $_REQUEST['autoquery'];
$autoresults = array();
$sql = "SELECT * FROM world WHERE title LIKE '%$autoquery%' AND worlduser LIKE 'tarfuin'";
$sqldata = mysqli_query($dbcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
  $namesuggest = ('<div onClick="nameinsert(\''.addslashes($row['title']).'\')">'.$row['title'].'</div>');
  array_push($autoresults,$namesuggest);
}
echo json_encode($autoresults);