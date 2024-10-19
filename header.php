<!DOCTYPE HTML>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/style.css?<?php echo time(); ?>" />
		<link rel="stylesheet" type="text/css" href="/selectize/css/selectize.default.css" />

		<title><?php echo $pgtitle; ?>Notes</title>
	</head>
	<!--<body id="headbody" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),  url(/assets/images/bg/<?php echo $selectedBg; ?>) no-repeat center center fixed;	-webkit-background-size: cover;	-moz-background-size: cover;	-o-background-size: cover;	background-size: cover;	opacity:0.9;"> -->
	<body id="headbody">
		<script src="/jquery-3.3.1.min.js" tpye="text/javascript"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" tpye="text/javascript"></script>
		<?php
		//SQL Connect
		 $sqlpath = $_SERVER['DOCUMENT_ROOT'];
		 $sqlpath .= "/sql-connect.php";
		 include_once($sqlpath);
	?>



		<div class="container-fluid">
