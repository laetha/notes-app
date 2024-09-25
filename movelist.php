<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$moveList = array();
$sql = "SELECT * FROM notes ORDER BY title ASC";
$sqldata = mysqli_query($dbcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {

  $heirarchy = explode('-',$row['lineage']);
  $title = '';
  foreach ($heirarchy as $x) {
  $sql1 = "SELECT title FROM notes WHERE id LIKE '$x'";
  $sql1data = mysqli_query($dbcon, $sql1) or die('error getting data');
  while($row1 =  mysqli_fetch_array($sql1data, MYSQLI_ASSOC)) {
      if ($title !== ''){
        $title .= '/';
      }
      $title .= $row1['title'];

    }
  }


  array_push($moveList, $row['lineage'], $title);
}
echo json_encode($moveList);

?>