<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$id = $_REQUEST['moveID']; //51
$movelineage = $_REQUEST['moveLineage']; //1
$sql = "SELECT id, lineage FROM notes WHERE lineage LIKE '%$id%'";
$sqldata = mysqli_query($dbcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {

    $tempid = $row['id']; //51
    $oldlineage = $row['lineage']; //23-51
    $oldlineage = strstr($oldlineage,$id); //51
    $newlineage = $movelineage.'-'.$oldlineage; //1-51
    $newlineage = ltrim($newlineage, '1-'); //51
    $sql1 = "UPDATE notes SET lineage='$newlineage' WHERE id LIKE '$tempid'";
    if ($dbcon->query($sql1) === TRUE) {
        echo $id;
      }
       
              else {
            
      }

}