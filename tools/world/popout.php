<!DOCTYPE HTML>
<html>
	<head>
		<?php
		$sqlpath = $_SERVER['DOCUMENT_ROOT'];
		$sqlpath .= "/plugins/Parsedown.php";
		include_once($sqlpath);
		 ?>
		 <?php  $Parsedown = new Parsedown();
		 ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/style.css" />
		<link rel="stylesheet" type="text/css" href="/selectize/css/selectize.default.css" />
    <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville:700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="/tools/compendium/statblock.css" rel="stylesheet" type="text/css">

       <?php
       //SQL Connect
        $sqlpath = $_SERVER['DOCUMENT_ROOT'];
        $sqlpath .= "/sql-connect.php";
        include_once($sqlpath);
        $pgtitle = $_GET['id'];
        ?>
		<title><?php echo $pgtitle; ?> - RPG Tools</title>
	</head>
	<body class="sidebartext" style="min-width: 0px; background: none transparent;">
		<div style="background: none transparent;">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" tpye="text/javascript"></script>
		<!--<script src="http://code.jquery.com/jquery-1.8.3.js" tpye="text/javascript"></script>-->
		<script src="/selectize/js/standalone/selectize.min.js" tpye="text/javascript"></script>
		<script src="/selectize/js/list.js" tpye="text/javascript"></script>
		<!--<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js" tpye="text/javascript"></script>-->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" tpye="text/javascript"></script>
<?php
    $tmp_action = basename($_GET['id']);
          $id = $tmp_action;
					$id = addslashes($id);

          $worldtitle = "SELECT * FROM `compendium` WHERE `title` LIKE '%$id%'";
          $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
          while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
            //echo ('<h2>'.ucwords($row['type']).'</h2>');
            $type = $row['type'];
            echo ('<h3 style="color: #5499c7;">'.$row['title'].'</h3><br />');

          if($type == 'item'){

            echo ('<strong>Type: '.ucwords($row['itemType']).'</strong><br />');
            if($row['itemMagic'] == 1){
              echo ('Magic Item, '.$row['itemDetail'].'<br />');
            }
            if($row['itemWeight'] != ''){
              echo ('Weight: '.$row['itemWeight'].'lbs.<br />');
            }
            /*if($row['itemValue'] != ''){
              echo ('Cost: '.$row['itemValue'].'gp<br />');
            }*/
            if($row['itemRange'] != ''){
              echo ('Range: '.$row['itemRange'].'<br />');
            }
            if($row['itemStrength'] != ''){
              echo ('Strength Requirement: '.$row['itemStrength'].'<br />');
            }
            if($row['itemStealth'] != ''){
              echo ('Stealth: Disadvantage<br />');
            }
            echo nl2br('<p></p><div class="sidebartext">'.$row['text'].'</div>');
            $sidebartype = $row['type'];
            }


}

$worldtitle = "SELECT * FROM `world` WHERE `title` LIKE '%$id%'";
$titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
	if ($row['type'] == 'npc') {

	$stripid = str_replace("'", "", $id);
  $stripid = stripslashes($stripid);
	$jpgurl = 'uploads/'.$stripid.'.jpg';
	$pngurl = 'uploads/'.$stripid.'.png';
	if (file_exists($jpgurl)){
		echo ('<div class="col-md-6">');
	}
	else if (file_exists($pngurl)){
		echo ('<div class="col-md-6">');
	}
	echo ('<h3 style="color: #5499c7;">'.$row['title'].'</h3><br />');

	echo('Race: '.$row['npc_race'].'<br />');
	echo('Establishment: '.$row['npc_est'].'<br />');
	echo('Location: '.$row['npc_location'].'<br />');
	echo('Faction: '.$row['npc_faction'].'<br />');
	echo('Deity: '.$row['npc_deity'].'<br />');
	echo('Title: '.$row['npc_title'].'<br />');
	echo ('<p>'.$Parsedown->text(nl2br($row['body'])).'</p>');
	echo ('</div>');

if (file_exists($jpgurl)){
echo ('</div>');
}
else if (file_exists($pngurl)){
echo ('</div>');
}

}

if (file_exists($jpgurl)){
echo('<div class="col-md-6">');
echo ('<div class="npcimg-container">');
echo ('<img class="npcimg" src="uploads/'.$stripid.'.jpg" />'); ?>
</div>
</div>


<?php
}

else if (file_exists($pngurl)){
echo('<div class="col-md-6">');
echo ('<div class="npcimg-container">');
echo ('<img class="npcimg" src="uploads/'.$stripid.'.png" />');
?>

</div>
</div>



<?php

}

}
?>

</div>
</body>
</html>
