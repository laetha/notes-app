<!-- SQL Connect -->
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);


$locationdrop = "SELECT 'body' FROM 'quests' ORDER BY rand() LIMIT 1";
              $locationdata = mysqli_query($dbcon, $locationdrop) or die('error getting data');
              while($locationrow =  mysqli_fetch_array($locationdata, MYSQLI_ASSOC)) {
                $body = $locationrow['body'];
              }
      
//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
