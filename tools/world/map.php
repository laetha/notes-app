<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $pgtitle = 'City Map - ';
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
      <div class="pagetitle" id="pgtitle">City Map</div>
      <p><button class="btn btn-info" id="addbutton">Add to Log</button></p>

      
    </div>
      <div class="body sidebartext col-xs-12" id="body">
     

  <!-- Add to Log -->
  
    <div id="adddiv" style="display:none;">
      <div class="row">
      <form method="post" action="logprocess.php" id="logadd">
        <div class="hide" style="padding-bottom:20px;"><input class="searchbox" style="width:100%;" type="text" name="worlduser" id="worlduser" value="<?php echo $loguser; ?>"></div>
        <div class="col-md-2" style="padding-bottom:20px;"><input class="searchbox" style="width:100%;" type="text" name="logdate" id="logdate" placeholder="day #"></div>
        <div class="col-md-2" style="padding-bottom:20px;"><input class="searchbox" style="width:100%;" type="text" name="logcoord" id="logcoord" placeholder="coordinates"></div>
        <div class="col-md-5" style="padding-bottom:20px;"><input class="searchbox" style="width:100%;" type="text" name="logentry" id="logentry" placeholder="Log Entry...."></div>
        <input name="logmap" value="0" type="hidden">
        <div class="col-md-1 sidebartext" style="padding-bottom:20px;"><input type="checkbox" name="logmap" value="1">Map?
        <button type="button" class="btn btn-primary" onclick="myGen()">Gen</button></div>
        <div class="hide"><input class="searchbox" style="width:100%;" type="text" name="maptype" id="maptype" value="city"></div>
        <div class="col-md-1"><input class="btn btn-primary" type="submit" value="Submit"></div>
    </form>
  </div>

  </div>
  <script>
  $(document).ready(function addLog(){
      $("#addbutton").click(function addLog(){
          $("#adddiv").slideToggle("slow");
      });
  });

  $(document).ready(function() {
    
            var currentDate = new Date();
            var date = currentDate.getDate();
            var month = currentDate.getMonth();
            var year = currentDate.getFullYear();
            var dateString = year + "-" + (month + 1) + "-" + date;
            $('#logdate').val(dateString);
// Setup - add a text input to each footer cell
  });
  </script>

<div class="table-responsive sidebartext">
<table id="campaignlog" class="table table-condensed table-striped table-responsive dt-responsive sidebartext" cellspacing="0" width="100%">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Day</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col">Coord</th>
            <th scope="col">Entry</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
          <th scope="col">Day</th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col">Coord</th>
          <th scope="col">Entry</th>
        </tr>
    </tfoot>
    <tbody id="thelog">
      <?php
      $logtitle = "SELECT * FROM campaignlog WHERE active=1 AND worlduser LIKE '$loguser' AND maptype LIKE 'city' ORDER BY date DESC ";
      $logdata = mysqli_query($dbcon, $logtitle) or die('error getting data');
      while($row =  mysqli_fetch_array($logdata, MYSQLI_ASSOC)) {
        echo ('<tr><td>');
        echo ($row['date'].'</td>');
        echo ('<td><button type="button" class="logbtn btn btn-danger btn-sq-xs" name="deleteItem" id="delete-log" data-toggle="modal" data-target="#deleteModal'.$row['id'].'"><span class="glyphicon glyphicon-remove"></span></button></td>');
        echo ('<td><button type="button" class="logbtn btn btn-info btn-sq-xs" id="edit-log" data-toggle="modal" data-target="#editModal'.$row['id'].'"><span class="glyphicon glyphicon-edit"></span></button></td>');
        echo ('<td><a href="/tools/world/map.php?id='.$row['coord'].'" target="_BLANK">'.$row['coord'].'</a></td>');

        echo ('<td>'.$row['entry'].'</td>');
        echo ('</tr>');
?>
        <!-- EDIT Modal -->
        <div class="modal fade" id="editModal<?php echo $row['id']; ?>" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content modalstyle bodytext">

              <div class="modal-body">
                <form method="post" action="logedit.php?editid=<?php echo $row['id']; ?>" id="edit<?php echo $row['id']; ?>">
                  <input form="edit<?php echo $row['id']; ?>" type="text" class="logeditdate" name="editdate<?php echo $row['id']; ?>" id="date<?php echo $row['id']; ?>" placeholder="Date..." value="" />
                  <input form="edit<?php echo $row['id']; ?>" class="logeditcoord" type="text" name="editcoord<?php echo $row['id']; ?>" id="coordentry<?php echo $row['id']; ?>" placeholder="Coord..." value="" />
                  <input form="edit<?php echo $row['id']; ?>" class="logeditentry" type="text" name="editentry<?php echo $row['id']; ?>" id="editentry<?php echo $row['id']; ?>" placeholder="Entry..." value="" />
                  <button form="edit<?php echo $row['id']; ?>"class="logbtn btn btn-info btn-sq-xs" id="editconfirm" type="submit" value="Save" />
                    <span class="glyphicon glyphicon-ok"></span></button>
                </form>
                <p></p><p>Old Text:</p>
                <p class="sidebartext">
                <?php echo $row['entry']; ?></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>

        <!-- DELETE Modal -->
        <div class="modal fade" id="deleteModal<?php echo $row['id']; ?>" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content modalstyle bodytext">

              <div class="modal-body">
                <p>Are you sure you want to delete <em>"<?php echo $row['entry']; ?>"</em>?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info delform" data-dismiss="modal">Go Back</button>
                    <a href="logdelete.php?id=<?php echo $row['id']; ?>"><button class="btn btn-danger delform">Delete</button></a>
              </div>
            </div>

          </div>
        </div>

<?php


      }
        ?>

</tbody>
</table>
<script>
$(document).ready(function() {

// DataTable
var table = $('#campaignlog').DataTable(
  {
    "order": [[ 0, "desc" ]],
    "columnDefs": [
  { "width": "50px", "targets": 0 },
  { "width": "15px", "targets": 1 },
  { "width": "15px", "targets": 2 },
  { "width": "50px", "targets": 3 }


]
  }
);


} );
</script>




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
  minZoom: 3,
  maxZoom: 7,
  maxNativeZoom: 10,
  center: [0, 0],
  zoom: 3,
  crs: L.CRS.Simple,
  scrollWheelZoom:'center'

});
var mapFeatures = L.layerGroup();
var mapLog = L.layerGroup();
var mapCompendium = L.layerGroup();


var overlayMaps = {
    /*"Map Feautures": mapFeatures,*/
    "Campaign Log": mapLog,
    "Compendium": mapCompendium
};


L.control.layers(null, overlayMaps).addTo(map);


// dimensions of the image
var w = 2259*6,
    h = 1435*6,
    url = '/assets/images/City2.png';

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

</script>



<?php
$worldtitle = "SELECT * FROM campaignlog WHERE active = 1 AND worlduser LIKE '$loguser' AND maptype LIKE 'city'";
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



  <div class="table-responsive">
 <table id="faction" class="table table-condensed table-striped table-responsive dt-responsive" cellspacing="0" width="100%">
      <thead class="thead-dark">
          <tr>
              <th scope="col">Coord</th>
             <th scope="col">Establishment</th>
             <th scope="col">Type</th>
             <th scope="col">Proprieter</th>
          </tr>
      </thead>
      <tfoot>
          <tr>
          <th scope="col">Coord</th>
             <th scope="col">Establishment</th>
             <th scope="col">Type</th>
             <th scope="col">Proprieter</th>
          </tr>
      </tfoot>
      <tbody>
        <?php
        $logtitle = "SELECT * FROM world WHERE coord NOT LIKE '' AND worlduser LIKE '$loguser'";
        $logdata = mysqli_query($dbcon, $logtitle) or die('error getting data');
        while($row =  mysqli_fetch_array($logdata, MYSQLI_ASSOC)) {
          $temptitle = $row['title'];
          echo ('<tr>');
          echo ('<td>'.$row['coord'].'</td>'); ?>
          <script>
          function movemap<?php echo $row['id'] ?>() {
              map.setView(new L.LatLng(<?php echo $row['coord']; ?>), 4);
          }
          </script>
          <?php
          echo ('<td><a href="world.php?id='.$row['title'].'" target="_BLANK">'.$row['title'].'</a></td>');
          echo ('<td>'.$row['est_type'].'</td>');
        $log1title = "SELECT title FROM world WHERE npc_est LIKE '$temptitle' AND worlduser LIKE '$loguser'";
        $log1data = mysqli_query($dbcon, $log1title) or die('error getting data');
        if ($log1data->num_rows == 1){
        while($row1 =  mysqli_fetch_array($log1data, MYSQLI_ASSOC)) {
          echo ('<td><a href="world.php?id='.$row1['title'].'" target="_BLANK">'.$row1['title'].'</td>');

        }
      }
      else if ($log1data->num_rows > 1){
        echo ('<td>');
        $names = '';
        while($row1 =  mysqli_fetch_array($log1data, MYSQLI_ASSOC)) {
          echo ('<a href="world.php?id='.$row1['title'].'" target="_BLANK">'.$row1['title'].'</a>, ');
        }
        echo ('</td>');
      }
      else {
        echo ('<td></td>');
      }
          echo ('</tr>');
         }

        $log2title = "SELECT * FROM mapfeatures WHERE active = 1 AND maptype LIKE 'city'";
        $log2data = mysqli_query($dbcon, $log2title) or die('error getting data');
        while($row2 =  mysqli_fetch_array($log2data, MYSQLI_ASSOC)) {
          echo ('<tr><td>'.$row2['coord'].'</td>');
          echo ('<td>'.$row2['text'].'</td><td></td><td></td></tr>');
        }
          ?>

 </tbody>
 </table>
 </div>
  <script>


 $(document).ready(function() {
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
for (i = 0; i < x.length; i++) {
  x[i].click();
    }
}, 500);

setTimeout(function () {
  filterMarkers();
}, 200);
    

 // Setup - add a text input to each footer cell
 $('#faction tfoot th').each( function () {
   var title = $(this).text();
   $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
 } );

 // DataTable
 var table = $('#faction').DataTable();
 var markerPos = [];
      var pinAnchor = [];
      var pin = [];
      var marker = [];

 function filterMarkers(){
    mapCompendium.clearLayers();
    table.rows({search:'applied'}).every(function(index){
      var row = table.row(index);
      var data = row.data();
      var coord = data[0];
      var vtitle = data[1];
      var vtype = data[2];
      $('#test').html(coord);
      var coords = coord.split(', ');
  markerPos[index] = new L.LatLng(coords[0],coords[1]);
  pinAnchor[index] = new L.Point(10, 32);
 if (vtype == 'inn'){
  pin[index] = new L.Icon({ iconUrl: "/assets/images/icon-inn.png", iconAnchor: pinAnchor[index], iconSize: [20, 32] });
 }
 else if (vtype == 'blacksmith'){
  pin[index] = new L.Icon({ iconUrl: "/assets/images/icon-blacksmith.png", iconAnchor: pinAnchor[index], iconSize: [20, 32] });
 }
 else if (vtype == 'Jeweler'){
  pin[index] = new L.Icon({ iconUrl: "/assets/images/icon-jeweler.png", iconAnchor: pinAnchor[index], iconSize: [20, 32] });
 }
 else if (vtype == 'alchemist'){
  pin[index] = new L.Icon({ iconUrl: "/assets/images/icon-alchemist.png", iconAnchor: pinAnchor[index], iconSize: [20, 32] });
 }
 else if (vtype == 'enchanter'){
  pin[index] = new L.Icon({ iconUrl: "/assets/images/icon-enchanter.png", iconAnchor: pinAnchor[index], iconSize: [20, 32] });
 }
 else if (vtype == ''){
  pin[index] = new L.Icon({ iconUrl: "/assets/images/map-marker-red.png", iconAnchor: pinAnchor[index], iconSize: [20, 32] });

 }
 else {
  pin[index] = new L.Icon({ iconUrl: "/assets/images/map-marker-purple.png", iconAnchor: pinAnchor[index], iconSize: [20, 32] });
 }
  marker[index] = new L.marker(markerPos[index], { icon: pin[index] }).addTo(map).bindPopup(vtitle);

  marker[index].addTo(mapCompendium);

  
    });
}

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
 } );

 

 </script>
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
