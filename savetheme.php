<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$filename = $_REQUEST['filename'];
$textcolor = $_REQUEST['textColor'];
$h1color = $_REQUEST['h1Color'];
$h2color = $_REQUEST['h2Color'];
$h3color = $_REQUEST['h3Color'];
$h4color = $_REQUEST['h4Color'];
$backgroundcolor = $_REQUEST['backgroundColor'];
$navcolor = $_REQUEST['navColor'];
$strongcolor = $_REQUEST['strongColor'];
$emcolor = $_REQUEST['emColor'];
$codecolor = $_REQUEST['codeColor'];
$linkcolor = $_REQUEST['linkColor'];
$body = ':root {

    --text: '.$textcolor.';
    --h1: '.$h1color.';
    --h2:'.$h2color.';
    --h3: '.$h3color.';
    --h4: '.$h4color.';
    --main-background:'.$backgroundcolor.';
    --sidebar-background: '.$navcolor.';
    --strong: '.$strongcolor.';
    --em: '.$emcolor.';
    --code: '.$codecolor.';
    --link-text: '.$linkcolor.';

}';

  echo file_put_contents('themes/'.$filename.'.css', $body);


?>