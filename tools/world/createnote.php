
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$worlduser = $_REQUEST['worlduser'];
$notetitle =$_REQUEST['noteTitle'];
$noteBody = html_entity_decode($_REQUEST['noteBody']);

$created = date('ymdHi');
$edited = date('ymdHi');

$sql = "INSERT INTO world(worlduser,title,type,body,created,edited)
				VALUES('$worlduser','$notetitle','session note','$notebody','$created','$edited')";

        if ($dbcon->query($sql) === TRUE) {
          $id = preg_replace("/[^0-9]/", "",$dbcon->insert_id);
          echo($id);
        }
				else {
          echo "Error: " . $sql . "<br>" . $dbcon->error;
        }