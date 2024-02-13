
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath); ?>

<!-- Header -->
<?php
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.php";
include_once($headpath);

//Execute the query
$sqldelete = "TRUNCATE TABLE savedencounters";
        if ($dbcon->query($sqldelete) === TRUE) { ?>
<script>
          window.location.href = '/tools/campaign-log/campaign-log.php';
</script>


<?php
        }
				else {
            echo "Error: " . $sqldelete . "<br>" . $dbcon->error;
        }

//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
