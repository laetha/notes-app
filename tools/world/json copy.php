
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath); ?>

<!-- Header -->
<?php
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.php";
include_once($headpath);
?>
<script>

var mysql = require('mysql');

var con = mysql.createConnection({
  host: "192.168.1.116:3306",
  user: "brian",
  password: "G0der!ch1",
  database: "dndtools_master"
});

	con.connect(function(err) {
  if (err) throw err;
  con.query("SELECT * FROM world", function (err, result, fields) {
    if (err) throw err;
    console.log(result);
  });
});
</script>

<?php
//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
