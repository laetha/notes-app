<?php
//SQL Connect
$sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);
//Header
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.php";
include_once($headpath);

?>
<!-- Import Form -->
<div class="mainbox col-lg-10 col-xs-12 col-lg-offset-1">
    <div class ="body bodytext">
  <h1 class="pagetitle">Add to Copendium</h1>
<div class="col-md-10 col-centered">
  <div class="col-sm-6 typebox col-centered" id="name">
      <form method="post" action="dbprocess.php" id="compendium" enctype="multipart/form-data">
      <div class="text">Name</div><input class="textbox" type="text" name="name" id="monname" placeholder="Name...">
</div>
<!-- 'Type' Dropbox -->
<div class="hide"><input type="text" name="worlduser" id="worlduser" value="<?php echo $loguser; ?>"></div>
<div class="col-sm-6 typebox col-centered" id="npc-type">
      <p class="text">Type

        <select form="compendium" required="yes" name="type" id="type" onchange="typeForm(this);">
          <option value="">None...</option>
          <option value="background">Background</option>
          <option value="feat">Feat</option>
          <option value="item">Item</option>
          <option value="monster">Monster</option>
          <option value="race">Race</option>
          <option value="spell">Spell</option>
          <option value="subclass">Subclass</option>
        </select>
        <script type="text/javascript">
        $('#type').selectize({
    create: true,
    sortField: 'text'
});
        </script>
      </p>
      </div>

      <!-- Different form for Different types -->
<!-- Form Alteration Script -->
<script type="text/javascript">
 function typeForm(selectObj) {

   var selectIndex=selectObj.selectedIndex;
   var selectValue=selectObj.options[selectIndex].text;
   var output=document.getElementById("output");
   var selectedForm = "#" + selectValue + "-form";
   selectedForm = (selectedForm).toLowerCase();
   
   $("#background-form").hide();
   $("#feat-form").hide();
   $("#item-form").hide();
   $("#monster-form").hide();
   $("#race-form").hide();
   $("#spell-form").hide();
   $("#subclass-form").hide();
   
   $(selectedForm).show();

 }
</script>
<div id="background-form" style="display:none;">
<div class="text col-centered col-md-6"><textarea type="text" name="backgroundProficiency" id="backgroundProficiency" placeholder="backgroundProficiency" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="backgroundTraits" id="backgroundTraits" placeholder="backgroundTraits" style="height:50px;"></textarea></div>

</div>
<div id="feat-form" style="display:none;">
<div class="text col-centered col-md-6"><textarea type="text" name="featText" id="featText" placeholder="featText" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="featPrerequisite" id="featPrerequisite" placeholder="featPrerequisite" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="featModifier" id="featModifier" placeholder="featModifier" style="height:50px;"></textarea></div>

</div>
<div id="item-form" style="display:none;">
<div class="text col-centered col-md-6"><textarea type="text" name="itemText" id="itemText" placeholder="itemText" style="height:50px;"></textarea></div>
<select form="compendium" name="itemType" id="itemType-form">
              <option value="" selected>None...</option>
              <?php
              $locationdrop = "SELECT DISTINCT itemType FROM `compendium` WHERE `type` LIKE 'item'";
              $locationdata = mysqli_query($dbcon, $locationdrop) or die('error getting data');
              while($locationrow =  mysqli_fetch_array($locationdata, MYSQLI_ASSOC)) {
                $location = $locationrow['itemType'];
                echo "<option value=\"$location\">$location</option>";
              }
              ?>
            </select>
<div class="text col-centered col-md-6"><textarea type="text" name="itemWeight" id="itemWeight" placeholder="itemWeight" style="height:50px;"></textarea></div>
<select form="compendium" name="itemStock" id="itemStock-form">
              <option value="" selected>None...</option>
              <?php
              $locationdrop = "SELECT DISTINCT itemStock FROM `compendium` WHERE `type` LIKE 'item' AND itemStock NOT LIKE ''";
              $locationdata = mysqli_query($dbcon, $locationdrop) or die('error getting data');
              while($locationrow =  mysqli_fetch_array($locationdata, MYSQLI_ASSOC)) {
                $location = $locationrow['itemStock'];
                echo "<option value=\"$location\">$location</option>";
              }
              ?>
            </select>
<div class="text col-centered col-md-6"><textarea type="text" name="itemDetail" id="itemDetail" placeholder="itemDetail" style="height:50px;"></textarea></div>
<input type="checkbox" name="itemMagic" value="1">Magic?<br>
<div class="text col-centered col-md-6"><textarea type="text" name="itemValue" id="itemValue" placeholder="itemValue" style="height:50px;"></textarea></div>
</div>
<div id="monster-form" style="display:none;">
<div class="text col-centered col-md-6"><textarea type="text" name="monsterBlock" id="monsterBlock" placeholder="monsterBlock" style="height:50px;" onKeyUp="monBlock()"></textarea></div>
<select form="compendium" name="monsterTrait1" id="monsterTrait1-form">
              <?php
                  $locationdrop = "SELECT DISTINCT monsterTrait1 FROM `compendium` WHERE monsterTrait1 NOT LIKE '%p.%'";
                  $locationdata = mysqli_query($dbcon, $locationdrop) or die('error getting data');
                  while($locationrow =  mysqli_fetch_array($locationdata, MYSQLI_ASSOC)) {
                    $source = $locationrow['monsterTrait1'];
                  echo "<option value=\"$source\">$source</option>";
                  }
              ?>
            </select>
            <script type="text/javascript">
              $('#monsterTrait1-form').selectize({
          create: true,
          sortField: 'text'
      });
              </script>
          <div class="text col-centered col-md-6"><textarea type="text" name="monsterSize" id="monsterSize-form" placeholder="monsterSize" style="height:50px;"></textarea></div>


            <div class="text col-centered col-md-6"><textarea type="text" name="monsterType" id="monsterType" placeholder="monsterType" style="height:50px;"></textarea></div>
            <div class="text col-centered col-md-6"><textarea type="text" name="monsterAlignment" id="monsterAlignment" placeholder="monsterAlignment" style="height:50px;"></textarea></div>
            <div class="text col-centered col-md-6"><textarea type="text" name="monsterAc" id="monsterAc" placeholder="monsterAc" style="height:50px;"></textarea></div>
            <div class="text col-centered col-md-6"><textarea type="text" name="monsterHp" id="monsterHp" placeholder="monsterHp" style="height:50px;"></textarea></div>
            <div class="text col-centered col-md-6"><textarea type="text" name="monsterSpeed" id="monsterSpeed" placeholder="monsterSpeed" style="height:50px;"></textarea></div>
            <div class="text col-centered col-md-6">
            <textarea type="text" name="monsterStr" id="monsterStr" placeholder="monsterStr" style="height:20px;"></textarea>
            <textarea type="text" name="monsterDex" id="monsterDex" placeholder="monsterDex" style="height:20px;"></textarea>
            <textarea type="text" name="monsterCon" id="monsterCon" placeholder="monsterCon" style="height:20px;"></textarea>
            <textarea type="text" name="monsterInt" id="monsterInt" placeholder="monsterInt" style="height:20px;"></textarea>
            <textarea type="text" name="monsterWis" id="monsterWis" placeholder="monsterWis" style="height:20px;"></textarea>
            <textarea type="text" name="monsterCha" id="monsterCha" placeholder="monsterCha" style="height:20px;"></textarea>
            <textarea type="text" name="monsterSave" id="monsterSave" placeholder="monsterSave" style="height:20px;"></textarea>
            <textarea type="text" name="monsterSkill" id="monsterSkill" placeholder="monsterSkill" style="height:20px;"></textarea>
            <textarea type="text" name="monsterResist" id="monsterResist" placeholder="monsterResist" style="height:20px;"></textarea>
            <textarea type="text" name="monsterVulnerable" id="monsterVulnerable" placeholder="monsterVulnerable" style="height:20px;"></textarea>
            <textarea type="text" name="monsterImmune" id="monsterImmune" placeholder="monsterImmune" style="height:20px;"></textarea>
            <textarea type="text" name="monsterConditionImmune" id="monsterConditionImmune" placeholder="monsterConditionImmune" style="height:20px;"></textarea>
            <textarea type="text" name="monsterSenses" id="monsterSenses" placeholder="monsterSenses" style="height:20px;"></textarea>
            <textarea type="text" name="monsterPassive" id="monsterPassive" placeholder="monsterPassive" style="height:20px;"></textarea>
            <textarea type="text" name="monsterLanguages" id="monsterLanguages" placeholder="monsterLanguages" style="height:20px;"></textarea>
            <textarea type="text" name="monsterCr" id="monsterCr" placeholder="monsterCr" style="height:20px;"></textarea>
            

            <!--<textarea type="text" name="monsterTrait1" id="monsterTrait1" placeholder="monsterTrait1" style="height:20px;"></textarea>-->
           <textarea type="text" name="monsterTrait2" id="monsterTrait2" placeholder="monsterTrait2" style="height:200px;"></textarea> 
            <textarea type="text" name="monsterTrait3" id="monsterTrait3" placeholder="monsterTrait3" style="height:200px;"></textarea> 
            <textarea type="text" name="monsterTrait4" id="monsterTrait4" placeholder="monsterTrait4" style="height:200px;"></textarea> 
            <textarea type="text" name="monsterTrait5" id="monsterTrait5" placeholder="monsterTrait5" style="height:200px;"></textarea> 
            <textarea type="text" name="monsterTrait6" id="monsterTrait6" placeholder="monsterTrait6" style="height:200px;"></textarea> 
            <textarea type="text" name="monsterTrait7" id="monsterTrait7" placeholder="monsterTrait7" style="height:200px;"></textarea> 
            <textarea type="text" name="monsterTrait8" id="monsterTrait8" placeholder="monsterTrait8" style="height:200px;"></textarea> 
            <textarea type="text" name="monsterAction1" id="monsterAction1" placeholder="monsterAction1" style="height:200px;"></textarea>
            <textarea type="text" name="monsterAction2" id="monsterAction2" placeholder="monsterAction2" style="height:200px;"></textarea> 
            <textarea type="text" name="monsterAction3" id="monsterAction3" placeholder="monsterAction3" style="height:200px;"></textarea> 
            <textarea type="text" name="monsterAction4" id="monsterAction4" placeholder="monsterAction4" style="height:200px;"></textarea> 
            <textarea type="text" name="monsterAction5" id="monsterAction5" placeholder="monsterAction5" style="height:200px;"></textarea> 
            <textarea type="text" name="monsterAction6" id="monsterAction6" placeholder="monsterAction6" style="height:200px;"></textarea> 
            <textarea type="text" name="monsterAction7" id="monsterAction7" placeholder="monsterAction7" style="height:200px;"></textarea> 
            <textarea type="text" name="monsterAction8" id="monsterAction8" placeholder="monsterAction8" style="height:200px;"></textarea>
            <textarea type="text" name="monsterLegendary1" id="monsterLegendary1" placeholder="monsterLegendary1" style="height:200px;"></textarea>
            <textarea type="text" name="monsterLegendary2" id="monsterLegendary2" placeholder="monsterLegendary2" style="height:200px;"></textarea> 
            <textarea type="text" name="monsterLegendary3" id="monsterLegendary3" placeholder="monsterLegendary3" style="height:200px;"></textarea> 
            <textarea type="text" name="monsterLegendary4" id="monsterLegendary4" placeholder="monsterLegendary4" style="height:200px;"></textarea> 
            <textarea type="text" name="monsterLegendary5" id="monsterLegendary5" placeholder="monsterLegendary5" style="height:200px;"></textarea> 
            <textarea type="text" name="monsterLegendary6" id="monsterLegendary6" placeholder="monsterLegendary6" style="height:200px;"></textarea> 
            <textarea type="text" name="monsterLegendary7" id="monsterLegendary7" placeholder="monsterLegendary7" style="height:200px;"></textarea> 
            <textarea type="text" name="monsterLegendary8" id="monsterLegendary8" placeholder="monsterLegendary8" style="height:200px;"></textarea>
            <textarea type="text" name="monsterReaction" id="monsterReaction" placeholder="monsterReaction" style="height:200px;"></textarea>
            

            <!--</div>-->


  <script>
  function monBlock(){
    var monsterBlock = $('#monsterBlock').val();
    monsterBlock = monsterBlock.trim();
    var monName = monsterBlock.substr(0, monsterBlock.indexOf('\n'));
    monsterBlock = monsterBlock.substr(monsterBlock.indexOf('\n')+1);
    var monsterSize = monsterBlock.substr(0, monsterBlock.indexOf(' '));
    monsterBlock = monsterBlock.substr(monsterBlock.indexOf(' ')+1);
    var monsterType = monsterBlock.substr(0, monsterBlock.indexOf(', '));
    monsterBlock = monsterBlock.substr(monsterBlock.indexOf(', ')+1);
    var monsterAlignment = monsterBlock.substr(0, monsterBlock.indexOf("\n"));
    monsterBlock = monsterBlock.substr(monsterBlock.indexOf("\n")+1);
    monsterBlock = monsterBlock.substr(monsterBlock.indexOf("Armor Class ")+12);
    var monsterAc = monsterBlock.substr(0, monsterBlock.indexOf("Hit Points "));
    monsterBlock = monsterBlock.substr(monsterBlock.indexOf("Hit Points ")+11);
    var monsterHp = monsterBlock.substr(0, monsterBlock.indexOf("Speed "));
    monsterBlock = monsterBlock.substr(monsterBlock.indexOf("Speed ")+6);
    var monsterSpeed = monsterBlock.substr(0, monsterBlock.indexOf("\n"));
    monsterBlock = monsterBlock.substr(monsterBlock.indexOf(monsterSpeed)+monsterSpeed.length);
    monsterBlock = monsterBlock.substr(monsterBlock.indexOf("STR\n")+4);
    var monsterStr = monsterBlock.substr(0, monsterBlock.indexOf(" ("));
    monsterBlock = monsterBlock.substr(monsterBlock.indexOf("DEX\n")+4);
    var monsterDex = monsterBlock.substr(0, monsterBlock.indexOf(" ("));
    monsterBlock = monsterBlock.substr(monsterBlock.indexOf("CON\n")+4);
    var monsterCon = monsterBlock.substr(0, monsterBlock.indexOf(" ("));
    monsterBlock = monsterBlock.substr(monsterBlock.indexOf("INT\n")+4);
    var monsterInt = monsterBlock.substr(0, monsterBlock.indexOf(" ("));
    monsterBlock = monsterBlock.substr(monsterBlock.indexOf("WIS\n")+4);
    var monsterWis = monsterBlock.substr(0, monsterBlock.indexOf(" ("));
    monsterBlock = monsterBlock.substr(monsterBlock.indexOf("CHA\n")+4);
    var monsterCha = monsterBlock.substr(0, monsterBlock.indexOf(" ("));
    monsterBlock = monsterBlock.substr(monsterBlock.indexOf(")\n")+2);
    var monsterSave='';
    if (monsterBlock.startsWith('Saving Throws') == true ){
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("Saving Throws ")+14);
      monsterSave = monsterBlock.substr(0, monsterBlock.indexOf("\n"));
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("\n")+1);
    }
    var monsterSkill='';
    if (monsterBlock.startsWith('Skills') == true ){
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("Skills ")+7);
      monsterSkill = monsterBlock.substr(0, monsterBlock.indexOf("\n"));
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("\n")+1);
    }
    var monsterVulnerable='';
    if (monsterBlock.startsWith('Damage Vulnerabilities') == true ){
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("Damage Vulnerabilities ")+23);
      monsterVulnerable = monsterBlock.substr(0, monsterBlock.indexOf("\n"));
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("\n")+1);
    }
    var monsterResist='';
    if (monsterBlock.startsWith('Damage Resistances') == true ){
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("Damage Resistances ")+19);
      monsterResist = monsterBlock.substr(0, monsterBlock.indexOf("\n"));
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("\n")+1);
    }
    var monsterImmune='';
    if (monsterBlock.startsWith('Damage Immunities') == true ){
      var immune = "Damage Immunities ";
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("Damage Immunities ")+18);
      monsterImmune = monsterBlock.substr(0, monsterBlock.indexOf("\n"));
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("\n")+1);
    }
    var monsterConditionImmune='';
    if (monsterBlock.startsWith('Condition Immunities') == true ){
      var conditionImmune = "Condition Immunities ";
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("Condition Immunities ")+21);
      monsterConditionImmune = monsterBlock.substr(0, monsterBlock.indexOf("\n"));
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("\n")+1);
    }

    monsterBlock = monsterBlock.substr(monsterBlock.indexOf("Senses ")+7);
    var monsterSenses = monsterBlock.substr(0, monsterBlock.indexOf(" Passive"));
    monsterBlock = monsterBlock.substr(monsterBlock.indexOf(monsterSenses)+monsterSenses.length);
    monsterBlock = monsterBlock.substr(monsterBlock.indexOf("Perception ")+11);
    var monsterPassive = monsterBlock.substr(0, monsterBlock.indexOf("\n"));
    monsterBlock = monsterBlock.substr(monsterBlock.indexOf("\n")+1);
    monsterBlock = monsterBlock.substr(monsterBlock.indexOf("Languages ")+10);
    var monsterLanguages = monsterBlock.substr(0, monsterBlock.indexOf("\n"));
    monsterBlock = monsterBlock.substr(monsterBlock.indexOf("\n")+1);
    monsterBlock = monsterBlock.substr(monsterBlock.indexOf("Challenge ")+10);
    var monsterCr = monsterBlock.substr(0, monsterBlock.indexOf(" ("));
    if (monsterCr == '1/2'){
      monsterCr = 0.5;
    }
    if (monsterCr == '1/4'){
      monsterCr = 0.25;
    }
    if (monsterCr == '1/8'){
      monsterCr = 0.125;
    }
    monsterBlock = monsterBlock.substr(monsterBlock.indexOf("\n")+1);
    var monsterTrait2 = '';
    if (monsterBlock.startsWith('Actions') == false ){
      monsterTrait2 = monsterBlock.substr(0, monsterBlock.indexOf("Actions"));
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("Actions\n"));
    }

    var monsterAction1 = '';
    if (monsterBlock.includes('Legendary Actions\n') == true){
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("Actions")+9);
      monsterAction1 = monsterBlock.substr(0, monsterBlock.indexOf("Legendary Actions"));
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("Legendary Actions"));
    }
    else if (monsterBlock.includes('Reactions\n') == true ){
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("Actions")+9);
      monsterAction1 = monsterBlock.substr(0, monsterBlock.indexOf("Reactions"));
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("Reactions"));
    }
    else {
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("Actions")+9);
      monsterAction1 = monsterBlock;
      monsterBlock = '';
    }
   /* var monsterAction2 = '';
    if (monsterBlock.startsWith('Legendary') == false ){
      monsterAction2 = monsterBlock.substr(0, monsterBlock.indexOf("\n\n"));
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("\n\n")+2);
    }
    var monsterAction3 = '';
    if (monsterBlock.startsWith('Legendary') == false ){
      monsterAction1 = monsterBlock.substr(0, monsterBlock.indexOf("\n\n"));
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("\n\n")+2);
    }
    var monsterAction3 = '';
    if (monsterBlock.startsWith('Legendary') == false ){
      monsterAction3 = monsterBlock.substr(0, monsterBlock.indexOf("\n\n"));
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("\n\n")+2);
    }
    var monsterAction4 = '';
    if (monsterBlock.startsWith('Legendary') == false ){
      monsterAction4 = monsterBlock.substr(0, monsterBlock.indexOf("\n\n"));
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("\n\n")+2);
    }
    var monsterAction5 = '';
    if (monsterBlock.startsWith('Legendary') == false ){
      monsterAction5 = monsterBlock.substr(0, monsterBlock.indexOf("\n\n"));
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("\n\n")+2);
    }
    var monsterAction6 = '';
    if (monsterBlock.startsWith('Legendary') == false ){
      monsterAction6 = monsterBlock.substr(0, monsterBlock.indexOf("\n\n"));
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("\n\n")+2);
    }
    var monsterAction7 = '';
    if (monsterBlock.startsWith('Legendary') == false ){
      monsterAction7 = monsterBlock.substr(0, monsterBlock.indexOf("\n\n"));
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("\n\n")+2);
    }
    var monsterAction8 = '';
    if (monsterBlock.startsWith('Legendary') == false ){
      monsterAction8 = monsterBlock.substr(0, monsterBlock.indexOf("\n\n"));
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("\n\n")+2);
    }*/

    //monsterBlock = monsterBlock.substr(monsterBlock.indexOf("its turn.")+11);

    var monsterLegendary1 = '';
    if (monsterBlock.includes('Legendary Actions\n') == true ){
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("Legendary Actions")+19);
      if (monsterBlock.includes('Reactions\n') == true ){
      monsterLegendary1 = monsterBlock.substr(0, monsterBlock.indexOf("Reactions"));
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("Reactions"));
      }
      else {
        monsterLegendary1 = monsterBlock;
      }
    }
    else {
      
    }
    /*var monsterLegendary2 = '';
    if (monsterBlock.startsWith('Reactions') == false ){
      monsterLegendary2 = monsterBlock.substr(0, monsterBlock.indexOf("\n\n"));
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("\n\n")+2);
    }
    var monsterLegendary3 = '';
    if (monsterBlock.startsWith('Reactions') == false ){
      monsterLegendary3 = monsterBlock.substr(0, monsterBlock.indexOf("\n\n"));
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("\n\n")+2);
    }
    var monsterLegendary4 = '';
    if (monsterBlock.startsWith('Reactions') == false ){
      monsterLegendary4 = monsterBlock.substr(0, monsterBlock.indexOf("\n\n"));
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("\n\n")+2);
    }
    var monsterLegendary5 = '';
    if (monsterBlock.startsWith('Reactions') == false ){
      monsterLegendary5 = monsterBlock.substr(0, monsterBlock.indexOf("\n\n"));
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("\n\n")+2);
    }
    var monsterLegendary6 = '';
    if (monsterBlock.startsWith('Reactions') == false ){
      monsterLegendary6 = monsterBlock.substr(0, monsterBlock.indexOf("\n\n"));
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("\n\n")+2);
    }
    var monsterLegendary7 = '';
    if (monsterBlock.startsWith('Reactions') == false ){
      monsterLegendary7 = monsterBlock.substr(0, monsterBlock.indexOf("\n\n"));
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("\n\n")+2);
    }
    var monsterLegendary8 = '';
    if (monsterBlock.startsWith('Reactions') == false ){
      monsterLegendary8 = monsterBlock.substr(0, monsterBlock.indexOf("\n\n"));
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("\n\n")+2);
    }
*/
    var monsterReaction = '';
    if (monsterBlock.includes('Reactions\n') == true ){
      monsterBlock = monsterBlock.substr(monsterBlock.indexOf("Reactions")+11);
      monsterReaction = monsterBlock;
    }
    else{
      monsterBlock = '';
      monsterReaction = '';
    }
    $('#monname').val(monName);
    $('#monsterSize-form').val(monsterSize);
    $('#monsterType').val(monsterType);
    $('#monsterAlignment').val(monsterAlignment);
    $('#monsterAc').val(monsterAc);
    $('#monsterHp').val(monsterHp);
    $('#monsterSpeed').val(monsterSpeed);
    $('#monsterStr').val(monsterStr);
    $('#monsterDex').val(monsterDex);
    $('#monsterCon').val(monsterCon);
    $('#monsterInt').val(monsterInt);
    $('#monsterWis').val(monsterWis);
    $('#monsterCha').val(monsterCha);
    $('#monsterSave').val(monsterSave);
    $('#monsterSkill').val(monsterSkill);
    $('#monsterVulnerable').val(monsterVulnerable);
    $('#monsterResist').val(monsterResist);
    $('#monsterImmune').val(monsterImmune);
    $('#monsterConditionImmune').val(monsterConditionImmune);
    $('#monsterSenses').val(monsterSenses);
    $('#monsterPassive').val(monsterPassive);
    $('#monsterLanguages').val(monsterLanguages);
    $('#monsterCr').val(monsterCr);
    $('#monsterTrait2').val(monsterTrait2);
    /*$('#monsterTrait3').val(monsterTrait3);
    $('#monsterTrait4').val(monsterTrait4);
    $('#monsterTrait5').val(monsterTrait5);
    $('#monsterTrait6').val(monsterTrait6);
    $('#monsterTrait7').val(monsterTrait7);
    $('#monsterTrait8').val(monsterTrait8);*/
    $('#monsterAction1').val(monsterAction1);
    /*$('#monsterAction2').val(monsterAction2);
    $('#monsterAction3').val(monsterAction3);
    $('#monsterAction4').val(monsterAction4);
    $('#monsterAction5').val(monsterAction5);
    $('#monsterAction6').val(monsterAction6);
    $('#monsterAction7').val(monsterAction7);
    $('#monsterAction8').val(monsterAction8);*/
    $('#monsterLegendary1').val(monsterLegendary1);
    /*$('#monsterLegendary2').val(monsterLegendary2);
    $('#monsterLegendary3').val(monsterLegendary3);
    $('#monsterLegendary4').val(monsterLegendary4);
    $('#monsterLegendary5').val(monsterLegendary5);
    $('#monsterLegendary6').val(monsterLegendary6);
    $('#monsterLegendary7').val(monsterLegendary7);
    $('#monsterLegendary8').val(monsterLegendary8);*/
    $('#monsterReaction').val(monsterReaction);
    $('#monsterChunk').val(monsterBlock);
    $('#checktest').val(checktest);
  };
  </script>
</div>
</div>
<div id="race-form" style="display:none;">
<select form="compendium" name="raceSize" id="raceSize-form">
              <option value="T">Tiny</option>
              <option value="S">Small</option>
              <option value="M" selected>Medium</option>
              <option value="L">Large</option>
              <option value="H">Huge</option>
              <option value="G">Gargantuan</option>
            </select>
<div class="text col-centered col-md-6"><textarea type="text" name="raceSpeed" id="raceSpeed" placeholder="raceSpeed" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="raceAbility" id="raceAbility" placeholder="raceAbility" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="raceSpellAbility" id="raceSpellAbility" placeholder="raceSpellAbility" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="raceProficiency" id="raceProficiency" placeholder="raceProficiency" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="raceTraits" id="raceTraits" placeholder="raceTraits" style="height:50px;"></textarea></div>
</div>
<div id="spell-form" style="display:none;">
<div class="text col-centered col-md-6"><textarea type="text" name="spellBlock" id="spellBlock" placeholder="spellBlock" style="height:50px;" onKeyUp="spellCalc()"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="spellLevel" id="spellLevel" placeholder="spellLevel" style="height:200px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="spellTime" id="spellTime" placeholder="spellTime" style="height:200px;"></textarea></div> 
<div class="text col-centered col-md-6"><textarea type="text" name="spellRange" id="spellRange" placeholder="spellRange" style="height:200px;"></textarea></div> 
<div class="text col-centered col-md-6"><textarea type="text" name="spellSchool" id="spellSchool" placeholder="spellSchool" style="height:200px;"></textarea></div> 
<div class="text col-centered col-md-6"><textarea type="text" name="spellRitual" id="spellRitual" placeholder="spellRitual" style="height:200px;"></textarea></div> 
<div class="text col-centered col-md-6"><textarea type="text" name="spellComponents" id="spellComponents" placeholder="spellComponents" style="height:200px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="spellDuration" id="spellDuration" placeholder="spellDuration" style="height:200px;"></textarea></div> 
<div class="text col-centered col-md-6"><textarea type="text" name="spellClasses" id="spellClasses" placeholder="spellClasses" style="height:200px;"></textarea></div> 
<div class="text col-centered col-md-6"><textarea type="text" name="spellText" id="spellText" placeholder="spellText" style="height:200px;"></textarea></div> 
</div>

<script>
    function spellCalc(){
    var spellBlock = $('#spellBlock').val();
    spellBlock = spellBlock.trim();
    var spellName = spellBlock.substr(0, spellBlock.indexOf('\n'));
    spellBlock = spellBlock.substr(spellBlock.indexOf('\n')+1);
    spellBlock = spellBlock.substr(spellBlock.indexOf('Level\n')+6);
    var spellLevel = spellBlock.charAt(0);
    if (spellLevel == 'C'){
      spellLevel = '0';
    }
    spellBlock = spellBlock.substr(spellBlock.indexOf('\n')+1);
    spellBlock = spellBlock.substr(spellBlock.indexOf('\n')+1);
    var spellTime = spellBlock.substr(0, spellBlock.indexOf('\n'));
    spellBlock = spellBlock.substr(spellBlock.indexOf('\n')+1);
    spellBlock = spellBlock.substr(spellBlock.indexOf('\n')+1);
    var spellRange = spellBlock.substr(0, spellBlock.indexOf('\n'));
    spellBlock = spellBlock.substr(spellBlock.indexOf('\n')+1);
    spellBlock = spellBlock.substr(spellBlock.indexOf('\n')+1);
    var spellComponents = spellBlock.substr(0, spellBlock.indexOf('\n'));
    spellBlock = spellBlock.substr(spellBlock.indexOf('\n')+1);
    spellBlock = spellBlock.substr(spellBlock.indexOf('\n')+1);
    var spellDuration = spellBlock.substr(0, spellBlock.indexOf('\n'));
    spellBlock = spellBlock.substr(spellBlock.indexOf('\n')+1);
    spellBlock = spellBlock.substr(spellBlock.indexOf('\n')+1);
    var spellSchool = spellBlock.substr(0, spellBlock.indexOf('\n'));
    spellSchool = spellSchool.charAt(0);
    spellBlock = spellBlock.substr(spellBlock.indexOf('\n')+1);
    spellBlock = spellBlock.substr(spellBlock.indexOf('\n')+1);
    spellBlock = spellBlock.substr(spellBlock.indexOf('\n')+1);
    spellBlock = spellBlock.substr(spellBlock.indexOf('\n')+1);
    spellBlock = spellBlock.substr(spellBlock.indexOf('\n')+1);
    var spellText = spellBlock.substr(0, spellBlock.indexOf('Available For:'));
    spellBlock = spellBlock.substr(spellBlock.indexOf('Available For: ')+15);
    var spellClasses = spellBlock;
    

      $('#monname').val(spellName);
      $('#spellLevel').val(spellLevel);
      $('#spellTime').val(spellTime);
      $('#spellRange').val(spellRange);
      $('#spellComponents').val(spellComponents);
      $('#spellDuration').val(spellDuration);
      $('#spellSchool').val(spellSchool);
      $('#spellText').val(spellText);
      $('#spellClasses').val(spellClasses);
      $('#spellRitual').val('0');

      
    };
  </script>

<div id="subclass-form" style="display:none;">
Class
<select form="compendium" name="subclassClass" id="subclassClass-form">
              <option value="" selected>None...</option>
              <?php
              $locationdrop = "SELECT DISTINCT class FROM `subclasses`";
              $locationdata = mysqli_query($dbcon, $locationdrop) or die('error getting data');
              while($locationrow =  mysqli_fetch_array($locationdata, MYSQLI_ASSOC)) {
                $location = $locationrow['class'];
                echo "<option value=\"$location\">$location</option>";
              }
              ?>
            </select>

<div class="text col-centered col-md-6"><textarea type="text" name="subclassSource" id="subclassSource" placeholder="subclassSource" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill1name" id="lvlskill1name" placeholder="lvlskill1name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill1text" id="lvlskill1text" placeholder="lvlskill1text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill2name" id="lvlskill2name" placeholder="lvlskill2name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill2text" id="lvlskill2text" placeholder="lvlskill2text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill3name" id="lvlskill3name" placeholder="lvlskill3name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill3text" id="lvlskill3text" placeholder="lvlskill3text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill4name" id="lvlskill4name" placeholder="lvlskill4name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill4text" id="lvlskill4text" placeholder="lvlskill4text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill5name" id="lvlskill5name" placeholder="lvlskill5name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill5text" id="lvlskill5text" placeholder="lvlskill5text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill6name" id="lvlskill6name" placeholder="lvlskill6name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill6text" id="lvlskill6text" placeholder="lvlskill6text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill7name" id="lvlskill7name" placeholder="lvlskill7name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill7text" id="lvlskill7text" placeholder="lvlskill7text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill8name" id="lvlskill8name" placeholder="lvlskill8name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill8text" id="lvlskill8text" placeholder="lvlskill8text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill9name" id="lvlskill9name" placeholder="lvlskill9name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill9text" id="lvlskill9text" placeholder="lvlskill9text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill10name" id="lvlskill10name" placeholder="lvlskill10name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill10text" id="lvlskill10text" placeholder="lvlskill10text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill11name" id="lvlskill11name" placeholder="lvlskill11name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill11text" id="lvlskill11text" placeholder="lvlskill11text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill12name" id="lvlskill12name" placeholder="lvlskill12name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill12text" id="lvlskill12text" placeholder="lvlskill12text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill13name" id="lvlskill13name" placeholder="lvlskill13name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill13text" id="lvlskill13text" placeholder="lvlskill13text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill14name" id="lvlskill14name" placeholder="lvlskill14name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill14text" id="lvlskill14text" placeholder="lvlskill14text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill15name" id="lvlskill15name" placeholder="lvlskill15name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill15text" id="lvlskill15text" placeholder="lvlskill15text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill16name" id="lvlskill16name" placeholder="lvlskill16name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill16text" id="lvlskill16text" placeholder="lvlskill16text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill17name" id="lvlskill17name" placeholder="lvlskill17name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill17text" id="lvlskill17text" placeholder="lvlskill17text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill18name" id="lvlskill18name" placeholder="lvlskill18name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill18text" id="lvlskill18text" placeholder="lvlskill18text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill19name" id="lvlskill19name" placeholder="lvlskill19name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill19text" id="lvlskill19text" placeholder="lvlskill19text" style="height:50px;"></textarea></div>


</div>

<!--    <div class="text col-centered col-md-12"><textarea type="text" name="body" id="body" placeholder="Type the body of your content here..."></textarea></div> -->
   

<div class="col-centered">
<input form="compendium" class="btn btn-primary col-centered" type="submit" value="Submit">
</div>
</form>

</div>
</div>
<!-- Footer -->
<?php
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath);
 ?>