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

?>
<!-- Import Form -->
<div class="mainbox col-lg-10 col-xs-12 col-lg-offset-1">
    <div class ="body bodytext">
  <h1 class="pagetitle">Add to World</h1>
<div class="col-md-10 col-centered">
  <div class="col-sm-6 typebox col-centered" id="name">
      <form method="post" action="process.php" id="import" enctype="multipart/form-data">
      <div class="text">Name</div><input class="textbox" type="text" name="name" id="name" placeholder="Name...">
</div>
<!-- 'Type' Dropbox -->
<div class="hide"><input type="text" name="worlduser" id="worlduser" value="<?php echo $loguser; ?>"></div>
<div class="col-sm-6 typebox col-centered" id="npc-type">
      <p class="text">Type

        <select form="import" required="yes" name="type" id="type" onchange="typeForm(this);">
          <option value="">None...</option>
          <?php
          $typeedit = "SELECT type FROM `world`";
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
    create: true,
    sortField: 'text'
});
        </script>
      </p>
      </div>

      <div class="col-sm-6 typebox col-centered" id="npc-type">
            <p class="text">Code

              <select form="import" required="yes" name="code" id="code" onchange="codeForm(this);">
                <option value="">None...</option>
                <?php
                $typeedit = "SELECT code FROM `world` WHERE worlduser LIKE '$loguser'";
                $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
                while($typerow =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
                  $code = $typerow['code'];
                  $codeUpper = ucwords($code);
                  echo "<option value=\"$code\">$code</option>";
                }

               ?>
              </select>
              <script type="text/javascript">
              $('#code').selectize({
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
   document.getElementById("npc-form").style.display = "none";

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
/*else if (selectValue == "public quest") {
document.getElementById("quest-form").style.display = "block";
document.getElementById("est-form").style.display = "none";
document.getElementById("npc-form").style.display = "none";
}*/
else if (selectValue == "quest") {
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
<div id="npc-form" style="display:none;">
<!-- 'NPC Diety' Dropbox -->
<div class="col-sm-6 typebox col-centered" id="npc-race">
      <p class="text">Race
        <select form="import" name="npc-race" id="race-form">
          <option value="" selected>None...</option>
          <?php
          $faithdrop = "SELECT npc_race FROM `world` WHERE `type` LIKE 'npc'";
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

<div class="col-sm-6 typebox col-centered" id="npc-deity">
      <p class="text">Faith
        <select form="import" name="npc-deity" id="deity-form">
          <option value="" selected>None...</option>
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
          <option value="" selected>None...</option>
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
          <option value="" selected>None...</option>
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
    <div class="col-sm-6 typebox col-centered" id="npc-est">
          <p class="text">Establishment
            <select form="import" name="npc-establishment" id="establishment-form">
              <option value="" selected>None...</option>
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
            $('#establishment-form').selectize({
        create: true,
        sortField: 'text'
    });
            </script>
          </p>
        </div>

        <!-- 'NPC title' Dropbox -->
        <div class="col-sm-6 typebox col-centered" id="npc-title">
              <div class="text">Title</div>
                <div class="text"><input form="import" class="textbox" type="text" name="npc-title" id="title-form" placeholder="Title..."></div>
            </div>


</div>

<div id="est-form" style="display:none;">

<!-- 'establishment location' Dropbox -->
<div class="col-sm-6 typebox col-centered" id="est-location">
      <p class="text">Location
        <select form="import" name="est-location" id="est-location-form">
          <option value="" selected>None...</option>
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
        $('#est-location-form').selectize({
    create: true,
    sortField: 'text'
});
        </script>
      </p>
    </div>
    <!-- 'establishment type' Dropbox -->
    <div class="col-sm-6 typebox col-centered" id="est-location">
          <p class="text">Type
            <select form="import" name="est-type" id="est-type-form">
              <option value="" selected>None...</option>
              <?php
              $locationdrop = "SELECT est_type FROM `world` WHERE `type` LIKE 'establishment' ORDER BY `world`.`est_type` ASC";
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

<div id="quest-form" style="display:none;">

<button type="button" class="btn btn-primary" onclick="randquest()">Generate Random Quest</button>
<button type="button" class="btn btn-primary" onclick="randnpc()">Random NPC</button>
<div id="randnpc"></div>
</div>

<script>
function randquest(){

  $.ajax({
     url : 'randquest.php',
     success: function(data)
     {
      document.getElementById('body').value = data;
     }

 });
};

function randnpc(){

$.ajax({
   url : 'randnpc.php',
   success: function(data)
   {
    document.getElementById('randnpc').innerHTML = data;
   }

});
};

</script>


    <div class="text col-centered col-md-12"><textarea type="text" name="body" id="body" placeholder="Type the body of your content here..."></textarea></div>
    <div id="toreplace" class="nonav"></div>
    <div id="namesuggest"></div>

    <input class="col-centered" type="file" name="fileToUpload1" id="fileToUpload1">
    <?php
    if ($loguser == 'tarfuin') { ?>
    <p><button type="button" class="btn btn-info" id="locbutton">Add Location</button></p>
    <?php } ?>
    <div id="map" style="display:none;">

    <div class="text">Coord</div><div><input class="textbox" style="text-align:center;" type="text" name="coord" id="coord" value=""></div>
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

map.on('click', onMapClick);

           function onMapClick(e) {
           popup
           .setLatLng(e.latlng)
           .setContent("You clicked the map at " + e.latlng.toString())
           .openOn(map);
           var newCoord = e.latlng.toString();
           newCoord = newCoord.replace(/LatLng/g, "");
             newCoord = newCoord.replace(/[{()}]/g, '');
           $("#coord").val(newCoord);
           //.openOn(map);
           }


           </script>

           <!-- END MAP -->

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
 const autoquery = editText.substring(editText.indexOf("@") + 1, cursorPos);
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
<input form="import" class="btn btn-primary col-centered" type="submit" value="Submit">
</div>
</form>

</div>
</div>
<!-- Footer -->
<?php
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath);
 ?>
