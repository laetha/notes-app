<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$fileID = $_GET['fileID'];
$sql = "SELECT lineage FROM notes WHERE lineage LIKE '%-$fileID'";
$sqldata = mysqli_query($dbcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
  
  // Split the string by hyphens into an array
  $numbers = explode('-', $row['lineage']);
  // Get the second-to-last number
  $upID = $numbers[count($numbers) - 2];

  echo $upID;  // Output: 11

}

?>