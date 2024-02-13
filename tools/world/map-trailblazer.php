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
      <div class="body sidebartext col-xs-12" id="body">

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
  minZoom: 1,
  maxZoom: 4,
  center: [0, 0],
  zoom: 2,
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
var w = 5040,
    h = 3308,
    url = '/assets/images/Starting-Region.jpg';

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


</script>

<?php
$worldtitle = "SELECT * FROM world WHERE coord NOT LIKE ''";
$titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
$mrk = 1;
while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
  ?>
  <script>
  var markerPos<?php echo $mrk; ?> = new L.LatLng(<?php echo $row['coord']; ?>);
  var pinAnchor<?php echo $mrk; ?> = new L.Point(10, 32);
  var pin<?php echo $mrk; ?> = new L.Icon({ iconUrl: "/assets/images/map-marker-purple.png", iconAnchor<?php echo $mrk; ?>: pinAnchor<?php echo $mrk; ?>, iconSize: [20, 32] });
  var marker<?php echo $mrk; ?> = new L.marker(markerPos<?php echo $mrk; ?>, { icon: pin<?php echo $mrk; ?> }).addTo(map).bindPopup('<a href="world.php?id=<?php echo $row['title']; ?>" target="_BLANK"><?php echo $row['title']; ?></a>');
//  var marker<?php echo $mrk; ?> = L.marker([<?php echo $row['coord']; ?>], {icon: myIcon}).addTo(map).bindPopup("<?php echo $row['entry']; ?>");
  marker<?php echo $mrk; ?>.addTo(mapCompendium);
  </script>
  <?php
    $mrk = $mrk + 1;

}
 ?>

<?php
$worldtitle = "SELECT * FROM campaignlog WHERE active = 1";
$titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
$mrk = 1;
while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
  ?>
  <script>
  var markerPos<?php echo $mrk; ?> = new L.LatLng(<?php echo $row['coord']; ?>);
  var pinAnchor<?php echo $mrk; ?> = new L.Point(10, 32);
  var pin<?php echo $mrk; ?> = new L.Icon({ iconUrl: "/assets/images/map-marker-blue.png", iconAnchor<?php echo $mrk; ?>: pinAnchor<?php echo $mrk; ?>, iconSize: [20, 32] });
  var marker<?php echo $mrk; ?> = new L.marker(markerPos<?php echo $mrk; ?>, { icon: pin<?php echo $mrk; ?> }).addTo(map).bindPopup("<?php echo 'Day '.$row['date'].': '.$row['entry']; ?>");
//  var marker<?php echo $mrk; ?> = L.marker([<?php echo $row['coord']; ?>], {icon: myIcon}).addTo(map).bindPopup("<?php echo $row['entry']; ?>");
  marker<?php echo $mrk; ?>.addTo(mapLog);
  </script>
  <?php
    $mrk = $mrk + 1;

}
 ?>

 <?php
 $worldtitle = "SELECT * FROM mapfeatures";
 $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
 $mrk = 1;
 while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
   ?>
   <script>
   var bmarkerPos<?php echo $mrk; ?> = new L.LatLng(<?php echo $row['coord']; ?>);
   var bpinAnchor<?php echo $mrk; ?> = new L.Point(10, 32);
   var bpin<?php echo $mrk; ?> = new L.Icon({ iconUrl: "/assets/images/map-marker-red.png", iconAnchor<?php echo $mrk; ?>: bpinAnchor<?php echo $mrk; ?>, iconSize: [20, 32] });
   var bmarker<?php echo $mrk; ?> = new L.marker(bmarkerPos<?php echo $mrk; ?>, { icon: bpin<?php echo $mrk; ?> }).addTo(map).bindPopup("<?php echo $row['text']; ?>");
 //  var marker<?php echo $mrk; ?> = L.marker([<?php echo $row['coord']; ?>], {icon: myIcon}).addTo(map).bindPopup("<?php echo $row['text']; ?>");
   bmarker<?php echo $mrk; ?>.addTo(mapFeatures);
   </script>
   <?php
     $mrk = $mrk + 1;

 }
  ?>
  <div class="table-responsive">
 <table id="faction" class="table table-condensed table-striped table-responsive dt-responsive" cellspacing="0" width="100%">
      <thead class="thead-dark">
          <tr>
              <th scope="col">Coord</th>
             <th scope="col">Text</th>
          </tr>
      </thead>
      <tfoot>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Text</th>
          </tr>
      </tfoot>
      <tbody>
        <?php
        $logtitle = "SELECT * FROM mapfeatures";
        $logdata = mysqli_query($dbcon, $logtitle) or die('error getting data');
        while($row =  mysqli_fetch_array($logdata, MYSQLI_ASSOC)) {
          echo ('<tr>');
          echo ('<td><a onclick="movemap'.$row['id'].'()">'.$row['coord'].'</a></td>'); ?>
          <script>
          function movemap<?php echo $row['id'] ?>() {
              map.setView(new L.LatLng(<?php echo $row['coord']; ?>), 4);
          }
          </script>
          <?php
          echo ('<td>'.$row['text'].'</td>');
          echo ('</tr>');
         }
          ?>

 </tbody>
 </table>
 <script>
 $(document).ready(function() {
 // Setup - add a text input to each footer cell
 $('#faction tfoot th').each( function () {
   var title = $(this).text();
   $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
 } );

 // DataTable
 var table = $('#faction').DataTable();

 // Apply the search
 table.columns().every( function () {
   var that = this;

   $( 'input', this.footer() ).on( 'keyup change', function () {
       if ( that.search() !== this.value ) {
           that
               .search( this.value )
               .draw();
       }
   } );
 } );
 } );
 </script>
 </div>
</div>
</div>
<script>
<?php
if ($id == 'notset') {
 ?>
map.setView(new L.LatLng(-219.375, 0.369713));
<?php }
else { ?>
  map.setView(new L.LatLng(<?php echo $id; ?>), 4);

<?php } ?>
</script>

   <?php
   //Footer
   $footpath = $_SERVER['DOCUMENT_ROOT'];
   $footpath .= "/footer.php";
   include_once($footpath);
    ?>
