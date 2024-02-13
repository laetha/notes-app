<?php
$pgtitle = '';

//SQL Connect
 $sqlpath = $_SERVER['DOCUMENT_ROOT'];
 $sqlpath .= "/sql-connect.php";
 include_once($sqlpath);

 include('header.php');
 ?>

<div class="mainbox col-lg-10 col-xs-12 col-lg-offset-1">
				<h1 class="pagetitle">Oops!</h1>
        <div class="bodytext col-centered">
          You're not allowed to be here!
        </div>
        <img class="col-centered" src="/assets/images/oops.jpg" />
			</div>
<?php include('footer.php'); ?>
