<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);
   $pgtitle = $_GET['id'].' - ';
   if(empty($_GET['id'])) {
     $pgtitle = 'World Building - ';
   }
   //Header
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);

//Display specific page or Table of Contents
$id = "index";
$disallowed_paths = array('header', 'footer');
if (!empty($_GET['id'])) {
  $tmp_action = basename($_GET['id']);
  if (!in_array($tmp_action, $disallowed_paths) /*&& file_exists("world/{$tmp_action}.php")*/)
        $id = $tmp_action;
  include("index.php");
  }
if (empty($_GET['id'])) {
  include('toc.php');

}
//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath);
?>
