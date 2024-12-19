<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$tocArray = array();
$x = 0;
$folders = "SELECT title,id FROM notes WHERE lineage LIKE '%-1515-%' && title NOT LIKE 'stop' ORDER BY title ASC";
$folderdata = mysqli_query($dbcon, $folders) or die('error getting data');
while($row =  mysqli_fetch_array($folderdata, MYSQLI_ASSOC)) {
  $tagid = $row['id'];
  $taglink = '<a onclick="showpanel('.$tagid.')" style="color:var(--gradient'.$x.'">'.$row['title'].'</a>';
  array_push($tocArray, $taglink);
  $x++;
}
echo json_encode($tocArray);
?>