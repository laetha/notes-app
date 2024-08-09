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
   if (empty($_GET['id'])) {
    $sql = "SELECT id, viewed FROM notes ORDER BY viewed DESC LIMIT 1";
    $sqldata = mysqli_query($dbcon, $sql) or die('error getting data');
    while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
      $pageid = $row['id'];
    }
   }
   else {
    $pageid = $_GET['id'];
   }


   ?>
   <script src="/plugins/ckeditor/build/ckeditor.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.js" type="text/javascript"></script>
   <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="/theme-gruvbox.css?<?php echo time(); ?>" />
   <link rel="manifest" href="manifest.json">


   <div class="mainbox col-lg-12 col-xs-12" style="padding-right:0%;">

     <!-- Page Header -->
     <div class="col-md-12">

   </div>
     <div class="body maintext col-xs-12" style="padding-left:0%; padding-right: 0%;" id="body">
     <div id="menustatus" class="nonav">closed</div>
      <div class="sidenav" id="nav-pane" height="100%">
        <a href="javascript:void(0)" class="closebtn" onclick="toggleNav()">&times;</a>
        <input id="searchbar" type="text" onkeyup="livesearch()" style="text-align:left; color:black;"></input><input id="dndcheck" type="checkbox" style="margin-left: 5px;"> DnD</input>
        <div id="left-pane">
        <!--<button class="btn btn-primary" id="expandcollapse" onClick="expandCollapse()">Expand All</button>-->
        <div id="createnote" onClick="newNote()"><strong>Create New +</strong></div>

        <!-- <input type="text" class="nonav" id="newnote" style="background-color:#1f2123; color:#fff; width:80%; text-align:left;"></input><button class="btn btn-success nonav" onClick="createNote()" id="notebutton">&#10004;</button> -->
        <div id="toc">

        </div>

        <div id="tempnote">

        </div>

        </div>
        <div class="nonav" id="flex-nav" style="font-size:12px;">
        </div>
      </div>

      <div class="col-md-8 col-sm-12" id="mainpanel" style="padding-left:0px; padding-right:0px;">
      <div id="test"></div>
        <div id="container" class="nonav" style="min-height:400px;">
        <!-- <input type="text" id="filetitle" value=""></input> -->


       <!-- <input type="text" id="filepath" value=""></input> -->
        <div id="fileID" class="nonav"></div>
        <div id="noteHistory" class="nonav"></div>
          <textarea name="editor" id="editor" class="nonav"></textarea>
          <div id="folderPreview"></div><p>
          <div class="col-md-12" id="lastsaved"></div>
          <div class="col-md-12" id="dndshow"></div>

        </div>
      </div>


      <!-- Modal -->
<div class="modal fade" id="dropmenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body" id="dropbody">
        ...
      </div>
    </div>
  </div>
</div>

      <!-- Modal -->
      <div class="modal fade" id="delwarning" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body" id="delbody">
        Delete note (including all subnotes)?
        <button class="btn btn-success" onclick="deleteNote()">Yes</button>
        <button class="btn btn-danger" id="delno">No</button>

      </div>
    </div>
  </div>
</div>

<script>
    var noteMentions = new Array();
    var dndMentions = new Array();
    var navToggle = $('#navtoggle').html();

function toggleNav() {
  navToggle = $('#menustatus').html();

  if(navToggle == 'closed'){
    document.getElementById("nav-pane").style.width = "350px";
    if (window.innerWidth > 800) {
      document.getElementById("mainpanel").style.marginLeft = "350px";
    }
    //$('#navtoggle').html('<');
    $('#menustatus').html('open');
  }
else if(navToggle == 'open'){
    document.getElementById("nav-pane").style.width = "0";
    if (window.innerWidth > 800) {
      document.getElementById("mainpanel").style.marginLeft = "0";
    }
    //$('#navtoggle').html('>');
    $('#menustatus').html('closed');
  }
}



      var noteHistory = '';

      ClassicEditor.create( document.querySelector( '#editor' ), {

    //removePlugins: [ 'Title' ],

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

$(document).ready(function(){
  $("h1").text('');
  leftpane();
  showpanel('<?php echo $pageid; ?>');
  if (window.innerWidth > 800) {
    $('#menustatus').html('closed');

  }
  else {
    $('#menustatus').html('open');
    $('body').css('padding-top','20px');

  }
  toggleNav();
  exportAll();
});

function exportAll(){
  <?php

$dir = "exports";
if(file_exists($dir)){
    $di = new RecursiveDirectoryIterator($dir);
    $di->setFlags(RecursiveDirectoryIterator::SKIP_DOTS);
    $ri = new RecursiveIteratorIterator($di);
    foreach ( $ri as $file ) {
          $file->isDir() ?  rmdir($file) : unlink($file);
    }
}

$sql = "SELECT title,body,lineage FROM notes";
$sqldata = mysqli_query($dbcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
  $title = $row['title'];
  $remtitle = '# '.$row['title'];
  $body = ltrim(substr($row['body'],strlen($remtitle)));
  $path = explode('-', $row['lineage']);
  array_pop($path);
  $newpath = '';
  foreach($path as $x){
   
    $sql1 = "SELECT title FROM notes WHERE id LIKE '$x'";
    $sqldata1 = mysqli_query($dbcon, $sql1) or die('error getting data');
    while($row =  mysqli_fetch_array($sqldata1, MYSQLI_ASSOC)) { 

      $newpath = $newpath.$row['title'].'/';

    }
  }

  if (!is_dir('exports/'.$newpath)) {
    // dir doesn't exist, make it
    mkdir('exports/'.$newpath, 0777, true);
  }

  echo file_put_contents('exports/'.$newpath.$title.'.md', $body);
}
  ?>
}


function livesearch(){
  var value = $('#searchbar').val();
  var searchLength = value.length;
  var dndCheck = document.getElementById("dndcheck").checked;
  if (searchLength >= 3){
   
  $.ajax({
    url : 'livesearch.php',
    type: 'GET',
    data : { "value" : value, "dndcheck" : dndCheck },
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
  else {
      $("#flex-nav").addClass('nonav');
      $("#left-pane").removeClass('nonav');
  }
 
}

function leftpane(){
  $('#toc').html('');
  $.ajax({
    url: 'getleftpane.php',
    type: 'GET',
    success: function(data)
    {
     var newData = JSON.parse(data);
     //var newHTML = '';
     for (let i = 0; i < newData.length; i = i + 2){
      var j = i + 1;
      if (!newData[i].includes('-')){
      $('#toc').append('<div id="' + newData[i] + 'head" onClick=showpanel(' + newData[i] + ')>' + '<div style="display:inline-block;" name="right-arrow" id="' + newData[i] + 'nav"></div>' + newData[j] + '</div>'
      + '<div class="nonav" id="' + newData[i] + 'children"></div>');
     }
      else {
        var lineage = newData[i].split("-");
        var currentID = lineage[lineage.length -1];
        var parent = lineage[lineage.length - 2];
        var parentDIV = '#' + parent + 'children';
        var parentHead = '#' + parent + 'head';
        var indent = '';
        var navigation = '';
        for (let x = 1; x <= lineage.length; x++){
          indent += '&nbsp;&nbsp;';
        }
        if (lineage.length !== 1){
          $('#' + parent + 'nav').html('<svg onClick=shownav(' + parent + ') xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/></svg>');
          if (lineage.length !== 2){
          $('#' + parent + 'head').css('margin-left','-15px');
          }
        }
        $(parentDIV).append('<div id="' + currentID + 'head" onClick=showpanel(' + currentID + ')>' + indent + '<div style="display:inline-block;" name="right-arrow" id="' + currentID + 'nav"></div>' + newData[j] + '</div>'
      + '<div class="nonav" id="' + currentID + 'children"></div>');

      // Expand the heriarchy of the currently open panel
      var panelID = $('#fileID').html();
      if (currentID == panelID){
      for (let i=0; i < lineage.length; i++){
        var childDiv = '#' + lineage[i] + 'children';
        $(childDiv).show();
        }
      }

      }
     }
     sortItems();

    },
    error: function (jqXHR, status, errorThrown)
    {

    }

  });
}

function sortItems(){

  // get all divs with id including "children"
  var allParents = document.querySelectorAll("[id$='children']");

  var parentItems = new Array();
  // for each 'children' div
  for (let i=0;i<allParents.length;i++){
    //get the children of that div
    var childNodes = $(allParents[i]).children();
    var newChildren = new Array();
    var childrenIndex = new Array();
    var parentID = allParents[i].id;
    //for every child of the current parent
    for (let x=0;x<childNodes.length;x++){
      //get only the headers
      if (childNodes[x].id.includes('head')){      
      //get text of header
      let tempChild = $(childNodes[x]).text();
      //push to array
      childrenIndex.push(tempChild);
      }
    }

    //sort alphabetically, reversed if certain parents
    if (allParents[i].id == '93children' || allParents[i].id == '58children'){
      childrenIndex.sort();
      childrenIndex.reverse();
    }
    else {
      childrenIndex.sort();
    }

    // for every child.text
    for (let x=0;x<childrenIndex.length;x++){
      //...and for every child node
      for (let z=0;z<childNodes.length;z++){
        let q = z + 1;
        var cIndex = childrenIndex[x];
        var cNode = $(childNodes[z]).text();
        // when the child index matches the child node
        if (cNode == cIndex){
          //push the header
          newChildren.push(childNodes[z]);
          //push the matching children div
          newChildren.push(childNodes[q]);
          $(allParents[i]).html(newChildren);

        }
      }
    }

  }
}

function toggleside(){
  if ($('#nav-pane').hasClass('nonav')){
    $('#nav-pane').removeClass('nonav');
  }
  else {
    $('#nav-pane').addClass('nonav');
  }
}


function shownav(value){
  var navID = '#' + value + 'children';
  var navNav = '#' + value + 'nav';
  $(navID).toggle();
  //if ($(navNav).is(':visible')){
    $(navNav).html('<svg onClick=shownav(' + value + ') xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/></svg>');
    $(navNav).attr('name','right-arrow');
  //}
  /*else {
    $(navNav).html('<svg onClick=shownav('+ value +') xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-short" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4"/></svg>');
    $(navNav).attr('name','down-arrow');
  }*/
}

$('#delno').click(function(){
  $('#delwarning').modal('toggle');
});

function moveNote(value){
  var moveID = $('#fileID').html();
  $('#dropmenu').modal('toggle');

  $.ajax({
    url: 'movenote.php',
    type: 'GET',
    data: { 'moveID' : moveID, 'moveLineage' : value },

    success: function(data){
      leftpane();

    },
    error: function(){
    }
  });
}

function createNote(){

  var noteParent = $('#fileID').html();
  //$('#filetitle').val('Untitled');

  $.ajax({
    url : 'createnote.php',
    type: 'GET',
    data: { 'noteParent' : noteParent },
    success: function(data)
    {
      leftpane();
      $('#fileID').html(data);
      showpanel(data);
    },
    
    error: function (jqXHR, status, errorThrown)
    {

    }
    });
};

/*$('#filetitle').change(function (){
  saveData();
});*/


function newNote(){


//var bodyID = value;

$.ajax({
    url : 'newnote.php',
    type: 'GET',
    success: function(data)
    {
      leftpane();
      $('#fileID').html(data);
      showpanel(data);
    },
    
    error: function (jqXHR, status, errorThrown)
    {
      //editor.setData(status);
    }
    });
  
}

function showpanel(value){
  $('#dndshow').html('');
  $('#mainpanel').addClass('nonav');
  $('#container').addClass('nonav');
  if (noteHistory == ''){
    noteHistory = value;
  }
  else {
    if (!noteHistory.endsWith('-' + value)){
    noteHistory = noteHistory + '-' + value;
  }
}
  $('#noteHistory').html(noteHistory);


  editor.destroy().catch( error => {
    console.log( error );
} );

$("h1").text('');

var bodyID = value;

var allHeads = document.querySelectorAll("[id$='head']");
for (let x=0;x<allHeads.length;x++){
  let currentHead = allHeads[x].id;
  $('#' + currentHead).css('backdrop-filter','brightness(100%)');
  $('#' + currentHead).css('color','var(--text)');
}

$('#' + bodyID + 'head').css('backdrop-filter','brightness(150%)');
$('#' + bodyID + 'head').css('color','var(--link-text)');

$.ajax({
    url : 'getbody.php',
    type: 'GET',
    data : { "bodyID" : bodyID },
    success: function(data)
    {
      $("h1").text(value);
      var newData = JSON.parse(data);
      $('#fileID').html(value);

      $.ajax({
      url:'movelist.php',
      type: 'GET',
      success: function(data1){
        var moveList = JSON.parse(data1);
        $('#dropbody').html('');
        for (let x = 0; x < moveList.length; x = x + 2){
        var y = x + 1;
          $('#dropbody').append('<div class="dropdown-item" onClick="moveNote(\'' + moveList[x] + '\')">' + moveList[y] + '</div>');
        }
      },
      error: function(data1){
      }
    });


    $.ajax({
      url: 'getmentions.php',
      type: 'GET',
      success: function(data){
        dndMentions = new Array();
        noteMentions = new Array();
        var allMentions = JSON.parse(data);
        for (let i=0; i < allMentions.length; i = i + 2){
          var j = i + 1;
          if (allMentions[i].startsWith('#')){
            dndMentions.push(allMentions[i],allMentions[j]);
          }
          else {
            noteMentions.push(allMentions[i],allMentions[j]);
          }
        }
        
      ClassicEditor
    .create( document.querySelector( '#editor' ), {
      //removePlugins: [ 'Title' ],
      addPlugins: ['MentionCustomization'],
      initialData: newData[1],
      simpleUpload: {
          // The URL that the images are uploaded to.
          uploadUrl: 'fileupload.php'
    },
    autosave: {
        save( editor ) {
          return saveData( editor.getData() );
        }

    },

    mention: {
            feeds: [
                {
                    marker: '@',
                    feed: noteMentions,
                    minimumCharacters: 1
                },
                {
                    marker: '#',
                    feed: dndMentions,
                    minimumCharacters: 1
                }
            ]
        }
    } )
    .then( editor => {
        window.editor = editor;
        $('.ck-toolbar__items').prepend('<div style="background-color:#c7c5c5; border-radius:10px; padding:0px 5px 0px 5px;" id="navtoggle" onClick="toggleNav()"><img src="/assets/list.svg" /></button>');
        $('.ck-toolbar__items').append('<div id="subnote" style="background-color:#004f5b; border-radius:10px; padding:0px 5px 0px 5px;" onClick="createNote()">New Sub-note</div>\
        <div class="dropdown" style="display:inline-block;">\
        <button type="button" data-toggle="modal" data-target="#dropmenu" style="background-color:purple; border-radius:10px; padding:0px 5px 0px 5px;">Move</button>\
      </div>\
        <button class="btn btn-danger" id="delnote" onClick="delWarning()" style="background-color:#a00; border-radius:10px; padding:0px 5px 0px 5px;">Delete</button>\
        <button class="btn btn-info" style="display:inline-block; background-color:#0043c4; border-radius:10px; padding:0px 5px 0px 5px;" onClick="goBack()">Back</button>'
      
        );
      
      $("input:checked").each(function() {
        $(this).closest("li").addClass('strike');
        //$(this).removeProperty('webkit-appearance');
      });

      $("input:not(:checked)").each(function() {
        $(this).closest("li").removeClass('strike');
      });

    
    } )
    .catch( err => {
        console.error( err.stack );
    } );

      },
      error: function(){
      }
    });

      $.ajax ({
        url: 'folderpreview.php',
        type: 'GET',
        data: { 'parent': bodyID },
        success: function(data2){
          var folderPreviews = JSON.parse(data2);
          $('#folderPreview').html('');
          for (i=0; i < folderPreviews.length; i = i + 2){
            var j = i + 1;
            if (folderPreviews[j] !== bodyID){
            $('#folderPreview').append('<div class="col-md-4 folderpreview" onClick="showpanel(' + folderPreviews[j] + ')">' + marked.parse(folderPreviews[i]) + '</div>'); 
            }
          }
        },
        error: function(){

        }
      });


      $('#container').removeClass('nonav');
      $('#mainpanel').removeClass('nonav');
      var currentItem = '#' + data + 'head';

    },
    
    error: function (jqXHR, status, errorThrown)
    {

    }
    });

  }

function exportNote(){
  var exportID = $('#fileID').html();

  $.ajax ({
    url: 'exportnote.php',
    type: 'GET',
    data: { 'exportID' : exportID},

    success: function (){
      $('#test').html('file exported!');
    },
    error: function(){
      
    }
  });
}

function goBack(){
  //history as string
  noteHistory = $('#noteHistory').html();
  //history as array
  var backHistory = noteHistory.split('-');
  if (backHistory.length != 1){
    //index of 2nd last entry
  var lastNote = backHistory.length - 2;
  //id of 2nd last entry
  var lastID = backHistory[lastNote];
  var newHistory = backHistory.slice(0,backHistory.length - 2);
  var historyString = newHistory.toString();
  //$('#noteHistory').html(historyString);
  historyString = historyString.replaceAll(',','-');
  noteHistory = historyString;

  $('#noteHistory').html(lastID);
  showpanel(lastID);
  }
  
}

function saveData(value){
  var noteTitle = $(".ck-content h1").text();
  var noteID = $('#fileID').html();
  var mentions = document.querySelectorAll('[data-mention]');
  var mentionArray = Array.from(mentions);
  var mentionReplace;
  var newValue = value;
  var regex;
  var noteMentionID;
  var dndMentionID;
  var mentionText;

  
  // Replace hashtag mentions with hyperlinks to DnD website pages

  // for each [data-mention]
  for (i=0; i < mentionArray.length; i++){
    // get the innerHTML of [data-mention]
    var mentionText = mentionArray[i].innerHTML;
    noteMentionID = noteMentions.indexOf(mentionText);
    // count and number the amount of mentions
    dndMentionID = dndMentions.indexOf(mentionText);
    if (noteMentionID != -1){
      mentionReplace = '[' + mentionText + '](https://notes.bkconnor.com?id=' + noteMentions[noteMentionID + 1] + ')';
      regex = new RegExp(mentionText,"g");
      newValue = newValue.replaceAll(regex, mentionReplace);
      noteMentionID = -1;
    }
    if (dndMentionID != -1){
      mentionReplace = '[' + mentionText + '](https://dnd.bkconnor.com/tools/world/world.php?id=' + dndMentions[dndMentionID + 1] + ')';
      regex = new RegExp(mentionText,"g");
      newValue = newValue.replaceAll(regex, mentionReplace);
      dndMentionID = -1;
    }
  }

  
  $.ajax({
    url: 'savedata.php',
    data: { "noteBody" : newValue, "noteTitle" : noteTitle, "noteID" : noteID },
    type: 'GET',
    success: function(data)
    {
      $('#lastsaved').html(data);
      leftpane();
      $("input:checked").each(function() {
        $(this).closest("li").addClass('strike');
      });

      $("input:not(:checked)").each(function() {
        $(this).closest("li").removeClass('strike');
      });
    },
    error: function (jqXHR, status, errorThrown)
    {
      $('#lastsaved').html(status)
    }


  });
}

function delWarning(){
  $('#delwarning').modal('toggle');
}

function deleteNote(){
  var delID = $('#fileID').html();

  $.ajax ({
    url: 'deletenote.php',
    type: 'GET',
    data: { 'delID' : delID },

    success: function(data){
      delWarning();
      leftpane();
      showpanel(1);
    },
    error: function(){

    }

  });
}

function showDnD(value){
  //value = value.replace(/\_/g, ' ');

  $.ajax({
    url : 'getdnd.php',
    type: 'GET',
    data : { "bodyID" : value },
    success: function(data)
    {
      var newdata = data;
      $('#dndshow').html(newdata);
    },
    error: function (jqXHR, status, errorThrown)
    {

    }
    });
}


  </script>

</div>
</div>
</div>


<style>

body {
  opacity: 1.0;
  padding-bottom:300px;
}

p strong {
    color: var(--strong);
}

strong {
  color: var(--strong);
}

.maintext {
  font-family:arial;
	font-size: 16px;
	text-align:left;
}

  .ck.ck-editor__editable_inline > :first-child {
    margin-top: 5px;
  }


.strike {
  color: #828282;
  text-decoration: line-through;
}

#dropmenu {
  background-color:black;

}
.image-inline img{
  height: 400px !important;
}

.ck-editor__editable.ck-content .todo-list .todo-list__label > span[contenteditable="false"] > input[checked]::before {
  background: #01537b;
  border-color: #00abff;
}

.folderpreview {
  height:250px;
  overflow:hidden;
  border: 1px solid white;
  opacity: 75%;
  cursor: pointer;
}

.folderpreview img {
  max-width: 100%;
  height: 200px;
}

div.folderpreview:hover {
  background-color: #424548;
}

.folderpreview h1{
  font-size: 16px;
  margin-top: 10px;
}

.folderpreview {
  font-size: 1em;
}

.dropdown-item {
  color: #e8e8e8;
}

.dropdown-item:hover {
  background-color: grey;
}

.modal-body {
  background-color: #1F2123;
}

.dropdown-menu {
  background-color:#1F2123;
}

.tealtitle {
  color:#00e7ff;
  font-size:16px;
}

.livesearch {

  padding: 0px !important;
  text-decoration: none;
  font-size: 12px !important;
  color: #818181;
  display: block;
  transition: 0.0s !important;
}

p {
  margin: 0 0 5px;
}

.ck-content pre code {
  font-size: 1.3em;
}

h1 {
  border-bottom: 2px solid #808080;
}

.folderpreview {
  font-size: 14px;
}

.folderpreview h1 {
  font-size:20px;
}
.folderpreview h2 {
  font-size:18px;
  margin-top:5px;
}
.folderpreview h3 {
  font-size:16px;
}
.folderpreview h4 {
  font-size:14px;
}

.searchresult {
  font-size: 14px;
  height:170px;
  overflow:hidden;
  border-top: 1px solid #808080;
  margin-bottom: 20px;
  padding-bottom: 10px;
  opacity: 0.95;
}

.searchresult h1 {
  font-size:20px;
  margin-top:5px;
}
.searchresult h2 {
  font-size:18px;
  margin-top:5px;
}
.searchresult h3 {
  font-size:16px;
  margin-top:5px;
}
.searchresult h4 {
  font-size:14px;
  margin-top:5px;
}

.searchresult a {
  font-size:12px;
  display:inline-block;
  padding: 0px 0px 0px 0px;
}

h2 {
  border-bottom: 1px solid #808080;;
  font-size: 1.6em;
  margin-top:30px;
}

h4 {
  margin-top: 20px;
}

h2, h3, h4 {
  margin-bottom: 3px;
}

.ck-content pre {
  background: #262626;;
}

.sidebartext {
  color: #e8e8e8;
}

#filetitle {
  background-color: #1F2123;
  font-size: 2em;
  text-align:left;
  border: 1px solid #1f2123;
  container-name: filetitle;
  max-width:100%;
}

@container filetitle (min-width: 700px) {
  #filetitle {
    font-size: 1em;
  }
}

li {
  margin-bottom:2px;
}

div[id$="children"] {
  backdrop-filter: brightness(125%);
  border-left: 1px solid var(--h2);
  margin-left: 10px;
}

div[id$="head"] {
  cursor: pointer;
}


.ck-content a:hover {
    opacity: 0.7;  
}

:root {
    /* Overrides the border radius setting in the theme. */
    --ck-border-radius: 15px;

    /* Overrides the default font size in the theme. */
    --ck-font-size-base: 14px;

    /* Helper variables to avoid duplication in the colors. */
    --ck-custom-foreground: hsl(255, 3%, 18%);
    --ck-custom-white: hsl(0, 0%, 100%);

    /* -- Overrides generic colors. ------------------------------------------------------------- */

    --ck-color-base-foreground: var(--ck-custom-background);
    --ck-color-focus-border: hsl(208, 90%, 62%);
    --ck-color-text: hsl(0, 0%, 98%);
    --ck-color-shadow-drop: hsla(0, 0%, 0%, 0.2);
    --ck-color-shadow-inner: hsla(0, 0%, 0%, 0.1);

    /* -- Overrides the default .ck-button class colors. ---------------------------------------- */

    --ck-color-button-default-background: var(--ck-custom-background);
    --ck-color-button-default-hover-background: hsl(270, 1%, 22%);
    --ck-color-button-default-active-background: hsl(270, 2%, 20%);
    --ck-color-button-default-active-shadow: hsl(270, 2%, 23%);
    --ck-color-button-default-disabled-background: var(--ck-custom-background);

    --ck-color-button-on-background: var(--ck-custom-foreground);
    --ck-color-button-on-hover-background: hsl(255, 4%, 16%);
    --ck-color-button-on-active-background: hsl(255, 4%, 14%);
    --ck-color-button-on-active-shadow: hsl(240, 3%, 19%);
    --ck-color-button-on-disabled-background: var(--ck-custom-foreground);

    --ck-color-button-action-background: hsl(168, 76%, 42%);
    --ck-color-button-action-hover-background: hsl(168, 76%, 38%);
    --ck-color-button-action-active-background: hsl(168, 76%, 36%);
    --ck-color-button-action-active-shadow: hsl(168, 75%, 34%);
    --ck-color-button-action-disabled-background: hsl(168, 76%, 42%);
    --ck-color-button-action-text: var(--ck-custom-white);

    --ck-color-button-save: hsl(120, 100%, 46%);
    --ck-color-button-cancel: hsl(15, 100%, 56%);

    /* -- Overrides the default .ck-dropdown class colors. -------------------------------------- */

    --ck-color-dropdown-panel-background: var(--ck-custom-background);
    --ck-color-dropdown-panel-border: var(--ck-custom-foreground);

    /* -- Overrides the default .ck-dialog class colors. ----------------------------------- */

    --ck-color-dialog-background: var(--ck-custom-background);
    --ck-color-dialog-form-header-border: var(--ck-custom-border);

    /* -- Overrides the default .ck-splitbutton class colors. ----------------------------------- */

    --ck-color-split-button-hover-background: var(--ck-color-button-default-hover-background);
    --ck-color-split-button-hover-border: var(--ck-custom-foreground);

    /* -- Overrides the default .ck-input class colors. ----------------------------------------- */

    --ck-color-input-background: var(--ck-custom-background);
    --ck-color-input-border: hsl(257, 3%, 43%);
    --ck-color-input-text: hsl(0, 0%, 98%);
    --ck-color-input-disabled-background: hsl(255, 4%, 21%);
    --ck-color-input-disabled-border: hsl(250, 3%, 38%);
    --ck-color-input-disabled-text: hsl(0, 0%, 78%);

    /* -- Overrides the default .ck-labeled-field-view class colors. ---------------------------- */

    --ck-color-labeled-field-label-background: var(--ck-custom-background);

    /* -- Overrides the default .ck-list class colors. ------------------------------------------ */

    --ck-color-list-background: var(--ck-custom-background);
    --ck-color-list-button-hover-background: var(--ck-custom-foreground);
    --ck-color-list-button-on-background: hsl(208, 88%, 52%);
    --ck-color-list-button-on-text: var(--ck-custom-white);

    /* -- Overrides the default .ck-balloon-panel class colors. --------------------------------- */

    --ck-color-panel-background: var(--ck-custom-background);
    --ck-color-panel-border: var(--ck-custom-border);

    /* -- Overrides the default .ck-toolbar class colors. --------------------------------------- */

    --ck-color-toolbar-background: var(--ck-custom-background);
    --ck-color-toolbar-border: var(--ck-custom-border);

    /* -- Overrides the default .ck-tooltip class colors. --------------------------------------- */

    --ck-color-tooltip-background: hsl(252, 7%, 14%);
    --ck-color-tooltip-text: hsl(0, 0%, 93%);

    /* -- Overrides the default colors used by the ckeditor5-image package. --------------------- */

    --ck-color-image-caption-background: hsl(0, 0%, 97%);
    --ck-color-image-caption-text: hsl(0, 0%, 20%);

    /* -- Overrides the default colors used by the ckeditor5-widget package. -------------------- */

    --ck-color-widget-blurred-border: hsl(0, 0%, 87%);
    --ck-color-widget-hover-border: hsl(43, 100%, 68%);
    --ck-color-widget-editable-focus-background: var(--ck-custom-white);

    /* -- Overrides the default colors used by the ckeditor5-link package. ---------------------- */

    --ck-color-link-default: hsl(190, 100%, 75%);

   /* The side navigation menu */
.sidenav {
  padding-left: 5px;
  height: 100%; /* 100% Full-height */
  width: 0px; /* 0 width - change this with JavaScript */
  position: fixed; /* Stay in place */
  z-index: 1; /* Stay on top */
  top: 0; /* Stay at the top */
  left: 0;
  background-color: #111; /* Black*/
  overflow-x: hidden; /* Disable horizontal scroll */
  padding-top: 20px; /* Place content 60px from the top */
  transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
}

/* When you mouse over the navigation links, change their color */
.sidenav a:hover {
  color: #f1f1f1;
}

/* Position and style the close button (top right corner) */
.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

/* Style page content - use this if you want to push the page content to the right when you open the side navigation */
#mainpanel {
  transition: margin-left .5s;
}

/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

.livesearchtext h1{
  font-size: 12px;
}

.livesearchtext a {
  font-size: 12px;
  display: inline-block;
  padding: 0 0 0 0;
}

}

  </style>

   <?php
   //Footer
   $footpath = $_SERVER['DOCUMENT_ROOT'];
   $footpath .= "/footer.php";
   include_once($footpath);
    ?>
