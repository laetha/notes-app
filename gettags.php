<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$tocArray = array();
$folders = "SELECT title,id FROM notes WHERE lineage LIKE '%-1515-%' ORDER BY title ASC";
$folderdata = mysqli_query($dbcon, $folders) or die('error getting data');
while($row =  mysqli_fetch_array($folderdata, MYSQLI_ASSOC)) {
  $tagid = $row['id'];
  $taglink = '<a onclick=showpanel('.$tagid.')>'.$row['title'].'</a>';
  array_push($tocArray, $taglink);
}
echo json_encode($tocArray);
?>