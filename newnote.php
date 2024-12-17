<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$title = 'Untitled';
$body = '';
$edited = date('ymdHi');
$dailyStatus = $_GET['dailyStatus'];
$currentDate = date("Ymd");
$noteExists = false;
$existID = '';

$sql = "SELECT title,id FROM notes WHERE lineage LIKE '259-%' && title LIKE '$currentDate%' ORDER BY title ASC";
$sqldata = mysqli_query($dbcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
  $noteExists = true;
  $existID = $row['id'];
}


if ($dailyStatus == 'daily'){
  if( $noteExists !== true){
    $body = '# '.$currentDate;
  $sql = "INSERT INTO notes (title,type,body,lineage,edited,viewed) VALUES ('$currentDate','','$body','','$edited','$edited')";
  
  if ($dbcon->query($sql) === TRUE) {
    $last_id = $dbcon->insert_id;
    $newlineage = '259-'.$last_id;
    $sql1 = "UPDATE notes SET lineage= '$newlineage' WHERE id LIKE '$last_id'";
    if ($dbcon->query($sql1) === TRUE) {
      echo $last_id;
    }
  }
  else {
      echo "Error: " . $sql . "<br>" . $dbcon->error;
  }

}

else {
  echo $existID;
}

}
else {
  $sql = "INSERT INTO notes (title,type,body,lineage,edited,viewed) VALUES ('$title','','$body','','$edited','$edited')";

        if ($dbcon->query($sql) === TRUE) {
          $last_id = $dbcon->insert_id;
          $sql1 = "UPDATE notes SET lineage= '$last_id' WHERE id LIKE '$last_id'";
          if ($dbcon->query($sql1) === TRUE) {
            echo $last_id;
          }
        }
				else {
            echo "Error: " . $sql . "<br>" . $dbcon->error;
        }
      }