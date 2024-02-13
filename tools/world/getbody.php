<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);
$parsepath = $_SERVER['DOCUMENT_ROOT'];
$parsepath .= "/plugins/Parsedown.php";
include_once($parsepath);
$Parsedown = new Parsedown();

$bodyID = $_REQUEST['bodyID'];

/*if ($bodyID == 'regionmap'){
  echo ('<iframe src="map-region.php" style="width:100%; height:800px;"/>');
}
else if ($bodyID == 'thepike'){
  echo ('<img src="/assets/images/The Pike.webp" width="80%" />');
}*/

//else {
$sql = "SELECT * FROM world WHERE id = $bodyID";
$sqldata = mysqli_query($dbcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {

  $body = '';
  $stripid = str_replace("'", "", $row['title']);
  $stripid = stripslashes($stripid);
    
    $jpgurl = 'uploads/'.$stripid.'.jpg';
    $pngurl = 'uploads/'.$stripid.'.png';
    $webpurl = 'uploads/'.$stripid.'.webp';
    $gifurl = 'uploads/'.$stripid.'.gif';
    $imgdir = 'uploads/'.$stripid.'/';

  echo ('<h2><a href="world.php?id='.$row['title'].'" target="_BLANK">'.$row['title'].'</a></h2>');
  echo ('<div id="getbodycontent">');
  if ($row['type'] == 'session note'){
    echo ('<button class="btn btn-info" onClick="editNote('.$row['id'].')">Edit</button>');
  }


  if (file_exists($jpgurl)){
    echo ('<span class="d-inline-block hovershow" data-placement="auto" data-toggle="popover" data-content=\'<img src="uploads/'.$stripid.'.jpg" width="300px">\'>');
    echo ('<button class="btn btn-info" id="imgshow" onClick="imgshow()">Show Image</button></span><br>');
    echo ('<div class="nonav" id="img">');
    echo ('<img class="npcimg" src="uploads/'.$stripid.'.jpg" />');
    echo ('</div>');
  }
  if (file_exists($pngurl)){
    echo ('<span class="d-inline-block hovershow" data-placement="auto" data-toggle="popover" data-content=\'<img src="uploads/'.$stripid.'.png" width="300px">\'>');
    echo ('<button class="btn btn-info" id="imgshow" onClick="imgshow()">Show Image</button></span><br>');
    echo ('<div class="nonav" id="img">');
    echo ('<img class="npcimg" src="uploads/'.$stripid.'.png" />');
    echo ('</div>');
  }
  if (file_exists($webpurl)){
    echo ('<span class="d-inline-block hovershow" data-placement="auto" data-toggle="popover" data-content=\'<img src="uploads/'.$stripid.'.webp" width="300px">\'>');
    echo ('<button class="btn btn-info" id="imgshow" onClick="imgshow()">Show Image</button></span><br>');
    echo ('<div class="nonav" id="img">');
    echo ('<img class="npcimg" src="uploads/'.$stripid.'.webp" />');
    echo ('</div>');
  }
  if (file_exists($gifurl)){
    echo ('<span class="d-inline-block hovershow" data-placement="auto" data-toggle="popover" data-content=\'<img src="uploads/'.$stripid.'.gif" width="300px">\'>');
    echo ('<button class="btn btn-info" id="imgshow" onClick="imgshow()">Show Image</button></span><br>');
    echo ('<div class="nonav" id="img">');
    echo ('<img class="npcimg" src="uploads/'.$stripid.'.gif" />');
    echo ('</div>');
  }
  
  $body = $row['body'];
  $npclocation = $row['npc_location'];
  $npcfaction = $row['npc_faction'];
  $npcdeity = $row['npc_deity'];
  $npcest = $row['npc_est'];
  $npctitle = $row['npc_title'];
  $esttype = $row['est_type'];
  $estlocation = $row['est_location'];
  $locnpcs = array();
  $estnpcs = array();

  $sql1 = "SELECT * FROM world WHERE worlduser LIKE 'tarfuin' AND title NOT LIKE ''";
$sql1data = mysqli_query($dbcon, $sql1) or die('error getting data');
while($row1 =  mysqli_fetch_array($sql1data, MYSQLI_ASSOC)) {
  if ($row1['title'] !== $row['title']){

  $pattern = "/<span[\S\s]+?<\/span>(*SKIP)(*FAIL)|\b".$row1['title']."\b/i";

  $body = preg_replace($pattern,'<span class="d-inline-block hovershow" data-placement="auto" data-toggle="popover" data-content="'.nl2br($row1['body']).'"><a href="world.php?id='.$row1['title'].'" target="_BLANK">'.$row1['title'].'</a></span>',$body);
  $npclocation = preg_replace($pattern,'<span class="d-inline-block hovershow" data-placement="auto" data-toggle="popover" data-content="'.nl2br($row1['body']).'"><a href="world.php?id='.$row1['title'].'" target="_BLANK">'.$row1['title'].'</a></span>',$npclocation);
  $npcfaction = preg_replace($pattern,'<span class="d-inline-block hovershow" data-placement="auto" data-toggle="popover" data-content="'.nl2br($row1['body']).'"><a href="world.php?id='.$row1['title'].'" target="_BLANK">'.$row1['title'].'</a></span>',$npcfaction);
  $npcdeity = preg_replace($pattern,'<span class="d-inline-block hovershow" data-placement="auto" data-toggle="popover" data-content="'.nl2br($row1['body']).'"><a href="world.php?id='.$row1['title'].'" target="_BLANK">'.$row1['title'].'</a></span>',$npcdeity);
  $npcest = preg_replace($pattern,'<span class="d-inline-block hovershow" data-placement="auto" data-toggle="popover" data-content="'.nl2br($row1['body']).'"><a href="world.php?id='.$row1['title'].'" target="_BLANK">'.$row1['title'].'</a></span>',$npcest);
  $esttype = preg_replace($pattern,'<span class="d-inline-block hovershow" data-placement="auto" data-toggle="popover" data-content="'.nl2br($row1['body']).'"><a href="world.php?id='.$row1['title'].'" target="_BLANK">'.$row1['title'].'</a></span>',$esttype);
  $estlocation = preg_replace($pattern,'<span class="d-inline-block hovershow" data-placement="auto" data-toggle="popover" data-content="'.nl2br($row1['body']).'"><a href="world.php?id='.$row1['title'].'" target="_BLANK">'.$row1['title'].'</a></span>',$estlocation);
  $npclink = ('<span class="d-inline-block hovershow" data-placement="auto" data-toggle="popover" data-content="'.nl2br($row1['body']).'"><a href="world.php?id='.$row1['title'].'" target="_BLANK">'.$row1['title'].'</a> :: '.$row1['npc_title'].'</span>');
  $estlink = ('<span class="d-inline-block hovershow" data-placement="auto" data-toggle="popover" data-content="'.nl2br($row1['body']).'"><a href="world.php?id='.$row1['title'].'" target="_BLANK">'.$row1['title'].'</a> :: '.$row1['npc_title'].'</span>');
  
  if ($row['type'] == 'location'){
      if ($row1['npc_location'] == $row['title']){
        array_push($locnpcs,$npclink);
      }
    }
    if ($row['type'] == 'establishment'){
      if ($row1['npc_est'] == $row['title']){
        array_push($estnpcs,$estlink);
      }
    }

  }
}
if ($row['type'] == 'npc'){
  echo ('<b>Race:</b> '.$row['npc_race'].'<p>');
  echo ('<b>Occupation:</b> '.$row['npc_title'].'<p>');
  echo ('<b>Location:</b> '.$npclocation.'<p>');
  echo ('<b>Group/Faction:</b> '.$npcfaction.'<p>');
  echo ('<b>Deity:</b> '.$npcdeity.'<p>');
  echo ('<b>Establishment:</b> '.$npcest.'<p>');
  echo ('<b>Title:</b> '.$npctitle.'<p>');

}
if ($row['type'] == 'establishment'){
  echo ('<b>Type:</b> '.$esttype.'<p>');
  echo ('<b>Location:</b> '.$estlocation.'<p>');
}

  $Parsedown->setBreaksEnabled(true);
  echo $Parsedown->text(htmlspecialchars_decode($body));

if ($row['type'] == 'location'){
  echo ('<h3>Key NPCs: </h3>');
  for ($x = 0; $x <= count($locnpcs); $x++) {
    echo '<div class="col-sm-4">'.$locnpcs[$x].'</div>';
  }
}
if ($row['type'] == 'establishment'){
  echo ('<h3>Inhabitants: </h3>');
  for ($x = 0; $x <= count($estnpcs); $x++) {
    echo '<div class="col-sm-4">'.$estnpcs[$x].'</div>';
  }
}
$files = scandir($imgdir.'/');
if (is_dir($imgdir)){
  echo '<h4>Images</h4>';
foreach($files as $file) {
  if (str_contains($file,'.jpg') || str_contains($file,'.jpeg') || str_contains($file,'.png') || str_contains($file,'.webp')){
  echo '<img src="'.$imgdir.'/'.$file.'" width="300px" />';
  }
}
}
  echo ('</div>');
}
//}
//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>