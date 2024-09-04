<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$files = scandir('themes');
$files = array_diff($files, array('.', '..'));
$sql = "SELECT * FROM themes";
$sqldata = mysqli_query($dbcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
    $currenttheme = $row['current'];
    echo ('<option>'.$currenttheme.'</option>');
}
foreach($files as $file){
    $file = rtrim($file,".css");
    if ($file !== $currenttheme){
        echo ('<option id="'.$file.'">'.$file.'</option>');
    }
}

?>