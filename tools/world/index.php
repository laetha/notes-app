<?php
$sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/plugins/Parsedown.php";
include_once($sqlpath);
/*if ($loguser !== 'tarfuin') {
echo ('<script>window.location.replace("/oops.php"); </script>');
}*/
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

  <!-- Page Header -->
  <div class="col-md-12">
  <div class="pagetitle" id="pgtitle" style="visibility: visible;">

    <?php
  $stripid = str_replace("'", "", $id);
  $stripid = stripslashes($stripid);
  $id = addslashes($id);
  $worldtitle = "SELECT * FROM world WHERE title LIKE $id OR id LIKE $id";
  $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
  while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
    $id = $row['title'];
    $stripid = str_replace("'", "", $id);
    $stripid = stripslashes($stripid);
    $id = addslashes($id);
    if ($loguser !== $row['worlduser']) {
    echo ('<script>window.location.replace("/oops.php"); </script>');
    }
    $sidebartype = $row['type'];
   echo $row['title'];
   $title = $row['title'];
   $deleteid = $row['id'];
    $qu = $row['code'];
   ?>
 </div>

 <script>
  $(document).ready(function() {

  $('[data-toggle="popover"]').popover({
                 trigger: "click",
                 sanitize: false,
                  html: true
               });
  });
</script>
<style>
  .popover {
    background-color:#141617;
    max-width: 400px;
  }


  </style>

 <?php
if ($row['coord'] != '') {
 echo('<span class="d-inline-block maphover" data-placement="auto" data-toggle="popover" style="cursor:pointer; color:#94a0ce;" data-content="<iframe width=\'600px\' height=\'370px\' src=\'map-raw.php?id='.$row['coord'].'\' />" style="color:#94A0CE; cursor:pointer;">View on Map</span>');
}
  ?>
 </div>

 <?php
 }
 if ($sidebartype == 'questline'){
 echo ('<ul class="body sidebartext col-xs-12">');

 $questline = "SELECT * FROM world WHERE code LIKE '$qu%' AND type NOT LIKE 'questline'";
 $npcdata = mysqli_query($dbcon, $questline) or die('error getting data');
 $num = 1;
 while($titlerow = mysqli_fetch_array($npcdata, MYSQLI_ASSOC)) {
   //$shorttitle = substr($titlerow['title'], strlen($qu));
   echo ('<li><a href="#quest'.$num.'">'.$titlerow['title'].'</a></li>');
   $num++;
   //echo ('<div class="sidebartext">'.$Parsedown->text(nl2br($titlerow['body'])).'</div>');
}
echo ('</ul>');
}
//Questline NPCs
if ($sidebartype == "quest") {
    $questpre = substr($id, 0, strpos($id, '0'));
    $questline = "SELECT * FROM world WHERE type LIKE 'questline' AND body LIKE '$questpre'";
    $npcdata = mysqli_query($dbcon, $questline) or die('error getting data');
    while($titlerow = mysqli_fetch_array($npcdata, MYSQLI_ASSOC)) {
      echo ('<div class="body sidebartext col-xs-12"><a href="/tools/world/world.php?id='.$titlerow['title'].'">'.$titlerow['title'].'</a></div>');
    }
}
  ?>


  <div class="body sidebartext col-xs-12" id="body">

    <!-- Body Text -->
      <?php
        $worldtitle = "SELECT * FROM `world` WHERE `id` LIKE '$deleteid' AND worlduser LIKE '$loguser'";
        $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
        while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
          //$sidebartype = $row['type'];
          $esttype = $row['est_type'];
          $jpgurl = 'uploads/'.$stripid.'.jpg';
          $pngurl = 'uploads/'.$stripid.'.png';
          $webpurl = 'uploads/'.$stripid.'.webp';
          $gifurl = 'uploads/'.$stripid.'.gif';


          if ($sidebartype == "player character") {
            if ($row['active'] == 1){ ?>
              <script>
              $( document ).ready(function() {
              $('#deactiveButton').show();
              $('#activeButton').hide();
              //on the click of the submit button
              $("#deactiveButton").click(function(){
               //get the form values
               var dtitle = $('#dtitle').val();
               var dtype = $('#dtype').val();
               var duser = $('#duser').val();


               //make the postdata
               //call your input.php script in the background, when it returns it will call the success function if the request was successful or the error one if there was an issue (like a 404, 500 or any other error status)

               $.ajax({
                  url : 'deactiveprocess.php',
                  type: 'GET',
                  data : { "title" : dtitle, "type" : dtype, "worlduser" : duser },
                  success: function()
                  {
                      //if success then just output the text to the status div then clear the form inputs to prepare for new data
                      $('#activeButton').show();
                      $('#deactiveButton').hide();
                      location.reload();

                  },
                  error: function (jqXHR, status, errorThrown)
                  {
                      //if fail show error and server status
                      $("#status_text").html('there was an error ' + errorThrown + ' with status ' + textStatus);
                  }
              });
              });
            });
              </script>
              <?php
            }
            else {
               ?>

              <script>
              $( document ).ready(function() {
              $('#activeButton').show();
              $('#deactiveButton').hide();

                        //on the click of the submit button
              $("#activeButton").click(function(){

               //get the form values
               var atitle = $('#atitle').val();
               var atype = $('#atype').val();
               var auser = $('#auser').val();


               //make the postdata
               //call your input.php script in the background, when it returns it will call the success function if the request was successful or the error one if there was an issue (like a 404, 500 or any other error status)

               $.ajax({
                  url : 'activeprocess.php',
                  type: 'GET',
                  data : { "title" : atitle, "type" : atype, "worlduser" : auser },
                  success: function()
                  {
                      //if success then just output the text to the status div then clear the form inputs to prepare for new data
                      $('#deactiveButton').show();
                      $('#activeButton').hide();
                      location.reload();

                  },
                  error: function (jqXHR, status, errorThrown)
                  {
                      //if fail show error and server status
                      $("#status_text").html('there was an error ' + errorThrown + ' with status ' + textStatus);
                  }
              });
            });
          });
              </script>
              <?php
            }
            ?>

            <?php
            echo ('<form onSubmit="return false" id="deactiveForm" style="display:inline-block; margin-left: 20px;">');
            echo ('<input type="hidden" name="dtitle" id="dtitle" value="'.$title.'">');
            echo ('<input type="hidden" name="dtype" id="dtype" value="'.$row['type'].'">');
            echo ('<input type="hidden" name="duser" id="duser" value="'.$loguser.'">');
            echo ('<button type="submit" id="deactiveButton" name="deactiveButton" class="btn btn-success">De-Activate</button>');
            echo ('</form>');



            echo ('<form onSubmit="return false" id="activeForm" style="display:inline-block; margin-left: 20px;">');
            echo ('<input type="hidden" name="atitle" id="atitle" value="'.$title.'">');
            echo ('<input type="hidden" name="atype" id="atype" value="'.$row['type'].'">');
            echo ('<input type="hidden" name="auser" id="auser" value="'.$loguser.'">');
            echo ('<button type="submit" id="activeButton" name="activeButton" class="btn btn-success">Activate</button>');
            echo ('</form>');
            echo ('<br>');
            echo('Level: '.$row['pc_lvl'].'<br />');
            echo('XP: '.$row['pc_xp'].'<br />');
?>



<?php        }



            if (file_exists($jpgurl)){
              echo ('<div class="col-md-8">');
            }
            else if (file_exists($pngurl)){
              echo ('<div class="col-md-8">');
            }
            else if (file_exists($webpurl)){
              echo ('<div class="col-md-8">');
            }
            else if (file_exists($gifurl)){
              echo ('<div class="col-md-8">');
            }
            if ($sidebartype == "npc") {

              echo('Race: '.$row['npc_race'].'<br />');
              echo('Establishment: '.$row['npc_est'].'<br />');
              echo('Location: '.$row['npc_location'].'<br />');
              echo('Faction: '.$row['npc_faction'].'<br />');
              echo('Deity: '.$row['npc_deity'].'<br />');
              echo('Title: '.$row['npc_title'].'<br />');
              $templast = substr($row['title'], strripos($row['title'], " "));
              echo('Family: ');
              $worldtitle = "SELECT * FROM `world` WHERE `title` LIKE '%$templast%' AND worlduser LIKE '$loguser' AND title NOT LIKE '$id' AND type LIKE 'npc'";
              $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
              while($row1 =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
                echo '<br />';
                echo $row1['title'].' :: '.$row1['npc_title'].' :: '.$row1['npc_location'];
              
              }
              echo ('<br />');
            


              }


                if ($sidebartype == "questline") {
                  echo ('Quest Code: ');
                  $qu = $row['code'];
                  echo $row['code'];
              

                  $questline = "SELECT * FROM world WHERE code LIKE '$qu%' AND type NOT LIKE 'questline'";
                  $npcdata = mysqli_query($dbcon, $questline) or die('error getting data');
                  $num1 = 1;
                  while($titlerow = mysqli_fetch_array($npcdata, MYSQLI_ASSOC)) {
                    echo ('<h3 style="border-bottom: 2px solid white;" id="quest'.$num1.'">'.$titlerow['title'].'</h3>');
                    echo ('<div class="sidebartext">'.$Parsedown->setBreaksEnabled(true) # enables automatic line breaks
                    ->text($titlerow['body']).'</div>');
                    $num1++;
                }
              }


              else {
                $Parsedown->setBreaksEnabled(true);
              echo ('<p>'.$Parsedown->text($row['body']).'</p>');
}


          if (file_exists($jpgurl)){
            echo ('</div>');
          }
          else if (file_exists($pngurl)){
            echo ('</div>');
          }
          else if (file_exists($webpurl)){
            echo ('</div>');
          }
          else if (file_exists($gifurl)){
            echo ('</div>');
          }

  }

  if (file_exists($jpgurl)){
    echo('<div class="col-md-4">');
    echo ('<div class="npcimg-container">');
  echo ('<img class="npcimg" src="uploads/'.$stripid.'.jpg" />'); ?>
  <form method="post">
    <select name="photoname" id="photoname" style="display:none;" required="yes">
      <option id="tmptype" value="<?php echo $stripid; ?>.jpg" selected></option>
      </select>
  <input class="btn btn-danger" type="submit" name="submit" value="X">
</form>
</div>
  </div>


<?php
if (isset($_POST['submit']))
{
$photoname = 'uploads/'.$_POST['photoname'];
if (!unlink($photoname))
{
echo ("Error deleting $photoname");
}
else
{
echo ("Deleted $photoname");
}
}

}

else if (file_exists($pngurl)){
  echo('<div class="col-md-4">');
  echo ('<div class="npcimg-container">');
echo ('<img class="npcimg" src="uploads/'.$stripid.'.png" />');
?>
<form method="post">
  <select name="photoname" id="photoname" style="display:none;" required="yes">
    <option id="tmptype" value="<?php echo $stripid; ?>.png" selected></option>
    </select>
    <input class="btn btn-danger" type="submit" name="submit" value="X">
</form>
  </div>
</div>



<?php
if (isset($_POST['submit']))
{
$photoname = 'uploads/'.$_POST['photoname'];
if (!unlink($photoname))
{
echo ("Error deleting $photoname");
}
else
{
echo ("Deleted $photoname");
}
}
}

else if (file_exists($webpurl)){
  echo('<div class="col-md-4">');
  echo ('<div class="npcimg-container">');
echo ('<img class="npcimg" src="uploads/'.$stripid.'.webp" />');
?>
<form method="post">
  <select name="photoname" id="photoname" style="display:none;" required="yes">
    <option id="tmptype" value="<?php echo $stripid; ?>.webp" selected></option>
    </select>
    <input class="btn btn-danger" type="submit" name="submit" value="X">
</form>
  </div>
</div>



<?php
if (isset($_POST['submit']))
{
$photoname = 'uploads/'.$_POST['photoname'];
if (!unlink($photoname))
{
echo ("Error deleting $photoname");
}
else
{
echo ("Deleted $photoname");
}
}
}

else if (file_exists($gifurl)){
  echo('<div class="col-md-4">');
  echo ('<div class="npcimg-container">');
echo ('<img class="npcimg" src="uploads/'.$stripid.'.gif" />');
?>
<form method="post">
  <select name="photoname" id="photoname" style="display:none;" required="yes">
    <option id="tmptype" value="<?php echo $stripid; ?>.gif" selected></option>
    </select>
    <input class="btn btn-danger" type="submit" name="submit" value="X">
</form>
  </div>
</div>



<?php
if (isset($_POST['submit']))
{
$photoname = 'uploads/'.$_POST['photoname'];
if (!unlink($photoname))
{
echo ("Error deleting $photoname");
}
else
{
echo ("Deleted $photoname");
}
}
}

      ?>
    </div>

      <p>
      <button type="button" class="editbutton btn btn-success" id="party-log" data-toggle="modal" data-target="#logModal">Party Encountered</button>
      <button type="button" class="editbutton btn btn-danger" id="delete-entry" data-toggle="modal" data-target="#delModal"><span class="glyphicon glyphicon-remove"></span>Delete</button>
      <a href="edit.php?id=<?php echo $title; ?>"><button class="editbutton btn btn-info"><span class="glyphicon glyphicon-edit"></span>Edit</button></a></p>

    <div class="body bodytext col-xs-12" id="body2">



  <!--location NPCs-->
  <?php
  if ($sidebartype == "location") {
    ?>
    <?php

    $temptitle = str_replace("'", "''", $title);
    $npcs = "SELECT * FROM world WHERE npc_location LIKE '%$temptitle%'";
    $npcdata = mysqli_query($dbcon, $npcs) or die('error getting data');
    $npcshow = 1;
    while($titlerow = mysqli_fetch_array($npcdata, MYSQLI_ASSOC)) {
      if($npcshow == 1){
        echo "<h3>Key NPCs:</h3>";
        echo ('<div class="row col-md-12">');
        $npcshow++;
      }
      $selectednpc = $titlerow['title'];
      $npcModal = addslashes($titlerow['title']);
      //echo "<a href=\"world.php?id=$selectednpc\">";
      echo ('<div class="col-md-4 col-sm-5">');
      ?><a href="world.php?id=<?php echo $titlerow['title']; ?>"><?php echo $selectednpc; ?></a><?php
      if ($titlerow['npc_title'] != '') {
      echo (' :: '.$titlerow['npc_title']);
    }
      echo "</div>";
    }
    ?>
    <script>
    function NPCModalChange(value) {
      document.getElementById("itemModalBody").innerHTML = '<div class="iframe-container"><iframe frameBorder="0" src="popout.php?id=' + value + '" /></div>';
      function showModal() {
        $("#itemModal").modal();
      }
      showModal();
    }
    </script>
    <?php
    echo "</div>";
  }


  //Faction NPCs
  if ($sidebartype == "faction") {
    ?>
    <div class="row col-md-12 bodytext">
    <?php
    $temptitle = str_replace("'", "''", $title);
    $factionnpcs = "SELECT * FROM world WHERE npc_faction LIKE '%$temptitle%' && worlduser LIKE '$loguser'";
    $factiondata = mysqli_query($dbcon, $factionnpcs) or die('error getting data');
    $membersshow = 1;
    while($factionrow = mysqli_fetch_array($factiondata, MYSQLI_ASSOC)) {
      if($membersshow == 1){
        echo "<h3>Known Members:</h3>";
        $membersshow++;
      }
      $selectednpc = $factionrow['title'];
      //echo "<a href=\"world.php?id=$selectednpc\">";
      echo ('<a href="world.php?id='.$selectednpc.'">'.$selectednpc.'</a>');
      if ($factionrow['npc_title'] != '') {
      echo (' :: '.$factionrow['npc_title']);
      echo (' :: '.$factionrow['npc_location']);

    }
      echo "</a><br />";
    }
    echo "</div>";
  }

  //Deity NPC's
  if ($sidebartype == "deity") {
    ?>
    <div class="row col-md-12 bodytext">
    <?php
    $temptitle = str_replace("'", "''", $title);
    $deitynpcs = "SELECT * FROM world WHERE npc_deity LIKE '%$temptitle%' && worlduser LIKE '$loguser'";
    $deitydata = mysqli_query($dbcon, $deitynpcs) or die('error getting data');
    $followersshow = 1;
    while($deityrow = mysqli_fetch_array($deitydata, MYSQLI_ASSOC)) {
      if($followersshow == 1){
        echo "<h3>Known Followers:</h3>";
        $followersshow++;
      }
      $selectednpc = $deityrow['title'];
      //echo "<a href=\"world.php?id=$selectednpc\">";
      echo ('<a href="world.php?id='.$selectednpc.'">'.$selectednpc.'</a>');
      echo "</a><br />";
    }
    echo "</div>";
  }
  ?>

  <div class="row col-md-12 bodytext">

<?php
if ($sidebartype == "location") {

  $temptitle = str_replace("'", "''", $title);
  $npcs = "SELECT * FROM world WHERE est_location LIKE '%$temptitle%'";
  $npcdata = mysqli_query($dbcon, $npcs) or die('error getting data');
  $npcshow = 1;
  while($titlerow = mysqli_fetch_array($npcdata, MYSQLI_ASSOC)) {
    if($npcshow == 1){
      echo "<h3>Establishments:</h3>";
      echo ('<div class="row col-md-12">');
      $npcshow++;
    }
    $selectednpc = $titlerow['title'];
    //echo "<a href=\"world.php?id=$selectednpc\">";
    echo ('<div class="col-md-4 col-sm-5">');
    if ($titlerow['est_type'] == 'alchemist') {
      echo ('<img class="txtimg" src="/assets/images/icon-alchemist.png" />');
    }
    else if ($titlerow['est_type'] == 'inn') {
      echo ('<img class="txtimg" src="/assets/images/icon-inn.png" />');
    }
    else if ($titlerow['est_type'] == 'blacksmith') {
      echo ('<img class="txtimg" src="/assets/images/icon-blacksmith.png" />');
    }
    else if ($titlerow['est_type'] == 'enchanter') {
      echo ('<img class="txtimg" src="/assets/images/icon-enchanter.png" />');
    }
    else if ($titlerow['est_type'] == 'Jeweler') {
      echo ('<img class="txtimg" src="/assets/images/icon-jeweler.png" />');
    }
    echo ('<a href="world.php?id=').$selectednpc.'">'.$selectednpc.'<a/>';
    echo "</div>";
  }
  echo ('</div>');
//echo ('</div>');
}

if ($sidebartype == "establishment") {
  echo ('<table><tr><td class="loctable">Inhabitants:</td>');
  echo ('<td class="loctable">Location:</td></tr><tr><td class="loctable">');
  $sqlcompendium = "SELECT * FROM world WHERE npc_est LIKE '%{$id}%'";
  $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
  while($row2 = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
    $entry1 = addslashes($row2['title']);
    ?><p><a href="world.php?id=<?php echo $row2['title']; ?>"> <?php echo $row2['title']; ?> :: <?php echo $row2['npc_title']; ?></a></p><?php
  }
  echo ('</td><td class="loctable">');
  $sqlcompendium = "SELECT * FROM world WHERE title LIKE '%{$id}%'";
  $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
  while($row2 = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
  $entry1 = addslashes($row2['est_location']);
  ?><p><a href="world.php?id=<?php echo $row2['est_location']; ?>"> <?php echo $row2['est_location']; ?></a></p><?php
}
echo ('</td></tr></table>');
  ?>
  <script>
  function modalChange(value) {
    document.getElementById("itemModalBody").innerHTML = '<div class="iframe-container"><iframe frameBorder="0" src="popout.php?id=' + value + '" /></div>';
    function showModal() {
      $("#itemModal").modal();
    }
    showModal();
  }
  </script>
  <?php
  if ($esttype == "alchemist") {

?>

  <div class="table-responsive sidebartext">
<table id="alch-inventory" class="table table-condensed table-striped table-responsive dt-responsive" cellspacing="0" width="100%">
  <thead class="thead-dark">
      <tr>
          <th scope="col">Name</th>
          <th scope="col">Value</th>
          <th scope="col">Magic</th>

      </tr>
  </thead>
  <tfoot>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Value</th>
        <th scope="col">Magic</th>

      </tr>
  </tfoot>
      <tbody>
        <?php
          $sqlcompendium = "SELECT * FROM compendium WHERE itemStock LIKE 'alchemist' AND itemMagic like '1' AND title LIKE '%healing%' AND itemValue NOT LIKE ''";
          $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
          while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
          echo ('<tr><td>');

          $entry = addslashes($row['title']);
          $entry1 = addslashes($entry);
          ?>
          <a class="magichref" onClick="modalChange('<?php echo $entry1; ?>')"> <?php echo $entry; ?></a>

          <?php
          echo ('</td>');
          echo ('<td>'.$row['itemValue'].'</td>');
          echo ('<td>Yes</td></tr>');

        }
          ?>
        <?php
          $sqlcompendium = "SELECT * FROM compendium WHERE itemStock LIKE 'alchemist' AND itemMagic like '1' AND itemValue NOT LIKE '' ORDER BY rand() LIMIT 10";
          $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
          while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
          echo ('<tr><td>');
          $entry = $row['title'];
          $entry1 = addslashes($entry);
          ?>
          <a class="magichref" onClick="modalChange('<?php echo $entry1; ?>')"> <?php echo $entry; ?></a>
          <?php
          echo ('</td>');
          echo ('<td>'.$row['itemValue'].'</td>');
          echo ('<td>Yes</td></tr>');

        }
          ?>
          <?php
            $sqlcompendium = "SELECT * FROM compendium WHERE itemStock LIKE 'alchemist' AND itemMagic NOT LIKE '1'";
            $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
            while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
            echo ('<tr><td>');
            $entry = $row['title'];
            $entry1 = addslashes($entry);
            ?>
            <a onClick="modalChange('<?php echo $entry1; ?>')"> <?php echo $entry; ?></a>
            <?php
            echo ('</td>');
            echo ('<td>'.$row['itemValue'].'</td>');
            echo ('<td>No</td></tr>');

          }
            ?>

</tbody>
</table>

</div>
<?php }

if ($esttype == "blacksmith") {

?>
<div class="table-responsive sidebartext">
<table id="bsmith" class="table table-condensed table-striped table-responsive dt-responsive" cellspacing="0" width="100%">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Value</th>
            <th scope="col">Magic</th>

        </tr>
    </thead>
    <tfoot>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Value</th>
          <th scope="col">Magic</th>

        </tr>
    </tfoot>
    <tbody>

      <?php
        $sqlcompendium = "SELECT * FROM compendium WHERE itemStock LIKE 'blacksmith' AND itemMagic like '1' AND itemValue NOT LIKE '' ORDER BY rand() LIMIT 8";
        $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
        while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
        echo ('<tr><td>');
        $entry = $row['title'];
        $entry1 = addslashes($entry);
        ?>
        <a class="magichref" onClick="modalChange('<?php echo $entry1; ?>')"> <?php echo $entry; ?></a>
        <?php
        echo ('</td>');
        echo ('<td>'.$row['itemValue'].'</td><td>');
          echo ('Yes');
        echo ('</td></tr>');
      }
        ?>
        <?php
          $sqlcompendium = "SELECT * FROM compendium WHERE itemStock LIKE 'blacksmith' AND itemMagic NOT LIKE '1'";
          $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
          while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
          echo ('<tr><td>');
          $entry = $row['title'];
          $entry1 = addslashes($entry);
          ?>
          <a onClick="modalChange('<?php echo $entry1; ?>')"> <?php echo $entry; ?></a>
          <?php
          echo ('</td>');
          echo ('<td>'.$row['itemValue'].'</td>');
          echo ('<td>No</td></tr>');
        }
          ?>

</tbody>
</table>

</div>
<?php }

if ($esttype == "all") {

?>
<div class="table-responsive sidebartext">
<table id="bsmith" class="table table-condensed table-striped table-responsive dt-responsive" cellspacing="0" width="100%">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Value</th>
            <th scope="col">Magic</th>

        </tr>
    </thead>
    <tfoot>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Value</th>
          <th scope="col">Magic</th>

        </tr>
    </tfoot>
    <tbody>

      <?php
        $sqlcompendium = "SELECT * FROM compendium WHERE itemMagic like '1' AND itemValue NOT LIKE '' ORDER BY rand() LIMIT 8";
        $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
        while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
        echo ('<tr><td>');
        $entry = $row['title'];
        $entry1 = addslashes($entry);
        ?>
        <a class="magichref" onClick="modalChange('<?php echo $entry1; ?>')"> <?php echo $entry; ?></a>
        <?php
        echo ('</td>');
        echo ('<td>'.$row['itemValue'].'</td><td>');
          echo ('Yes');
        echo ('</td></tr>');
      }
        ?>

</tbody>
</table>

</div>
<?php }

if ($esttype == "Jeweler") {

?>
<div class="table-responsive sidebartext">
<table id="jeweler-inventory" class="table table-condensed table-striped table-responsive dt-responsive" cellspacing="0" width="100%">
  <thead class="thead-dark">
      <tr>
          <th scope="col">Name</th>
          <th scope="col">Value</th>
          <th scope="col">Magic</th>

      </tr>
  </thead>
  <tfoot>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Value</th>
        <th scope="col">Magic</th>

      </tr>
  </tfoot>
    <tbody>
      <?php
        $sqlcompendium = "SELECT * FROM compendium WHERE lower(itemStock) LIKE 'jeweler' AND itemValue NOT LIKE '' ORDER BY rand() LIMIT 5";
        $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
        while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
        echo ('<tr><td>');
        $entry = $row['title'];
        $entry1 = addslashes($entry);
        ?>
        <a class="magichref" onClick="modalChange('<?php echo $entry1; ?>')"> <?php echo $entry; ?></a>
        <?php
        echo ('</td>');
        echo ('<td>'.$row['itemValue'].'</td>');
        echo ('<td>Yes</td></tr>');

      }
        ?>
        <?php
          $sqlcompendium = "SELECT * FROM compendium WHERE lower(itemStock) LIKE 'jeweler' AND itemMagic NOT LIKE '1'";
          $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
          while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
          echo ('<tr><td>');
          $entry = $row['title'];
          $entry1 = addslashes($entry);
          ?>
          <a onClick="modalChange('<?php echo $entry1; ?>')"> <?php echo $entry; ?></a><?php
          echo ('</td>');
          echo ('<td>'.$row['itemValue'].'</td>');
          echo ('<td>No</td></tr>');
        }
          ?>
</tbody>
</table>

</div>
<?php }

if ($esttype == "enchanter") {

?>
<div class="table-responsive sidebartext">
<table id="enchanter-inventory" class="table table-condensed table-striped table-responsive dt-responsive" cellspacing="0" width="100%">
  <thead class="thead-dark">
      <tr>
          <th scope="col">Name</th>
          <th scope="col">Value</th>
          <th scope="col">Magic</th>

      </tr>
  </thead>
  <tfoot>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Value</th>
        <th scope="col">Magic</th>

      </tr>
  </tfoot>
    <tbody>
      <?php
        $sqlcompendium = "SELECT * FROM compendium WHERE itemStock LIKE 'enchanter' AND itemValue NOT LIKE '' ORDER BY rand() LIMIT 10";
        $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
        while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
        echo ('<tr><td>');
        $entry = $row['title'];
        $entry1 = addslashes($entry);
        ?>
        <a class="magichref" onClick="modalChange('<?php echo $entry1; ?>')"> <?php echo $entry; ?></a>
        <?php
        echo ('</td>');
        echo ('<td>'.$row['itemValue'].'</td>');
        echo ('<td>Yes</td></tr>');

      }
        ?>
        <?php
          $sqlcompendium = "SELECT * FROM compendium WHERE itemStock LIKE 'enchanter' AND itemMagic NOT LIKE '1'";
          $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
          while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
          echo ('<tr><td>');
          $entry = $row['title'];
          $entry1 = addslashes($entry);
          ?>
          <a onClick="modalChange('<?php echo $entry1; ?>')"> <?php echo $entry; ?></a><?php
          echo ('</td>');
          echo ('<td>'.$row['itemValue'].'</td>');
          echo ('<td>No</td></tr>');
        }
          ?>
</tbody>
</table>

</div>
<?php }

if ($esttype == "general store") {

?>
<div class="table-responsive sidebartext">
<table id="gstore-inventory" class="table table-condensed table-striped table-responsive dt-responsive" cellspacing="0" width="100%">
  <thead class="thead-dark">
      <tr>
          <th scope="col">Name</th>
          <th scope="col">Value</th>
          <th scope="col">Magic</th>

      </tr>
  </thead>
  <tfoot>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Value</th>
        <th scope="col">Magic</th>

      </tr>
  </tfoot>
    <tbody>
      <?php
        $sqlcompendium = "SELECT * FROM compendium WHERE itemStock LIKE 'general store' ORDER BY rand()";
        $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
        while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
        echo ('<tr><td>');
        $entry = $row['title'];
        $entry1 = addslashes($entry);
        ?>
        <a class="magichref" onClick="modalChange('<?php echo $entry1; ?>')"> <?php echo $entry; ?></a>
        <?php
        echo ('</td>');
        echo ('<td>'.$row['itemValue'].'</td>');
        echo ('<td>Yes</td></tr>');

      }
        ?>
        <?php
          $sqlcompendium = "SELECT * FROM compendium WHERE itemStock LIKE 'general store' AND itemMagic NOT LIKE '1'";
          $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
          while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
          echo ('<tr><td>');
          $entry = $row['title'];
          $entry1 = addslashes($entry);
          ?>
          <a onClick="modalChange('<?php echo $entry1; ?>')"> <?php echo $entry; ?></a><?php
          echo ('</td>');
          echo ('<td>'.$row['itemValue'].'</td>');
          echo ('<td>No</td></tr>');
        }
          ?>
</tbody>
</table>

</div>
<?php } ?>

<?php
}

?>

<script>
function modalChange(value) {
  document.getElementById("itemModalBody").innerHTML = '<div class="iframe-container"><iframe frameBorder="0" src="popout.php?id=' + value + '" /></div>';
  function showModal() {
    $("#itemModal").modal();
  }
  showModal();
}
</script>
  <!-- campaignlog References -->
  <?php

    ?>
    <div class="row col-md-12 sidebartext" id="logref">
    <?php
    $temptitle = str_replace("'", "''", $title);
    $logs = "SELECT * FROM campaignlog WHERE entry LIKE '%$temptitle%' AND active = 1 AND worlduser LIKE '$loguser' ORDER BY date DESC";
    $logdata = mysqli_query($dbcon, $logs) or die('error getting data');
    $logshow = 1;
    while($logrow = mysqli_fetch_array($logdata, MYSQLI_ASSOC)) {
      if($logshow == 1){
        echo ('<h3>Log references:</h3>');
        echo ('<ul style="list-style-type: circle;">');
        $logshow++;

      }

      echo ('<li>');
      $selecteddate = $logrow['date'];
      $selectedlog = $logrow['entry'];
      echo ('<strong>Day ');
      echo $selecteddate;
      echo (':</strong> ');
      echo $selectedlog;
      echo "</li><p>";

    }

    echo "</ul></div>";
?>
    <!-- Other References -->
    <?php

      ?>
      <style>
           .highlight {
	          background-color:#94a0ce;
	          color:black;
	          font-size:16px;
      }
        </style>
      <div class="row col-md-12 sidebartext">
      <?php
      $temptitle = str_replace("'", "''", $title);
      $logs = "SELECT * FROM world WHERE body LIKE '%$temptitle%' AND worlduser LIKE '$loguser' ORDER BY id DESC";
      $logdata = mysqli_query($dbcon, $logs) or die('error getting data');
      $logshow = 1;
      while($logrow = mysqli_fetch_array($logdata, MYSQLI_ASSOC)) {
        
        if($logshow == 1){
          echo ('<h3>World References:</h3>');
          echo ('<ul style="list-style-type: circle;">');
          $logshow++;
        }

        $valuepos = stripos($logrow['body'],$temptitle);
        $samplestart = $valuepos - 50;
        if ($samplestart < 0){
          $samplestart = 0;
        }

        $sampleend = $samplestart + 200;
        $bodysample = substr($logrow['body'], $samplestart, 200);
        $bodysample = str_ireplace($temptitle,"<span class=\"highlight\">$temptitle</span>",$bodysample);
        echo ('<li>');
        echo ('<a href="world.php?id='.$logrow['title'].'">'.$logrow['title'].'</a>: '.$bodysample);
        echo "</li><p>";

      }

      echo "</ul></div>";

  ?>
  </div>


    <script>

    $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#bsmith tfoot th').each( function () {
       var title = $(this).text();
       $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
    } );

    // DataTable
    var table = $('#bsmith').DataTable({
      "drawCallback": function(){
        $('[data-toggle="popover"]').popover()

        $('.popover-dismiss').popover({
        trigger: 'focus'
        });
      }
    }

    );

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

    $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#alch-inventory tfoot th').each( function () {
       var title = $(this).text();
       $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
    } );

    // DataTable
    var table = $('#alch-inventory').DataTable({
      "drawCallback": function(){
        $('[data-toggle="popover"]').popover()

        $('.popover-dismiss').popover({
        trigger: 'focus'
        });
      }
    }

    );

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


    $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#jeweler-inventory tfoot th').each( function () {
       var title = $(this).text();
       $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
    } );

    // DataTable
    var table = $('#jeweler-inventory').DataTable({
      "drawCallback": function(){
        $('[data-toggle="popover"]').popover()

        $('.popover-dismiss').popover({
        trigger: 'focus'
        });
      }
    }

    );

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


    $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#enchanter-inventory tfoot th').each( function () {
       var title = $(this).text();
       $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
    } );

    // DataTable
    var table = $('#enchanter-inventory').DataTable({
      "drawCallback": function(){
        $('[data-toggle="popover"]').popover()

        $('.popover-dismiss').popover({
        trigger: 'focus'
        });
      }
    }

    );

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


    $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#gstore-inventory tfoot th').each( function () {
       var title = $(this).text();
       $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
    } );

    // DataTable
    var table = $('#gstore-inventory').DataTable({
      "drawCallback": function(){
        $('[data-toggle="popover"]').popover()

        $('.popover-dismiss').popover({
        trigger: 'focus'
        });
      }
    }

    );

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
<script>
$(function () {
$('[data-toggle="popover"]').popover()

$('.popover-dismiss').popover({
trigger: 'focus'
});
});
</script>

</div>


<!-- Search and add hyperlinks -->
  <?php
    $sqlworld = "SELECT * FROM world WHERE title NOT LIKE '$id' AND worlduser LIKE '$loguser'";
    $worlddata = mysqli_query($dbcon, $sqlworld) or die('error getting data');
    while($linkrow = mysqli_fetch_array($worlddata, MYSQLI_ASSOC)) {
    $temp = $linkrow['title'];
    ?>
    <script>
    var foundlink = "<?php echo $temp ?>";
    function replace (querytext){
      var bodytext = document.getElementById("body").innerHTML;
      var noquotes = querytext + "\">";
      var quotesreg = new RegExp(noquotes, 'ig');
      var quotestest = quotesreg.test(bodytext);
      var regex = new RegExp(querytext, 'ig');
      var regtest = regex.test(bodytext);
     if (quotestest == false){
      var url = "<a href=\"world.php?id=" + querytext + "\">" + querytext + "</a>";
        var newtext = bodytext.replace(regex, url);
        document.getElementById("body").innerHTML = newtext;
    }
    }
    replace(foundlink);

    </script>
    <?php
  }
  ?>
  <!-- Search and add hyperlinks -->
    <?php
      $sqlworld = "SELECT title FROM world WHERE worlduser LIKE '$loguser'";
      $worlddata = mysqli_query($dbcon, $sqlworld) or die('error getting data');
      while($linkrow = mysqli_fetch_array($worlddata, MYSQLI_ASSOC)) {
      $temp = $linkrow['title'];
      ?>
      <script>
      var foundlink = "<?php echo $temp ?>";

      function replace (querytext){
        var bodytext = document.getElementById("logref").innerHTML;
        var noquotes = querytext + "\">";
        var quotesreg = new RegExp(noquotes, 'ig');
        var quotestest = quotesreg.test(bodytext);
        var regex = new RegExp(querytext, 'ig');
        var regtest = regex.test(bodytext);
       if (quotestest == false){
        var url = "<a onclick=\"worldModal('" + querytext + "')\" data-toggle=\"modal\" data-target=\"#myModal\">" + querytext + "</a>";
          var newtext = bodytext.replace(regex, url);
          document.getElementById("logref").innerHTML = newtext;
      }

      }
      replace(foundlink);
      function worldModal(value){
  var newURL = '<div class="col-md-12"><iframe width="100%" height="600" src="world.php?id=' + value + '" /></div>';
  $('#worldmodal').html(newURL);
}
      </script>
      <?php
    }
    ?>

  </div>
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="background-color: rgb(45, 45, 45);">
        <div class="modal-body" id="worldmodal">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


<!-- Log Modal -->
<div class="modal fade" id="logModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content modalstyle bodytext">

        <div class="modal-body">
          <input class="textbox" type="text" id="logtext" />
          <button type="button" class="editbutton btn btn-success" id="logsave">Save</button>
          <script>
          $('#logsave').click(function(){
            $('#logModal').modal('hide');
            var loguser = "<?php echo $loguser; ?>";
            var currentDate = new Date();
            var date = ("0" + currentDate.getDate()).slice(-2);
            var month = ("0" + currentDate.getMonth() + 1).slice(-2);
            var year = currentDate.getFullYear();
            var dateString = year + '' + (month) + '' + date;
            var active = 1;
            var logtext = $('#logtext').val();
            var logtitle = "<?php echo $title; ?>";
            var logentry = logtitle + ": " + logtext;

            $.ajax({
              url : 'npclogprocess.php',
              type: 'GET',
              data : { "worlduser" : loguser, "date" : dateString, "entry" : logentry, "active" : active },
              success: function()
              {
                  
              },
              error: function (jqXHR, status, errorThrown)
              {
                  //if fail show error and server status
             }

            });

          });
          </script>
        </div>
        <div class="modal-footer">
        
        </div>
      </div>

    </div>
  </div>


  <!-- Delete Modal -->
  <div class="modal fade" id="delModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content modalstyle bodytext">

        <div class="modal-body">
          <p>Are you sure you want to delete <?php echo $title; ?>?</p>
        </div>
        <div class="modal-footer">
        <form class="delform" method="post" id="delform" action="delete.php">
          <select form="delform" name="delete" id="deleteid" style="display:none;" required="yes">
            <option value="<?php echo $deleteid; ?>" selected></option></select>
  <button type="button" class="btn btn-info delform" data-dismiss="modal">Go Back</button>
            <input class="btn btn-danger" type="submit" value="Delete"></Input>

        </form>
        </div>
      </div>

    </div>
  </div>


  <!-- Item Modal -->
  <div class="modal fade bd-example-modal-lg" id="itemModal" role="dialog">
    <div class="modal-dialog" style="width: 80%; max-width:1200px;">

      <!-- Modal content-->
      <div class="modal-content modalstyle bodytext" style="height:100%;">
        <div class="modal-header" style="padding-bottom: 0px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
        <div class="modal-body" id="itemModalBody" style="height:100%; padding-top: 0px;">
          <iframe frameBorder="0" src="" />
        </div>

      </div>

    </div>
  </div>

  <?php
  //Footer
  $footpath = $_SERVER['DOCUMENT_ROOT'];
  $footpath .= "/footer.php";
  include_once($footpath);
   ?>
