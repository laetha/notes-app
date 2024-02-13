<?php
  session_start();
//SQL Connect
 $sqlpath = $_SERVER['DOCUMENT_ROOT'];
 $sqlpath .= "/sql-connect.php";
 include_once($sqlpath);

 //convert POST to normal variables
 $password = $_POST['password'];
 $username = $_POST['username'];
 $email  = $_POST['email'];

 $sql = mysql_query ("SELECT * FROM userlogin WHERE username='$username' AND $password='$password'");
 $login_check = mysql_num_rows ($sql);

if($login_check > 0) {
  while ($row = mysqli_fetch_array($sql)) {
    foreach( $row as $key => $val) {
      $$key = stripslashes($val);
    }
    session_register('client_logged_in');
    window.location('success.php');
  }

}
else {
echo ("You could not be logged in! Either the username and password do not match or you do not yet have an account."); 
}

 ?>
