
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath); ?>

<!-- Header -->
<?php
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.php";
include_once($headpath);

//Execute the query
$sql = "LOAD XML LOCAL INFILE 'xml/Output1.xml'
  INTO TABLE quests
  ROWS IDENTIFIED BY '<entry>'";

        if ($dbcon->query($sql) === TRUE) {
					include('success.php');
					include('import.php');
        }
				else {
            echo "Error: " . $sql . "<br>" . $dbcon->error;
        }
//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
