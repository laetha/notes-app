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
   <link rel="stylesheet" type="text/css" href="/theme-default.css?<?php echo time(); ?>" />
   <link rel="manifest" href="manifest.json">


   <div class="mainbox col-lg-12 col-xs-12" style="padding-right:0%;">

     <!-- Page Header -->
     <div class="col-md-12">
      <h1>Themer</h1>
   </div>
     <div class="body maintext col-xs-12" style="padding-left:0%; padding-right: 0%; text-align: left;" id="body">
      <div id="nav-pane" class="col-md-2" style="height: 600px;">
        <em>Sidebar</em>
        <p>
          Here's some regular text on the sidebar.
          
        </p>
      </div>
     <div class="col-md-6 col-sm-12" id="mainpanel" style="padding-left:0px; padding-right:0px;">
      <h1>Title pages will look like this!</h1>
      Here is some text in between every bit of header to let you see how it's looking at each stage of work.
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
  <div class="col-md-4">
    Color-picker
  </div>
  
</div>
  </div>

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
