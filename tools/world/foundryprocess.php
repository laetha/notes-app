
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath); ?>

<!-- Header -->
<?php
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.php";
include_once($headpath);
$json = file_get_contents($_FILES["fileToUpload1"]["tmp_name"]);
echo ('<div id="worlduser" style="display:none;">'.$loguser.'</div>');
echo ('<div id="theStuff" style="display:none;">');
echo $json;
echo ('</div>');
echo ('<div class="sidebartext" id="rawData">hello</div>');
?>
<script>
	 $(document).ready(function() {
		 var theStuff = $('#theStuff');
		//var rawData = $('#rawData').html();
		var realDate = theStuff.find('h1');
		realDate = $(realDate).html();
		//var realDate = logDate[0].innerHTML;
		realDate = realDate.substr(0, realDate.indexOf(' Session'));
		var entries = theStuff.find('li').text();
		var allEntries = theStuff.find('li').map(function () {
        return $(this).text();
    }).get().join('|');

	var entryList = theStuff.find('li').map(function () {
        return $(this).text();
    }).get().join('<br>');
    //alert(option_all);
		//.toArray();	
		//entries = entries.join("|");
		//entries = $(entries).text();
  		//$('#rawData').html(entries[1]);
		worldUser = $('#worlduser').html();
		  
		  $.ajax({
   type: "GET",
   data: {"entries":allEntries, "date":realDate, "worlduser":worldUser},
   url: "foundrylog.php",
   success: function(){
	$('#rawData').html('Successfully Imported!<p>Date: '+ realDate + '<p>Entries: <br />' + entryList);
   }
  //var x = theStuff.getElementsByTagName("LI");
  //document.getElementById("rawData").innerHTML = x[0].innerHTML;
	 });
	 });
</script>
