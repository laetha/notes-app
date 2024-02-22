<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$parent = $_REQUEST['parent'];
$folderpreviews = array();
$sql = "SELECT * FROM notes WHERE lineage LIKE '%$parent%'";
$sqldata = mysqli_query($dbcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
  if (str_ends_with($row['lineage'], '-'.$parent.'-'.$row['id']) ||$row['lineage'] == $parent.'-'.$row['id']){
    array_push($folderpreviews, $row['body'], $row['id']);
  }
}
echo json_encode($folderpreviews);

?>