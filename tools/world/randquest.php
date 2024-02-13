<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$worldtitle = "SELECT * FROM quests ORDER BY rand() LIMIT 1";
           $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
           while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
            $body = $row['body'];
           }
           echo $body;