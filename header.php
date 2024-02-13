<!DOCTYPE HTML>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/style.css" />
		<link rel="stylesheet" type="text/css" href="/selectize/css/selectize.default.css" />

		<title><?php echo $pgtitle; ?>Notes</title>
		<?php
		/*$handle = opendir(dirname(realpath(__FILE__)).'/assets/images/bg/');
		while( $entry = readdir($handle) )
		{
		    if( $entry != '.' && $entry != '..' )
		    {
		        $files[] = $entry;
		    }
		}

		closedir($handle);

		sort($files);

		  $i = rand(0, count($files)-1); // generate random number size of the array
		  $selectedBg = "$files[$i]"; // set variable equal to which random filename was chosen
	*/	?>
	</head>
	<!--<body id="headbody" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),  url(/assets/images/bg/<?php echo $selectedBg; ?>) no-repeat center center fixed;	-webkit-background-size: cover;	-moz-background-size: cover;	-o-background-size: cover;	background-size: cover;	opacity:0.9;"> -->
	<body id="headbody" style="background-color: #2d2d2d; opacity: 0.8;">
		<script src="/jquery-3.3.1.min.js" tpye="text/javascript"></script>
		<!--<script src="http://code.jquery.com/jquery-1.8.3.js" tpye="text/javascript"></script>-->
		<script src="/selectize/js/standalone/selectize.min.js" tpye="text/javascript"></script>
		<script src="/selectize/js/list.js" tpye="text/javascript"></script>
		<!--<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js" tpye="text/javascript"></script>-->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" tpye="text/javascript"></script>
		<script src="/plugins/Do-Math-Within-Input-jQuery-Abacus\jquery.abacus.min.js"></script>
		<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
		<script src="/plugins/simplemde-markdown-editor/dist/simplemde.min.js"></script>
		<?php
		//SQL Connect
		 $sqlpath = $_SERVER['DOCUMENT_ROOT'];
		 $sqlpath .= "/sql-connect.php";
		 include_once($sqlpath);
	?>



		<div class="container-fluid">
