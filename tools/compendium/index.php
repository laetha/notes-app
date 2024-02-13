<?php
$sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/plugins/Parsedown.php";
include_once($sqlpath);
 ?>
 <?php  $Parsedown = new Parsedown(); ?>
<link href="https://fonts.googleapis.com/css?family=Libre+Baskerville:700" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic,700italic" rel="stylesheet" type="text/css">
<link href="/tools/compendium/statblock.css" rel="stylesheet" type="text/css">
<div class="mainbox col-lg-10 col-xs-12 col-lg-offset-1">

  <!-- Page Header -->
  <div class="col-md-12">
  <div class="pagetitle" id="pgtitle"><?php
  $id = addslashes($id);
  $stripid = str_replace("'", "", $id);
  $stripid = stripslashes($stripid);
  $worldtitle = "SELECT title, type FROM `compendium` WHERE `title` LIKE '$id'";
  $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
  while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
   echo htmlspecialchars($row['title']);
   $title = $row['title'];
   if ($loguser !== 'null') {
     $favtitle = "SELECT * FROM favourites WHERE user LIKE '$loguser'";
     $favdata = mysqli_query($dbcon, $favtitle) or die('error getting data');
     while($favrow =  mysqli_fetch_array($favdata, MYSQLI_ASSOC)) {
       if ($id == $favrow['title']) {
         ?>
          <script>
          $( document ).ready(function() {
          $("#favButton").addClass('disabled');
          $('#favButton').html('In Favourites');
        });
          </script>

         <?php
       }
     }

  ?>
<form onSubmit="return false" id='favForm' style="display:inline-block; margin-left: 20px;">
  <?php
    echo ('<input type="hidden" name="title" id="favtitle" value="'.$title.'">');
    echo ('<input type="hidden" name="type" id="favtype" value="'.$row['type'].'">');
    echo ('<input type="hidden" name="user" id="favuser" value="'.$loguser.'">');
    ?>
    <button type="submit" id="favButton" name="favButton" class="btn btn-success">Add to Favourites</button>
</form>
<?php
} ?>
</div>
</div>
<script>
//on the click of the submit button
$("#favButton").click(function(){
 //get the form values
 var ftitle = $('#favtitle').val();
 var ftype = $('#favtype').val();
 var fuser = $('#favuser').val();

 //make the postdata
 //call your input.php script in the background, when it returns it will call the success function if the request was successful or the error one if there was an issue (like a 404, 500 or any other error status)

 $.ajax({
    url : 'favprocess.php',
    type: 'GET',
    data : { "title" : ftitle, "type" : ftype, "user" : fuser },
    success: function()
    {
        //if success then just output the text to the status div then clear the form inputs to prepare for new data
        $("#favButton").addClass('disabled');
        $('#favButton').html('In Favourites');
    },
    error: function (jqXHR, status, errorThrown)
    {
        //if fail show error and server status
        $("#status_text").html('there was an error ' + errorThrown + ' with status ' + textStatus);
    }
});
});
</script>
<?php



}
?>
  <div class="body sidebartext col-xs-12" id="body">

    <!-- Body Text -->
      <?php
        $worldtitle = "SELECT * FROM `compendium` WHERE `title` LIKE '$id'";
        $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
        while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
          //echo ('<h2>'.ucwords($row['type']).'</h2>');
          $type = $row['type'];
          if ($type != 'monster' && $type != 'class') {
            echo ('<p class="bodytext">'.$row['title'].'</p>');
        }
          if($type == 'background'){
            echo nl2br('<div class="sidebartext">'.$Parsedown->text($row['backgroundTraits'].'</div>'));
            $sidebartype = $row['type'];
          }
          elseif($type == 'class'){
            echo ('<ul class="nav nav-tabs">');
            $classtitle = "SELECT name FROM `subclasses` WHERE class LIKE '$id'";
            $classdata = mysqli_query($dbcon, $classtitle) or die('error getting data');
            while($classrow =  mysqli_fetch_array($classdata, MYSQLI_ASSOC)) {
              $subtemp = $classrow['name'];
              if (strpos($classrow['name'], ' core') !== false){
              $subtemp = 'Core '.$id;
              }
              $subslashes = str_replace(' ', '_', $subtemp);
            echo('<li><a data-toggle="tab" href="#'.$subslashes.'">'.$subtemp.'</a></li>');

            }
            ?>
          </ul>

          <p><button class="btn btn-info" id="classbutton">Show Class Table</button>

            <?php if($id == "Warlock") { ?>

            <button class="btn btn-primary" id="warlockbutton">All Invocations</button>

            <div id="warlocktable" style="display:none;" class="sidebartext mystic">
            <?php  $worldtitle = "SELECT * FROM `spells` WHERE `title` LIKE '%Invocation:%'";
              $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
              while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
               echo ('<h3>'.$row['title'].'</h3>');
               echo ('<p>'.$Parsedown->text(nl2br($row['text'])).'</p>');

            }
          ?>
          </div>
          <?php
          }
              ?>

              <?php if($id == "Monk") { ?>

              <button class="btn btn-primary" id="monkbutton">Way of the Four Elements Spells</button>

              <div id="monktable" style="display:none;" class="sidebartext mystic">
              <?php  $worldtitle = "SELECT * FROM `spells` WHERE `classes` LIKE '%Monk%'";
                $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
                while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
                 echo ('<h3>'.$row['title'].'</h3>');
                 echo ('<p>'.$Parsedown->text(nl2br($row['text'])).'</p>');

              }
            ?>
            </div>
            <?php
            }
                ?>


            <?php if($id == "Mystic") { ?>

            <button class="btn btn-primary" id="talentbutton">Talents</button>
            <button class="btn btn-success" id="discbutton">Disciplines</button>

            <div id="talenttable" style="display:none;" class="sidebartext mystic">
            <?php  $worldtitle = "SELECT * FROM `mysticabilities` WHERE `type` LIKE 'talent'";
              $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
              while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
               echo ('<h3>'.$row['name'].'</h3>');
               echo ('<p>'.$Parsedown->text(nl2br($row['text'])).'</p>');

            }
          ?>
        </div>

            <div id="disctable" style="display:none;" class="sidebartext mystic">
            <?php  $worldtitle = "SELECT * FROM `mysticabilities` WHERE `type` LIKE 'discipline'";
              $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
              while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
               echo ('<h3>'.$row['name'].'</h3>');
               echo ('<p>'.$Parsedown->text(nl2br($row['text'])).'</p>');
               echo ('<div style="margin-top:70px;"></div>');

            }
            ?> </div> <?php
          }
              ?>
              <?php  if ($id == "Fighter") {?>
                  <button class="btn btn-primary" id="EKButton">Eldritch Knight Table</button>
                  <div class="table-responsive" id="EKTable" style="display:none;">
                    <form method="post" action="logprocess.php" id="logadd">
                      <table class="table table-striped table-condensed">
            <thead>
            <?php
                    echo ('<tr>');
                    echo('<th>Level</th>');
                    echo('<th>Cantrips</th>');
                    echo('<th>Spells Known</th>');
                    echo('<th>1st</th>');
                    echo('<th>2nd</th>');
                    echo('<th>3rd</th>');
                    echo('<th>4th</th>');
                    echo('</tr>');
                  echo('</thead>');
                  echo('<tbody>');


                  $classtabletitle = "SELECT * FROM `classtable` WHERE class LIKE 'Knight'";
                  $classtabledata = mysqli_query($dbcon, $classtabletitle) or die('error getting data');
                  while($classtablerow =  mysqli_fetch_array($classtabledata, MYSQLI_ASSOC)) {

                    echo ('<tr><td>'.$classtablerow['level'].'</td>');
                    echo ('<td>'.$classtablerow['cantrips'].'</td>');
                    echo ('<td>'.$classtablerow['known'].'</td>');
                    echo ('<td>'.$classtablerow['spelllvl1'].'</td>');
                    echo ('<td>'.$classtablerow['spelllvl2'].'</td>');
                    echo ('<td>'.$classtablerow['spelllvl3'].'</td>');
                    echo ('<td>'.$classtablerow['spelllvl4'].'</td></tr>');
                    }
                    ?>
                  </tbody>
                </table>
                          </form>
                        </div>
                      <?php } ?>

                      <?php  if ($id == "Rogue") {?>
                          <button class="btn btn-primary" id="TricksterButton">Arcane Trickster Table</button>
                          <div class="table-responsive" id="TricksterTable" style="display:none;">
                            <form method="post" action="logprocess.php" id="logadd">
                              <table class="table table-striped table-condensed">
                    <thead>
                    <?php
                            echo ('<tr>');
                            echo('<th>Level</th>');
                            echo('<th>Cantrips</th>');
                            echo('<th>Spells Known</th>');
                            echo('<th>1st</th>');
                            echo('<th>2nd</th>');
                            echo('<th>3rd</th>');
                            echo('<th>4th</th>');
                            echo('</tr>');
                          echo('</thead>');
                          echo('<tbody>');


                          $classtabletitle = "SELECT * FROM `classtable` WHERE class LIKE 'Trickster'";
                          $classtabledata = mysqli_query($dbcon, $classtabletitle) or die('error getting data');
                          while($classtablerow =  mysqli_fetch_array($classtabledata, MYSQLI_ASSOC)) {

                            echo ('<tr><td>'.$classtablerow['level'].'</td>');
                            echo ('<td>'.$classtablerow['cantrips'].'</td>');
                            echo ('<td>'.$classtablerow['known'].'</td>');
                            echo ('<td>'.$classtablerow['spelllvl1'].'</td>');
                            echo ('<td>'.$classtablerow['spelllvl2'].'</td>');
                            echo ('<td>'.$classtablerow['spelllvl3'].'</td>');
                            echo ('<td>'.$classtablerow['spelllvl4'].'</td></tr>');
                            }
                            ?>
                          </tbody>
                        </table>
                                  </form>
                                </div>
                              <?php } ?>

                              <?php  if ($id == "Blood Hunter") {?>
                                  <button class="btn btn-primary" id="ProfaneButton">Profane Soul Table</button>
                                  <div class="table-responsive" id="ProfaneTable" style="display:none;">
                                    <form method="post" action="logprocess.php" id="logadd">
                                      <table class="table table-striped table-condensed">
                            <thead>
                            <?php
                                    echo ('<tr>');
                                    echo('<th>Level</th>');
                                    echo('<th>Cantrips</th>');
                                    echo('<th>Spells Known</th>');
                                    echo('<th>Spell Slots</th>');
                                    echo('<th>Slot Level</th>');
                                    echo('</tr>');
                                  echo('</thead>');
                                  echo('<tbody>');


                                  $classtabletitle = "SELECT * FROM `classtable` WHERE class LIKE 'Profane'";
                                  $classtabledata = mysqli_query($dbcon, $classtabletitle) or die('error getting data');
                                  while($classtablerow =  mysqli_fetch_array($classtabledata, MYSQLI_ASSOC)) {

                                    echo ('<tr><td>'.$classtablerow['level'].'</td>');
                                    echo ('<td>'.$classtablerow['cantrips'].'</td>');
                                    echo ('<td>'.$classtablerow['known'].'</td>');
                                    echo ('<td>'.$classtablerow['spelllvl1'].'</td>');
                                    echo ('<td>'.$classtablerow['spelllvl2'].'</td></tr>');

                                    }
                                    ?>
                                  </tbody>
                                </table>
                                          </form>
                                        </div>
                                      <?php } ?>

          <div class="table-responsive" id="classtable" style="display:none;">
            <form method="post" action="logprocess.php" id="logadd">
              <table class="table table-striped table-condensed">
  <thead>
    <?php
    if($id == "Artificer") {
      echo ('<tr>');
      echo('<th>Level</th>');
      echo('<th>Proficiency</th>');
      echo('<th>Features</th>');
      echo('<th>Infusions Known</th>');
      echo('<th>Infused Items</th>');
      echo('<th>Cantrips</th>');
      echo('<th>1st</th>');
      echo('<th>2nd</th>');
      echo('<th>3rd</th>');
      echo('<th>4th</th>');
      echo('<th>5th</th>');
      echo('</tr>');
    echo('</thead>');
    echo('<tbody>');


    $classtabletitle = "SELECT * FROM `classtable` WHERE class LIKE '$id'";
    $classtabledata = mysqli_query($dbcon, $classtabletitle) or die('error getting data');
    while($classtablerow =  mysqli_fetch_array($classtabledata, MYSQLI_ASSOC)) {

      echo ('<tr id="'.$classtablerow['name'].'"><td>'.$classtablerow['level'].'</td>');
      echo ('<td>'.$classtablerow['proficiency'].'</td>');
      echo ('<td>'.$classtablerow['feature'].'</td>');
      echo ('<td>'.$classtablerow['resource'].'</td>');
      echo ('<td>'.$classtablerow['known'].'</td>');
      echo ('<td>'.$classtablerow['cantrips'].'</td>');
      echo ('<td>'.$classtablerow['spelllvl1'].'</td>');
      echo ('<td>'.$classtablerow['spelllvl2'].'</td>');
      echo ('<td>'.$classtablerow['spelllvl3'].'</td>');
      echo ('<td>'.$classtablerow['spelllvl4'].'</td>');
      echo ('<td>'.$classtablerow['spelllvl5'].'</td></tr>');

      }
}

if($id == "Barbarian") {
  echo ('<tr>');
  echo('<th>Level</th>');
  echo('<th>Proficiency</th>');
  echo('<th>Features</th>');
  echo('<th>Rages</th>');
  echo('<th>Rage Damage</th>');
  echo('</tr>');
echo('</thead>');
echo('<tbody>');


$classtabletitle = "SELECT * FROM `classtable` WHERE class LIKE '$id'";
$classtabledata = mysqli_query($dbcon, $classtabletitle) or die('error getting data');
while($classtablerow =  mysqli_fetch_array($classtabledata, MYSQLI_ASSOC)) {

  echo ('<tr><td>'.$classtablerow['level'].'</td>');
  echo ('<td>'.$classtablerow['proficiency'].'</td>');
  echo ('<td>'.$classtablerow['feature'].'</td>');
  echo ('<td>'.$classtablerow['resource'].'</td>');
  echo ('<td>'.$classtablerow['known'].'</td></tr>');

  }
}

if($id == "Bard") {
  echo ('<tr>');
  echo('<th>Level</th>');
  echo('<th>Proficiency</th>');
  echo('<th>Features</th>');
  echo('<th>Cantrips</th>');
  echo('<th>Spells Known</th>');
  echo('<th>1st</th>');
  echo('<th>2nd</th>');
  echo('<th>3rd</th>');
  echo('<th>4th</th>');
  echo('<th>5th</th>');
  echo('<th>6th</th>');
  echo('<th>7th</th>');
  echo('<th>8th</th>');
  echo('<th>9th</th>');
  echo('</tr>');
echo('</thead>');
echo('<tbody>');


$classtabletitle = "SELECT * FROM `classtable` WHERE class LIKE '$id'";
$classtabledata = mysqli_query($dbcon, $classtabletitle) or die('error getting data');
while($classtablerow =  mysqli_fetch_array($classtabledata, MYSQLI_ASSOC)) {

  echo ('<tr><td>'.$classtablerow['level'].'</td>');
  echo ('<td>'.$classtablerow['proficiency'].'</td>');
  echo ('<td>'.$classtablerow['feature'].'</td>');
  echo ('<td>'.$classtablerow['cantrips'].'</td>');
  echo ('<td>'.$classtablerow['known'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl1'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl2'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl3'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl4'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl5'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl6'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl7'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl8'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl9'].'</td></tr>');

  }
}

if($id == "Cleric") {
  echo ('<tr>');
  echo('<th>Level</th>');
  echo('<th>Proficiency</th>');
  echo('<th>Features</th>');
  echo('<th>Cantrips</th>');
  echo('<th>1st</th>');
  echo('<th>2nd</th>');
  echo('<th>3rd</th>');
  echo('<th>4th</th>');
  echo('<th>5th</th>');
  echo('<th>6th</th>');
  echo('<th>7th</th>');
  echo('<th>8th</th>');
  echo('<th>9th</th>');
  echo('</tr>');
echo('</thead>');
echo('<tbody>');


$classtabletitle = "SELECT * FROM `classtable` WHERE class LIKE '$id'";
$classtabledata = mysqli_query($dbcon, $classtabletitle) or die('error getting data');
while($classtablerow =  mysqli_fetch_array($classtabledata, MYSQLI_ASSOC)) {

  echo ('<tr><td>'.$classtablerow['level'].'</td>');
  echo ('<td>'.$classtablerow['proficiency'].'</td>');
  echo ('<td>'.$classtablerow['feature'].'</td>');
  echo ('<td>'.$classtablerow['cantrips'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl1'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl2'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl3'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl4'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl5'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl6'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl7'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl8'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl9'].'</td></tr>');

  }
}

if($id == "Druid") {
  echo ('<tr>');
  echo('<th>Level</th>');
  echo('<th>Proficiency</th>');
  echo('<th>Features</th>');
  echo('<th>Cantrips</th>');
  echo('<th>1st</th>');
  echo('<th>2nd</th>');
  echo('<th>3rd</th>');
  echo('<th>4th</th>');
  echo('<th>5th</th>');
  echo('<th>6th</th>');
  echo('<th>7th</th>');
  echo('<th>8th</th>');
  echo('<th>9th</th>');
  echo('</tr>');
echo('</thead>');
echo('<tbody>');


$classtabletitle = "SELECT * FROM `classtable` WHERE class LIKE '$id'";
$classtabledata = mysqli_query($dbcon, $classtabletitle) or die('error getting data');
while($classtablerow =  mysqli_fetch_array($classtabledata, MYSQLI_ASSOC)) {

  echo ('<tr><td>'.$classtablerow['level'].'</td>');
  echo ('<td>'.$classtablerow['proficiency'].'</td>');
  echo ('<td>'.$classtablerow['feature'].'</td>');
  echo ('<td>'.$classtablerow['cantrips'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl1'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl2'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl3'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl4'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl5'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl6'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl7'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl8'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl9'].'</td></tr>');

  }
}

if($id == "Fighter") {
  echo ('<tr>');
  echo('<th>Level</th>');
  echo('<th>Proficiency</th>');
  echo('<th>Features</th>');
  echo('</tr>');
echo('</thead>');
echo('<tbody>');


$classtabletitle = "SELECT * FROM `classtable` WHERE class LIKE '$id'";
$classtabledata = mysqli_query($dbcon, $classtabletitle) or die('error getting data');
while($classtablerow =  mysqli_fetch_array($classtabledata, MYSQLI_ASSOC)) {

  echo ('<tr><td>'.$classtablerow['level'].'</td>');
  echo ('<td>'.$classtablerow['proficiency'].'</td>');
  echo ('<td>'.$classtablerow['feature'].'</td></tr>');

  }
}

if($id == "Monk") {
  echo ('<tr>');
  echo('<th>Level</th>');
  echo('<th>Proficiency</th>');
  echo('<th>Martial Arts</th>');
  echo('<th>Ki Points</th>');
  echo('<th>Unarmored Movement</th>');
  echo('<th>Features</th>');
  echo('</tr>');
echo('</thead>');
echo('<tbody>');


$classtabletitle = "SELECT * FROM `classtable` WHERE class LIKE '$id'";
$classtabledata = mysqli_query($dbcon, $classtabletitle) or die('error getting data');
while($classtablerow =  mysqli_fetch_array($classtabledata, MYSQLI_ASSOC)) {

  echo ('<tr><td>'.$classtablerow['level'].'</td>');
  echo ('<td>'.$classtablerow['proficiency'].'</td>');
  echo ('<td>'.$classtablerow['cantrips'].'</td>');
  echo ('<td>'.$classtablerow['resource'].'</td>');
  echo ('<td>'.$classtablerow['known'].'</td>');
  echo ('<td>'.$classtablerow['feature'].'</td></tr>');

  }
}

if($id == "Mystic") {
  echo ('<tr>');
  echo('<th>Level</th>');
  echo('<th>Proficiency</th>');
  echo('<th>Features</th>');
  echo('<th>Talents Known</th>');
  echo('<th>Disciplines Known</th>');
  echo('<th>Psi Points</th>');
  echo('<th>Psi Limit</th>');
  echo('</tr>');
echo('</thead>');
echo('<tbody>');


$classtabletitle = "SELECT * FROM `classtable` WHERE class LIKE '$id'";
$classtabledata = mysqli_query($dbcon, $classtabletitle) or die('error getting data');
while($classtablerow =  mysqli_fetch_array($classtabledata, MYSQLI_ASSOC)) {

  echo ('<tr><td>'.$classtablerow['level'].'</td>');
  echo ('<td>'.$classtablerow['proficiency'].'</td>');
  echo ('<td>'.$classtablerow['feature'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl1'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl2'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl3'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl4'].'</td></tr>');

  }
}

if($id == "Paladin") {
  echo ('<tr>');
  echo('<th>Level</th>');
  echo('<th>Proficiency</th>');
  echo('<th>Features</th>');
  echo('<th>1st</th>');
  echo('<th>2nd</th>');
  echo('<th>3rd</th>');
  echo('<th>4th</th>');
  echo('<th>5th</th>');
  echo('</tr>');
echo('</thead>');
echo('<tbody>');


$classtabletitle = "SELECT * FROM `classtable` WHERE class LIKE '$id'";
$classtabledata = mysqli_query($dbcon, $classtabletitle) or die('error getting data');
while($classtablerow =  mysqli_fetch_array($classtabledata, MYSQLI_ASSOC)) {

  echo ('<tr><td>'.$classtablerow['level'].'</td>');
  echo ('<td>'.$classtablerow['proficiency'].'</td>');
  echo ('<td>'.$classtablerow['feature'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl1'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl2'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl3'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl4'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl5'].'</td></tr>');

  }
}

if($id == "Ranger") {
  echo ('<tr>');
  echo('<th>Level</th>');
  echo('<th>Proficiency</th>');
  echo('<th>Features</th>');
  echo('<th>Spells Known</th>');
  echo('<th>1st</th>');
  echo('<th>2nd</th>');
  echo('<th>3rd</th>');
  echo('<th>4th</th>');
  echo('<th>5th</th>');
  echo('</tr>');
echo('</thead>');
echo('<tbody>');


$classtabletitle = "SELECT * FROM `classtable` WHERE class LIKE '$id'";
$classtabledata = mysqli_query($dbcon, $classtabletitle) or die('error getting data');
while($classtablerow =  mysqli_fetch_array($classtabledata, MYSQLI_ASSOC)) {

  echo ('<tr><td>'.$classtablerow['level'].'</td>');
  echo ('<td>'.$classtablerow['proficiency'].'</td>');
  echo ('<td>'.$classtablerow['feature'].'</td>');
  echo ('<td>'.$classtablerow['known'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl1'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl2'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl3'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl4'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl5'].'</td></tr>');

  }
}

if($id == "Rogue") {
  echo ('<tr>');
  echo('<th>Level</th>');
  echo('<th>Proficiency</th>');
  echo('<th>Sneak Attack</th>');
  echo('<th>Features</th>');
  echo('</tr>');
echo('</thead>');
echo('<tbody>');


$classtabletitle = "SELECT * FROM `classtable` WHERE class LIKE '$id'";
$classtabledata = mysqli_query($dbcon, $classtabletitle) or die('error getting data');
while($classtablerow =  mysqli_fetch_array($classtabledata, MYSQLI_ASSOC)) {

  echo ('<tr><td>'.$classtablerow['level'].'</td>');
  echo ('<td>'.$classtablerow['proficiency'].'</td>');
  echo ('<td>'.$classtablerow['cantrips'].'</td>');
  echo ('<td>'.$classtablerow['feature'].'</td>');

  }
}


if($id == "Sorcerer") {
  echo ('<tr>');
  echo('<th>Level</th>');
  echo('<th>Proficiency</th>');
  echo('<th>Sorcery Points</th>');
  echo('<th>Features</th>');
  echo('<th>Cantrips</th>');
  echo('<th>Spells Known</th>');
  echo('<th>1st</th>');
  echo('<th>2nd</th>');
  echo('<th>3rd</th>');
  echo('<th>4th</th>');
  echo('<th>5th</th>');
  echo('<th>6th</th>');
  echo('<th>7th</th>');
  echo('<th>8th</th>');
  echo('<th>9th</th>');
  echo('</tr>');
echo('</thead>');
echo('<tbody>');


$classtabletitle = "SELECT * FROM `classtable` WHERE class LIKE '$id'";
$classtabledata = mysqli_query($dbcon, $classtabletitle) or die('error getting data');
while($classtablerow =  mysqli_fetch_array($classtabledata, MYSQLI_ASSOC)) {

  echo ('<tr><td>'.$classtablerow['level'].'</td>');
  echo ('<td>'.$classtablerow['proficiency'].'</td>');
  echo ('<td>'.$classtablerow['resource'].'</td>');
  echo ('<td>'.$classtablerow['feature'].'</td>');
  echo ('<td>'.$classtablerow['cantrips'].'</td>');
  echo ('<td>'.$classtablerow['known'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl1'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl2'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl3'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl4'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl5'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl6'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl7'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl8'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl9'].'</td></tr>');

  }
}

if($id == "Warlock") {
  echo ('<tr>');
  echo('<th>Level</th>');
  echo('<th>Proficiency</th>');
  echo('<th>Features</th>');
  echo('<th>Cantrips</th>');
  echo('<th>Spells Known</th>');
  echo('<th>Spell Slots</th>');
  echo('<th>Slot Level</th>');
  echo('<th>Invocations Known</th>');
  echo('</tr>');
echo('</thead>');
echo('<tbody>');


$classtabletitle = "SELECT * FROM `classtable` WHERE class LIKE '$id'";
$classtabledata = mysqli_query($dbcon, $classtabletitle) or die('error getting data');
while($classtablerow =  mysqli_fetch_array($classtabledata, MYSQLI_ASSOC)) {

  echo ('<tr><td>'.$classtablerow['level'].'</td>');
  echo ('<td>'.$classtablerow['proficiency'].'</td>');
  echo ('<td>'.$classtablerow['feature'].'</td>');
  echo ('<td>'.$classtablerow['cantrips'].'</td>');
  echo ('<td>'.$classtablerow['known'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl1'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl2'].'</td>');
  echo ('<td>'.$classtablerow['resource'].'</td></tr>');

  }
}

if($id == "Wizard") {
  echo ('<tr>');
  echo('<th>Level</th>');
  echo('<th>Proficiency</th>');
  echo('<th>Features</th>');
  echo('<th>Cantrips</th>');
  echo('<th>1st</th>');
  echo('<th>2nd</th>');
  echo('<th>3rd</th>');
  echo('<th>4th</th>');
  echo('<th>5th</th>');
  echo('<th>6th</th>');
  echo('<th>7th</th>');
  echo('<th>8th</th>');
  echo('<th>9th</th>');
  echo('</tr>');
echo('</thead>');
echo('<tbody>');


$classtabletitle = "SELECT * FROM `classtable` WHERE class LIKE '$id'";
$classtabledata = mysqli_query($dbcon, $classtabletitle) or die('error getting data');
while($classtablerow =  mysqli_fetch_array($classtabledata, MYSQLI_ASSOC)) {

  echo ('<tr><td>'.$classtablerow['level'].'</td>');
  echo ('<td>'.$classtablerow['proficiency'].'</td>');
  echo ('<td>'.$classtablerow['feature'].'</td>');
  echo ('<td>'.$classtablerow['cantrips'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl1'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl2'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl3'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl4'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl5'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl6'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl7'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl8'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl9'].'</td></tr>');

  }
}

if($id == "Blood Hunter") {
  echo ('<tr>');
  echo('<th>Level</th>');
  echo('<th>Proficiency</th>');
  echo('<th>Crimson Rite</th>');
  echo('<th>Features</th>');
  echo('<th>Blood Curses Known</th>');
  echo('</tr>');
echo('</thead>');
echo('<tbody>');


$classtabletitle = "SELECT * FROM `classtable` WHERE class LIKE '$id'";
$classtabledata = mysqli_query($dbcon, $classtabletitle) or die('error getting data');
while($classtablerow =  mysqli_fetch_array($classtabledata, MYSQLI_ASSOC)) {

  echo ('<tr><td>'.$classtablerow['level'].'</td>');
  echo ('<td>'.$classtablerow['proficiency'].'</td>');
  echo ('<td>'.$classtablerow['resource'].'</td>');
  echo ('<td>'.$classtablerow['feature'].'</td>');
  echo ('<td>'.$classtablerow['known'].'</td>');

  }
}

if($id == "Revised Ranger") {
  echo ('<tr>');
  echo('<th>Level</th>');
  echo('<th>Proficiency</th>');
  echo('<th>Features</th>');
  echo('<th>Spells Known</th>');
  echo('<th>1st</th>');
  echo('<th>2nd</th>');
  echo('<th>3rd</th>');
  echo('<th>4th</th>');
  echo('<th>5th</th>');
  echo('</tr>');
echo('</thead>');
echo('<tbody>');


$classtabletitle = "SELECT * FROM `classtable` WHERE class LIKE '$id'";
$classtabledata = mysqli_query($dbcon, $classtabletitle) or die('error getting data');
while($classtablerow =  mysqli_fetch_array($classtabledata, MYSQLI_ASSOC)) {

  echo ('<tr><td>'.$classtablerow['level'].'</td>');
  echo ('<td>'.$classtablerow['proficiency'].'</td>');
  echo ('<td>'.$classtablerow['feature'].'</td>');
  echo ('<td>'.$classtablerow['known'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl1'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl2'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl3'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl4'].'</td>');
  echo ('<td>'.$classtablerow['spelllvl5'].'</td></tr>');

  }
}


    ?>

  </tbody>
</table>
          </form>
        </div>
        <script>
        $(document).ready(function addLog(){
            $("#classbutton").click(function addLog(){
                $("#classtable").slideToggle("slow");
            });
        });
        </script>
        <script>
        $(document).ready(function talentLog(){
            $("#talentbutton").click(function addLog(){
                $("#talenttable").slideToggle("slow");
            });
        });
        </script>
        <script>
        $(document).ready(function talentLog(){
            $("#EKButton").click(function addLog(){
                $("#EKTable").slideToggle("slow");
            });
        });
        </script>
        <script>
        $(document).ready(function talentLog(){
            $("#TricksterButton").click(function addLog(){
                $("#TricksterTable").slideToggle("slow");
            });
        });
        </script>
        <script>
        $(document).ready(function talentLog(){
            $("#ProfaneButton").click(function addLog(){
                $("#ProfaneTable").slideToggle("slow");
            });
        });
        </script>
        <script>
        $(document).ready(function discLog(){
            $("#discbutton").click(function addLog(){
                $("#disctable").slideToggle("slow");
            });
        });
        </script>
        <script>
        $(document).ready(function discLog(){
            $("#warlockbutton").click(function addLog(){
                $("#warlocktable").slideToggle("slow");
            });
        });
        </script>
        <script>
        $(document).ready(function discLog(){
            $("#monkbutton").click(function addLog(){
                $("#monktable").slideToggle("slow");
            });
        });
        </script>

          <div class="tab-content">
            <?php
              $subtitle = "SELECT * FROM `subclasses` WHERE class LIKE '$id'";
              $subdata = mysqli_query($dbcon, $subtitle) or die('error getting data');
              while($subrow =  mysqli_fetch_array($subdata, MYSQLI_ASSOC)) {
                $subtemp1 = $subrow['name'];
                if (strpos($subrow['name'], ' core') !== false){
                $subtemp1 = 'Core '.$id;
                }
                $subslashes1 = str_replace(' ', '_', $subtemp1);
                echo ('<div class="tab-pane fade');
                if (strpos($subtemp1, 'Core') !== false){
                echo (' in active');
                }
                echo ('" id="'.$subslashes1.'">');

              echo ('<h2>'.$subtemp1.'</h2>');
              echo ('<h4>'.$subrow['source'].'</h4>');
              if (strpos($subrow['name'], ' core') !== false){
              echo ('<strong>Saving Throw Proficiencies:</strong> '.$subrow['saves']);
              }


          for ($counter = 1; $counter <= 19; $counter++) {
          $skillname = 'lvlskill'.$counter.'name';
          $skilltext = 'lvlskill'.$counter.'text';
          if(isset($subrow[$skillname])){
          echo nl2br('<h3>'.$subrow[$skillname].'</h3>');
        }
          if(isset($subrow[$skilltext])){
            echo ('<p class="subentry">');
            echo $Parsedown->text($subrow[$skilltext]);
            echo ('</p>');
          }
      }



              echo('</div>');
            }
                ?>
          </div>

          <?php
          }
          elseif($type == 'feat'){
            if($row['featModifier'] != ''){
            echo ('<strong>Ability Score Increase: '.ucwords($row['featModifier']).'</strong><p></p>');
          }
            echo nl2br('<div class="sidebartext">'.$row['text'].'</div>');
            $sidebartype = $row['type'];
          }
          elseif($type == 'item'){
            echo ('<strong>Type: '.ucwords($row['itemType']).'</strong><br />');
            if($row['itemMagic'] == 1){
              echo ($row['itemDetail'].'<br />');
            }
            if($row['itemWeight'] != ''){
              echo ('Weight: '.$row['itemWeight'].'lbs.<br />');
            }
            /*
            if($row['itemValue'] != ''){
              echo ('Cost: '.$row['itemValue'].'gp<br />');
            }

            if($row['itemRange'] != ''){
              echo ('Range: '.$row['itemRange'].'<br />');
            }
            if($row['itemStrength'] != ''){
              echo ('Strength Requirement: '.$row['itemStrength'].'<br />');
            }
            if($row['itemStealth'] != ''){
              echo ('Stealth: Disadvantage<br />');
            }
            */
            echo nl2br('<p></p><div class="sidebartext">'.$row['text'].'</div>');
            $sidebartype = $row['type'];
          }

          elseif($type == 'race'){
            echo ('<strong>Size: </strong>'.ucwords($row['raceSize']).'<br />');
            echo ('<strong>Speed: </strong>'.ucwords($row['raceSpeed']).'<br />');
            echo ('<strong>Bonus Abilities: </strong>'.ucwords($row['raceAbility']).'<br />');
            echo ('<strong>Spellcasting Ability: </strong>'.ucwords($row['raceSpellAbility']).'<p></p>');
            echo nl2br('<div class="sidebartext">'.$Parsedown->text($row['raceTraits'].'</div>'));
            $sidebartype = $row['type'];
          }
          elseif($type == 'spell'){
              echo ('<div class="spellDetail">');
              echo ('<strong>Level:</strong> '.$row['spellLevel'].'<br />');
              echo ('<strong>School:</strong> '.$row['spellSchool'].'<br />');
              echo ('<strong>Casting Time:</strong> '.$row['spellTime'].'<br />');
              echo ('<strong>Range:</strong> '.$row['spellRange'].'<br />');
              echo ('<strong>Components:</strong> '.$row['spellComponents'].'<br />');
              echo ('<strong>Duration:</strong> '.$row['spellDuration'].'<br />');
              echo ('<strong>Class:</strong> '.$row['spellClasses']);
              $classID = $id.'*';
              $spellclasstitle = "SELECT spellClasses FROM compendium WHERE title LIKE '$classID'";
              $spellclassdata = mysqli_query($dbcon, $spellclasstitle) or die('error getting data');
              while($spellclassrow =  mysqli_fetch_array($spellclassdata, MYSQLI_ASSOC)) {
                echo (', ');
                echo $spellclassrow['spellClasses'];
              }
              echo ('<br />');
              $ritualID = $id.' (Ritual Only)';
              $ritualtitle = "SELECT spellClasses FROM compendium WHERE title LIKE '$ritualID'";
              $ritualdata = mysqli_query($dbcon, $ritualtitle) or die('error getting data');
              while($ritualrow =  mysqli_fetch_array($ritualdata, MYSQLI_ASSOC)) {
                echo ('<strong>This spell can be cast as a Ritual</strong>');
              }
              echo ('</div>');
            echo nl2br('<p></p><div class="sidebartext">'.$row['text'].'</div>');
            $sidebartype = $row['type'];
          }
          elseif($type == 'monster'){

            ?>
            <div class="stat-block wide">
	<hr class="orange-border" />
	<div class="section-left">
		<div class="creature-heading">
			<h1><?php echo $row['title']; ?></h1>
			<h2><?php echo $row['monsterSize'].' '.$row['monsterType'].', '.$row['monsterAlignment']; ?></h2>
		</div> <!-- creature heading -->
		<svg height="5" width="100%" class="tapered-rule">
	    <polyline points="0,0 400,2.5 0,5"></polyline>
	  </svg>
		<div class="top-stats">
			<div class="property-line first">
				<h4>Armor Class</h4>
				<p><?php echo $row['monsterAc']; ?></p>
			</div> <!-- property line -->
			<div class="property-line">
				<h4>Hit Points</h4>
				<p><?php echo $row['monsterHp']; ?></p>
			</div> <!-- property line -->
			<div class="property-line last">
				<h4>Speed</h4>
				<p><?php echo $row['monsterSpeed']; ?></p>
			</div> <!-- property line -->
			<svg height="5" width="100%" class="tapered-rule">
	    <polyline points="0,0 400,2.5 0,5"></polyline>
	  </svg>
			<div class="abilities">
				<div class="ability-strength">
					<h4>STR</h4>
					<p><?php echo $row['monsterStr']; ?></p>
				</div> <!-- ability strength -->
				<div class="ability-dexterity">
					<h4>DEX</h4>
					<p><?php echo $row['monsterDex']; ?></p>
				</div> <!-- ability dexterity -->
				<div class="ability-constitution">
					<h4>CON</h4>
					<p><?php echo $row['monsterCon']; ?></p>
				</div> <!-- ability constitution -->
				<div class="ability-intelligence">
					<h4>INT</h4>
					<p><?php echo $row['monsterInt']; ?></p>
				</div> <!-- ability intelligence -->
				<div class="ability-wisdom">
					<h4>WIS</h4>
					<p><?php echo $row['monsterWis']; ?></p>
				</div> <!-- ability wisdom -->
				<div class="ability-charisma">
					<h4>CHA</h4>
					<p><?php echo $row['monsterCha']; ?></p>
				</div> <!-- ability charisma -->
			</div> <!-- abilities -->
			<svg height="5" width="100%" class="tapered-rule">
	    <polyline points="0,0 400,2.5 0,5"></polyline>
	  </svg>
    <?php if($row['monsterSave'] != ''){ ?>
      <div class="property-line">
				<h4><strong>Saving Throws:</strong></h4>
				<p><?php echo $row['monsterSave']; ?></p>
			</div> <!-- property line -->
    <?php } ?>
  <?php if($row['monsterSkill'] != ''){ ?>
      <div class="property-line">
				<h4><strong>Skills:</strong></h4>
				<p><?php echo $row['monsterSkill']; ?></p>
			</div> <!-- property line -->
    <?php } ?>
    <?php if($row['monsterResist'] != ''){ ?>
      <div class="property-line">
				<h4><strong>Damage Resistences:</strong></h4>
				<p><?php echo $row['monsterResist']; ?></p>
			</div> <!-- property line -->
    <?php } ?><?php if($row['monsterVulnerable'] != ''){ ?>
      <div class="property-line">
				<h4><strong>Damage Vulnerabilities:</strong></h4>
				<p><?php echo $row['monsterVulnerable']; ?></p>
			</div> <!-- property line -->
  <?php } ?><?php if($row['monsterImmune'] != ''){ ?>
    <div class="property-line">
      <h4><strong>Damage Immunities:</strong></h4>
      <p><?php echo $row['monsterImmune']; ?></p>
    </div> <!-- property line -->
<?php } ?><?php if($row['monsterConditionImmune'] != ''){ ?>
  <div class="property-line">
    <h4><strong>Condition Immunities:</strong></h4>
    <p><?php echo $row['monsterConditionImmune']; ?></p>
  </div> <!-- property line -->
<?php } ?><?php if($row['monsterSenses'] != ''){ ?>
  <div class="property-line">
    <h4><strong>Senses:</strong></h4>
    <p><?php echo $row['monsterSenses']; ?></p>
  </div> <!-- property line -->
<?php } ?><?php if($row['monsterPassive'] != ''){ ?>
  <div class="property-line">
    <h4><strong>Passive Perception:</strong></h4>
    <p><?php echo $row['monsterPassive']; ?></p>
  </div> <!-- property line -->
<?php } ?><?php if($row['monsterLanguages'] != ''){ ?>
  <div class="property-line">
    <h4><strong>Languages:</strong></h4>
    <p><?php echo $row['monsterLanguages']; ?></p>
  </div> <!-- property line -->
<?php } ?><?php
$cr = $row['monsterCr'];
 if($row['monsterCr'] != ''){ ?>
  <div class="property-line">
    <h4><strong>Challenge Rating:</strong></h4>
    <p><?php

    if($row['monsterCr'] ==0.125){
      echo ('1/8');

    }
    elseif($row['monsterCr'] ==0.25){
      echo ('1/4');

    }
    elseif($row['monsterCr'] ==0.5){
      echo ('1/2');
    }
    else{
    echo number_format((float)$cr, 0, '.', '');
  }
      if($cr == 0){
        echo (' (10xp)');
      }
      if($cr == 0.125){
        echo (' (25xp)');
      }
      if($cr == 0.25){
        echo (' (50xp)');
      }
      if($cr == 0.5){
        echo (' (100xp)');
      }
      if($cr == 1){
        echo (' (200xp)');
      }
      if($cr == 2){
        echo (' (450xp)');
      }
      if($cr == 3){
        echo (' (700xp)');
      }
      if($cr == 4){
        echo (' (1,100xp)');
      }
      if($cr == 5){
        echo (' (1,800xp)');
      }
      if($cr == 6){
        echo (' (4,100xp)');
      }
      if($cr == 7){
        echo (' (2,900xp)');
      }
      if($cr == 8){
        echo (' (3,900xp)');
      }
      if($cr == 9){
        echo (' (5,000xp)');
      }
      if($cr == 10){
        echo (' (5,900xp)');
      }
      if($cr == 11){
        echo (' (7,200xp)');
      }
      if($cr == 12){
        echo (' (8,400xp)');
      }
      if($cr == 13){
        echo (' (10,000xp)');
      }
      if($cr == 14){
        echo (' (11,500xp)');
      }
      if($cr == 15){
        echo (' (13,000xp)');
      }
      if($cr == 16){
        echo (' (15,000xp)');
      }
      if($cr == 17){
        echo (' (18,000xp)');
      }
      if($cr == 18){
        echo (' (20,000xp)');
      }
      if($cr == 19){
        echo (' (22,000xp)');
      }
      if($cr == 20){
        echo (' (25,000xp)');
      }
      if($cr == 21){
        echo (' (33,000xp)');
      }
      if($cr == 22){
        echo (' (41,000xp)');
      }
      if($cr == 23){
        echo (' (50,000xp)');
      }
      if($cr == 24){
        echo (' (62,000xp)');
      }
      if($cr == 25){
        echo (' (75,000xp)');
      }
      if($cr == 26){
        echo (' (90,000xp)');
      }
      if($cr == 27){
        echo (' (105,000xp)');
      }
      if($cr == 28){
        echo (' (120,000xp)');
      }
      if($cr == 29){
        echo (' (135,000xp)');
      }
      if($cr == 30){
        echo (' (155,000xp)');
      }
      ?>
    </p>
  </div> <!-- property line -->
<?php } ?>
		</div> <!-- top stats -->
		<svg height="5" width="100%" class="tapered-rule">
	    <polyline points="0,0 400,2.5 0,5"></polyline>
	  </svg>
    <?php if($row['monsterTrait1'] != ''){ ?>
      <div class="property-block">
        <p><?php echo nl2br($row['monsterTrait1']); ?></p>
      </div> <!-- property Block -->
    <?php } ?>
  <?php if($row['monsterTrait2'] != ''){ ?>
    <div class="property-block">
      <p><?php echo nl2br($row['monsterTrait2']); ?></p>
    </div> <!-- property Block -->
  <?php } ?>
  <?php if($row['monsterTrait3'] != ''){ ?>
    <div class="property-block">
      <p><?php echo nl2br($row['monsterTrait3']); ?></p>
    </div> <!-- property Block -->
  <?php } ?>
  <?php if($row['monsterTrait4'] != ''){ ?>
    <div class="property-block">
      <p><?php echo nl2br($row['monsterTrait4']); ?></p>
    </div> <!-- property Block -->
  <?php } ?>
  <?php if($row['monsterTrait5'] != ''){ ?>
    <div class="property-block">
      <p><?php echo nl2br($row['monsterTrait5']); ?></p>
    </div> <!-- property Block -->
  <?php } ?>
  <?php if($row['monsterTrait6'] != ''){ ?>
    <div class="property-block">
      <p><?php echo nl2br($row['monsterTrait6']); ?></p>
    </div> <!-- property Block -->
  <?php } ?>
  <?php if($row['monsterTrait7'] != ''){ ?>
    <div class="property-block">
      <p><?php echo nl2br($row['monsterTrait7']); ?></p>
    </div> <!-- property Block -->
  <?php } ?>
  <?php if($row['monsterTrait8'] != ''){ ?>
    <div class="property-block">
      <p><?php echo nl2br($row['monsterTrait8']); ?></p>
    </div> <!-- property Block -->
  <?php } ?>
	</div> <!-- section left -->
	<div class="section-right">
		<div class="actions">
			<h3>Actions</h3>
      <?php if($row['monsterAction1'] != ''){ ?>
        <div class="property-block">
          <p><?php echo nl2br($row['monsterAction1']); ?></p>
        </div> <!-- property Block -->
      <?php } ?>
      <?php if($row['monsterAction2'] != ''){ ?>
        <div class="property-block">
          <p><?php echo nl2br($row['monsterAction2']); ?></p>
        </div> <!-- property Block -->
      <?php } ?>
      <?php if($row['monsterAction3'] != ''){ ?>
        <div class="property-block">
          <p><?php echo nl2br($row['monsterAction3']); ?></p>
        </div> <!-- property Block -->
      <?php } ?>
      <?php if($row['monsterAction4'] != ''){ ?>
        <div class="property-block">
          <p><?php echo nl2br($row['monsterAction4']); ?></p>
        </div> <!-- property Block -->
      <?php } ?>
      <?php if($row['monsterAction5'] != ''){ ?>
        <div class="property-block">
          <p><?php echo nl2br($row['monsterAction5']); ?></p>
        </div> <!-- property Block -->
      <?php } ?>
      <?php if($row['monsterAction6'] != ''){ ?>
        <div class="property-block">
          <p><?php echo nl2br($row['monsterAction6']); ?></p>
        </div> <!-- property Block -->
      <?php } ?>
      <?php if($row['monsterAction7'] != ''){ ?>
        <div class="property-block">
          <p><?php echo nl2br($row['monsterAction7']); ?></p>
        </div> <!-- property Block -->
      <?php } ?>
      <?php if($row['monsterAction8'] != ''){ ?>
        <div class="property-block">
          <p><?php echo nl2br($row['monsterAction8']); ?></p>
        </div> <!-- property Block -->
      <?php } ?>
		</div> <!-- actions -->
		<div class="actions">
        <?php if($row['monsterLegendary1'] != ''){ ?>
          <h3>Legendary Actions</h3>
          <div class="property-block">
            <p><?php echo nl2br($row['monsterLegendary1']); ?></p>
          </div> <!-- property Block -->
        <?php } ?>
        <?php if($row['monsterLegendary2'] != ''){ ?>
          <div class="property-block">
            <p><?php echo nl2br($row['monsterLegendary2']); ?></p>
          </div> <!-- property Block -->
        <?php } ?>
        <?php if($row['monsterLegendary3'] != ''){ ?>
          <div class="property-block">
            <p><?php echo nl2br($row['monsterLegendary3']); ?></p>
          </div> <!-- property Block -->
        <?php } ?>
        <?php if($row['monsterLegendary4'] != ''){ ?>
          <div class="property-block">
            <p><?php echo nl2br($row['monsterLegendary4']); ?></p>
          </div> <!-- property Block -->
        <?php } ?>
        <?php if($row['monsterLegendary5'] != ''){ ?>
          <div class="property-block">
            <p><?php echo nl2br($row['monsterLegendary5']); ?></p>
          </div> <!-- property Block -->
        <?php } ?>
        <?php if($row['monsterLegendary6'] != ''){ ?>
          <div class="property-block">
            <p><?php echo nl2br($row['monsterLegendary6']); ?></p>
          </div> <!-- property Block -->
        <?php } ?>
        <?php if($row['monsterLegendary7'] != ''){ ?>
          <div class="property-block">
            <p><?php echo nl2br($row['monsterLegendary7']); ?></p>
          </div> <!-- property Block -->
        <?php } ?>
        <?php if($row['monsterLegendary8'] != ''){ ?>
          <div class="property-block">
            <p><?php echo nl2br($row['monsterLegendary8']); ?></p>
          </div> <!-- property Block -->
        <?php } ?>
		</div> <!-- actions -->
    <div class="actions">
     <?php if($row['monsterReaction'] != ''){ ?>
           <h3>Reactions</h3>
         <div class="property-block">
         <p><?php echo nl2br($row['monsterReaction']); ?></p>
       </div> <!-- property Block -->
     <?php } ?>

   </div>
<?php
   $jpgurl = 'bestiary/'.$stripid.'.jpg';
   $pngurl = 'bestiary/'.$stripid.'.png';

   if (file_exists($jpgurl)){
     echo('<div class="col-md-12">');
     echo ('<div class="npcimg-container">');
   echo ('<img class="monsterimg" src="bestiary/'.$stripid.'.jpg" />'); ?>

 </div>
   </div>


 <?php
 if (isset($_POST['submit']))
 {
 $photoname = 'bestiary/'.$_POST['photoname'];
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
   echo('<div class="col-md-12">');
   echo ('<div class="npcimg-container">');
 echo ('<img class="monsterimg" src="bestiary/'.$stripid.'.png" />');
 ?>

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

	</div> <!-- section right -->
	<hr class="orange-border bottom" />
</div> <!-- stat block -->
          <?php
            $sidebartype = $row['type'];
          }
        }

      ?>
      </div>
<!-- Search and add hyperlinks -->
<?php
  /*  $sqlworld = "SELECT * FROM world WHERE title NOT LIKE '%{$id}%'";
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
  <!-- Search and add hyperlinks -->
    <?php
      $sqlworld = "SELECT * FROM world";
      $worlddata = mysqli_query($dbcon, $sqlworld) or die('error getting data');
      while($linkrow = mysqli_fetch_array($worlddata, MYSQLI_ASSOC)) {
      $temp = $linkrow['title'];
      ?>
      <script>
      var foundlink = "<?php echo $temp ?>";
      function replace (querytext){
        var bodytext = document.getElementById("body2").innerHTML;
        var url = "<a href=\"world.php?id=" + querytext + "\">" + querytext + "</a>";
        var regex = new RegExp(querytext, 'ig');
        var newtext = bodytext.replace(regex, url)
        document.getElementById("body2").innerHTML = newtext;
      }
      replace(foundlink);

      </script>
      <?php
    }
*/    ?>

</div>
