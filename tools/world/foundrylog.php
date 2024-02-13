
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$worlduser =$_REQUEST['worlduser'];
$date = $_REQUEST['date'];
$entries = $_REQUEST['entries'];
$entries = (explode("|",$entries));
$active = 1;
$coord = '';
$maptype = 'city';

foreach($entries as $entry){
  $sql = "INSERT INTO campaignlog(worlduser,date,entry,active,coord,maptype)
				VALUES('$worlduser','$date','$entry','$active','$coord','$maptype')";

        if ($dbcon->query($sql) === TRUE) {
          
          echo ('<li>'.$entry.'</li>');
        }
				else {
          echo "Error: " . $sql . "<br>" . $dbcon->error;
        }
      }
//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>