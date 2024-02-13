<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $pgtitle = 'All - ';
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);
   /*if ($loguser !== 'tarfuin') {
   echo ('<script>window.location.replace("/oops.php"); </script>');
 }*/
   ?>
   <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.js" type="text/javascript"></script>
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">
  <script>
  $(function () {
  $('[data-toggle="popover"]').popover()
})</script>
   <div class="mainbox col-lg-10 col-xs-12 col-lg-offset-1">

     <!-- Page Header -->
     <div class="col-md-12">
     <div class="pagetitle" id="pgtitle">Search</div>


   </div>
     <div class="body sidebartext col-xs-12" id="body">
       
     <select id="search1">
					<option value=""></option>
					<?php
					//if ($loguser == 'tarfuin') {
					$searchdrop = "SELECT title FROM world WHERE worlduser LIKE '$loguser'";
					$searchdata = mysqli_query($dbcon, $searchdrop) or die('error getting data');
					while($searchrow =  mysqli_fetch_array($searchdata, MYSQLI_ASSOC)) {
						$search = $searchrow['title'];
						$searchvalue = $search.'1';
						echo "<option value=\"$searchvalue\">$search</option>";
					}
          $searchdrop = "SELECT title FROM world WHERE worlduser LIKE '$loguser'";
					$searchdata = mysqli_query($dbcon, $searchdrop) or die('error getting data');
					while($searchrow =  mysqli_fetch_array($searchdata, MYSQLI_ASSOC)) {
						$search = $searchrow['title'];
						$searchvalue = $search.'1';
						echo "<option value=\"$searchvalue\">$search</option>";
					}
				//}
					?>
					
					</select>

</div>
</div>
</div>

<script type="text/javascript">
				$('#search1').selectize({
				onChange: function(value){
					if(value.slice(-1) == 1) {
					window.location.href = '/tools/world/world.php?id=' + value.slice(0, -1);
				}
				else if(value.slice(-1) == 2) {

					window.location.href = '/tools/compendium/compendium.php?id=' + value.slice(0, -1);
				}
				else {

					window.location.href = '/tools/srd/rules.php?id=' + value.slice(0, -1);
				}
				},
				create: false,
				openOnFocus: false,
				maxOpions: 4,
				sortField: 'text',
				placeholder: 'search...'
				},);
				</script>
   <?php
   //Footer
   $footpath = $_SERVER['DOCUMENT_ROOT'];
   $footpath .= "/footer.php";
   include_once($footpath);
    ?>
