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
   <link rel="stylesheet" type="text/css" href="/themes/theme-default.css?<?php echo time(); ?>" />
   <link rel="manifest" href="manifest.json">
   <link rel="stylesheet" href="plugins/Coloris-main/dist/coloris.min.css" />
   <script src="plugins/Coloris-main/dist/coloris.min.js"></script>

   <div class="mainbox col-lg-12 col-xs-12" style="padding-right:0%;">

     <!-- Page Header -->
     <div class="col-md-12">
      <h1>Themer</h1>
      <div id="test"></div>
   </div>
     <div class="body maintext col-xs-12" style="padding-left:0%; padding-right: 0%; text-align: left;" id="body">
      <div id="nav-pane" class="col-md-2" style="height: 600px;">
        <em>Sidebar</em>
        <p>
          Here's some regular text on the sidebar.
          
        </p>
      </div>
     <div class="col-md-8 col-sm-12" id="mainpanel" style="padding-left:0px; padding-right:0px;">
      <h1>Title pages will look like this!</h1>
      <p class="newtext">Here is some text in between every bit of header to let you see how it's looking at each stage of work.</p>
      <h2 style="border-bottom: 1px solid white;">Main headers will look like this</h2>
      Here is some text in <strong>between every bit of header</strong> to let you see how it's looking at each stage of work.
      <h3>Mid headers will look like this</h3>
      Here is some text in between every bit of header to let you see how it's looking at each stage of work.
      <h4>Sub headers will look like this</h4>
      Here is some text in between every bit of <a href="">header to let you see how it's</a> looking at each stage of work.
      <div>
      <pre style="background-color: #262626;; border: 1px solid white;"><code>Code will look like this.</code></pre>
      </div>
  </div>
  <div class="col-md-2">

      <div id="pickerfields" class="sidebartext" style="background-color:#262626;">
    <input id="color-picker" type="text" class="Coloris" data-coloris />
    <ul>
      <li><input type="radio" id="text" name="element"> - Text <span id="currenttext"></span></li>
      <li><input type="radio" id="h1" name="element"> - H1 <span id="currenth1"></span></li>
      <li><input type="radio" id="h2" name="element"> - H2 <span id="currenth2"></span></li>
      <li><input type="radio" id="h3" name="element"> - H3 <span id="currenth3"></span></li>
      <li><input type="radio" id="h4" name="element"> - H4 <span id="currenth4"></span></li>
      <br>
      <li><input type="radio" id="strong" name="element"> - Strong <span id="currentstrong"></span></li>
      <li><input type="radio" id="em" name="element"> - Em <span id="currentem"></span></li>
      <li><input type="radio" id="code" name="element"> - Code <span id="currentcode"></span></li>
      <li><input type="radio" id="a" name="element"> - Links <span id="currenta"></span></li>

      <li><input type="radio" id="background" name="element"> - Background <span id="currentbackground"></span></li>
      <li><input type="radio" id="nav" name="element"> - Nav <span id="currentnav"></span></li>
    </ul>
    <input type="text" id="savename" placeholder="theme name..." style="color: black;">  <button class="btn btn-primary" id="savebutton">Save</button>
    <p>------</p>
    <p>load existing template...</p>
    <select id="loadtemplate" style="color:black;">
      <option>
        default
      </option>
      <option>
        gruvbox
      </option>
  </select>
  <button class="btn btn-info">Load</button>
  </div>
  
</div>
</div>
  </div>

  <script>
    $(document).ready(function(){
      var style = getComputedStyle(document.body);
      $('#currenttext').css('background-color',style.getPropertyValue('--text'));
      $('#currenttext').html(style.getPropertyValue('--text'));

      $('#currenth1').css('background-color',style.getPropertyValue('--h1'));
      $('#currenth1').html(style.getPropertyValue('--h1'));
      
      $('#currenth2').css('background-color',style.getPropertyValue('--h2'));
      $('#currenth2').html(style.getPropertyValue('--h2'));
      
      $('#currenth3').css('background-color',style.getPropertyValue('--h3'));
      $('#currenth3').html(style.getPropertyValue('--h3'));
      
      $('#currenth4').css('background-color',style.getPropertyValue('--h4'));
      $('#currenth4').html(style.getPropertyValue('--h4'));
      
      $('#currentbackground').css('background-color',style.getPropertyValue('--main-background'));
      $('#currentbackground').html(style.getPropertyValue('--main-background'));
      
      $('#currentnav').css('background-color',style.getPropertyValue('--sidebar-background'));
      $('#currentnav').html(style.getPropertyValue('--sidebar-background'));
      
      $('#currentstrong').css('background-color',style.getPropertyValue('--strong'));
      $('#currentstrong').html(style.getPropertyValue('--strong'));
      
      $('#currentem').css('background-color',style.getPropertyValue('--em'));
      $('#currentem').html(style.getPropertyValue('--em'));
      
      $('#currentcode').css('background-color',style.getPropertyValue('--code'));
      $('#currentcode').html(style.getPropertyValue('--code'));
      
      $('#currenta').css('background-color',style.getPropertyValue('--link-text'));
      $('#currenta').html(style.getPropertyValue('--link-text'));    
    });



Coloris({
  theme: 'large',
  themeMode: 'dark', // light, dark, auto
  onChange: (color) =>  changeColor()
});

function changeColor(){
  var radioStatus = document.querySelector('input[name="element"]:checked').id;
  $('#test').html(radioStatus);
  var currentColor = $('#color-picker').val();
  var currentDiv = '#current' + radioStatus;
  
  if (radioStatus == 'text'){
    $('.maintext').css('color',currentColor);
   // textColor = currentColor;
  }

  else if (radioStatus == 'background'){
    $('.mainbox').css('background-color',currentColor);
    $('body').css('background-color',currentColor);
    //backgroundColor = currentColor;
  }

  else if (radioStatus == 'nav'){
    $('#nav-pane').css('background-color',currentColor);
   // navColor = currentColor;
  }

  else {
    var allElements = document.querySelectorAll(radioStatus);
    for (x=0; x < allElements.length; x++){
      allElements[x].style.color = currentColor;
      let thisVar = radioStatus + 'color';
    //  thisVar = currentColor;
    }
  }

  $(currentDiv).html(currentColor);
  $(currentDiv).css('background-color',currentColor);
  $(currentDiv).css('padding-left','25px');

}


$('#savebutton').click(function (){

  var filename = 'theme-' + $('#savename').val();

  var textColor = $('#currenttext').html();
  var h1Color = $('#currenth1').html();
  var h2Color = $('#currenth2').html();
  var h3Color = $('#currenth3').html();
  var h4Color = $('#currenth4').html();
  var backgroundColor = $('#currentbackground').html();
  var navColor = $('#currentnav').html();
  var strongColor = $('#currentstrong').html();
  var emColor = $('#currentem').html();
  var codeColor = $('#currentcode').html();
  var linkColor = $('#currenta').html();

  $.ajax({
    url : 'savetheme.php',
    type: 'GET',
    data : { "filename" : filename, "textColor" : textColor, "h1Color" : h1Color, "h2Color" : h2Color, "h3Color" : h3Color, "h4Color" : h4Color, "backgroundColor" : backgroundColor, "navColor" : navColor, "strongColor" : strongColor, "emColor" : emColor, "codeColor" : codeColor, "linkColor" : linkColor },
    success: function(data)
    {
     $('#test').html(h3Color);
    },
    error: function (jqXHR, status, errorThrown)
    {

    }
    });

});

    </script>

<style>

/* THEME CONTENT */


.maintext {
    color: var(--text);
}

input[type="checkbox"] {
    accent-color: var(--h3);
}

body {
    background-color: var(--main-background);
}

a {
    color: var(--link-text);
  }

a:hover {
  color: var(--link-text);
  opacity: 0.6;
}

p strong {
    color: var(--strong);
}

strong {
  color: var(--strong);
}

em {
  color: var(--em);
}


h1 {
    color: var(--h1);
}

h2 {
    color: var(--h2);
}

h3 {
    color: var(--h3);
}

h4 {
    color: var(--h4);
}

.mainbox {
    background-color: var(--main-background);
}

#nav-pane {
    background-color: var(--sidebar-background);
}

pre code {
    color: var(--code);
}

</style>

   <?php
   //Footer
   $footpath = $_SERVER['DOCUMENT_ROOT'];
   $footpath .= "/footer.php";
   include_once($footpath);
    ?>
