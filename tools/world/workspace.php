<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

     $pgtitle = 'Workspace - ';

   //Header
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);


?>
<div class="mainbox">
  <div class="row">
  <button class="btn btn-info" id="notesbutton" onclick ="displayToggle()">Toggle Display</button>
  <script>
  function displayToggle() {
    document.getElementById('area4');
    if (area4.style.display === 'none') {
      area4.style.display = "block";
      document.getElementById('area1').className = "col-md-4";

    }
    else {
    area4.style.display = "none";
    document.getElementById('area1').className = "col-md-8";
  }
  }
  </script>
</div>

  <style>
  .col-md-4 {
    padding-left: 0px;
    padding-right: 0px;
  }
  .navbar {
    margin-bottom: 0px;
  }
  </style>
  <div class="col-md-4" id="area1">
  <select id="search1">
    <option value=""></option>
<option value="awardxp4">Award XP</option>
<option value="gmnotes5">GM Notes</option>
<option value="campaignlog6">Campaign Log</option>
<option value="generator7">Random Generator</option>
<option value="Initiative8">Initiative</option>   <?php
  $searchdrop = "SELECT title FROM world WHERE worlduser LIKE '$loguser'";
  $searchdata = mysqli_query($dbcon, $searchdrop) or die('error getting data');
  while($searchrow =  mysqli_fetch_array($searchdata, MYSQLI_ASSOC)) {
    $search = $searchrow['title'];
    $searchvalue = $search.'1';
    echo "<option value=\"$searchvalue\">$search</option>";
  }
  ?>
  <?php
  $searchdrop1 = "SELECT title FROM compendium";
  $searchdata1 = mysqli_query($dbcon, $searchdrop1) or die('error getting data');
  while($searchrow1 =  mysqli_fetch_array($searchdata1, MYSQLI_ASSOC)) {
    $search1 = $searchrow1['title'];
    $searchvalue1 = $search1.'2';
    echo "<option value=\"$searchvalue1\">$search1</option>";
  }
  ?>
  <?php
  $searchdrop2 = "SELECT title FROM srd";
  $searchdata2 = mysqli_query($dbcon, $searchdrop2) or die('error getting data');
  while($searchrow2 =  mysqli_fetch_array($searchdata2, MYSQLI_ASSOC)) {
    $search2 = $searchrow2['title'];
    $searchvalue2 = $search2.'3';
    echo "<option value=\"$searchvalue2\">Rules: $search2</option>";
  }
  ?>
  </select>
  <div id="box1"><iframe class="blockframetall" id="frame1"></iframe></div>
</div>


<div class="col-md-4">
<select id="search2">
<option value=""></option>
<option value="awardxp4">Award XP</option>
<option value="gmnotes5">GM Notes</option>
<option value="campaignlog6">Campaign Log</option>
<option value="generator7">Random Generator</option>
<option value="Initiative8">Initiative</option><?php
$searchdrop = "SELECT title FROM world WHERE worlduser LIKE '$loguser'";
$searchdata = mysqli_query($dbcon, $searchdrop) or die('error getting data');
while($searchrow =  mysqli_fetch_array($searchdata, MYSQLI_ASSOC)) {
  $search = $searchrow['title'];
  $searchvalue = $search.'1';
  echo "<option value=\"$searchvalue\">$search</option>";
}
?>
<?php
$searchdrop1 = "SELECT title FROM compendium";
$searchdata1 = mysqli_query($dbcon, $searchdrop1) or die('error getting data');
while($searchrow1 =  mysqli_fetch_array($searchdata1, MYSQLI_ASSOC)) {
  $search1 = $searchrow1['title'];
  $searchvalue1 = $search1.'2';
  echo "<option value=\"$searchvalue1\">$search1</option>";
}
?>
<?php
$searchdrop2 = "SELECT title FROM srd";
$searchdata2 = mysqli_query($dbcon, $searchdrop2) or die('error getting data');
while($searchrow2 =  mysqli_fetch_array($searchdata2, MYSQLI_ASSOC)) {
  $search2 = $searchrow2['title'];
  $searchvalue2 = $search2.'3';
  echo "<option value=\"$searchvalue2\">Rules: $search2</option>";
}
?>
</select>
<div id="box2"><iframe class="blockframe" id="frame2"></iframe></div>



<select id="search3">
<option value=""></option>
<option value="awardxp4">Award XP</option>
<option value="gmnotes5">GM Notes</option>
<option value="campaignlog6">Campaign Log</option>
<option value="generator7">Random Generator</option>
<option value="Initiative8">Initiative</option><?php
$searchdrop = "SELECT title FROM world WHERE worlduser LIKE '$loguser'";
$searchdata = mysqli_query($dbcon, $searchdrop) or die('error getting data');
while($searchrow =  mysqli_fetch_array($searchdata, MYSQLI_ASSOC)) {
  $search = $searchrow['title'];
  $searchvalue = $search.'1';
  echo "<option value=\"$searchvalue\">$search</option>";
}
?>
<?php
$searchdrop1 = "SELECT title FROM compendium";
$searchdata1 = mysqli_query($dbcon, $searchdrop1) or die('error getting data');
while($searchrow1 =  mysqli_fetch_array($searchdata1, MYSQLI_ASSOC)) {
  $search1 = $searchrow1['title'];
  $searchvalue1 = $search1.'2';
  echo "<option value=\"$searchvalue1\">$search1</option>";
}
?>
<?php
$searchdrop2 = "SELECT title FROM srd";
$searchdata2 = mysqli_query($dbcon, $searchdrop2) or die('error getting data');
while($searchrow2 =  mysqli_fetch_array($searchdata2, MYSQLI_ASSOC)) {
  $search2 = $searchrow2['title'];
  $searchvalue2 = $search2.'3';
  echo "<option value=\"$searchvalue2\">Rules: $search2</option>";
}
?>
</select>
<div id="box3"><iframe class="blockframe" id="frame3"></iframe></div>

</div>

<div class="col-md-4" id="area4">
<select id="search4">
<option value=""></option>
<option value="awardxp4">Award XP</option>
<option value="gmnotes5">GM Notes</option>
<option value="campaignlog6">Campaign Log</option>
<option value="generator7">Random Generator</option>
<option value="Initiative8">Initiative</option><?php
$searchdrop = "SELECT title FROM world WHERE worlduser LIKE '$loguser'";
$searchdata = mysqli_query($dbcon, $searchdrop) or die('error getting data');
while($searchrow =  mysqli_fetch_array($searchdata, MYSQLI_ASSOC)) {
  $search = $searchrow['title'];
  $searchvalue = $search.'1';
  echo "<option value=\"$searchvalue\">$search</option>";
}
?>
<?php
$searchdrop1 = "SELECT title FROM compendium";
$searchdata1 = mysqli_query($dbcon, $searchdrop1) or die('error getting data');
while($searchrow1 =  mysqli_fetch_array($searchdata1, MYSQLI_ASSOC)) {
  $search1 = $searchrow1['title'];
  $searchvalue1 = $search1.'2';
  echo "<option value=\"$searchvalue1\">$search1</option>";
}
?>
<?php
$searchdrop2 = "SELECT title FROM srd";
$searchdata2 = mysqli_query($dbcon, $searchdrop2) or die('error getting data');
while($searchrow2 =  mysqli_fetch_array($searchdata2, MYSQLI_ASSOC)) {
  $search2 = $searchrow2['title'];
  $searchvalue2 = $search2.'3';
  echo "<option value=\"$searchvalue2\">Rules: $search2</option>";
}
?>
</select>
<div id="box4"><iframe class="blockframetall" id="frame4"></iframe></div>

</div>


  <script type="text/javascript">
    function nonav() {
      document.getElementById('frame1').contentWindow.document.getElementById('nonav').style.display = "none";
      document.getElementById('frame2').contentWindow.document.getElementById('nonav').style.display = "none";
      document.getElementById('frame3').contentWindow.document.getElementById('nonav').style.display = "none";
      document.getElementById('frame4').contentWindow.document.getElementById('nonav').style.display = "none";
      document.getElementById('logframe').contentWindow.document.getElementById('nonav').style.display = "none";
      document.getElementById('notesframe').contentWindow.document.getElementById('nonav').style.display = "none";

    }
  $('#search1').selectize({
  onChange: function(value){
    if(value.slice(-1) == 1) {
    document.getElementById("frame1").src = '/tools/world/world.php?id=' + value.slice(0, -1);
  }
  else if(value.slice(-1) == 2) {

    document.getElementById("frame1").src = '/tools/compendium/compendium.php?id=' + value.slice(0, -1);
  }
  else if(value.slice(-1) == 3) {

    document.getElementById("frame1").src = '/tools/srd/rules.php?id=' + value.slice(0, -1);
  }
  else if(value.slice(-1) == 4) {

    document.getElementById("frame1").src = '/tools/world/xp.php';
  }
  else if(value.slice(-1) == 5) {

    document.getElementById("frame1").src = '/tools/world/gmnotes.php';
  }
  else if(value.slice(-1) == 6) {

    document.getElementById("frame1").src = '/tools/campaign-log/campaign-log.php';
  }
  else if(value.slice(-1) == 7) {

    document.getElementById("frame1").src = '/tools/generator/generator.php';
  }
  else if(value.slice(-1) == 8) {

    document.getElementById("frame1").src = '/tools/initiative/initiative.php';
  }
  window.setTimeout(nonav,2000);
  },
  create: false,
  openOnFocus: false,
  maxOptions: 4,
  sortField: 'text',
  placeholder: 'search...'
},);

  </script>

  <script type="text/javascript">
  function nonav() {
    document.getElementById('frame1').contentWindow.document.getElementById('nonav').style.display = "none";
    document.getElementById('frame2').contentWindow.document.getElementById('nonav').style.display = "none";
    document.getElementById('frame3').contentWindow.document.getElementById('nonav').style.display = "none";
    document.getElementById('frame4').contentWindow.document.getElementById('nonav').style.display = "none";
  }
  $('#search2').selectize({
  onChange: function(value){
    if(value.slice(-1) == 1) {
    document.getElementById("frame2").src = '/tools/world/world.php?id=' + value.slice(0, -1);
  }
  else if(value.slice(-1) == 2) {

    document.getElementById("frame2").src = '/tools/compendium/compendium.php?id=' + value.slice(0, -1);
  }
  else if(value.slice(-1) == 3) {

    document.getElementById("frame2").src = '/tools/srd/rules.php?id=' + value.slice(0, -1);
  }
  else if(value.slice(-1) == 4) {

    document.getElementById("frame2").src = '/tools/world/xp.php';
  }
  else if(value.slice(-1) == 5) {

    document.getElementById("frame2").src = '/tools/world/gmnotes.php';
  }
  else if(value.slice(-1) == 6) {

    document.getElementById("frame2").src = '/tools/campaign-log/campaign-log.php';
  }
  else if(value.slice(-1) == 7) {

    document.getElementById("frame2").src = '/tools/generator/generator.php';
  }
  else if(value.slice(-1) == 8) {

    document.getElementById("frame2").src = '/tools/initiative/initiative.php';
  }
  window.setTimeout(nonav,2000);
  },
  create: false,
  openOnFocus: false,
  maxOptions: 4,
  sortField: 'text',
  placeholder: 'search...'
  },);
  </script>

  <script type="text/javascript">
  function nonav() {
    document.getElementById('frame1').contentWindow.document.getElementById('nonav').style.display = "none";
    document.getElementById('frame2').contentWindow.document.getElementById('nonav').style.display = "none";
    document.getElementById('frame3').contentWindow.document.getElementById('nonav').style.display = "none";
    document.getElementById('frame4').contentWindow.document.getElementById('nonav').style.display = "none";
  }
  $('#search3').selectize({
  onChange: function(value){
    if(value.slice(-1) == 1) {
    document.getElementById("frame3").src = '/tools/world/world.php?id=' + value.slice(0, -1);
  }
  else if(value.slice(-1) == 2) {

    document.getElementById("frame3").src = '/tools/compendium/compendium.php?id=' + value.slice(0, -1);
  }
  else if(value.slice(-1) == 3) {

    document.getElementById("frame3").src = '/tools/srd/rules.php?id=' + value.slice(0, -1);
  }
  else if(value.slice(-1) == 4) {

    document.getElementById("frame3").src = '/tools/world/xp.php';
  }
  else if(value.slice(-1) == 5) {

    document.getElementById("frame3").src = '/tools/world/gmnotes.php';
  }
  else if(value.slice(-1) == 6) {

    document.getElementById("frame3").src = '/tools/campaign-log/campaign-log.php';
  }
  else if(value.slice(-1) == 7) {

    document.getElementById("frame3").src = '/tools/generator/generator.php';
  }
  else if(value.slice(-1) == 8) {

    document.getElementById("frame3").src = '/tools/initiative/initiative.php';
  }
  window.setTimeout(nonav,2000);

  },
  create: false,
  openOnFocus: false,
  maxOptions: 4,
  sortField: 'text',
  placeholder: 'search...'
  },);
  </script>

  <script type="text/javascript">
  function nonav() {
    document.getElementById('frame1').contentWindow.document.getElementById('nonav').style.display = "none";
    document.getElementById('frame2').contentWindow.document.getElementById('nonav').style.display = "none";
    document.getElementById('frame3').contentWindow.document.getElementById('nonav').style.display = "none";
    document.getElementById('frame4').contentWindow.document.getElementById('nonav').style.display = "none";
  }
  $('#search4').selectize({
  onChange: function(value){
    if(value.slice(-1) == 1) {
    document.getElementById("frame4").src = '/tools/world/world.php?id=' + value.slice(0, -1);
  }
  else if(value.slice(-1) == 2) {

    document.getElementById("frame4").src = '/tools/compendium/compendium.php?id=' + value.slice(0, -1);
  }
  else if(value.slice(-1) == 3) {

    document.getElementById("frame4").src = '/tools/srd/rules.php?id=' + value.slice(0, -1);
  }
  else if(value.slice(-1) == 4) {

    document.getElementById("frame4").src = '/tools/world/xp.php';
  }
  else if(value.slice(-1) == 5) {

    document.getElementById("frame4").src = '/tools/world/gmnotes.php';
  }
  else if(value.slice(-1) == 6) {

    document.getElementById("frame4").src = '/tools/campaign-log/campaign-log.php';
  }
  else if(value.slice(-1) == 7) {

    document.getElementById("frame4").src = '/tools/generator/generator.php';
  }
  else if(value.slice(-1) == 8) {

    document.getElementById("frame4").src = '/tools/initiative/initiative.php';
  }
  window.setTimeout(nonav,2000);

  },
  create: false,
  openOnFocus: false,
  maxOptions: 4,
  sortField: 'text',
  placeholder: 'search...'
  },);
  </script>

</div>
<?php
//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath);
?>
