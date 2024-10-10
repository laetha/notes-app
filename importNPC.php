<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$sql = "SELECT * FROM world WHERE id = 4076";
$sqldata = mysqli_query($dndcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
  $cleantitle = str_replace(' ', '_', $row['title']);
  $notetitle = $row['title'];
  $lineage = '247-86-276';
  $race = $row['npc_race'];
  $npcbody = $row['body'];
  if ($race != ''){
    $race = '@'.$race;
  }
  $establishment = $row['npc_est'];
  if ($establishment != ''){
    $establishment = '@'.$establishment;
  }
  $location = $row['npc_location'];
  if ($location != ''){
    $location = '@'.$location;
  }
  $faction = $row['npc_faction'];
  if ($faction != ''){
    $faction = '@'.$faction;
  }
  $deity = $row['npc_deity'];
  if ($deity != ''){
    $deity = '@'.$deity;
  }
  $npctitle = $row['npc_title'];

  $body = "# ".$notetitle."\r\n\r\n" .
  '![](uploads/'.$id.'-'.$cleantitle.')'."\r\n" .
  'Race: '.$race."\r\n" .
  'Establishment: '.$establishment."\r\n" .
  'Location: '.$location."\r\n" .
  'Faction: '.$faction."\r\n" .
  'Deity: '.$deity."\r\n" .
  'Title: '.$npctitle."\r\n\r\n" .
  $npcbody;
  $body = html_entity_decode(trim(addslashes($body)));

  $edited = date('ymdHi');

  $sql1 = "INSERT INTO notes (title,type,body,lineage,edited,viewed) VALUES ('$notetitle','','$body','$lineage','$edited','$edited')";

  if ($dbcon->query($sql1) === TRUE) {
    $last_id = $dbcon->insert_id;
    $lineage = $lineage.'-'.$last_id;
    $sql1 = "UPDATE notes SET lineage= '$lineage' WHERE id LIKE '$last_id'";
    if ($dbcon->query($sql1) === TRUE) {
      echo $last_id;
    }


    echo $notetitle. 'successfully created!';
  }
  else {
      echo "Error: " . $sql1 . "<br>" . $dbcon->error;
  }
}

?>