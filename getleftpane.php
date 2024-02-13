<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$sql = "SELECT DISTINCT depth FROM notes ORDER BY depth DESC LIMIT 1";
$data = mysqli_query($dbcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($data, MYSQLI_ASSOC)) {
  $depth = $row['depth'];
}

//for($x=0; $x<=$depth; $x++){
  //$y=$x+1;
  $html = "";

$folders = "SELECT title, id, depth FROM notes ORDER BY lineage ASC";
$folderdata = mysqli_query($dbcon, $folders) or die('error getting data');
while($row =  mysqli_fetch_array($folderdata, MYSQLI_ASSOC)) {
  $rowid = $row['id'];
  switch ($row['depth']){
    case "0": $html.='<div id="'.$row['id'].'head" onClick=showpanel('.$rowid.')>'.$row['title'].'</div>'; break;
    case "1": $html.='<div id="'.$row['id'].'head" onClick=showpanel('.$rowid.')>&nbsp;&nbsp;'.$row['title'].'</div>'; break;
    case "2": $html.='<div id="'.$row['id'].'head" onClick=showpanel('.$rowid.')>&nbsp;&nbsp;&nbsp;&nbsp;'.$row['title'].'</div>'; break;
    case "3": $html.='<div id="'.$row['id'].'head" onClick=showpanel('.$rowid.')>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['title'].'</div>'; break;
    case "4": $html.='<div id="'.$row['id'].'head" onClick=showpanel('.$rowid.')>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['title'].'</div>'; break;
    case "5": $html.='<div id="'.$row['id'].'head" onClick=showpanel('.$rowid.')>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['title'].'</div>'; break;

  }
}
echo $html;
?>
