<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$exportID = $_REQUEST['exportID'];
$sql = "SELECT title,body,lineage FROM notes WHERE id LIKE '$exportID'";
$sqldata = mysqli_query($dbcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
  $title = $row['title'];
  $remtitle = '# '.$row['title'];
  $body = ltrim(substr($row['body'],strlen($remtitle)));
  $path = explode('-', $row['lineage']);
  array_pop($path);
  $newpath = '';
  foreach($path as $x){
   
    $sql = "SELECT title FROM notes WHERE id LIKE '$x'";
    $sqldata = mysqli_query($dbcon, $sql) or die('error getting data');
    while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) { 

      $newpath = $newpath.$row['title'].'/';

    }
  }

  if (!is_dir('exports/'.$newpath)) {
    // dir doesn't exist, make it
    mkdir('exports/'.$newpath, 0777, true);
  }

  echo file_put_contents('exports/'.$newpath.$title.'.md', $body);
//  echo file_put_contents('exports/test.md', $newpath);

}

?>