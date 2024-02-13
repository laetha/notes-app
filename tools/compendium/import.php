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
<!-- Import Form -->
  <div class="tocbox col-md-12">
    <div class ="body bodytext">
  <h1 class="pagetitle">Add to Compendium</h1>
<div class="col-md-10 col-centered">
  <div class="col-sm-6 typebox col-centered" id="name">
      <form method="post" action="process.php" id="import">
      <div class="text">Name</div><input class="textbox" type="text" name="name" id="name" placeholder="Name...">
</div>
<!-- 'Type' Dropbox -->

<div class="col-sm-6 typebox col-centered" id="npc-type">
      <p class="text">Type
         
        <select form="import" required="yes" name="type" id="type" onchange="typeForm(this);">
          <option value="">None...</option>
          <?php
          $typeedit = "SELECT type FROM `compendium`";
          $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
          while($typerow =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
            $type = $typerow['type'];
            $typeUpper = ucwords($type);
            echo "<option value=\"$type\">$type</option>";
          }

         ?>
        </select>
        <script type="text/javascript">
        $('#type').selectize({
    create: false,
    sortField: 'text'
});
        </script>
      </p>
      </div>
      <!-- Different form for Different types -->
<!-- Form Alteration Script -->
<script type="text/javascript">
 function typeForm(selectObj) {

   var selectIndex=selectObj.selectedIndex;
   var selectValue=selectObj.options[selectIndex].text;
   var output=document.getElementById("output");
   //alert(output.innerText);
   document.getElementById("npc-form").style.display = "none";
  
  if (selectValue == "npc") {
    document.getElementById("npc-form").style.display = "block";
}
 }
</script>

<!--NPC FORM -->
<div id="npc-form" style="display:none;">
<!-- 'NPC Diety' Dropbox -->
<div class="col-sm-6 typebox col-centered" id="npc-deity">
      <p class="text">Faith
        <select form="import" name="npc-deity" id="deity-form">
          <option value="" selected>None...</option>
          <?php
          $faithdrop = "SELECT title FROM `compendium` WHERE `type` LIKE 'deity' ORDER BY `compendium`.`title` ASC";
          $faithdata = mysqli_query($dbcon, $faithdrop) or die('error getting data');
          while($deityrow =  mysqli_fetch_array($faithdata, MYSQLI_ASSOC)) {
            $deity = $deityrow['title'];
            echo "<option value=\"$deity\">$deity</option>";
          }
          ?>
        </select>
        <script type="text/javascript">
        $('#deity-form').selectize({
    create: true,
    sortField: 'text'
});
        </script>
      </p>
</div>
<!-- 'NPC location' Dropbox -->
<div class="col-sm-6 typebox col-centered" id="npc-location">
      <p class="text">Location
        <select form="import" name="npc-location" id="location-form">
          <option value="" selected>None...</option>
          <?php
          $locationdrop = "SELECT title FROM `compendium` WHERE `type` LIKE 'location' ORDER BY `compendium`.`title` ASC";
          $locationdata = mysqli_query($dbcon, $locationdrop) or die('error getting data');
          while($locationrow =  mysqli_fetch_array($locationdata, MYSQLI_ASSOC)) {
            $location = $locationrow['title'];
            echo "<option value=\"$location\">$location</option>";
          }
          ?>
        </select>
        <script type="text/javascript">
        $('#location-form').selectize({
    create: true,
    sortField: 'text'
});
        </script>
      </p>
    </div>
<!-- 'NPC faction' Dropbox -->
<div class="col-sm-6 typebox col-centered" id="npc-faction">
      <p class="text">Faction
        <select form="import" name="npc-faction" id="faction-form">
          <option value="" selected>None...</option>
          <?php
          $factiondrop = "SELECT title FROM `compendium` WHERE `type` LIKE 'faction' ORDER BY `compendium`.`title` ASC";
          $factiondata = mysqli_query($dbcon, $factiondrop) or die('error getting data');
          while($factionrow =  mysqli_fetch_array($factiondata, MYSQLI_ASSOC)) {
            $faction = $factionrow['title'];
            echo "<option value=\"$faction\">$faction</option>";
          }
          ?>
        </select>
        <script type="text/javascript">
        $('#faction-form').selectize({
    create: true,
    sortField: 'text'
});
        </script>
      </p>
    </div>
</div>
    <div class="text col-centered col-md-12"><textarea type="text" name="body" id="body" placeholder="Type the body of your content here..."></textarea></div>

<div class="col-centered">
<input form="import" class="btn btn-primary col-centered" type="submit" value="Submit">
</div>
</form>
</div>
</div>
</div>
<!-- Footer -->
<?php
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath);
 ?>
