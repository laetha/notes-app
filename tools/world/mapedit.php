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
        $worldedit = "SELECT * FROM `mapfeatures` WHERE `id` LIKE '$id'";
        $editdata = mysqli_query($dbcon, $worldedit) or die('error getting data');
        while($editrow =  mysqli_fetch_array($editdata, MYSQLI_ASSOC)) {
          $editid = $editrow['id'];
          $edittext = $editrow['text'];
          $coord = $editrow['coord'];
        }
      ?>
         <div class="tocbox col-md-12">
           <div class ="body bodytext">
         <h1 class="pagetitle">Edit Map Feature</h1>
         <div id="test"></div>
       <div class="col-md-10 col-centered">
        <div id="extract">
         <div class="col-sm-6 typebox col-centered" id="name">
             <form method="post" action="mapprocess.php" id="import" enctype="multipart/form-data">
             <select form="import" name="editid" id="editid" style="display:none;" required="yes">
                  <option id="tmptype" value="<?php echo $editid; ?>" selected></option>
                  </select>
                  <select form="import" name="coord" id="coord" style="display:none;" required="yes">
                  <option id="tmptype" value="<?php echo $coord; ?>" selected></option>
                  </select>
                  <div class="text col-centered col-md-12"><textarea type="text" name="body" id="body"><?php echo $edittext; ?></textarea></div>
           <div id="namesuggest"></div>

<script>
// Using leaflet.js to pan and zoom a big image.
// See also: http://kempe.net/blog/2014/06/14/leaflet-pan-zoom-image.html


  $("#body").keyup(function(e) {
  var editText = $('#body').val();
  if (editText.includes('@') == true){
    //var autoquery = editText.split("@");
    var autoquery = editText.substring(editText.indexOf("@") + 1, editText.lastIndexOf("@"));
    var querylength = autoquery.length;
    if (querylength >= 3){
   
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
  var toReplace = editbody.split("@");
  var newReplace = '@' + toReplace[1] + '@';
  var newbody = editbody.replace(newReplace,value);
  $('#body').val(newbody);
  $('#body').focus();
  $('#namesuggest').html('');
}

             </script>
</div>

       <div class="col-centered">
       <input class="btn btn-primary col-centered inline" type="submit" value="Save">
       <a class="clean" href="mapfeature.php"><button class="btn btn-danger col-centered inline" type="button">Cancel</button></a>
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

<!-- Footer -->
<?php
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath);
 ?>
