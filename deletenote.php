<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$id = $_REQUEST['delID'];


$sql = "DELETE FROM notes WHERE id=$id";

        if ($dbcon->query($sql) === TRUE) {
          echo ($id.' deleted');
        }
         
				else {
          echo "Error: " . $sql . "<br>" . $dbcon->error;
        }