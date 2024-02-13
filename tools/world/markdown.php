
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath); ?>

<!-- Header -->
<?php
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.php";
include_once($headpath);
echo ('<div class="mainbox col-lg-10 col-xs-12 col-lg-offset-1">
<div class ="body bodytext">
<h1 class="pagetitle">Markdown Exported</h1>
<div class="col-md-10 col-centered">');
$markdown = '';
$z = new ZipArchive();
$z->open('npcs.zip');
$logtitle = "SELECT * FROM world WHERE worlduser LIKE '$loguser'";
$logdata = mysqli_query($dbcon, $logtitle) or die('error getting data');
while($row =  mysqli_fetch_array($logdata, MYSQLI_ASSOC)) {
	$stripid = str_replace("'", "", $row['title']);
	$stripid = stripslashes($stripid);
	$markdown = '';
	$title = $row['title'];
	$jpgurl = 'uploads/'.$stripid.'.jpg';
	$jpegurl = 'uploads/'.$stripid.'.jpeg';
	$pngurl = 'uploads/'.$stripid.'.png';
	$webpurl = 'uploads/'.$stripid.'.webp';
	$gifurl = 'uploads/'.$stripid.'.gif';
	if ($row['type'] == "npc"){

	 $markdown .= 'Race: '.$row['npc_race'].'
Establishment: '.$row['npc_est'].'
Location: '.$row['npc_location'].'
Faction: '.$row['npc_faction'].'
Deity: '.$row['npc_deity'].'
Title: '.$row['npc_title'];
	}

	if ($row['type'] == "establishment"){
		//$tmptitle = $row['title'];
		$markdown .= 'Type: '.$row['est_type'].'
Location: '.$row['est_location'].'
Inhabitants: ';
		$safetitle = addslashes($title);
		$esttitle = "SELECT * FROM world WHERE npc_est LIKE '$safetitle'";
		$estdata = mysqli_query($dbcon, $esttitle) or die('error getting data');
		while($estrow =  mysqli_fetch_array($estdata, MYSQLI_ASSOC)) {
			$markdown .= $estrow['title'].' :: '.$estrow['npc_title'];
		}
	}
	echo $title.'<br>';

	
$markdown .= '
'.$row['body'];

if (file_exists($jpgurl)){
	$markdown .= '![](</images/'.$stripid.'.jpg>)';
 }
 if (file_exists($jpegurl)){
	$markdown .= '![](</images/'.$stripid.'.jpeg>)';
 }
 if (file_exists($pngurl)){
	$markdown .= '![](</images/'.$stripid.'.png>)';
 }
 if (file_exists($webpurl)){
	$markdown .= '![](</images/'.$stripid.'.webp>)';
 }
 if (file_exists($gifurl)){
	$markdown .= '![](</images/'.$stripid.'.gif>)';
 }
		 $npctitle1 = "SELECT title FROM world WHERE worlduser LIKE '$loguser'";
		 $npcdata1 = mysqli_query($dbcon, $npctitle1) or die('error getting data');
		 while($npcrow1 =  mysqli_fetch_array($npcdata1, MYSQLI_ASSOC)) {
			$temptitle = $npcrow1['title'];
			$newtitle = '[['.$temptitle.']]';
			if (strpos($markdown, $newtitle) == false) {
				if ($temptitle != $title){
			$markdown = str_replace($temptitle, $newtitle, $markdown);
				}
			}
		 }
		$markdown = html_entity_decode($markdown, ENT_QUOTES);
		$filename = $title.'.md';
		$bytes = file_put_contents($row['type'].'/'.$filename, $markdown);
		$z->addFile($filename);
}
		$z->close();
		echo ('<a href="'.$z.'" download><div class="btn btn-success">'.$z.'</div></a>');

	echo ('</div></div></div>');

//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>