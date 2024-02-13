
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath); ?>

<!-- Header -->
<?php
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.php";
include_once($headpath);
$worldname = $_GET['id'];
$json = '{
	"_meta": {
		"sources": [
			{
				"json": "PIKE",
				"abbreviation": "PIKE",
				"full": "The Pike",
				"version": "1.0.0",
				"authors": [
					"Laetha"
				],
				"convertedBy": [
					"Laetha"
				]
			}
		]
	},
"monster": [';
	$logtitle = "SELECT * FROM world WHERE worlduser LIKE '$loguser' AND title NOT LIKE '' AND type LIKE 'npc'";
	$logdata = mysqli_query($dbcon, $logtitle) or die('error getting data');
	while($row =  mysqli_fetch_array($logdata, MYSQLI_ASSOC)) {
		$json = $json.'
		{
			"name":"'.$row['title'].'",
			"source":"PIKE",
				"size":"M",
				"type":"none",
				"ac":[
					{
						"ac": 14,
						"from": ["{@item studded leather armor|phb|studded leather}"]
					}
				],
				"hp":
				{
					"average": 11,
					"formula": "2d8 + 2"},
				"speed":
				{
					"walk":30
				},
				"isnpc":true
			}';
		//$item->entries = $row['title'];
		//$json=$json.json_encode($item);
		$json=$json.',';
}
$json = rtrim($json, ",");
$json=$json.'
	]
}';

	$filename = $worldname.'.json';
	$bytes = file_put_contents($filename, $json);
	echo ('<div class="mainbox col-lg-10 col-xs-12 col-lg-offset-1">
    <div class ="body bodytext">
  <h1 class="pagetitle">JSON Exported</h1>
<div class="col-md-10 col-centered">');
	echo ('<a href="'.$filename.'" download><div class="btn btn-success">'.$filename.'</div></a>');
	echo ('</div></div></div>');

//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
