<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $pgtitle = 'Campaign Log - ';
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);
?>


<div class="mainbox col-lg-10 col-xs-12 col-lg-offset-1">
  <div class ="body bodytext">
    <h1 class="pagetitle">Login</h1>

  <div class="col-sm-6 typebox col-centered" id="name">
		<form id="login" name="login" method="post" action="auth.php">
      <div class="text">Name</div><input class="textbox" type="text" name="name" id="name" placeholder="Name...">
      <div class="text">Password</div><input class="textbox" type="text" name="password" id="password" placeholder="password...">
      <div class="text">Email</div><input class="textbox" type="text" name="email" id="email" placeholder="email...">
      <div class="col-centered">
      <input form="login" class="btn btn-primary col-centered" type="submit" value="Submit">
      </div>
    </form>



</div>
			</div>
    </div>
      <?php
      //Footer
      $footpath = $_SERVER['DOCUMENT_ROOT'];
      $footpath .= "/footer.php";
      include_once($footpath);
      ?>
