<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $pgtitle = 'Master - ';
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
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
   integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
   crossorigin=""/>
   <!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
  integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
  crossorigin=""></script>
 
   <div class="mainbox col-lg-12 col-xs-12">

     <!-- Page Header -->
     <div class="col-md-12">

   </div>
     <div class="body sidebartext col-xs-12" style="padding-left:0%;" id="body">
     <div id="test1">TEST</div>


      <div class="col-sm-2" id="nav-pane" height="100%" style="background-color:#16181a; border-radius:25px; margin-top:10px;">
        <input id="searchbar" type="text" onkeyup="livesearch()" style="text-align:left; color:black;"></input>
        <div id="left-pane">
        <button class="btn btn-primary" id="expandcollapse" onClick="expandCollapse()">Expand All</button>
        <h3 id="sessionbutton">+ Session Notes</h3>
        <div id="session" class="nonav">
        <div id="createnote" style="color:#42f486;" onClick="newNote()">Create New +</div>
        <input type="text" class="nonav" id="newnote" style="background-color:#1f2123; color:#fff; width:80%; text-align:left;"></input><button class="btn btn-success nonav" onClick="createNote()" id="notebutton">&#10004;</button>
        <div id="tempnote"></div>
        <?php
        $folders = "SELECT title, id FROM world WHERE type LIKE 'session note' AND worlduser LIKE 'tarfuin' ORDER BY id DESC";
        $folderdata = mysqli_query($dbcon, $folders) or die('error getting data');
        while($row =  mysqli_fetch_array($folderdata, MYSQLI_ASSOC)) {
          //$cleanrow = str_replace(" ", "_", $row['title']);
          echo ('<div id="'.$row['title'].'head" onClick=showpanel("'.$row['id'].'")>'.$row['title'].'</div>');
        }      
        ?>


        </div>


        <h3 id="deitybutton">+ Deities</h3>
        <div id="deities" class="nonav">
        <?php
        $folders = "SELECT title, id FROM world WHERE type LIKE 'deity' AND worlduser LIKE 'tarfuin' ORDER BY title ASC";
        $folderdata = mysqli_query($dbcon, $folders) or die('error getting data');
        while($row =  mysqli_fetch_array($folderdata, MYSQLI_ASSOC)) {
          //$cleanrow = str_replace(" ", "_", $row['title']);
          echo ('<div id="'.$row['title'].'head" onClick=showpanel("'.$row['id'].'")>'.$row['title'].'</div>');
        }      
        ?>
        </div>

        <h3 id="factionbutton">+ Factions</h3>
        <div id="factions" class="nonav">
        <?php
        $folders = "SELECT title, id FROM world WHERE type LIKE 'faction' AND worlduser LIKE 'tarfuin' ORDER BY title ASC";
        $folderdata = mysqli_query($dbcon, $folders) or die('error getting data');
        while($row =  mysqli_fetch_array($folderdata, MYSQLI_ASSOC)) {
          //$cleanrow = str_replace(" ", "_", $row['title']);
          echo ('<div id="'.$row['title'].'head" onClick=showpanel("'.$row['id'].'")>'.$row['title'].'</div>');
        }      
        ?>
        </div>

        <h3 id="locationbutton">+ Locations</h3>
        <div id="locations" class="nonav">
        <?php
        $folders = "SELECT title, id FROM world WHERE type LIKE 'location' AND worlduser LIKE 'tarfuin' ORDER BY title ASC";
        $folderdata = mysqli_query($dbcon, $folders) or die('error getting data');
        while($row =  mysqli_fetch_array($folderdata, MYSQLI_ASSOC)) {
          //$cleanrow = str_replace(" ", "_", $row['title']);
          echo ('<div id="'.$row['title'].'head" onClick=showpanel("'.$row['id'].'")>'.$row['title'].'</div>');
        }      
        ?>
        </div>

        <h3 id="mapbutton">+ Maps</h3>
        <div id="maps" class="nonav">
        <div id="regionmaphead" onClick="showpanel('regionmap')">Region Map</div>
        <div id="thepikehead" onClick="showpanel('thepike')">The Pike</div>
      </div>

        <h3 id="notesbutton">+ Notes</h3>
        <div id="notes" class="nonav">
        <?php
        $folders = "SELECT title, id FROM world WHERE type LIKE 'Note' AND worlduser LIKE 'tarfuin' ORDER BY title ASC";
        $folderdata = mysqli_query($dbcon, $folders) or die('error getting data');
        while($row =  mysqli_fetch_array($folderdata, MYSQLI_ASSOC)) {
          //$cleanrow = str_replace(" ", "_", $row['title']);
          echo ('<div id="'.$row['title'].'head" onClick=showpanel("'.$row['id'].'")>'.$row['title'].'</div>');
        }      
        ?>
        </div>

        <h3 id="npcbutton">+ NPCs</h3>
        <div id="npcs" class="nonav">
        <?php
        $folders = "SELECT title, id FROM world WHERE type LIKE 'npc' AND worlduser LIKE 'tarfuin' ORDER BY title ASC";
        $folderdata = mysqli_query($dbcon, $folders) or die('error getting data');
        while($row =  mysqli_fetch_array($folderdata, MYSQLI_ASSOC)) {
          //$cleanrow = str_replace(" ", "_", $row['title']);
          echo ('<div id="'.$row['title'].'head" onClick=showpanel("'.$row['id'].'")>'.$row['title'].'</div>');
        }      
        ?>
        </div>

        <h3 id="pcbutton">+ PCs</h3>
        <div id="pcs" class="nonav">
        <?php
        $folders = "SELECT title, id FROM world WHERE type LIKE 'player character' AND worlduser LIKE 'tarfuin' ORDER BY title ASC";
        $folderdata = mysqli_query($dbcon, $folders) or die('error getting data');
        while($row =  mysqli_fetch_array($folderdata, MYSQLI_ASSOC)) {
          //$cleanrow = str_replace(" ", "_", $row['title']);
          echo ('<div id="'.$row['title'].'head" onClick=showpanel("'.$row['id'].'")>'.$row['title'].'</div>');
        }      
        ?>

        </div>

        <h3 id="questbutton">+ Quests</h3>
        <div id="quests" class="nonav">
        <?php
        $folders = "SELECT title, id FROM world WHERE type LIKE 'quest' AND worlduser LIKE 'tarfuin' ORDER BY title ASC";
        $folderdata = mysqli_query($dbcon, $folders) or die('error getting data');
        while($row =  mysqli_fetch_array($folderdata, MYSQLI_ASSOC)) {
          //$cleanrow = str_replace(" ", "_", $row['title']);
          echo ('<div id="'.$row['title'].'head" onClick=showpanel("'.$row['id'].'")>'.$row['title'].'</div>');
        }      
        ?>

        </div>

        </div>
        <div class="nonav" id="flex-nav" style="font-size:12px;">

        </div>
      </div>

      <div class="col-sm-10 nonav" id="editnote">
        <div id="noteid" class="nonav"></div>
        <input type="text" id="notetitle" style="background-color:#1f2123; color:#fff; width:300px; text-align:left;"></input><button class="btn btn-primary" onClick="closeEdit()">Close</button><p>
        <textarea type="text" id="notebody" style="background-color:#1f2123; color:#fff; margin-left:0px;"></textarea><div id="namesuggest"></div>
        <div id="toreplace" class="nonav"></div>
        <div id="lastsaved"></div>
        <div class="nonav" id="mapdiv"><iframe id ="mapframe" src="map-raw.php" width="100%" height="600px"></iframe></div>
      </div>
 
      <div class="col-sm-10" id="mainpanel">
        
      </div>
<style>
  .popover {
    background-color:#141617;
    max-width: 400px;
  }


  </style>
<script>

function closeEdit(){
  $('#editnote').addClass('nonav');
}

function createNote(){
  var noteTitle = $('#newnote').val();
  var noteBody = '';
  var worlduser = '<?php echo $loguser; ?>';

  $.ajax({
    url : 'createnote.php',
    type: 'GET',
    data : { "noteTitle" : noteTitle, "noteBody" : noteBody, "worlduser" : worlduser },
    success: function(data)
    {
      data = parseInt(data);
      var quotedata = '\"' + data + '\"';
      quotedata = quotedata.replace(/\s/g, '');
      $('#notebutton').addClass('nonav');
      $('#newnote').addClass('nonav');
      $('#mainpanel').addClass('nonav');
      $('#editnote').removeClass('nonav');
      $('#notetitle').val(noteTitle);
      $('#noteid').html(data);
      $('#tempnote').html('<div id="'+noteTitle+'head" onClick="showpanel('+data+')">'+noteTitle+'</div>');
      editNote();

    },
    error: function (jqXHR, status, errorThrown)
    {

    }
    });



  $('#noteBody').prop('disabled', false);
}

function showpanel(value){
  //value = value.replace(/\_/g, ' ');
  var bodyID = value;

  if (value == 'regionmap'){
    $(function() {
      //$('#mainpanel').load('map-region.php');
      //$('#mainpanel').html(newdata);

      $.get('map-region.php', function(maphtml){
        var mapextract = maphtml.split('<div id="extract">');
        var mapdoc = '<div id="extract">' + mapextract[1];
        $('#mainpanel').html(mapdoc);
      });

      $('#newnote').addClass('nonav');
      $('#editnote').addClass('nonav');
      $('#mainpanel').removeClass('nonav');
    });
  }


  else if (value == 'thepike'){
    var newdata = '<img src="/assets/images/The Pike.webp" width="80%" />';
    $('#mainpanel').html(newdata);
    $('#newnote').addClass('nonav');
    $('#editnote').addClass('nonav');
    $('#mainpanel').removeClass('nonav');
  }

  else{

  $.ajax({
    url : 'getbody.php',
    type: 'GET',
    data : { "bodyID" : bodyID },
    success: function(data)
    {

      var mapfind = data.split('!');
      var newdata = data;
      for (let i = 1; i < mapfind.length; i++) {
        if (mapfind[i].startsWith('(')){
          var mapfindfull = '!' + mapfind[i] + '!';
          mapfind[i] = mapfind[i].replaceAll('(','');
          mapfind[i] = mapfind[i].replaceAll(')','');
          newdata = newdata.replaceAll(mapfindfull,'<span class="d-inline-block maphover" data-placement="auto" data-toggle="popover" data-content="<iframe width=\'600px;\' height=\'370px\' src=\'map-raw.php?id=' + mapfind[i]+'\' />" style="color:#94A0CE; cursor:pointer;">(' + mapfind[i] +')</span>');
        }
    }
      //var newdata = data.replace(mapfind,'<span class="d-inline-block maphover" data-placement="auto" data-toggle="popover" data-content="<iframe width=\'600px;\' height=\'370px\' src=\'map-raw.php?id='+mapfindclean+'\' />">' + mapfindclean + '</span>');
      //var newdata = data.replace(mapfind,'hi');
      $('#mainpanel').html(newdata);
      $('#newnote').addClass('nonav');
      //$('#editnote').addClass('nonav');
      $('#mainpanel').removeClass('nonav');
      $('[class="d-inline-block maphover"]').popover({
        trigger: "click",
        sanitize: "false",
        html: "true"
      }); 

      $('[class="d-inline-block hovershow"]').popover({
        trigger: "hover",
        sanitize: "false",
        html: "true"
      }); 


    },
    error: function (jqXHR, status, errorThrown)
    {

    }
    });
  }
}

function htmlDecode(input) {
  var doc = new DOMParser().parseFromString(input, "text/html");
  return doc.documentElement.textContent;
}

function newNote(){
  $('#notebutton').removeClass('nonav');
  $('#newnote').removeClass('nonav');
}

function editNote(value){
  $('#editnote').removeClass('nonav');
  $('#mainpanel').addClass('nonav');
  $('#lastsaved').html('');

  var editID = value;
  $.ajax({
    url : 'getedit.php',
    type: 'GET',
    data : { "editID" : editID },
    //dataType: 'json',
    success: function(editdata)
    {
      var editfields = JSON.parse(editdata);
      $('#notetitle').val(editfields[0]);
      var notefix = htmlDecode(editfields[1]);
      $('#notebody').val(notefix);
      $('#noteid').html(editfields[2]);
      //$('#notebody').val(editdata);
    },
    error: function (jqXHR, status, errorThrown)
    {

    }
    });
}

$('#notebody').change(function (){
  autosave();
});

function autosave(){
  var noteBody = $('#notebody').val();
  var noteID = $('#noteid').html();

  $.ajax({
    url : 'saveedit.php',
    type: 'GET',
    data : { "noteID" : noteID, "noteBody" : noteBody },
    success: function(data)
    {
      $('#lastsaved').html(data)
    },
    error: function (jqXHR, status, errorThrown)
    {

    }
    });
}


$.fn.selectRange = function(start, end) {
    if(end === undefined) {
        end = start;
    }
    return this.each(function() {
        if('selectionStart' in this) {
            this.selectionStart = start;
            this.selectionEnd = end;
        } else if(this.setSelectionRange) {
            this.setSelectionRange(start, end);
        } else if(this.createTextRange) {
            var range = this.createTextRange();
            range.collapse(true);
            range.moveEnd('character', end);
            range.moveStart('character', start);
            range.select();
        }
    });
};


$("#notebody").keyup(function(e) {
  var editText = $('#notebody').val();
  if (editText.includes('@') == true){
    //editText.replace("@","@@");
 var tempquery = editText.split("@");
 var cursorPos= $("#notebody"). prop('selectionStart');
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
  else {
    $('#namesuggest').html('');
  }

    
  }
  if (editText.includes('!map') == true){
    $('#mapdiv').removeClass('nonav');
    
  }
  else {
    $('#mapdiv').addClass('nonav');
  }

})

$('#mapframe').on('load', function() {
  var iframe = $(this).contents();
  iframe.find('#image-map').click( function() {
    var coordraw = iframe.find('.leaflet-popup-content').html();
    if (coordraw){
      if (coordraw.includes("You clicked")){
    var coord = '!' + coordraw.substring(coordraw.indexOf("("),coordraw.lastIndexOf(")") + 1) + '!';
    var mapbody = $('#notebody').val();
    var newmapbody = mapbody.replace("!map",coord);
    $('#notebody').val(newmapbody);
      }
    }
  });
});

function nameinsert(value){
  
  var editbody = $('#notebody').val();
  var autoquery = '@' + $('#toreplace').html();

  var newbody = editbody.replace(autoquery,value);
  $('#notebody').val(newbody);
  $('#notebody').focus();
  $('#namesuggest').html('');
  autosave();

}

function imgshow(){
    $("#img").slideToggle("fast");
}

function livesearch(){
  var value = $('#searchbar').val();
  var searchLength = value.length;
  if (searchLength >= 3){
    
  if (value.includes('+')) {
    var values = value.split('+');
    
    $.ajax({
    url : 'livesearch1.php',
    type: 'GET',
    data : { "value" : values[0], "value1" : values[1] },
    success: function(searchdata)
    {
      $('#test1').html(values[1]);
      $('#flex-nav').html(searchdata);
      $("#flex-nav").removeClass('nonav');
      $("#left-pane").addClass('nonav');
    },
    error: function (jqXHR, status, errorThrown)
    {
      $('#test1').html('FAIL');
    }
    });
  }
  else {
  $.ajax({
    url : 'livesearch.php',
    type: 'GET',
    data : { "value" : value },
    success: function(searchdata)
    {
      $('#flex-nav').html(searchdata);
      $("#flex-nav").removeClass('nonav');
      $("#left-pane").addClass('nonav');
    },
    error: function (jqXHR, status, errorThrown)
    {

    }
    });

  }
}
  else {
      $("#flex-nav").addClass('nonav');
      $("#left-pane").removeClass('nonav');
  }
  
}



$(document).ready(function(){
            $("#deitybutton").click(function (){
                $("#deities").slideToggle("fast");
                var deitystate = $('#deitybutton').html();
                if (deitystate == '- Deities'){
                  $('#deitybutton').html('+ Deities');
                }
                else {
                  $('#deitybutton').html('- Deities');
                }
            });

            $("#npcbutton").click(function (){
                $("#npcs").slideToggle("fast");
                var npcstate = $('#npcbutton').html();
                if (npcstate == '- NPCs'){
                  $('#npcbutton').html('+ NPCs');
                }
                else {
                  $('#npcbutton').html('- NPCs');
                }
            });
            
            $("#factionbutton").click(function (){
                $("#factions").slideToggle("fast");
                var factionstate = $('#factionbutton').html();
                if (factionstate == '- Factions'){
                  $('#factionbutton').html('+ Factions');
                }
                else {
                  $('#factionbutton').html('- Factions');
                }
            });

            $("#locationbutton").click(function (){
                $("#locations").slideToggle("fast");
                var locationstate = $('#locationbutton').html();
                if (locationstate == '- Locations'){
                  $('#locationbutton').html('+ Locations');
                }
                else {
                  $('#locationbutton').html('- Locations');
                }
            });

            $("#mapbutton").click(function (){
                $("#maps").slideToggle("fast");
                var mapstate = $('#mapbutton').html();
                if (mapstate == '- Maps'){
                  $('#mapbutton').html('+ Maps');
                }
                else {
                  $('#mapbutton').html('- Maps');
                }
            });

            $("#pcbutton").click(function (){
                $("#pcs").slideToggle("fast");
                var pcstate = $('#pcbutton').html();
                if (pcstate == '- PCs'){
                  $('#pcbutton').html('+ PCs');
                }
                else {
                  $('#pcbutton').html('- PCs');
                }
            });

            $("#questbutton").click(function (){
                $("#quests").slideToggle("fast");
                var pcstate = $('#questbutton').html();
                if (pcstate == '- Quests'){
                  $('#questbutton').html('+ Quests');
                }
                else {
                  $('#questbutton').html('- Quests');
                }
            });

            $("#notesbutton").click(function (){
                $("#notes").slideToggle("fast");
                var notestate = $('#notesbutton').html();
                if (notestate == '- Notes'){
                  $('#notesbutton').html('+ Notes');
                }
                else {
                  $('#notesbutton').html('- Notes');
                }
            });
            $("#sessionbutton").click(function (){
                $("#session").slideToggle("fast");
                var sessionstate = $('#sessionbutton').html();
                if (sessionstate == '- Session Notes'){
                  $('#sessionbutton').html('+ Session Notes');
                }
                else {
                  $('#sessionbutton').html('- Session Notes');
                }
            });
        });

  function expandCollapse(){
    var status = $('#expandcollapse').html();
    if (status == 'Collapse All'){
      $("#session").slideUp("fast");
      $("#deities").slideUp("fast");
      $("#factions").slideUp("fast");
      $("#locations").slideUp("fast");
      $("#maps").slideUp("fast");
      $("#notes").slideUp("fast");
      $("#npcs").slideUp("fast");
      $("#pcs").slideUp("fast");

      $('#sessionbutton').html('+ Session Notes');
      $('#notesbutton').html('+ Notes');
      $('#pcbutton').html('+ PCs');
      $('#npcbutton').html('+ NPCs');
      $('#locationbutton').html('+ Locations');
      $('#mapbutton').html('+ Maps');
      $('#factionbutton').html('+ Factions');
      $('#deitybutton').html('+ Deities');

      $('#expandcollapse').html('Expand All');
    }
    else {
      $("#session").slideDown("fast");
      $("#deities").slideDown("fast");
      $("#factions").slideDown("fast");
      $("#locations").slideDown("fast");
      $("#maps").slideDown("fast");
      $("#notes").slideDown("fast");
      $("#npcs").slideDown("fast");
      $("#pcs").slideDown("fast");

      $('#sessionbutton').html('- Session Notes');
      $('#notesbutton').html('- Notes');
      $('#pcbutton').html('- PCs');
      $('#npcbutton').html('- NPCs');
      $('#locationbutton').html('- Locations');
      $('#mapbutton').html('- Maps');
      $('#factionbutton').html('- Factions');
      $('#deitybutton').html('- Deities');

      $('#expandcollapse').html('Collapse All');
    }
  }

  </script>

</div>
</div>
</div>
   <?php
   //Footer
   $footpath = $_SERVER['DOCUMENT_ROOT'];
   $footpath .= "/footer.php";
   include_once($footpath);
    ?>
