<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$title = 'Untitled';
$body = '';

$sql = "INSERT INTO notes (title,type,body,lineage) VALUES ('$title','','$body','')";

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