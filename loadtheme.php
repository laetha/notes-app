<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$filename = $_REQUEST['filename'];

//$body = file_get_contents('themes/'.$filename.'.css');
$myfile = fopen('themes/'.$filename.'.css', 'r') or die("Unable to open file!");
echo fread($myfile,filesize('themes/'.$filename.'.css', 'r'));
fclose($myfile);
echo $filename;
?>