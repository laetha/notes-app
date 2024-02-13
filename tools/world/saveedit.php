<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$id = $_REQUEST['noteID'];
$notebodytemp = $_REQUEST['noteBody'];
$notebody=html_entity_decode(trim(addslashes($notebodytemp)));


$sql = "UPDATE world SET body='$notebody' WHERE id=$id";

        if ($dbcon->query($sql) === TRUE) {
            echo ('Saved successfully at '.date("h:i:sa"));
          }
         
				else {
          echo "Error: " . $sql . "<br>" . $dbcon->error;
        }