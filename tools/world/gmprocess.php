
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath); ?>

<!-- Header -->
<?php
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.php";
include_once($headpath);

// Create variables
$notetemp=$_POST['gmnote'];
$note=htmlentities(trim(addslashes($notetemp)));

//Execute the query
$sql = "UPDATE gmnotes
SET note = '$note'
WHERE worlduser LIKE '$loguser'";

        if ($dbcon->query($sql) === TRUE){
					?>
					<script type="text/javascript">
    window.location = "gmnotes.php";

</script>
<?php
        }
				else {
            echo "Error: " . $sql . "<br>" . $dbcon->error;
        }


//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
