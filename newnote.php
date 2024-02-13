<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$title = 'Untitled';
$body = '';

$sql = "INSERT INTO notes (title,type,body,parent,children) VALUES ('$title','','$body',0,'')";

        if ($dbcon->query($sql) === TRUE) {
          $last_id = $dbcon->insert_id;
					echo $last_id;
        }
				else {
            echo "Error: " . $sql . "<br>" . $dbcon->error;
        }