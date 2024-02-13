<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $pgtitle = 'Enounter Builder - ';
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);
   ?>
   <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.js" type="text/javascript"></script>
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">
   <div class="mainbox col-lg-10 col-xs-12 col-lg-offset-1">
     <style>
     th, td { white-space: normal; }
     </style>
     <!-- Page Header -->
     <div class="col-md-12">
     <div class="pagetitle" id="pgtitle">Enounter Builder</div>
   </div>
   <div class="col-md-4 sidebartext">
     <div class="selectors">
     # of players
     <select id="numPlayers" onchange="calcDifficulty()">
       <option>1
       <option>2
       <option>3
       <option>4
       <option>5
       <option>6
       <option>7
       <option>8
     </select>

     Level
     <select id="playerLevel" onchange="calcDifficulty()">
       <option>1
       <option>2
       <option>3
       <option>4
       <option>5
       <option>6
       <option>7
       <option>8
       <option>9
       <option>10
       <option>11
       <option>12
       <option>13
       <option>14
       <option>15
       <option>16
       <option>17
       <option>18
       <option>19
       <option>20
     </select>
   </div>
     <div class="hide monslot" id="slot1"><div class="inline" id="monster1"></div><div class="hide" id="xp1"></div><div class="controls"><button class="btn btn-success" onclick="addMon('1')">+</button><button class="btn btn-danger" onclick="remMon('1')">-</button><input class="narrowinput" type"text" id="num1" value="0"></input></div></div>
     <div class="hide monslot" id="slot2"><div class="inline" id="monster2"></div><div class="hide" id="xp2"></div><div class="controls"><button class="btn btn-success" onclick="addMon('2')">+</button><button class="btn btn-danger" onclick="remMon('2')">-</button><input class="narrowinput" type"text" id="num2" value="0"></input></div></div>
     <div class="hide monslot" id="slot3"><div class="inline" id="monster3"></div><div class="hide" id="xp3"></div><div class="controls"><button class="btn btn-success" onclick="addMon('3')">+</button><button class="btn btn-danger" onclick="remMon('3')">-</button><input class="narrowinput" type"text" id="num3" value="0"></input></div></div>
     <div class="hide monslot" id="slot4"><div class="inline" id="monster4"></div><div class="hide" id="xp4"></div><div class="controls"><button class="btn btn-success" onclick="addMon('4')">+</button><button class="btn btn-danger" onclick="remMon('4')">-</button><input class="narrowinput" type"text" id="num4" value="0"></input></div></div>
     <div class="hide monslot" id="slot5"><div class="inline" id="monster5"></div><div class="hide" id="xp5"></div><div class="controls"><button class="btn btn-success" onclick="addMon('5')">+</button><button class="btn btn-danger" onclick="remMon('5')">-</button><input class="narrowinput" type"text" id="num5" value="0"></input></div></div>
     <div class="hide monslot" id="slot6"><div class="inline" id="monster6"></div><div class="hide" id="xp6"></div><div class="controls"><button class="btn btn-success" onclick="addMon('6')">+</button><button class="btn btn-danger" onclick="remMon('6')">-</button><input class="narrowinput" type"text" id="num6" value="0"></input></div></div>
     <div class="hide monslot" id="slot7"><div class="inline" id="monster7"></div><div class="hide" id="xp7"></div><div class="controls"><button class="btn btn-success" onclick="addMon('7')">+</button><button class="btn btn-danger" onclick="remMon('7')">-</button><input class="narrowinput" type"text" id="num7" value="0"></input></div></div>
     <div class="hide monslot" id="slot8"><div class="inline" id="monster8"></div><div class="hide" id="xp8"></div><div class="controls"><button class="btn btn-success" onclick="addMon('8')">+</button><button class="btn btn-danger" onclick="remMon('8')">-</button><input class="narrowinput" type"text" id="num8" value="0"></input></div></div>
     <div class="hide monslot" id="slot9"><div class="inline" id="monster9"></div><div class="hide" id="xp9"></div><div class="controls"><button class="btn btn-success" onclick="addMon('9')">+</button><button class="btn btn-danger" onclick="remMon('9')">-</button><input class="narrowinput" type"text" id="num9" value="0"></input></div></div>
     <div class="hide monslot" id="slot10"><div class="inline" id="monster10"></div><div class="hide" id="xp10"></div><div class="controls"><button class="btn btn-success" onclick="addMon('10')">+</button><button class="btn btn-danger" onclick="remMon('10')">-</button><input class="narrowinput" type"text" id="num10" value="0"></input></div></div>

     <br><div style="margin-bottom:15px;"><div style="float:right;">Total XP: <div id="totalxp" style="display:inline;">0</div></div>
     <br><div style="float:right;">Adjusted XP: <div id="adjxp" style="display:inline;">0</div></div></div>
     <br><div style="margin-bottom:15px;"><div id="easyname" style="float:right;">Easy: <div id="easy" style="display:inline;">0</div></div>
     <br><div id="mediumname" style="float:right;">Medium: <div id="medium" style="display:inline;">0</div></div>
     <br><div id="hardname" style="float:right;">Hard: <div id="hard" style="display:inline;">0</div></div>
     <br><div id="deadlyname" style="float:right;">Deadly: <div id="deadly" style="display:inline;">0</div></div></div>
     <br><div id="dailyname" style="float:right;">Daily Budget: <div id="daily" style="display:inline;">0</div></div>
     <br><button class="btn btn-primary" onclick="saveEncounter()">Save Encounter</button><input type="text" id="encLabel" placeholder="Enter Encounter label..."></input>
     <br>
     <select id="dungeon" onchange="dungeonform(this)">
     <option value="">Add to dungeon...</option>
     <?php
     $worldtitle = "SELECT DISTINCT dungeon FROM fights WHERE worlduser LIKE '$loguser' ORDER BY title ASC";
       $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
       while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
          echo ('<option>'.$row['dungeon'].'</option>');
       }
     ?>
     </select>
       <div class="hide" id="currentdungeon"></div>
      <script type="text/javascript">
        $('#dungeon').selectize({
    create: true,
    sortField: 'text'
});
        </script>

        <script>
        function dungeonform(selectObj){
          var selectIndex=selectObj.selectedIndex;
          var selectValue=selectObj.options[selectIndex].text;
          $('#currentdungeon').html(selectValue);
        }
        </script>

     <div id="encounterAdd" class="margintop">
       My Encounters: <br>

       <?php
      $dungeontitle = "SELECT DISTINCT dungeon FROM fights WHERE worlduser LIKE '$loguser' ORDER BY encLabel ASC";
       $dungeondata = mysqli_query($dbcon, $dungeontitle) or die('error getting data');
       while($row1 =  mysqli_fetch_array($dungeondata, MYSQLI_ASSOC)) {
        $dungeonorig = $row1['dungeon'];
        $dungeonquery = str_replace("'", "''", $dungeonorig);
        $dungeon = str_replace("'", "", $dungeonorig);
        $dungeon = str_replace(" ", "", $dungeon);

               echo ('<button class="btn btn-primary margintop" id="'.$dungeon.'">'.$row1['dungeon'].' +</button>');
               ?>
               <script>
                $(document).ready(function showPlayers(){
        $("#<?php echo $dungeon; ?>").click(function addLog(){
            $("#<?php echo ($dungeon.'show'); ?> ").slideToggle("slow");
        });
      });

        </script>
        <?php
               echo ('<div id="'.$dungeon.'show" class="margintop" style="display:none;">');
       echo ('<table style="overflow:auto;">');
       $playercount = 1;
       $worldtitle = "SELECT * FROM fights WHERE worlduser LIKE '$loguser' AND dungeon LIKE '$dungeonquery' ORDER BY encLabel ASC";
       $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
       while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
           echo ('<tr id="encounter'.$row['id'].'"><td><button class="btn btn-danger" style="margin-right: 10px; margin-top:20px;" onclick="delEncounter('.$row['id'].')">-</button>');
           echo ('</td><td class="sidebartext" style="white-space: normal;">');
           if ($row['encLabel'] != ''){
           echo ('<div class="diff" style="display:inline-block;">');
           echo $row['encLabel'];
           echo (': </div><br>');
         }
           $EncArray = explode(",",$row['title']);
           $ArrLength = count($EncArray);
           foreach ($EncArray as $i => $item) {
             $EncName = str_replace("monster","",$EncArray[$i]);
             $EncNum  = preg_replace('/[^0-9]/', '', $EncName);
             $EncWords  = preg_replace('/[0-9]/', '', $EncName);
             $EncWords = preg_replace('/(?<!\ )[A-Z][a-z]/', ' $0', $EncWords);
             echo ($EncNum.'x '.$EncWords);
             $x = $i + 1;
             if ($ArrLength != $x) {
               echo (', ');
             }
           }


           ?>
           <?php
           //echo ($EncNum.'x '.$EncName);
           echo ('</td></tr>');
         }

        
      echo ('</table>');
         echo ('</div><br>');
        }
      ?>
   </div>
<script>
function delEncounter(value){
    var delID = parseInt(value);

    $.ajax({
    url : '/tools/compendium/encounter-del.php',
    type: 'GET',
    data : { "delID" : delID },
    success: function(data)
    {
      $('#encounter' + delID).addClass("hide");
    },
    error: function (jqXHR, status, errorThrown)
    {

    }
    });
}

</script>

   </div>
     <div class="body sidebartext col-md-8" id="body">
       <div class="table-responsive">
   <table id="allspells" class="table table-condensed table-striped table-responsive dt-responsive" cellspacing="0" width="100%">
           <thead class="thead-dark">
               <tr>
                   <th scope="col">Add</th>
                   <th scope="col">Name</th>
                   <th scope="col">Image</th>
                   <th scope="col">Size</th>
                   <th scope="col">Type</th>
                   <th scope="col">CR</th>
                   <th scope="col">Source</th>
                   <th scope="col">AC</th>
                   <th scope="col">HP</th>
                   <th scope="col">Speed</th>
                   <th scope="col">STR</th>
                   <th scope="col">DEX</th>
                   <th scope="col">CON</th>
                   <th scope="col">INT</th>
                   <th scope="col">WIS</th>
                   <th scope="col">CHA</th>
                   <th scope="col">Saves</th>
                   <th scope="col">Resistences</th>
                   <th scope="col">Vulnerabilities</th>
                   <th scope="col">Immunities</th>
                   <th scope="col">Condition Immunities</th>
                   <th scope="col">Senses</th>
                   <th scope="col">Passive Perception</th>
                   <th scope="col">Languages</th>


               </tr>
           </thead>
           <tfoot>
               <tr>
                 <th scope="col">Add</th>
                 <th scope="col">Name</th>
                <th scope="col">Image</th> 
                 <th scope="col">Size</th>
                 <th scope="col">Type</th>
                 <th scope="col">CR</th>
                 <th scope="col">Source</th>
                 <th scope="col">AC</th>
                 <th scope="col">HP</th>
                 <th scope="col">Speed</th>
                 <th scope="col">STR</th>
                 <th scope="col">DEX</th>
                 <th scope="col">CON</th>
                 <th scope="col">INT</th>
                 <th scope="col">WIS</th>
                 <th scope="col">CHA</th>
                 <th scope="col">Saves</th>
                 <th scope="col">Resistences</th>
                 <th scope="col">Vulnerabilities</th>
                 <th scope="col">Immunities</th>
                 <th scope="col">Condition Immunities</th>
                 <th scope="col">Senses</th>
                 <th scope="col">Passive Perception</th>
                 <th scope="col">Languages</th>

               </tr>
           </tfoot>
           <tbody>
             <?php
               $sqlcompendium = "SELECT * FROM compendium WHERE type LIKE 'monster'";
               $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
               while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
                 $entry = $row['title'];
                 $entry1 =  str_replace("(monster)","",$entry);
                 $jpgurl = 'bestiary/'.$entry1.'.jpg';
                 $pngurl = 'bestiary/'.$entry1.'.png';

               echo ('<tr><td>');
               echo ('<button class="btn btn-success" onclick="addMonster(\''.$entry.'\')">+</button>');
               echo ('</td><td>');
               echo "<a href=\"compendium.php?id=$entry\">";
               echo $entry;
               echo "</a></td>";
               if (file_exists($jpgurl)){
                 echo ('<td><img class="tableimg" src="'.$jpgurl.'"></td>');
               }
               else if (file_exists($pngurl)){
                 echo ('<td><img class="tableimg" src="'.$pngurl.'"></td>');
               }
               else {
                 echo ('<td>n/a</td>');
               }
               echo ('<td>'.$row['monsterSize'].'</td>');
               echo ('<td>'.$row['monsterType'].'</td>');
               if($row['monsterCr'] ==0.125){
                 echo ('<td>0.125</td>');

               }
               elseif($row['monsterCr'] ==0.25){
                 echo ('<td>0.25</td>');

               }
               elseif($row['monsterCr'] ==0.5){
                 echo ('<td>0.5</td>');

               }
               else{
               echo ('<td>'.number_format((float)$row['monsterCr'], 0, '.', '').'</td>');
             }
             echo ('<td>'.$row['monsterTrait1'].'</td>');
             echo ('<td>'.$row['monsterAc'].'</td>');
             echo ('<td>'.$row['monsterHp'].'</td>');
             echo ('<td>'.$row['monsterSpeed'].'</td>');
             echo ('<td>'.$row['monsterStr'].'</td>');
             echo ('<td>'.$row['monsterDex'].'</td>');
             echo ('<td>'.$row['monsterCon'].'</td>');
             echo ('<td>'.$row['monsterInt'].'</td>');
             echo ('<td>'.$row['monsterWis'].'</td>');
             echo ('<td>'.$row['monsterCha'].'</td>');
             echo ('<td>'.$row['monsterSave'].'</td>');
             echo ('<td>'.$row['monsterResist'].'</td>');
             echo ('<td>'.$row['monsterVulnerable'].'</td>');
             echo ('<td>'.$row['monsterImmune'].'</td>');
             echo ('<td>'.$row['monsterConditionImmune'].'</td>');
             echo ('<td>'.$row['monsterSenses'].'</td>');
             echo ('<td>'.$row['monsterPassive'].'</td>');
             echo ('<td>'.$row['monsterLanguages'].'</td>');

             echo ('</tr>');

             }
               ?>

</tbody>
</table>
<script>
$(document).ready(function() {
  calcDifficulty();
    // Setup - add a text input to each footer cell
    var x = 1;
    $('#allspells tfoot th').each( function () {
        var title = $(this).text();
        if (x > 1 && x != 3){
        $(this).html( '<input type="text" class="form-control" placeholder="'+title+'..." style="width:90px;" />' );
        }
        x = x + 1;
    } ); 



    // DataTable
    var table = $('#allspells').DataTable(
      {
         "scrollX": true,
         "scrollY": "600px",
         "responsive": false,
         "pageLength": 50,
         
   "lengthMenu": [[10, 25, 50, 100, 250, -1], [10, 25, 50, 100, 250, "All"]],
        "fixedColumns": true

        /* initComplete: function () {
            var countnum = 1;
            this.api().columns().every( function () {
                if (countnum > 2 && countnum < 6){
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+ d +'</option>' )
                } );
  }
  countnum = countnum + 1;

            } );
        }
        //table.draw();
*/
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
//var i = 1;
function addMonster(value) {
  var totalxp = document.getElementById('totalxp').innerHTML;
  totalxp = parseFloat(totalxp);
  var monster = value;
  var currentxp;
  $.ajax({
  url : '/tools/compendium/encounter-add.php',
  type: 'GET',
  data : { "monster" : monster },
  success: function(data)
  {
    var x = 1;
    for (i = 1; i <= 10; i++){
      var checkEmpty = document.getElementById('monster' + i).innerHTML;
      if (checkEmpty == '' && x == 1){
        document.getElementById('num' + i).value = 1;
        document.getElementById('monster' + i).innerHTML = monster;
        $('#slot' + i).removeClass('hide');
        currentxp = data.replace(/\D/g,'');
        currentxp = parseInt(currentxp.slice(0, -2));
        document.getElementById('xp' + i).innerHTML = currentxp;
       // i++;
        totalxp = totalxp + currentxp;
        document.getElementById('totalxp').innerHTML = totalxp;
        x++;
      }

 }
   calcAdjXp();

  },
  error: function (jqXHR, status, errorThrown)
  {
      //if fail show error and server status
      $("#status_text").html('there was an error ' + errorThrown + ' with status ' + textStatus);
  }
  });
}
</script>

<script>
function addMon(value) {
var currentNum = $('#num' + value).val();
var monID = 'num' + value;
var newNum = parseInt(currentNum) + 1;
document.getElementById(monID).value = newNum;
var monXp = $('#xp' + value).html();
var totalxp = document.getElementById('totalxp').innerHTML;
totalxp = parseInt(totalxp) + parseInt(monXp);
document.getElementById('totalxp').innerHTML = totalxp;
calcAdjXp();
}
</script>
<script>
function remMon(value) {
var currentNum = $('#num' + value).val();
if (parseInt(currentNum) > 0){
var monID = 'num' + value;
var newNum = parseInt(currentNum) - 1;
document.getElementById(monID).value = newNum;
var monXp = $('#xp' + value).html();
var totalxp = document.getElementById('totalxp').innerHTML;
totalxp = parseInt(totalxp) - parseInt(monXp);
document.getElementById('totalxp').innerHTML = totalxp;
if (newNum == 0) {
  $('#slot' + value).addClass("hide");
  $('#xp' + value).html("0");
  $('#monster' + value).html("");
  $('#num' + value).val("0");
}
}
calcAdjXp();
}

</script>
<script>
function calcAdjXp(){
var mon1 = parseInt($('#num1').val());
var mon2 = parseInt($('#num2').val());
var mon3 = parseInt($('#num3').val());
var mon4 = parseInt($('#num4').val());
var mon5 = parseInt($('#num5').val());
var mon6 = parseInt($('#num6').val());
var mon7 = parseInt($('#num7').val());
var mon8 = parseInt($('#num8').val());
var mon9 = parseInt($('#num9').val());
var mon10 = parseInt($('#num10').val());
var numMon = 0;
numMon = mon1 + mon2 + mon3 + mon4 + mon5 + mon6 + mon7 + mon8 + mon9 + mon10;
var monMult = 0;

if (numMon == 1){
  monMult = 1;
}
if (numMon == 2){
  monMult = 1.5;
}
if (numMon >= 3 && numMon <= 6){
  monMult = 2;
}
if (numMon >= 7 && numMon <= 10){
  monMult = 2.5;
}
if (numMon >= 11 && numMon <= 14){
  monMult = 3;
}
if (numMon >= 15){
  monMult = 4;
}
var totalxp = $('#totalxp').html();
var adjXp = totalxp * monMult;
document.getElementById('adjxp').innerHTML = adjXp;
calcDifficulty();
}

</script>

<script>
function calcDifficulty() {
    var easy = [25, 50, 75, 125, 250, 300, 350, 450, 550, 600, 800, 1000, 1100, 1250, 1400, 1600, 2000, 2100, 2400, 2800];
    var medium = [50, 100, 150, 250, 500, 600, 750, 900, 1100, 1200, 1600, 2000, 2200, 2500, 2800, 3200, 3900, 4200, 4900, 5700];
    var hard = [75, 150, 225, 375, 750, 900, 1100, 1400, 1600, 1900, 2400, 3000, 3400, 3800, 4300, 4800, 5900, 6300, 7300, 8500];
    var deadly = [100, 200, 400, 500, 1100, 1400, 1700, 2100, 2400, 2800, 3600, 4500, 5100, 5700, 6400, 7200, 8800, 9500, 10900, 12700];
    var daily = [300, 600, 1200, 1700, 3500, 4000, 5000, 6000, 7500, 9000, 10500, 11500, 13500, 15000, 18000, 20000, 25000, 27000, 30000, 40000];

    var numPlayers = $('#numPlayers').find(":selected").text();
    var playerLevel = $('#playerLevel').find(":selected").text();
    var arrayPos = parseInt(playerLevel) - 1;
    var easyBar = parseInt(numPlayers) * parseInt(easy[arrayPos]);
    var mediumBar = parseInt(numPlayers) * parseInt(medium[arrayPos]);
    var hardBar = parseInt(numPlayers) * parseInt(hard[arrayPos]);
    var deadlyBar = parseInt(numPlayers) * parseInt(deadly[arrayPos]);
    var dailyBar = parseInt(numPlayers) * parseInt(daily[arrayPos]);

    $('#easy').html(easyBar);
    $('#medium').html(mediumBar);
    $('#hard').html(hardBar);
    $('#deadly').html(deadlyBar);
    $('#daily').html(dailyBar);
    var adjXp = parseInt($('#adjxp').html());
    easyBar = parseInt(easyBar);
    mediumBar = parseInt(mediumBar);
    hardBar = parseInt(hardBar);
    deadlyBar = parseInt(deadlyBar);
    dailyBar = parseInt(dailyBar);
    if (adjXp <= easyBar){
      $('#easy').addClass("diff");
      $('#easyname').addClass("diff");
      $('#medium').removeClass("diff");
      $('#mediumname').removeClass("diff");
      $('#hard').removeClass("diff");
      $('#hardname').removeClass("diff");
      $('#deadly').removeClass("diff");
      $('#deadlyname').removeClass("diff");
    }
    if (adjXp > easyBar && adjXp <= mediumBar){
      $('#easy').addClass("diff");
      $('#easyname').addClass("diff");
      $('#medium').removeClass("diff");
      $('#mediumname').removeClass("diff");
      $('#hard').removeClass("diff");
      $('#hardname').removeClass("diff");
      $('#deadly').removeClass("diff");
      $('#deadlyname').removeClass("diff");
    }
    if (adjXp > mediumBar && adjXp <= hardBar){
      $('#easy').removeClass("diff");
      $('#easyname').removeClass("diff");
      $('#medium').addClass("diff");
      $('#mediumname').addClass("diff");
      $('#hard').removeClass("diff");
      $('#hardname').removeClass("diff");
      $('#deadly').removeClass("diff");
      $('#deadlyname').removeClass("diff");
    }
    if (adjXp > hardBar && adjXp <= deadlyBar){
      $('#easy').removeClass("diff");
      $('#easyname').removeClass("diff");
      $('#medium').removeClass("diff");
      $('#mediumname').removeClass("diff");
      $('#hard').addClass("diff");
      $('#hardname').addClass("diff");
      $('#deadly').removeClass("diff");
      $('#deadlyname').removeClass("diff");
    }
    if (adjXp > deadlyBar){
      $('#easy').removeClass("diff");
      $('#easyname').removeClass("diff");
      $('#medium').removeClass("diff");
      $('#mediumname').removeClass("diff");
      $('#hard').removeClass("diff");
      $('#hardname').removeClass("diff");
      $('#deadly').addClass("diff");
      $('#deadlyname').addClass("diff");
    }
}

</script>

<script>
function saveEncounter(){
  var mon1 = $('#monster1').html();
  var mon2 = $('#monster2').html();
  var mon3 = $('#monster3').html();
  var mon4 = $('#monster4').html();
  var mon5 = $('#monster5').html();
  var mon6 = $('#monster6').html();
  var mon7 = $('#monster7').html();
  var mon8 = $('#monster8').html();
  var mon9 = $('#monster9').html();
  var mon10 = $('#monster10').html();
  var num1 = $('#num1').val();
  var num2 = $('#num2').val();
  var num3 = $('#num3').val();
  var num4 = $('#num4').val();
  var num5 = $('#num5').val();
  var num6 = $('#num6').val();
  var num7 = $('#num7').val();
  var num8 = $('#num8').val();
  var num9 = $('#num9').val();
  var num10 = $('#num10').val();
  mon1 = mon1 + num1;
  mon2 = mon2 + num2;
  mon3 = mon3 + num3;
  mon4 = mon4 + num4;
  mon5 = mon5 + num5;
  mon6 = mon6 + num6;
  mon7 = mon7 + num7;
  mon8 = mon8 + num8;
  mon9 = mon9 + num9;
  mon10 = mon10 + num10;
  var mons = [mon1,mon2,mon3,mon4,mon5,mon6,mon7,mon8,mon9,mon10];
  mons = mons.filter(a => a !== '0');
  mons = mons.join(',');
  mons = mons.replace(/[- )(]/g,'');
  var worlduser = '<?php echo $loguser; ?>';
  var encLabel = $("#encLabel").val();
  var dungeon = $("#currentdungeon").html();
  if ($("#currentdungeon").is(':empty')){
    dungeon = "Misc Encounters";
  }

  $.ajax({
  url : '/tools/compendium/encounter-save.php',
  type: 'GET',
  data : { "encounter" : mons, "worlduser" : worlduser, "encLabel" : encLabel, "dungeon" : dungeon },
  success: function()
  {
  $('#myModal').modal('show');

  },
  error: function (jqXHR, status, errorThrown)
  {
      //if fail show error and server status
      $("#status_text").html('there was an error ' + errorThrown + ' with status ' + textStatus);
  }
  });

}

</script>

</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content modalstyle bodytext">

      <div class="modal-body">
        <p>Encounter Saved!</p>
      </div>
      <div class="modal-footer">
        <a href="encounter-builder.php"><button type="button" class="btn btn-primary">Add Another Encounter</button></a>
      </div>
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
