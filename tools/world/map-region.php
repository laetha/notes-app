<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $pgtitle = 'Region Map - ';
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);
   if ($loguser !== 'tarfuin') {
   echo ('<script>window.location.replace("/oops.php"); </script>');
   }

   $id = 'notset';
   $disallowed_paths = array('header', 'footer');
   if (!empty($_GET['id'])) {
     $tmp_action = basename($_GET['id']);
     if (!in_array($tmp_action, $disallowed_paths) /*&& file_exists("world/{$tmp_action}.php")*/)
           $id = $tmp_action;
     }
   $id = addslashes($id);
   $id = str_replace('%20', ' ', $id);
   echo $id;
   ?>
   <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.js" type="text/javascript"></script>
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
   integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
   crossorigin=""/>
   <!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
  integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
  crossorigin=""></script>
    <div class="mainbox col-lg-10 col-xs-12 col-lg-offset-1">

      <!-- Page Header -->
      <div class="col-md-12">
      <div class="pagetitle" id="pgtitle">Region Map</div>
            
    </div>
     <div id="extract">
      <div class="body sidebartext col-xs-12" id="body">
      <div id="test"></div>
     
        <style>
        #image-map {
          width: 100%;
          height: 600px;
          border: 1px solid #ccc;
          margin-bottom: 10px;
        }
                </style>

        <div id="image-map"></div>


  <div class="table-responsive">
 <table id="faction" class="table table-condensed table-striped table-responsive dt-responsive" cellspacing="0" width="100%">
      <thead class="thead-dark">
          <tr>
              <th scope="col">ID</th>
              <th scope="col">Coord</th>
              <th scope="col">Title</th>
              <th scopy="col">Type</th>
              <th scope="col">Text</th>
            
          </tr>
      </thead>
      <tfoot>
          <tr>
              <th scope="col">ID</th>
              <th scope="col">Coord</th>
              <th scope="col">Title</th>
              <th scopy="col">Type</th>
              <th scope="col">Text</th>
            
          </tr>
      </tfoot>
      <tbody>
        <?php
        $worldtitle = "SELECT * FROM mapfeatures WHERE active= 1 AND maptype LIKE 'region'";
        $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
        while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
          //$temptitle = $row['title'];
          echo ('<tr>');
          echo ('<td>'.$row['id'].'</td>');
          echo ('<td>'.$row['coord'].'</td>'); 
          echo ('<td></td><td>mapFeatures</td>'); ?>
          <script>
          function movemap<?php echo $row['id'] ?>() {
              map.setView(new L.LatLng(<?php echo $row['coord']; ?>), 4);
          }
          </script>
          <?php
          echo ('<td>'.htmlspecialchars_decode($row['text'].'</td>'));
          echo ('</tr>');
         }

         $worldtitle = "SELECT * FROM world WHERE worlduser LIKE '$loguser' AND coord NOT LIKE ''";
         $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
         while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
           //$temptitle = $row['title'];
           echo ('<tr>');
           echo ('<td></td>');
           echo ('<td>'.$row['coord'].'</td>'); 
           echo ('<td><a href="world.php?id='.$row['title'].'" target="_BLANK">'.$row['title'].'</a></td><td>Compendium</td>'); ?>
           <script>
           function movemap<?php echo $row['id'] ?>() {
               map.setView(new L.LatLng(<?php echo $row['coord']; ?>), 4);
           }
           </script>
           <?php
           echo ('<td>'.htmlspecialchars_decode($row['body'].'</td>'));
           echo ('</tr>');
          }

          $worldtitle = "SELECT * FROM world WHERE worlduser LIKE '$loguser' AND body LIKE '%!(%'";
          $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
          while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
            $coordarray = explode('!', $row['body']);
            for($i=0; $i<=count($coordarray); $i++){
             if (str_starts_with($coordarray[$i],'(')){
              $coordarray[$i] = str_replace('(','',$coordarray[$i]);
              $coordarray[$i] = str_replace(')','',$coordarray[$i]);
              echo ('<tr>');
              echo ('<td></td>');
              echo ('<td>'.$coordarray[$i].'</td>'); 
              echo ('<td><a href="world.php?id='.$row['title'].'" target="_BLANK">'.$row['title'].'</a></td><td>mapLog</td>'); ?>
              <script>
              function movemap<?php echo $row['id'] ?>() {
                  map.setView(new L.LatLng(<?php echo $coordarray[$i]; ?>), 4);
              }
              </script>
              <?php
              echo ('<td>'.htmlspecialchars_decode($row['body'].'</td>'));
              echo ('</tr>');
             }
            }       
           }
          ?>

 </tbody>
 </table>
 </div>
  <script>

    // Using leaflet.js to pan and zoom a big image.
// See also: http://kempe.net/blog/2014/06/14/leaflet-pan-zoom-image.html

// create the slippy map
var map = L.map('image-map', {
  minZoom: 3,
  maxZoom: 7,
  maxNativeZoom: 10,
  center: [0,0],
  zoom: 3,
  crs: L.CRS.Simple,
  scrollWheelZoom:'center'

});
var mapFeatures = L.layerGroup();
var mapLog = L.layerGroup();
var mapCompendium = L.layerGroup();


var overlayMaps = {
    "Map Feautures": mapFeatures,
    "Campaign Log": mapLog,
    "Compendium": mapCompendium
};


L.control.layers(null, overlayMaps).addTo(map);


// dimensions of the image
var w = 5200*2,
    h = 4100*2,
    url = '/assets/images/campaign3-zones.webp';

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
document.getElementById("logcoord").value = newCoord;
//.openOn(map);
}

map.on('click', onMapClick);


 //$(document).ready(function() {
   var x = document.getElementsByClassName("leaflet-control-layers-selector");
   var i;
   setTimeout(function () {
for (i = 0; i < x.length; i++) {
  x[i].click();
    }
}, 300);

setTimeout(function () {
for (i = 0; i < x.length; i++) {
  x[i].click();
    }
}, 400);

setTimeout(function () {
for (i = 1; i < x.length; i++) {
  x[i].click();
    }
}, 500);

setTimeout(function () {
  filterMarkers();
}, 200);
    

 // Setup - add a text input to each footer cell


 // DataTable
 var table = $('#faction').DataTable();
 var markerPos = [];
      var pinAnchor = [];
      var pin = [];
      var marker = [];

/*$('#compendiumCheck').change(function(){
  filterMarkers();
});
$('#logCheck').change(function(){
  filterMarkers();
});
$('#mapCheck').change(function(){
  filterMarkers();
});*/

for (i = 0; i < x.length; i++) {
  $(x[i]).change(function(){
    filterMarkers();
  });
}

$(document).ready(function(){
  filterMarkers();
});

 function filterMarkers(){

  //if (compendiumBox = true){
    mapCompendium.clearLayers();
  //}
  //if (logBox = true){
    mapLog.clearLayers();
 // }
 // if (mapBox = true){
    mapFeatures.clearLayers();
  //}
  //$('#test').html(compendiumBox);

    table.rows({search:'applied'}).every(function(index){
      var row = table.row(index);
      var data = row.data();
      var coord = data[1];
      var vtitle = data[2];
      var vtype = data[3];
      var vtext = data[4];
      var vid = data[0];
      var vedit = ' <b><a style="font-size:14px;" href="mapedit.php?id=' + vid + '" target="_BLANK">Edit<a/></b>';
      var vbody = vtext + vedit;
      var coords = coord.split(', ');
  markerPos[index] = new L.LatLng(coords[0],coords[1]);
  pinAnchor[index] = new L.Point(10, 32);


  if ($(x[0]).is(':checked')){
    if (vtype == 'mapFeatures'){
    pin[index] = new L.Icon({ iconUrl: "/assets/images/map-marker-red.png", iconAnchor: pinAnchor[index], iconSize: [20, 32] });
    marker[index] = new L.marker(markerPos[index], { icon: pin[index] }).addTo(map).bindPopup(vbody);
    marker[index].addTo(mapFeatures);
  }
}
if ($(x[2]).is(':checked')){
  if (vtype == 'Compendium'){
  pin[index] = new L.Icon({ iconUrl: "/assets/images/map-marker-purple.png", iconAnchor: pinAnchor[index], iconSize: [20, 32] });
  marker[index] = new L.marker(markerPos[index], { icon: pin[index] }).addTo(map).bindPopup('<a href=\'world.php?id=' + vtitle + '\' target="_BLANK">' + vtitle + '</a>');
  marker[index].addTo(mapCompendium);
  }
}
if ($(x[1]).is(':checked')){
  if (vtype == 'mapLog'){
  pin[index] = new L.Icon({ iconUrl: "/assets/images/map-marker-blue.png", iconAnchor: pinAnchor[index], iconSize: [20, 32] });
  marker[index] = new L.marker(markerPos[index], { icon: pin[index] }).addTo(map).bindPopup('<a href=\'world.php?id=' + vtitle + '\' target="_BLANK">' + vtitle + '</a>');
  marker[index].addTo(mapLog);
  }
}

    });
}
filterMarkers();

$("input[type='search']").on("keyup", function () {
  filterMarkers();
});

 // Apply the search
 table.columns().every( function () {
   var that = this;

   $( 'input', this.footer() ).on( 'keyup change', function () {
       if ( that.search() !== this.value ) {
           that
               .search( this.value )
               .draw();
       }
      filterMarkers();
   } );
 } );
 //} );

 

 </script>
</div>
</div>
<script>
<?php
if ($id == 'notset') {
 ?>
map.setView(new L.LatLng(-43.129166, 75.623759));
<?php }
else { ?>
  map.setView(new L.LatLng(<?php echo $id; ?>), 4);

<?php } ?>
</script>
</div>

   <?php
   //Footer
   $footpath = $_SERVER['DOCUMENT_ROOT'];
   $footpath .= "/footer.php";
   include_once($footpath);
    ?>