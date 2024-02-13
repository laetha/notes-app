<!DOCTYPE HTML>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/style.css" />
		<link rel="stylesheet" type="text/css" href="/selectize/css/selectize.default.css" />

			<!-- This code is to prevent FOUC -->
			<script type="text/javascript">
		    $('html').addClass('hidden');
		    $(window).on('load', function () {
		    $('html').removeClass('hidden');
		     });
		   </script>

		<title><?php echo $pgtitle; ?>RPG Tools</title>
	
	</head>
	<body style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),  url(/assets/images/bg/<?php echo $selectedBg; ?>) no-repeat center center fixed;	-webkit-background-size: cover;	-moz-background-size: cover;	-o-background-size: cover;	background-size: cover;	opacity:0.9;">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" tpye="text/javascript"></script>
		<!--<script src="http://code.jquery.com/jquery-1.8.3.js" tpye="text/javascript"></script>-->
		<script src="/selectize/js/standalone/selectize.min.js" tpye="text/javascript"></script>
		<script src="/selectize/js/list.js" tpye="text/javascript"></script>
		<!--<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js" tpye="text/javascript"></script>-->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" tpye="text/javascript"></script>
		<script src="/plugins/Do-Math-Within-Input-jQuery-Abacus\jquery.abacus.min.js"></script>

		<?php
		//SQL Connect
		 $sqlpath = $_SERVER['DOCUMENT_ROOT'];
		 $sqlpath .= "/sql-connect.php";
		 include_once($sqlpath);
		 ?>
		 <link rel="stylesheet" type="text/css" href="/navbar.css" />
     <div class="container-fluid">
   <?php

//Display specific page or Table of Contents
$id = "index";
$disallowed_paths = array('header', 'footer');
if (!empty($_GET['id'])) {
  $tmp_action = basename($_GET['id']);
  if (!in_array($tmp_action, $disallowed_paths) /*&& file_exists("world/{$tmp_action}.php")*/)
        $id = $tmp_action;
  include("index.php");
  }
if (empty($_GET['id'])) {
  include('toc.php');

}
//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath);
?>
