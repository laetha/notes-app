
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$title =$_REQUEST['title'];
$type = $_REQUEST['type'];
$user = $_REQUEST['user'];


$sql = "INSERT INTO favourites(title,type,user)
				VALUES('$title','$type','$user')";

        if ($dbcon->query($sql) === TRUE) {
					
        }
				else {

        }

//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
