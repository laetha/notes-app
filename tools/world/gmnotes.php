<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $pgtitle = 'GM Notes - ';
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);
   /* if ($loguser !== 'tarfuin') {
   echo ('<script>window.location.replace("/oops.php"); </script>');
 }*/
   ?>
   <?php
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/plugins/Parsedown.php";
   include_once($sqlpath);
    ?>
    <?php  $Parsedown = new Parsedown();
    ?>
   <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.js" type="text/javascript"></script>
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">
   <div class="mainbox col-lg-10 col-xs-12 col-lg-offset-1">

     <div class="col-md-12">
     <div class="pagetitle" id="pgtitle">GM Notes</div>
     <p><button class="btn btn-info" id="addbutton">Add Notes</button></p>
     <div id="adddiv" style="display:none;">
     <form method="post" action="gmprocess.php" id="import" enctype="multipart/form-data">



         <div class="text col-centered col-md-12" style="padding-left:2%; padding-right:2%;"><textarea type="text" name="gmnote" id="gmnote" placeholder="Enter notes here..." style="width:100%;">
           <?php
           $typeedit = "SELECT * FROM `gmnotes` WHERE worlduser LIKE '$loguser'";
           $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
           while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
           echo $row['note'];
}
?></textarea></div>


   </form>
   <input form="import" class="btn btn-primary col-centered" type="submit" value="Save" />
</div>
   <div class="body sidebartext col-xs-12" id="body">
     <?php
     $typeedit = "SELECT * FROM `gmnotes` WHERE worlduser LIKE '$loguser'";
     $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
     while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
     echo $Parsedown->text(nl2br($row['note']));
}
?>
   </div>
<?php

 ?>

 <!-- Search and add hyperlinks -->
   <?php
     $sqlworld = "SELECT * FROM world WHERE worlduser LIKE '$loguser'";
     $worlddata = mysqli_query($dbcon, $sqlworld) or die('error getting data');
     while($linkrow = mysqli_fetch_array($worlddata, MYSQLI_ASSOC)) {
     $temp = $linkrow['title'];
     ?>
     <script>
     var foundlink = "<?php echo $temp ?>";
     function replace (querytext){
       var bodytext = document.getElementById("body").innerHTML;
       //var pgtitle = document.getElementById("pgtitle").innerHTML;
       var url = "<a href=\"world.php?id=" + querytext + "\">" + querytext + "</a>";
       var regex = new RegExp(querytext, 'ig');
       var newtext = bodytext.replace(regex, url)
       document.getElementById("body").innerHTML = newtext;
     }
     replace(foundlink);

     </script>
     <?php
   }
   ?>

</div>
<script>
$(document).ready(function addLog(){
    $("#addbutton").click(function addLog(){
        $("#adddiv").slideToggle("slow");
    });
});
</script>
</div>
   <?php
   //Footer
   $footpath = $_SERVER['DOCUMENT_ROOT'];
   $footpath .= "/footer.php";
   include_once($footpath);
    ?>
