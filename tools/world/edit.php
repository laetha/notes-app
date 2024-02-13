<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
crossorigin=""/>
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
crossorigin=""></script>

<?php
//SQL Connect
$sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

//Header
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.php";
include_once($headpath);
/*if ($loguser !== 'tarfuin') {
echo ('<script>window.location.replace("/oops.php"); </script>');
}*/

$id = "index";
$disallowed_paths = array('header', 'footer');
if (!empty($_GET['id'])) {
  $tmp_action = basename($_GET['id']);
  if (!in_array($tmp_action, $disallowed_paths) /*&& file_exists("world/{$tmp_action}.php")*/)
        $id = $tmp_action;
        $id = addslashes($id);
        $worldedit = "SELECT * FROM `world` WHERE `title` LIKE '$id'";
        $editdata = mysqli_query($dbcon, $worldedit) or die('error getting data');
        while($editrow =  mysqli_fetch_array($editdata, MYSQLI_ASSOC)) {
          $editid = $editrow['id'];
if ($editrow['type'] == "npc"){
  ?><style type="text/css">#npc-form{
  display:block;
  }</style>
  <style type="text/css">#est-form{
  display:none;
  }</style>
  <style type="text/css">#quest-form{
  display:none;
  }</style>
    <?php
}
          else if ($editrow['type'] == "establishment") {
?>
<style type="text/css">#npc-form{
display:none;
}</style>
<style type="text/css">#est-form{
display:block;
}</style>
<style type="text/css">#quest-form{
display:none;
}</style>
<?php
}

  else if ($editrow['quest_status'] !== "") {
?>
<style type="text/css">#npc-form{
display:none;
}</style>
<style type="text/css">#est-form{
display:none;
}</style>
<style type="text/css">#quest-form{
display:block;
}</style>
<?php
}

else {
?>
<style type="text/css">#npc-form{
display:none;
}</style>
<style type="text/css">#est-form{
display:none;
}</style>
<style type="text/css">#quest-form{
display:none;
}</style>
<?php
}
         ?>
         <div class="tocbox col-md-12">
           <div class ="body bodytext">
         <h1 class="pagetitle">Edit Entry</h1>
         <div id="test"></div>
       <div class="col-md-10 col-centered">
        <div id="extract">
         <div class="col-sm-6 typebox col-centered" id="name">
             <form method="post" action="editprocess.php" id="import" enctype="multipart/form-data">
             <div class="text">Name</div><input class="textbox" style="text-align:center;" type="text" name="name" id="name" value="<?php echo $editrow['title']; ?>">
       </div>
       <!-- 'Type' Dropbox -->

       <div class="col-sm-6 typebox col-centered" id="npc-type">
             <p class="text">Type
                <select form="import" name="editid" id="editid" style="display:none;" required="yes">
                  <option id="tmptype" value="<?php echo $editrow['id']; ?>" selected></option>
                  </select>
               <select form="import" required="yes" name="type" id="type" onchange="typeForm(this);">
                 <option value="">None...</option>
                 <option value="<?php echo $editrow['type']; ?>" selected><?php echo $editrow['type']; ?></option>
                 <?php
                 $typeedit = "SELECT type FROM `world`";
                 $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
                 while($typerow =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
                   $type = $typerow['type'];
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

             <div class="col-sm-6 typebox col-centered" id="code">
                   <p class="text">Code
                     <select form="import" name="code" id="code-form">
                       <option value="">None...</option>
                       <option value="<?php echo $editrow['code']; ?>" selected><?php echo $editrow['code']; ?></option>
                       <?php
                       $faithdrop = "SELECT code FROM `world` WHERE worlduser LIKE '$loguser'";
                       $faithdata = mysqli_query($dbcon, $faithdrop) or die('error getting data');
                       while($deityrow =  mysqli_fetch_array($faithdata, MYSQLI_ASSOC)) {
                         $code = $deityrow['code'];
                         echo "<option value=\"$code\">$code</option>";
                       }
                       ?>
                     </select>
                     <script type="text/javascript">
                     $('#code-form').selectize({
                 create: true,
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
          document.getElementById("npc-form").style.display = "none";
          document.getElementById("est-form").style.display = "none";
          document.getElementById("quest-form").style.display = "none";

         if (selectValue == "npc") {
           document.getElementById("quest-form").style.display = "none";
           document.getElementById("npc-form").style.display = "block";
           document.getElementById("est-form").style.display = "none";
       }
         else if (selectValue == "establishment") {
           document.getElementById("quest-form").style.display = "none";
         document.getElementById("est-form").style.display = "block";
         document.getElementById("npc-form").style.display = "none";
       }
       else if (selectValue == "public quest") {
       document.getElementById("quest-form").style.display = "block";
       document.getElementById("est-form").style.display = "none";
       document.getElementById("npc-form").style.display = "none";
       }
         else {
           document.getElementById("quest-form").style.display = "none";
           document.getElementById("npc-form").style.display = "none";
           document.getElementById("est-form").style.display = "none";
         }

        }

       </script>

       <!--NPC FORM -->
       <div id="npc-form">

         <!-- 'NPC Race' Dropbox -->
         <div class="col-sm-6 typebox col-centered" id="npc-race">
               <p class="text">Race
                 <select form="import" name="npc-race" id="race-form">
                   <option value="">None...</option>
                   <option value="<?php echo $editrow['npc_race']; ?>" selected><?php echo $editrow['npc_race']; ?></option>
                   <?php
                   $faithdrop = "SELECT npc_race FROM `world` WHERE `type` LIKE 'npc' AND worlduser LIKE '$loguser'";
                   $faithdata = mysqli_query($dbcon, $faithdrop) or die('error getting data');
                   while($deityrow =  mysqli_fetch_array($faithdata, MYSQLI_ASSOC)) {
                     $deity = $deityrow['npc_race'];
                     echo "<option value=\"$deity\">$deity</option>";
                   }
                   ?>
                 </select>
                 <script type="text/javascript">
                 $('#race-form').selectize({
             create: true,
             sortField: 'text'
         });
                 </script>
               </p>
         </div>

       <!-- 'NPC Diety' Dropbox -->
       <div class="col-sm-6 typebox col-centered" id="npc-deity">
             <p class="text">Faith
               <select form="import" name="npc-deity" id="deity-form">
                 <option value="">None...</option>
                 <option value="<?php echo $editrow['npc_deity']; ?>" selected><?php echo $editrow['npc_deity']; ?></option>
                 <?php
                 $faithdrop = "SELECT title FROM `world` WHERE `type` LIKE 'deity' AND worlduser LIKE '$loguser' ORDER BY `world`.`title` ASC";
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
                 <option value="">None...</option>
                 <option value="<?php echo $editrow['npc_location']; ?>" selected><?php echo $editrow['npc_location']; ?></option>
                 <?php
                 $locationdrop = "SELECT title FROM `world` WHERE `type` LIKE 'location' AND worlduser LIKE '$loguser' ORDER BY `world`.`title` ASC";
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
                 <option value="">None...</option>
                 <option value="<?php echo $editrow['npc_faction']; ?>" selected><?php echo $editrow['npc_faction']; ?></option>
                 <?php
                 $factiondrop = "SELECT title FROM `world` WHERE `type` LIKE 'faction' AND worlduser LIKE '$loguser' ORDER BY `world`.`title` ASC";
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

           <!-- 'NPC establishment' Dropbox -->
           <div class="col-sm-6 typebox col-centered" id="npc-establishment">
                 <p class="text">Establishment
                   <select form="import" name="npc-establishment" id="npc-est-form">
                     <option value="">None...</option>
                     <option value="<?php echo $editrow['npc_est']; ?>" selected><?php echo $editrow['npc_est']; ?></option>
                     <?php
                     $factiondrop = "SELECT title FROM `world` WHERE `type` LIKE 'establishment' AND worlduser LIKE '$loguser' ORDER BY `world`.`title` ASC";
                     $factiondata = mysqli_query($dbcon, $factiondrop) or die('error getting data');
                     while($factionrow =  mysqli_fetch_array($factiondata, MYSQLI_ASSOC)) {
                       $faction = $factionrow['title'];
                       echo "<option value=\"$faction\">$faction</option>";
                     }
                     ?>
                   </select>
                   <script type="text/javascript">
                   $('#npc-est-form').selectize({
               create: true,
               sortField: 'text'
           });
                   </script>
                 </p>
               </div>

               <!-- 'NPC title' Dropbox -->
               <div class="col-sm-6 typebox col-centered" id="npc-title">
                     <div class="text">Title</div>
                     <?php
                     $titledrop = "SELECT * FROM world WHERE id LIKE '$editid'";
                     $titledata = mysqli_query($dbcon, $titledrop) or die('error getting data');
                     while($titlerow =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
                       echo ('<div class="text"><input form="import" class="textbox" type="text" name="npc-title" id="title-form" value="'.$titlerow['npc_title'].'"></div>');
                     }
                     ?>
                   </div>

       </div>

       <!--Establishment FORM -->
       <div id="est-form">
       <!-- 'Establishment Location' Dropbox -->
       <div class="col-sm-6 typebox col-centered" id="est-location">
             <p class="text">Location
               <select form="import" name="est-location" id="est-location-form">
                 <option value="">None...</option>
                 <option value="<?php echo $editrow['est_location']; ?>" selected><?php echo $editrow['est_location']; ?></option>
                 <?php
                 $faithdrop = "SELECT title FROM `world` WHERE `type` LIKE 'location' AND worlduser LIKE '$loguser' ORDER BY `world`.`title` ASC";
                 $faithdata = mysqli_query($dbcon, $faithdrop) or die('error getting data');
                 while($deityrow =  mysqli_fetch_array($faithdata, MYSQLI_ASSOC)) {
                   $deity = $deityrow['title'];
                   echo "<option value=\"$deity\">$deity</option>";
                 }
                 ?>
               </select>
               <script type="text/javascript">
               $('#est-location-form').selectize({
           create: true,
           sortField: 'text'
       });
               </script>
             </p>
       </div>
       <!-- 'Establishment Type' Dropbox -->
       <div class="col-sm-6 typebox col-centered" id="est-type">
             <p class="text">Type
               <select form="import" name="est-type" id="est-type-form">
                 <option value="">None...</option>
                 <option value="<?php echo $editrow['est_type']; ?>" selected><?php echo $editrow['est_type']; ?></option>
                 <?php
                 $locationdrop = "SELECT est_type FROM `world` WHERE `type` LIKE 'establishment' AND worlduser LIKE '$loguser' ORDER BY `world`.`est_type` ASC";
                 $locationdata = mysqli_query($dbcon, $locationdrop) or die('error getting data');
                 while($locationrow =  mysqli_fetch_array($locationdata, MYSQLI_ASSOC)) {
                   $location = $locationrow['est_type'];
                   echo "<option value=\"$location\">$location</option>";
                 }
                 ?>
               </select>
               <script type="text/javascript">
               $('#est-type-form').selectize({
           create: true,
           sortField: 'text'
       });
               </script>
             </p>
           </div>

       </div>


<!-- Quest Form -->
       <div id="quest-form">

      <!-- 'establishment location' Dropbox -->
<div class="col-sm-6 typebox col-centered" id="equest-status">
      <p class="text">Quest Status
        <select form="import" name="quest-status" id="quest-status-form">
        <option value="<?php echo $editrow['quest_status']; ?>" selected><?php echo $editrow['quest_status']; ?></option>
          <option value="" selected>None...</option>
          <option value="available">Available</option>
          <option value="private">Private</option>
          <option value="complete">Complete</option>
        </select>
        <script type="text/javascript">
        $('#quest-status-form').selectize({
    create: true,
    sortField: 'text'
});
        </script>
      </p>
    </div>
    <!-- 'establishment type' Dropbox -->
    <div class="col-sm-6 typebox col-centered" id="quest-faction">
          <p class="text">Faction
            <select form="import" name="quest-faction" id="quest-faction-form">
            <option value="<?php echo $editrow['quest_faction']; ?>" selected><?php echo $editrow['quest_faction']; ?></option>
              <option value="" selected>None...</option>
              <?php
              $locationdrop = "SELECT title FROM `world` WHERE `type` LIKE 'faction' AND worlduser LIKE '$loguser'";
              $locationdata = mysqli_query($dbcon, $locationdrop) or die('error getting data');
              while($locationrow =  mysqli_fetch_array($locationdata, MYSQLI_ASSOC)) {
                $location = $locationrow['title'];
                echo "<option value=\"$location\">$location</option>";
              }
              ?>
            </select>
            <script type="text/javascript">
            $('#quest-faction-form').selectize({
        create: true,
        sortField: 'text'
    });
            </script>
          </p>
        </div>
               <div class="text col-centered col-md-6"><textarea type="text" name="quest-reward" id="quest-reward" placeholder="Reward...." style="height:100px;"><?php echo $editrow['quest_reward']; ?></textarea></div>

       </div>

           <div class="text col-centered col-md-12"><textarea type="text" name="body" id="body"><?php echo $editrow['body']; ?></textarea></div>
           <div id="toreplace" class="nonav"></div>
           <div id="namesuggest"></div>
           <div class="col-centered">
             <?php
              $jpgurl = 'uploads/'.$id.'.jpg';
              $pngurl = 'uploads/'.$id.'.png';
                if (file_exists($jpgurl)){
                  ?>
             <img src="uploads/<?php echo $id?>.jpg" style="width:100px;">
             <?php
           }
           else if (file_exists($pngurl)){
             ?>
             <img src="uploads/<?php echo $id?>.png" style="width:100px;">
           <?php }
           else if (file_exists($webpurl)){
             ?>
             <img src="uploads/<?php echo $id?>.webp" style="width:100px;">
           <?php } ?>
           </div>
           <input class="col-centered" type="file" name="fileToUpload" id="fileToUpload">
           <p><button type="button" class="btn btn-info" id="locbutton">Add Location</button></p>

<div id="map" style="display:none;">

<div class="text">Coord</div><input class="textbox" style="text-align:center;" type="text" name="coord" id="coord" value="<?php echo $editrow['coord']; ?>">

<style>
        #image-map {
          width: 100%;
          height: 600px;
          border: 1px solid #ccc;
          margin-bottom: 10px;
        }
        </style>

        <div id="image-map"></div>
<script>
// Using leaflet.js to pan and zoom a big image.
// See also: http://kempe.net/blog/2014/06/14/leaflet-pan-zoom-image.html

// create the slippy map
var map = L.map('image-map', {
  minZoom: 2,
  maxZoom: 7,
  center: [0, 0],
  zoom: 2,
  crs: L.CRS.Simple,
  scrollWheelZoom:'center'

});
var mapFeatures = L.layerGroup();
var mapLog = L.layerGroup();
var mapCompendium = L.layerGroup();
var mapZones = L.layerGroup();

var overlayMaps = {
    "Map Feautures": mapFeatures,
    "Campaign Log": mapLog,
    "Legend": mapCompendium,
    "Zones": mapZones

};

L.control.layers(null, overlayMaps).addTo(map);


// dimensions of the image
var w = 5200*2,
    h = 4100*2,
    url = '/assets/images/campaign3-zone1.webp';

// calculate the edges of the image, in coordinate space
var southWest = map.unproject([0, h], map.getMaxZoom()-1);
var northEast = map.unproject([w, 0], map.getMaxZoom()-1);
var bounds = new L.LatLngBounds(southWest, northEast);

// add the image overlay,
// so that it covers the entire map
L.imageOverlay(url, bounds).addTo(map);

// tell leaflet that the map is exactly as big as the image
map.setMaxBounds(bounds);

var popup = L.popup();
           function onMapClick(e) {
           popup
           .setLatLng(e.latlng)
           .setContent("You clicked the map at " + e.latlng.toString())
           .openOn(map);
           var newCoord = e.latlng.toString();
           newCoord = newCoord.replace(/LatLng/g, "");
             newCoord = newCoord.replace(/[{()}]/g, '');
           document.getElementById("coord").value = newCoord;
           //.openOn(map);
           }

           map.on('click', onMapClick);

           </script>
           <?php
           $worldtitle = "SELECT * FROM campaignlog WHERE active = 1";
           $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
           $mrk = 1;
           while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
           ?>
           <script>
           var myIcon = L.icon({
               iconUrl: 'https://raw.githubusercontent.com/iconic/open-iconic/master/png/map-marker-8x.png',
               iconSize: [32, 32],
               iconAnchor: [16,32]
           });
           var marker<?php echo $mrk; ?> = L.marker([<?php echo $row['coord']; ?>, {icon: myIcon}]).addTo(map);

           marker<?php echo $mrk; ?>.bindPopup("<?php echo $row['entry']; ?>");
           </script>
           <?php
           $mrk = $mrk + 1;

           }
           ?>

             </div>
             <script>
             $(document).ready(function addLog(){
                 $("#locbutton").click(function addLog(){
                     $("#map").slideToggle("slow");
                 });
             });
  
  $("#body").keyup(function(e) {
  var editText = $('#body').val();
  if (editText.includes('@') == true){
    //var autoquery = editText.split("@");
    var tempquery = editText.split("@");
    var cursorPos= $("#body"). prop('selectionStart');
    const autoquery = editText.substring(editText.indexOf("@") + 1, cursorPos);    var querylength = autoquery.length;
    var querylength = autoquery.length;
    
    if (querylength >= 3){
      $('#toreplace').html(autoquery);

      $.ajax({
    url : 'autocomplete.php',
    type: 'GET',
    data : { "autoquery" : autoquery },
    success: function(data)
    {
      var tags = JSON.parse(data);
      $('#namesuggest').html(tags);
      
    },
    error: function (jqXHR, status, errorThrown)
    {

    }
    });
  }
}
  else {
    $('#namesuggest').html('');
  }
});

function nameinsert(value){
  
  var editbody = $('#body').val();
  var autoquery = '@' + $('#toreplace').html();
  var newbody = editbody.replace(autoquery,value);
  $('#body').val(newbody);
  $('#body').focus();
  $('#namesuggest').html('');
}

             </script>
</div>

       <div class="col-centered">
       <input class="btn btn-primary col-centered inline" type="submit" value="Save">
       <a class="clean" href="world.php?id=<?php echo $id; ?>"><button class="btn btn-danger col-centered inline" type="button">Cancel</button></a>
       </div>
      </form>

     </div>
   </div>
            </div>
  </div>
         <?php
       }
  ?>
  <!-- Import Form -->

<?php
  }
  ?>

<!-- Footer -->
<?php
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath);
 ?>
