<?php

   //Header
   $pgtitle = 'Subclass - ';
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);

  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

	 $parsepath = $_SERVER['DOCUMENT_ROOT'];
	 $parsepath .= "/plugins/Parsedown.php";
	 include_once($parsepath);


	 $Parsedown = new Parsedown();


    $tmp_action = basename($_GET['id']);
          $id = $tmp_action;

?>
<div class="mainbox popout" style="background:none;">
<div class="body sidebartext col-xs-12" id="body">

<?php

          $worldtitle = "SELECT * FROM `subclasses` WHERE `name` LIKE '$id'";
          $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
          while($subrow =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
            //echo ('<h2>'.ucwords($row['type']).'</h2>');
            //$type = $row['type'];

						echo ('<h2>'.$subrow['name'].'</h2>');
						echo ('<h4>'.$subrow['source'].'</h4>');


				for ($counter = 1; $counter <= 19; $counter++) {
				$skillname = 'lvlskill'.$counter.'name';
				$skilltext = 'lvlskill'.$counter.'text';
				if(isset($subrow[$skillname])){
				echo nl2br('<h3>'.$subrow[$skillname].'</h3>');
			}
				if(isset($subrow[$skilltext])){
					echo ('<p class="subentry">');
					echo $Parsedown->text(nl2br($subrow[$skilltext]));
					echo ('</p>');
				}
		}
	}
?>
</div>
</div>

<?php
//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath);
 ?>
