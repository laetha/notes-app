
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$delid = $_REQUEST['delID'];

$sqlcompendium = "DELETE FROM fights WHERE id = $delid";


        if ($dbcon->query($sqlcompendium) === TRUE) {
        }
				else {
        }

//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
