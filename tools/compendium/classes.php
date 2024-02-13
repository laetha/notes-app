<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);
   ?>

   <div class="mainbox col-sm-10 col-xs-12 col-sm-offset-1">
  <h1 class="pagetitle">Playable Classes</h1>
<div class ="body bodytext">
      <div class="toc bodytext">
      <!-- Locations -->
      <div class="tocitem col-md-12">
      <?php
        $sqlcompendium = "SELECT title FROM compendium WHERE type LIKE 'class'";
        $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
        while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
        $entry = $row['title'];
        echo "<a href=\"compendium.php?id=$entry\">";
        echo $entry;
        echo "</a>";
        echo "<br>";
      }
        ?>
      </div>

      </div>
  </div>
</div>

<?php
//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath);
 ?>
