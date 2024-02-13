<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$id = $_REQUEST['editID'];
$id = preg_replace("/[^0-9]/", "", $id);
$id = intval($id);
$sql = "SELECT * FROM world WHERE id=$id";
$sqldata = mysqli_query($dbcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
  $editresults = [$row['title'],$row['body'],$row['id']];

}
echo json_encode($editresults);

        if ($dbcon->query($sql) === TRUE) {

          }
         
				else {
        }