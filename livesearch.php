
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$value = $_REQUEST['value'];
$dndcheck = $_REQUEST['dndcheck'];
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

if ($dndcheck == 'true'){

$sql = "SELECT * FROM world WHERE title LIKE '%$value%' AND worlduser LIKE 'tarfuin'";
$sqldata = mysqli_query($dndcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
  echo ('<div class="greentitle" onClick="showDnD(\''.$row['title'].'\')">'.$row['title']);
  //echo ('<a class="livesearch" href="https://dnd.bkconnor.com/tools/world/world.php?id='.$row['title'].'" target="_BLANK""><div><span class="greentitle" style="font-size:18px; cursor:pointer;">'.$row['title'].'</span><br/>');
  echo ('<hr>');
  echo ('</div>');
}


$sql = "SELECT * FROM world WHERE body LIKE '%$value%' OR npc_faction LIKE '%$value%' OR npc_location LIKE '%$value%' OR npc_deity LIKE '%$value%' OR npc_est LIKE '%$value%' OR est_type LIKE '%$value%' OR est_location LIKE '%$value%' OR npc_title LIKE '%$value%' ORDER BY id DESC";
$sqldata = mysqli_query($dndcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {

  if ($row['worlduser'] == 'tarfuin'){
    if (strlen($value) >= 3){
    $body = $row['body'];
    $npcfaction = $row['npc_faction'];
    $npclocation = $row['npc_location'];
    $npcdeity = $row['npc_deity'];
    $npcest = $row['npc_est'];
    $esttype = $row['est_type'];
    $estlocation = $row['est_location'];
    $npctitle = $row['npc_title'];




    $valuepos = stripos($body,$value);
    $samplestart = $valuepos - 50;
    if ($samplestart <= 0){
      $samplestart = 0;
    }
    //$sampleend = $valuepos + 50;
    $bodysample = substr($body,$samplestart, 200);
    $title = str_ireplace($value,"<span style=\"background-color:yellow;\">$value</span>",$row['title']);
    echo ('<div class="greentitle" onClick="showDnD(\''.$row['title'].'\')">'.$row['title']);
    echo ('<span class="livesearch">');
  //echo ('<a class="livesearch" href="https://dnd.bkconnor.com/tools/world/world.php?id='.$row['title'].'" target="_BLANK"><div><span class="greentitle" style="cursor:pointer;">'.$title.'</span><br/>');
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
  $npclocation = str_ireplace($value,"<span class=\"highlight\">$value</span>",$npclocation);
  $npcfaction = str_ireplace($value,"<span class=\"highlight\">$value</span>",$npcfaction);
  $npcdeity = str_ireplace($value,"<span class=\"highlight\">$value</span>",$npcdeity);
  $npcest = str_ireplace($value,"<span class=\"highlight\">$value</span>",$npcest);
  $esttype = str_ireplace($value,"<span class=\"highlight\">$value</span>",$esttype);
  $estloction = str_ireplace($value,"<span class=\"highlight\">$value</span>",$estloction);
  $npctitle = str_ireplace($value,"<span class=\"highlight\">$value</span>",$npctitle);





  if (strpos($npclocation, $value) !== false) {
        echo ('Location: '.$npclocation.'<br/>');
  }
  if (strpos($npcfaction, $value) !== false) {
      echo ('Faction: '.$npcfaction.'<br/>');
  }
  if (strpos($npcdeity, $value) !== false) {
    echo ('Deity: '.$npcdeity.'<br/>');
}
if (strpos($npcest, $value) !== false) {
  echo ('Establishment: '.$npcest.'<br/>');
}
if (strpos($esttype, $value) !== false) {
  echo ('Type: '.$esttype.'<br/>');
}
if (strpos($estloction, $value) !== false) {
  echo ('Location: '.$estloction.'<br/>');
}
if (strpos($npctitle, $value) !== false) {
  echo ('Title: '.$npctitle.'<br/>');
}



  if (strpos($bodysample, $value) !== false) {
      echo $bodysample;
     }
echo ('<hr>');
echo ('</span></div>');
    }
  }
  
}
}



//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>