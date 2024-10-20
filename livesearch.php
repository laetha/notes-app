
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$parsepath = $_SERVER['DOCUMENT_ROOT'];
$parsepath .= "/plugins/Parsedown.php";
include_once($parsepath);

$Parsedown = new Parsedown();
 


$value = $_REQUEST['value'];
//$dndcheck = $_REQUEST['dndcheck'];
$x = 0;
$sql = "SELECT * FROM notes WHERE title LIKE '%$value%'";
$sqldata = mysqli_query($dbcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
  $lineage = $row['lineage'];
  $id = $row['id'];
  if ($x < 1){
    echo ('<h2>Notes</h2>');
  }
  echo ('<div onClick="showpanel('.$row['id'].')" style="margin-bottom:10px;"><span class="greentitle" cursor:pointer;">'.$row['title'].'</span><br/>');
  echo ('<hr>');
  echo ('</div>');
  $x++;

  $sql1 = "SELECT * FROM notes WHERE lineage LIKE '%$lineage-%' && id NOT LIKE '$id'";
  $sql1data = mysqli_query($dbcon, $sql1) or die('error getting data');
  while($row1 =  mysqli_fetch_array($sql1data, MYSQLI_ASSOC)){
    $path = explode("-",$row1['lineage']);
    $pathstring = '';
    foreach ($path as $x){
      $sql2 = "SELECT * FROM notes WHERE id LIKE '$x'";
      $sql2data = mysqli_query($dbcon, $sql2) or die('error getting data');
      while($row2 =  mysqli_fetch_array($sql2data, MYSQLI_ASSOC)) { 
        $pathstring = $pathstring.'/'.$row2['title'];
      }
    }

  echo ('<div onClick=showpanel("'.$row1['id'].'")"><span class="greentitle" cursor:pointer;">'.$pathstring.'</span><br/>');
  echo ('<hr>');
  echo ('</div>');
  }
}

$y = 0;
$sql = "SELECT * FROM notes WHERE body LIKE '%$value%' ORDER BY id DESC";
$sqldata = mysqli_query($dbcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {

    $pathstring = '';

    $sublineage = $row['lineage'];
    $fullpath = explode('-',$sublineage);
    array_pop($fullpath);
    foreach($fullpath as $x){
      $sql1 = "SELECT title FROM notes WHERE id LIKE '$x'";
      $sql1data = mysqli_query($dbcon, $sql1) or die('error getting data');
      while($row1 =  mysqli_fetch_array($sql1data, MYSQLI_ASSOC)) {
        $pathstring.= $row1['title'].'/';
      }
    }
    

    if (strlen($value) >= 3){
      $body = $row['body'];
     
    // Find the position of the first newline
    $first_newline_pos = strpos($body, "\n");

    $valuepos = stripos($body,$value);
    $samplestart = $valuepos - 50;
    if ($samplestart <= 0){
      $samplestart = 0;
    }
    
    // Ensure the match happens after the first newline, or if no newline exists
    if ($first_newline_pos === false || $valuepos > $first_newline_pos) {
      $bodysample = substr($body,$samplestart);
      $title = str_ireplace($value,"<span style=\"background-color:yellow;\">$value</span>",$row['title']);
      if ($y < 1){
        echo ('<h2>References</h2>');
      }
      echo ('<div class="searchresult" onClick=showpanel("'.$row['id'].'")><span class="tealtitle" style="cursor:pointer;">'.$title.'</span><br/>');
      $y++;

  ?>
<style>
   .highlight {
	background-color:#d5e319;
	color:black;
	font-size:14px;
  }
  </style>
  <?php
  $bodysample = $Parsedown->text(str_ireplace($value,"<span class=\"highlight\">$value</span>",$bodysample));
  

  if (strpos($bodysample, $value) !== false) {
      $bodysample = preg_replace("/\<h1(.*)\>(.*)\<\/h1\>/","", $bodysample); //remove <h1>
      echo '<div class="minipath">'.$pathstring.'</div>';
      echo $bodysample;
     }

//echo ('<hr>');
echo ('</div>');
    }
  }
  
}

//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>