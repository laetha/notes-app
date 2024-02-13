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
   <script src="/plugins/ckeditor/build/ckeditor.js" type="text/javascript"></script>
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

      <div class="col-sm-2" id="nav-pane" height="100%" style="background-color:#16181a; border-radius:25px; margin-top:10px;">
        <input id="searchbar" type="text" onkeyup="livesearch()" style="text-align:left; color:black;"></input>
        <div id="left-pane">
        <button class="btn btn-primary" id="expandcollapse" onClick="expandCollapse()">Expand All</button>
        <div id="createnote" style="color:#42f486;" onClick="newNote()">Create New +</div>

        <!-- <input type="text" class="nonav" id="newnote" style="background-color:#1f2123; color:#fff; width:80%; text-align:left;"></input><button class="btn btn-success nonav" onClick="createNote()" id="notebutton">&#10004;</button> -->
        <div id="toc">

        </div>

        <div id="tempnote">

        </div>

        </div>
        <div class="nonav" id="flex-nav" style="font-size:12px;">
        </div>
      </div>


      <div class="col-sm-10 nonav" id="editnote">
        <div id="noteid" class="nonav"></div>
        <textarea type="text" id="notebody" style="background-color:#1f2123; color:#fff; margin-left:0px;"></textarea><div id="namesuggest"></div>
        <div id="toreplace" class="nonav"></div>
      </div>
 
      <div class="col-sm-10" id="mainpanel">
        <div id="container" style="min-height:400px;">
        <input type="text" id="filetitle" value=""></input>
       <!-- <input type="text" id="filepath" value=""></input> -->
        <div id="fileID" class="nonav"></div>
          <div id="editor" class="nonav"></div>
        </div>
      </div>
      <div id="lastsaved"></div>

<script>

      ClassicEditor.create( document.querySelector( '#editor' ), {

    removePlugins: [ 'Title' ]/*,

    autosave: {
        save( editor ) {
            return saveData( editor.getData() );
        }

    }*/

    // ... other configuration options.
} )
.then( editor => {
    window.editor = editor;
});

$(document).ready(function(){
  $('#filetitle').val('');
  leftpane();

});

function leftpane(){
  $.ajax({
    url: 'getleftpane.php',
    type: 'GET',
    success: function(data)
    {
      $('#toc').html(data);
    },
    error: function (jqXHR, status, errorThrown)
    {

    }

  });
}



function showpanel(value){

  editor.destroy().catch( error => {
    console.log( error );
} );

$('#filetitle').val('');

var bodyID = value;

$.ajax({
    url : 'getbody.php',
    type: 'GET',
    data : { "bodyID" : bodyID },
    success: function(data)
    {
      $('#fileID').html(value);
      var newData = JSON.parse(data);
      $('#filetitle').val(newData[0]);
      //editor.setData(newData[1]);
      ClassicEditor.create( document.querySelector( '#editor' ), {

removePlugins: [ 'Title' ],
initialData: newData[1],

autosave: {
    save( editor ) {
        return saveData( editor.getData() );
    }

}

// ... other configuration options.
} )
.then( editor => {
window.editor = editor;

});


      $('#mainpanel').removeClass('nonav');
      $('#editor').removeClass('nonav');
    },
    
    error: function (jqXHR, status, errorThrown)
    {
     // editor.setData(status);
    }
    });

  }


function saveData(value){
  var noteTitle = $('#filetitle').val();
  var noteID = $('#fileID').html();
  
  $.ajax({
    url: 'savedata.php',
    data: { "noteBody" : value, "noteTitle" : noteTitle, "noteID" : noteID },
    type: 'GET',
    success: function(data)
    {
      $('#lastsaved').html(data)
    },
    error: function (jqXHR, status, errorThrown)
    {
      $('#lastsaved').html(errorThrown)
    }


  });
}

function newNote(){

$('#filetitle').val('Untitled');

//var bodyID = value;

$.ajax({
    url : 'newnote.php',
    type: 'GET',
    success: function(data)
    {
      $('#fileID').html(data);
/*      ClassicEditor.create( document.querySelector( '#editor' ), {

removePlugins: [ 'Title' ],
initialData: ''
// ... other configuration options.
} )
.then( editor => {
window.editor = editor;

});


      $('#mainpanel').removeClass('nonav');
      $('#editor').removeClass('nonav');*/
      showpanel(data);
    },
    
    error: function (jqXHR, status, errorThrown)
    {
      //editor.setData(status);
    }
    });
  
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
