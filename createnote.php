<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$title = 'Untitled';
$body = '';
$parent = $_REQUEST['noteParent'];

$sql1 = "SELECT * FROM notes WHERE id LIKE '$parent'";
$sql1data = mysqli_query($dbcon, $sql1) or die('error getting data');
while($row1 =  mysqli_fetch_array($sql1data, MYSQLI_ASSOC)) {
  $lineage = $row1['lineage'];
}

$sql = "INSERT INTO notes (title,type,body,lineage) VALUES ('$title','','$body','')";

        if ($dbcon->query($sql) === TRUE) {
          $last_id = $dbcon->insert_id;
          $lineage = $lineage.'-'.$last_id;
          $sql1 = "UPDATE notes SET lineage= '$lineage' WHERE id LIKE '$last_id'";
          if ($dbcon->query($sql1) === TRUE) {
            echo $last_id;
          }
        }
				else {
            echo "Error: " . $sql . "<br>" . $dbcon->error;
        }