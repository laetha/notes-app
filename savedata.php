<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$id = $_REQUEST['noteID'];
$notebodytemp = $_REQUEST['noteBody'];
$notetitletemp = $_REQUEST['noteTitle'];
$notebody=html_entity_decode(trim(addslashes($notebodytemp)));
$notetitle=html_entity_decode(trim(addslashes($notetitletemp)));
$edited = date('ymdHi');


$sql = "UPDATE notes SET title='$notetitle', body='$notebody', edited='$edited' WHERE id=$id";

        if ($dbcon->query($sql) === TRUE) {
          echo ('Saved successfully at '.date("h:i:sa"));
        }
         
				else {
          echo "Error: " . $sql . "<br>" . $dbcon->error;
        }