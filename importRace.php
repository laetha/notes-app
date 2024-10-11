<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$sql = "SELECT DISTINCT npc_race FROM world WHERE npc_race != ''";
$sqldata = mysqli_query($dndcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
  
  $notetitle = $row['npc_race'];
  $lineage = "247-86-288-289";
  $edited = date('ymdHi');
  $body = "# ".$notetitle;

  $sql1 = "INSERT INTO notes (title,type,body,lineage,edited,viewed) VALUES ('$notetitle','','$body','$lineage','$edited','$edited')";

  if ($dbcon->query($sql1) === TRUE) {
    $last_id = $dbcon->insert_id;
    $lineage = $lineage.'-'.$last_id;
    $sql2 = "UPDATE notes SET lineage= '$lineage' WHERE id LIKE '$last_id'";
    if ($dbcon->query($sql2) === TRUE) {
      echo $last_id;
    }
  }
  else {
      echo "Error: " . $sql1 . "<br>" . $dbcon->error;
  }
}

?>