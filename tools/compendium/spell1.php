<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);
   $parsepath = $_SERVER['DOCUMENT_ROOT'];
   $parsepath .= "/plugins/Parsedown.php";
   include_once($parsepath);

   //Header
   $pgtitle = 'Spells - ';
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);
   ?>
   <?php  $Parsedown = new Parsedown(); ?>
   <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.js" type="text/javascript"></script>
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">
   <div class="mainbox col-lg-10 col-xs-12 col-lg-offset-1">
     <?php
     $id = "index";
     $disallowed_paths = array('header', 'footer');
     if (!empty($_GET['id'])) {
       $tmp_action = basename($_GET['id']);
       if (!in_array($tmp_action, $disallowed_paths) /*&& file_exists("world/{$tmp_action}.php")*/)
             $id = $tmp_action;

   $stripid = str_replace("'", "", $id);
   $stripid = stripslashes($stripid);
   $id = addslashes($id);
   $worldtitle = "SELECT * FROM `characters` WHERE `title` LIKE '$id'";
   $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
   while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
     if ($row['user'] !== $loguser && $loguser !== 'tarfuin'){
       header("Location: /tools/users/login.php");
       die();
     }
     $allspells = $row['spells'];
     $prepped = $row['prepped'];
     $spellsarray = explode(',', $allspells);
     $spellsarray = join("','",$spellsarray);
     $title = $row['title'];
     $charID = $row['id'];
     $fullclass = $row['class1'];
     $fullmulticlass = $row['class2'];
     $dexmod = floor((($row['dex']-10)/2));
     $coreclass = substr($fullclass, 0, strpos($fullclass, "(") -1);
     $coremulticlass = substr($fullmulticlass, 0, strpos($fullmulticlass, "(") -1);
     $subclasstemp = substr($fullclass, strpos($fullclass, "(") +1);
     $multisubclasstemp = substr($fullmulticlass, strpos($fullmulticlass, "(") +1);
     $subclass = trim($subclasstemp, ')');
     $multisubclass = trim($multisubclasstemp, ')');
     $coreclassbare = ucwords($coreclass);
     $coremultibare = ucwords($coremulticlass);
     $coremulticlassbare = ucwords($coremulticlass);
     $background = $row['background'];
     $race = $row['race'];
     $bgbare = ucwords($row['background']);
     $coreclass = $coreclass.' core';
     $checkprofs = $row['proficiencies'];
     $checksaves = $row['saves'];
     $checkexperts = $row['expertise'];
     $allattacks = $row['attacks'];
     $allfeats = $row['feats'];
     $customattacks = $row['customattacks'];
     $charNotes = $row['notes'];
     $charItems = $row['items'];
     $level = $row['level'];
     $multiclasslevel = (int)$row['class2lvl'];
     $mainclasslevel = (int)$level - $multiclasslevel;

     $strmod = floor((($row['str']-10)/2));
     $dexmod = floor((($row['dex']-10)/2));
     $conmod = floor((($row['con']-10)/2));
     $intelmod = floor((($row['intel']-10)/2));
     $wismod = floor((($row['wis']-10)/2));
     $chamod = floor((($row['cha']-10)/2));
     $level = $row['level'];
     $multiclasslevel = (int)$row['class2lvl'];
     $mainclasslevel = (int)$level - $multiclasslevel;


     if ($row['level'] >= 1 && $row['level'] <= 4) {
       $profbonus = 2;
     }
     if ($row['level'] >= 5 && $row['level'] <= 8) {
       $profbonus = 3;
     }
     if ($row['level'] >= 9 && $row['level'] <= 12) {
       $profbonus = 4;
     }
     if ($row['level'] >= 13 && $row['level'] <= 16) {
       $profbonus = 5;
     }
     if ($row['level'] >= 17 && $row['level'] <= 20) {
       $profbonus = 6;
     }




     $basespelldc = 8 + (int)$profbonus;
     if ($coreclassbare == 'Paladin' || $coreclassbare == 'Sorcerer' || $coreclassbare == 'Warlock' || $coreclassbare == 'Bard'){
       $spelldc = $basespelldc + $chamod;
       $spellattack = $chamod + (int)$profbonus;
     }
     else if ($coreclassbare == 'Wizard' || $coreclassbare == 'Mystic' || $coreclassbare == 'Artificer' || $subclass == 'Eldritch Knight' || $subclass == 'Arcane Trickster'){
       $spelldc = $basespelldc + $intelmod;
       $spellattack = $intelmod + (int)$profbonus;
     }
     else if ($coreclassbare == 'Cleric' || $coreclassbare == 'Druid' || $coreclassbare == 'Monk' || $coreclassbare == 'Ranger' || $coreclassbare == 'Revised Ranger'){
       $spelldc = $basespelldc + $wismod;
       $spellattack = $wismod + (int)$profbonus;
     }
     else {
       $spelldc = 'N/A';
       $spellattack = 'N/A';
     }
     if ($coremultibare == 'Paladin' || $coremultibare == 'Sorcerer' || $coremultibare == 'Warlock' || $coremultibare == 'Bard'){
       $spelldc2 = $basespelldc + $chamod;
       $spellattack2 = $chamod + (int)$profbonus;
     }
     else if ($coremultibare == 'Wizard' || $coremultibare == 'Mystic' || $coremultibare == 'Artificer' || $multisubclass == 'Eldritch Knight' || $multisubclass == 'Arcane Trickster'){
       $spelldc2 = $basespelldc + $intelmod;
       $spellattack2 = $intelmod + (int)$profbonus;
     }
     else if ($coremultibare == 'Cleric' || $coremultibare == 'Druid' || $coremultibare == 'Monk' || $coremultibare == 'Ranger' || $coremultibare == 'Revised Ranger'){
       $spelldc2 = $basespelldc + $wismod;
       $spellattack2 = $wismod + (int)$profbonus;
     }
     else {
       $spelldc2 = 'N/A';
       $spellattack2 = 'N/A';
     }
       ?>

     <!-- Page Header -->
     <div class="col-md-12">
       <?php
        echo ('<div id="currentSpells" style="display:none;">'.$prepped.'</div>');
        ?>
     <div class="pagetitle" id="pgtitle"><?php echo ucwords($row['title']); ?>'s' Spells</div>
   </div>
     <div class="body sidebartext col-xs-12" id="body" style="padding: 0px;">
       <table class="col-centered" style="width: 25%;">
         <tr>
           <td><div class="col-centered spellinfo" id="spelldc"><?php echo $spelldc; ?></div></td>
           <td><div class="col-centered spellinfo" id="spellattack">+<?php echo $spellattack; ?></div></td>
         </tr>
         <tr>
         <td><div class="charDeet">Spell DC</div></td>
         <td><div class="charDeet">Spell Attack</div></td>
       </tr>
       <table style="width:100%;">
         <?php
         if ($coreclassbare == 'Warlock' || strpos($subclass, 'Profane Soul') !== false) { ?>
           <tr class="col-centered col-xs-12">
             <td class="slotcell" style="border-left: 1px solid white;">Slots</td>
             <td class="slotcell">Slot Level</td>
           </tr>

           <tr class="bigt col-centered col-xs-12"> <?php
         }
         else if ($coreclassbare == 'Mystic'){ ?>
           <tr class="col-centered col-xs-12">
             <td class="slotcell" style="border-left: 1px solid white;">Psi Points</td>
             <td class="slotcell">Psi Limit</td>
           </tr>

           <tr class="bigt col-centered col-xs-12"> <?php
         }
         else {
           ?>
         <tr class="col-centered col-xs-12">
           <td class="slotcell" style="border-left: 1px solid white;">1st</td>
           <td class="slotcell">2nd</td>
           <td class="slotcell">3rd</td>
           <td class="slotcell">4th</td>
           <td class="slotcell">5th</td>
           <td class="slotcell">6th</td>
           <td class="slotcell">7th</td>
           <td class="slotcell">8th</td>
           <td class="slotcell">9th</td>
         </tr>

         <tr class="bigt col-centered col-xs-12">
           <?php
         }
          if (strpos($subclass, 'Profane Soul') !== false){
            $spellsub = 'Profane';
          }
          else if (strpos($subclass, 'Arcane Trickster') !== false){
            $spellsub = 'Trickster';
          }
          else if (strpos($subclass, 'Eldritch Knight') !== false){
            $spellsub = 'Knight';
          }
          else {
            $spellsub = $coreclassbare;
          }
           $worldtitle1 = "SELECT * FROM `classtable` WHERE `class` LIKE '$spellsub'";
           $titledata1 = mysqli_query($dbcon, $worldtitle1) or die('error getting data');
           while($row1 =  mysqli_fetch_array($titledata1, MYSQLI_ASSOC)) {
             $checktable = str_replace($row1['class'], '', $row1['name']);
             if ($checktable == $mainclasslevel) {
               if ($coreclassbare == 'Warlock' || strpos($subclass, 'Profane Soul') !== false) { ?>
                 <td class="slotcell" style="border-left: 1px solid white;"><input class="prof" style="width:50px;" type="text"value="<?php echo $row1['spelllvl1']; ?>"></td>
                 <td class="slotcell"><input class="prof" style="width:50px;" type="text"value="<?php echo $row1['spelllvl2']; ?>"></td>

               <?php
             }
            else if ($coreclassbare == 'Mystic') { ?>
               <td class="slotcell" style="border-left: 1px solid white;"><input class="prof" style="width:50px;" type="text"value="<?php echo $row1['spelllvl3']; ?>"></td>
               <td class="slotcell"><input class="prof" style="width:50px;" type="text"value="<?php echo $row1['spelllvl4']; ?>"></td>
             <?php
           }
               else {
               ?>
               <td class="slotcell" style="border-left: 1px solid white;"><input class="prof" type="text"value="<?php echo $row1['spelllvl1']; ?>"></td>
               <td class="slotcell"><input class="prof" type="text"value="<?php echo $row1['spelllvl2']; ?>"></td>
               <td class="slotcell"><input class="prof" type="text"value="<?php echo $row1['spelllvl3']; ?>"></td>
               <td class="slotcell"><input class="prof" type="text"value="<?php echo $row1['spelllvl4']; ?>"></td>
               <td class="slotcell"><input class="prof" type="text"value="<?php echo $row1['spelllvl5']; ?>"></td>
               <td class="slotcell"><input class="prof" type="text"value="<?php echo $row1['spelllvl6']; ?>"></td>
               <td class="slotcell"><input class="prof" type="text"value="<?php echo $row1['spelllvl7']; ?>"></td>
               <td class="slotcell"><input class="prof" type="text"value="<?php echo $row1['spelllvl8']; ?>"></td>
               <td class="slotcell"><input class="prof" type="text"value="<?php echo $row1['spelllvl9']; ?>"></td>

                <?php
              }
            }
           }

            ?>

         </tr>
       </table>
       <table>
         <tr>
       <td><button class="btn btn-info" id="btn-show-all-children" type="button">Expand All</button></td>
<td><button class="btn btn-primary" id="btn-hide-all-children" type="button">Collapse All</button></td>
<td width="100%"><div class="col-centered sidebartext" id="prepwarning" style="display:none;">Please refresh to see changes to prepared spells</div></td>
       <div class="table-responsive">
   <table id="allspells" class="table table-condensed table-striped table-responsive dt-responsive" cellspacing="0" width="100%">
           <thead class="thead-dark">
               <tr>
                   <th scope="col">Name</th>
                   <th scope="col">lvl</th>
                   <th scope="col">Casting Time</th>
                   <th scope="col">Duration</th>
                   <th scope="col">Range</th>
                   <th scope="col">Attack/Save</th>
                   <th scope="col">Prep?</th>
                   <th scope="col">Prepared</th>
                   <th scope="col" class="none">Description</th>
               </tr>
           </thead>
           <tfoot>
               <tr>
                 <th scope="col">Name</th>
                 <th scope="col">lvl</th>
                 <th scope="col">Casting Time</th>
                 <th scope="col">Duration</th>
                 <th scope="col">Range</th>
                 <th scope="col">Attack/Save</th>
                 <th scope="col">Prep?</th>
                 <th scope="col">Prepared</th>
                 <th scope="col">Description</th>
               </tr>
           </tfoot>
           <tbody>
             <?php
               $a = 1;
               $sqlcompendium = "SELECT * FROM compendium WHERE type LIKE 'spell' AND title NOT LIKE '%*' AND title NOT LIKE '%(Ritual Only)' AND title NOT LIKE '%invocation%' AND title IN ('$spellsarray')";
               $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
               while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
                 $spelltitlens = str_replace(' ', '', $row['title']);
                 $spelltitlespec = str_replace('\'', '_', $row['title']);
                 $spelltitlens = preg_replace('/[^a-z\d]+/i', '_', $spelltitlens);
               echo ('<tr style="padding:50px;"><td class="bigt">');
               $entry = $row['title'];
               echo "<a href=\"compendium.php?id=$entry\">";
               echo $entry;
               echo "</a></td>";
               echo ('<td>'.$row['spellLevel'].'</td>');
               echo ('<td>'.$row['spellTime'].'</td>');
               echo ('<td>'.$row['spellDuration'].'</td>');
               echo ('<td>'.$row['spellRange'].'</td>');
               if (strpos($row['text'], 'Strength saving throw') !== false){
                 echo ('<td>STR Save</td>');

               }
               else if (strpos($row['text'], 'Dexterity saving throw') !== false){
                 echo ('<td>DEX Save</td>');

               }
               else if (strpos($row['text'], 'Constitution saving throw') !== false){
                 echo ('<td>CON Save</td>');

               }
               else if (strpos($row['text'], 'Intelligence saving throw') !== false){
                 echo ('<td>INT Save</td>');

               }
               else if (strpos($row['text'], 'Wisdom saving throw') !== false){
                 echo ('<td>WIS Save</td>');

               }
               else if (strpos($row['text'], 'Charisma saving throw') !== false){
                 echo ('<td>CHA Save</td>');

               }
               else if (strpos($row['text'], 'spell attack') !== false){
                 echo ('<td>Spell Attack</td>');

               }
               else {
                 echo ('<td>-</td>');
               }
               echo ('<td><input type="checkbox" class="expertRadio" id="'.$spelltitlens.'" onclick="spellList(\''.$spelltitlespec.'\')"></input></td>');
               echo ('<td id="'.$spelltitlens.'prep"></td>');
               $spelldeet = substr($row['text'], 0, strpos($row['text'], "Source:"));
               $spelldeet = rtrim($spelldeet);
               echo ('<td class="smallt" id="spell'.$a.'">'.nl2br($spelldeet).'</td>');
               echo ('</tr>');
               ?>
               <?php
             }
               ?>

</tbody>
</table>
<script>
$(document).ready(function prepcheck() {
  var prepped = '<?php echo $prepped; ?>';
   var prepArray = prepped.split(',');
   var index = 0;
   var entryNS = '';
   for (index = 0; index < prepArray.length; ++index) {
     entryNS = prepArray[index].replace(/ /g,'');
     var checkbox = document.getElementById(entryNS);
     if (checkbox) {
          $('#' + entryNS).prop('checked', true);
          document.getElementById(entryNS + 'prep').innerHTML = "YES";
     }
   }

});
</script>
<?php
  }
}
 ?>

<script>
function spellList(value) {

  var spellList = document.getElementById('currentSpells').innerHTML;
  var valueNS = value.replace(/[() ]/g,'');
  var spellBoxID = valueNS;
  var charID = '<?php echo $charID; ?>';

  if (document.getElementById(spellBoxID).checked) {
    spellList = spellList + value + ',';
}
else {
  if (spellList.includes(value + ',') == true){
/*   if (spellList.startsWith(value)){
     if (spellList.includes(value + ',')) {*/
     spellList = spellList.replace(value + ',', '');
     }
     /*else {
      spellList = spellList.replace(value , '');
    }*/
  }
    //else {
      //spellList = spellList.replace(',' + value, '');
    //}

  //}

if (spellList.startsWith(',') == false){
  spellList = ',' + spellList;
}
if (spellList.endsWith(',') == false){
  spellList = spellList + ',';
}

document.getElementById('currentSpells').innerHTML = spellList;
document.getElementById('prepwarning').style = "display:block";


$.ajax({
   url : 'prep.php',
   type: 'GET',
   data : { "id" : charID, "prepped" : spellList },
   success: function()
   {
       //if success then just output the text to the status div then clear the form inputs to prepare for new data
     //  $("#favButton").addClass('disabled');
       //$('#favButton').html('In Favourites');
       //var newURL = '/tools/compen/characters.php?id=' + levelName;
       //$(location).attr('href', newURL)
   },
   error: function (jqXHR, status, errorThrown)
   {
       //if fail show error and server status
       $("#status_text").html('there was an error ' + errorThrown + ' with status ' + textStatus);
   }
});
};



$(document).ready(function() {
    // Setup - add a text input to each footer cell


    // DataTable
    var table = $('#allspells').DataTable( {
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.childRowImmediate,
                type: ''
            }
        },
         "order": [[ 7, "desc" ], [ 1, "asc" ]],
         "pageLength": 50

    } );

    $('#btn-show-all-children').on('click', function(){
           // Expand row details
           table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
       });

       // Handle click on "Collapse All" button
       $('#btn-hide-all-children').on('click', function(){
           // Collapse row details
           table.rows('.parent').nodes().to$().find('td:first-child').trigger('click');
       });
} );


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
