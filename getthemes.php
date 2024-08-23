<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$files = scandir('themes');
$files = array_diff($files, array('.', '..'));
foreach($files as $file){
    $file = trim($file,"theme-");
    $file = rtrim($file,".css");
    echo ('<option>'.$file.'</option>');
}

?>