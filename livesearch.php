
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$value = $_REQUEST['value'];
$sql = "SELECT * FROM notes WHERE title LIKE '%$value%'";
$sqldata = mysqli_query($dbcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
  echo ('<div onClick=showpanel("'.$row['id'].'")><span class="greentitle" style="font-size:18px; cursor:pointer;">'.$row['title'].'</span><br/>');
  echo ('<hr>');
  echo ('</div>');
}


$sql = "SELECT * FROM notes WHERE body LIKE '%$value%' ORDER BY id DESC";
$sqldata = mysqli_query($dbcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {

    if (strlen($value) >= 3){
    $body = $row['body'];


    $valuepos = stripos($body,$value);
    $samplestart = $valuepos - 50;
    if ($samplestart <= 0){
      $samplestart = 0;
    }
    //$sampleend = $valuepos + 50;
    $bodysample = substr($body,$samplestart, 200);
    $title = str_ireplace($value,"<span style=\"background-color:yellow;\">$value</span>",$row['title']);
  echo ('<div onClick=showpanel("'.$row['id'].'")><span class="greentitle" style="cursor:pointer;">'.$title.'</span><br/>');
  ?>
<style>
   .highlight {
	background-color:#d5e319;
	color:black;
	font-size:14px;
  }
  </style>
  <?php
  $bodysample = str_ireplace($value,"<span class=\"highlight\">$value</span>",$bodysample);
  

  if (strpos($bodysample, $value) !== false) {
      echo $bodysample;
     }

echo ('<hr>');
echo ('</div>');
    }
  
}

//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>