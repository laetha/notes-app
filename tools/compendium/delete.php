
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath); ?>

<!-- Header -->
<?php
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.php";
include_once($headpath);

// Create variables
$delid=$_POST['delete'];

//Execute the query
$sqldelete = "DELETE FROM compendium WHERE id = $delid";
        if ($dbcon->query($sqldelete) === TRUE) {
					include('compendium.php');
          include('delete-modal.php');
        }
				else {
            echo "Error: " . $sqldelete . "<br>" . $dbcon->error;
        }

//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
