<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$docid = $_GET['docid'];
$referenceList = array();
$checkString = 'notes.bkconnor.com?id='.$docid.')';
$sql = "SELECT title,id FROM notes WHERE body LIKE '%$checkString%'";
$sqldata = mysqli_query($dbcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
  array_push($referenceList,'<a onclick=showpanel('.$row['id'].')>@'.$row['title'].'</a>');
}

echo json_encode($referenceList);

?>