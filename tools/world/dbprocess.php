
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath); ?>

<!-- Header -->
<?php
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.php";
include_once($headpath);

// Create variables
$nametemp=$_POST['name'];
$typetemp=$_POST['type'];
$raceSizetemp=$_POST['raceSize'];
$raceSpeedtemp=$_POST['raceSpeed'];
$raceAbilitytemp=$_POST['raceAbility'];
$raceSpellAbilitytemp=$_POST['raceSpellAbility'];
$raceProficiencytemp=$_POST['raceProficiency'];
$raceTraitstemp=$_POST['raceTraits'];
$itemTexttemp=$_POST['itemText'];
$itemTypetemp=$_POST['itemType'];
$itemStocktemp=$_POST['itemStock'];
$itemDetailtemp=$_POST['itemDetail'];
$itemValuetemp=$_POST['itemValue'];
$itemMagictemp=$_POST['itemMagic'];
$backgroundProficiencytemp=$_POST['backgroundProficiency'];
$backgroundTraitstemp=$_POST['backgroundTraits'];
$subclassSourcetemp=$_POST['subclassSource'];
$subclassClasstemp=$_POST['subclassClass'];
$lvlskill1nametemp=$_POST['lvlskill1name'];
$lvlskill1texttemp=$_POST['lvlskill1text'];
$lvlskill2nametemp=$_POST['lvlskill2name'];
$lvlskill2texttemp=$_POST['lvlskill2text'];
$lvlskill3nametemp=$_POST['lvlskill3name'];
$lvlskill3texttemp=$_POST['lvlskill3text'];
$lvlskill4nametemp=$_POST['lvlskill4name'];
$lvlskill4texttemp=$_POST['lvlskill4text'];
$lvlskill5nametemp=$_POST['lvlskill5name'];
$lvlskill5texttemp=$_POST['lvlskill5text'];
$lvlskill6nametemp=$_POST['lvlskill6name'];
$lvlskill6texttemp=$_POST['lvlskill6text'];
$lvlskill7nametemp=$_POST['lvlskill7name'];
$lvlskill7texttemp=$_POST['lvlskill7text'];
$lvlskill8nametemp=$_POST['lvlskill8name'];
$lvlskill8texttemp=$_POST['lvlskill8text'];
$lvlskill9nametemp=$_POST['lvlskill9name'];
$lvlskill9texttemp=$_POST['lvlskill9text'];
$lvlskill10nametemp=$_POST['lvlskill10name'];
$lvlskill10texttemp=$_POST['lvlskill10text'];
$lvlskill11nametemp=$_POST['lvlskill11name'];
$lvlskill11texttemp=$_POST['lvlskill11text'];
$lvlskill12nametemp=$_POST['lvlskill12name'];
$lvlskill12texttemp=$_POST['lvlskill12text'];
$lvlskill13nametemp=$_POST['lvlskill13name'];
$lvlskill13texttemp=$_POST['lvlskill13text'];
$lvlskill14nametemp=$_POST['lvlskill14name'];
$lvlskill14texttemp=$_POST['lvlskill14text'];
$lvlskill15nametemp=$_POST['lvlskill15name'];
$lvlskill15texttemp=$_POST['lvlskill15text'];
$lvlskill16nametemp=$_POST['lvlskill16name'];
$lvlskill16texttemp=$_POST['lvlskill16text'];
$lvlskill17nametemp=$_POST['lvlskill17name'];
$lvlskill17texttemp=$_POST['lvlskill17text'];
$lvlskill18nametemp=$_POST['lvlskill18name'];
$lvlskill18texttemp=$_POST['lvlskill18text'];
$lvlskill19nametemp=$_POST['lvlskill19name'];
$lvlskill19texttemp=$_POST['lvlskill19text'];
$monsterSizetemp=$_POST['monsterSize'];
$monsterTypetemp=$_POST['monsterType'];
$monsterAlignmenttemp=$_POST['monsterAlignment'];
$monsterActemp=$_POST['monsterAc'];
$monsterHptemp=$_POST['monsterHp'];
$monsterSpeedtemp=$_POST['monsterSpeed'];
$monsterStrtemp=$_POST['monsterStr'];
$monsterDextemp=$_POST['monsterDex'];
$monsterContemp=$_POST['monsterCon'];
$monsterInttemp=$_POST['monsterInt'];
$monsterWistemp=$_POST['monsterWis'];
$monsterChatemp=$_POST['monsterCha'];
$monsterSavetemp=$_POST['monsterSave'];
$monsterSkilltemp=$_POST['monsterSkill'];
$monsterResisttemp=$_POST['monsterResist'];
$monsterVulnerabletemp=$_POST['monsterVulnerable'];
$monsterImmunetemp=$_POST['monsterImmune'];
$monsterConditionImmunetemp=$_POST['monsterConditionImmune'];
$monsterSensestemp=$_POST['monsterSenses'];
$monsterPassivetemp=$_POST['monsterPassive'];
$monsterLanguagestemp=$_POST['monsterLanguages'];
$monsterCrtemp=$_POST['monsterCr'];
$monsterTrait1temp=$_POST['monsterTrait1'];
$monsterTrait2temp=$_POST['monsterTrait2'];
$monsterTrait3temp=$_POST['monsterTrait3'];
$monsterTrait4temp=$_POST['monsterTrait4'];
$monsterTrait5temp=$_POST['monsterTrait5'];
$monsterTrait6temp=$_POST['monsterTrait6'];
$monsterTrait7temp=$_POST['monsterTrait7'];
$monsterTrait8temp=$_POST['monsterTrait8'];
$monsterAction1temp=$_POST['monsterAction1'];
$monsterAction2temp=$_POST['monsterAction2'];
$monsterAction3temp=$_POST['monsterAction3'];
$monsterAction4temp=$_POST['monsterAction4'];
$monsterAction5temp=$_POST['monsterAction5'];
$monsterAction6temp=$_POST['monsterAction6'];
$monsterAction7temp=$_POST['monsterAction7'];
$monsterAction8temp=$_POST['monsterAction8'];
$monsterLegendary1temp=$_POST['monsterLegendary1'];
$monsterLegendary2temp=$_POST['monsterLegendary2'];
$monsterLegendary3temp=$_POST['monsterLegendary3'];
$monsterLegendary4temp=$_POST['monsterLegendary4'];
$monsterLegendary5temp=$_POST['monsterLegendary5'];
$monsterLegendary6temp=$_POST['monsterLegendary6'];
$monsterLegendary7temp=$_POST['monsterLegendary7'];
$monsterLegendary8temp=$_POST['monsterLegendary8'];
$monsterLegendary8temp=$_POST['monsterLegendary8'];
$monsterReactiontemp=$_POST['monsterReaction'];
$spellLeveltemp=$_POST['spellLevel'];
$spellTimetemp=$_POST['spellTime'];
$spellRangetemp=$_POST['spellRange'];
$spellComponentstemp=$_POST['spellComponents'];
$spellDurationtemp=$_POST['spellDuration'];
$spellSchooltemp=$_POST['spellSchool'];
$spellTexttemp=$_POST['spellText'];
$spellClassestemp=$_POST['spellClasses'];
$spellRitualtemp=$_POST['spellRitual'];
$featTexttemp=$_POST['featText'];




$name=htmlentities(trim(addslashes($nametemp)));
$type=htmlentities(trim(addslashes($typetemp)));
$raceSize=htmlentities(trim(addslashes($raceSizetemp)));
$raceSpeed=htmlentities(trim(addslashes($raceSpeedtemp)));
$raceAbility=htmlentities(trim(addslashes($raceAbilitytemp)));
$raceSpellAbility=htmlentities(trim(addslashes($raceSpellAbilitytemp)));
$raceProficiency=htmlentities(trim(addslashes($raceProficiencytemp)));
$raceTraits=htmlentities(trim(addslashes($raceTraitstemp)));
$itemText=htmlentities(trim(addslashes($itemTexttemp)));
$itemType=htmlentities(trim(addslashes($itemTypetemp)));
$itemStock=htmlentities(trim(addslashes($itemStocktemp)));
$itemDetail=htmlentities(trim(addslashes($itemDetailtemp)));
$itemValue=htmlentities(trim(addslashes($itemValuetemp)));
$itemMagic=htmlentities(trim(addslashes($itemMagictemp)));
$backgroundProficiency=htmlentities(trim(addslashes($backgroundProficiencytemp)));
$backgroundTraits=htmlentities(trim(addslashes($backgroundTraitstemp)));
$subclassClass=htmlentities(trim(addslashes($subclassClasstemp)));
$subclassSource=htmlentities(trim(addslashes($subclassSourcetemp)));
$lvlskill1name=htmlentities(trim(addslashes($lvlskill1nametemp)));
$lvlskill1text=htmlentities(trim(addslashes($lvlskill1texttemp)));
$lvlskill2name=htmlentities(trim(addslashes($lvlskill2nametemp)));
$lvlskill2text=htmlentities(trim(addslashes($lvlskill2texttemp)));
$lvlskill3name=htmlentities(trim(addslashes($lvlskill3nametemp)));
$lvlskill3text=htmlentities(trim(addslashes($lvlskill3texttemp)));
$lvlskill4name=htmlentities(trim(addslashes($lvlskill4nametemp)));
$lvlskill4text=htmlentities(trim(addslashes($lvlskill4texttemp)));
$lvlskill5name=htmlentities(trim(addslashes($lvlskill5nametemp)));
$lvlskill5text=htmlentities(trim(addslashes($lvlskill5texttemp)));
$lvlskill6name=htmlentities(trim(addslashes($lvlskill6nametemp)));
$lvlskill6text=htmlentities(trim(addslashes($lvlskill6texttemp)));
$lvlskill7name=htmlentities(trim(addslashes($lvlskill7nametemp)));
$lvlskill7text=htmlentities(trim(addslashes($lvlskill7texttemp)));
$lvlskill8name=htmlentities(trim(addslashes($lvlskill8nametemp)));
$lvlskill8text=htmlentities(trim(addslashes($lvlskill8texttemp)));
$lvlskill9name=htmlentities(trim(addslashes($lvlskill9nametemp)));
$lvlskill9text=htmlentities(trim(addslashes($lvlskill9texttemp)));
$lvlskill10name=htmlentities(trim(addslashes($lvlskill10nametemp)));
$lvlskill10text=htmlentities(trim(addslashes($lvlskill10texttemp)));
$lvlskill11name=htmlentities(trim(addslashes($lvlskill11nametemp)));
$lvlskill11text=htmlentities(trim(addslashes($lvlskill11texttemp)));
$lvlskill12name=htmlentities(trim(addslashes($lvlskill12nametemp)));
$lvlskill12text=htmlentities(trim(addslashes($lvlskill12texttemp)));
$lvlskill13name=htmlentities(trim(addslashes($lvlskill13nametemp)));
$lvlskill13text=htmlentities(trim(addslashes($lvlskill13texttemp)));
$lvlskill14name=htmlentities(trim(addslashes($lvlskill14nametemp)));
$lvlskill14text=htmlentities(trim(addslashes($lvlskill14texttemp)));
$lvlskill15name=htmlentities(trim(addslashes($lvlskill15nametemp)));
$lvlskill15text=htmlentities(trim(addslashes($lvlskill15texttemp)));
$lvlskill16name=htmlentities(trim(addslashes($lvlskill16nametemp)));
$lvlskill16text=htmlentities(trim(addslashes($lvlskill16texttemp)));
$lvlskill17name=htmlentities(trim(addslashes($lvlskill17nametemp)));
$lvlskill17text=htmlentities(trim(addslashes($lvlskill17texttemp)));
$lvlskill18name=htmlentities(trim(addslashes($lvlskill18nametemp)));
$lvlskill18text=htmlentities(trim(addslashes($lvlskill18texttemp)));
$lvlskill19name=htmlentities(trim(addslashes($lvlskill19nametemp)));
$lvlskill19text=htmlentities(trim(addslashes($lvlskill19texttemp)));
$monsterSize=htmlentities(trim(addslashes($monsterSizetemp)));
$monsterType=htmlentities(trim(addslashes($monsterTypetemp)));
$monsterAlignment=htmlentities(trim(addslashes($monsterAlignmenttemp)));
$monsterAc=htmlentities(trim(addslashes($monsterActemp)));
$monsterHp=htmlentities(trim(addslashes($monsterHptemp)));
$monsterSpeed=htmlentities(trim(addslashes($monsterSpeedtemp)));
$monsterStr=htmlentities(trim(addslashes($monsterStrtemp)));
$monsterDex=htmlentities(trim(addslashes($monsterDextemp)));
$monsterCon=htmlentities(trim(addslashes($monsterContemp)));
$monsterInt=htmlentities(trim(addslashes($monsterInttemp)));
$monsterWis=htmlentities(trim(addslashes($monsterWistemp)));
$monsterCha=htmlentities(trim(addslashes($monsterChatemp)));
$monsterSave=htmlentities(trim(addslashes($monsterSavetemp)));
$monsterSkill=htmlentities(trim(addslashes($monsterSkilltemp)));
$monsterResist=htmlentities(trim(addslashes($monsterResisttemp)));
$monsterVulnerable=htmlentities(trim(addslashes($monsterVulnerabletemp)));
$monsterImmune=htmlentities(trim(addslashes($monsterImmunetemp)));
$monsterConditionImmune=htmlentities(trim(addslashes($monsterConditionImmunetemp)));
$monsterSenses=htmlentities(trim(addslashes($monsterSensestemp)));
$monsterPassive=htmlentities(trim(addslashes($monsterPassivetemp)));
$monsterLanguages=htmlentities(trim(addslashes($monsterLanguagestemp)));
$monsterCr=htmlentities(trim(addslashes($monsterCrtemp)));
$monsterTrait1=htmlentities(trim(addslashes($monsterTrait1temp)));
$monsterTrait2=htmlentities(trim(addslashes($monsterTrait2temp)));
$monsterTrait3=htmlentities(trim(addslashes($monsterTrait3temp)));
$monsterTrait4=htmlentities(trim(addslashes($monsterTrait4temp)));
$monsterTrait5=htmlentities(trim(addslashes($monsterTrait5temp)));
$monsterTrait6=htmlentities(trim(addslashes($monsterTrait6temp)));
$monsterTrait7=htmlentities(trim(addslashes($monsterTrait7temp)));
$monsterTrait8=htmlentities(trim(addslashes($monsterTrait8temp)));
$monsterAction1=htmlentities(trim(addslashes($monsterAction1temp)));
$monsterAction2=htmlentities(trim(addslashes($monsterAction2temp)));
$monsterAction3=htmlentities(trim(addslashes($monsterAction3temp)));
$monsterAction4=htmlentities(trim(addslashes($monsterAction4temp)));
$monsterAction5=htmlentities(trim(addslashes($monsterAction5temp)));
$monsterAction6=htmlentities(trim(addslashes($monsterAction6temp)));
$monsterAction7=htmlentities(trim(addslashes($monsterAction7temp)));
$monsterAction8=htmlentities(trim(addslashes($monsterAction8temp)));
$monsterLegendary1=htmlentities(trim(addslashes($monsterLegendary1temp)));
$monsterLegendary2=htmlentities(trim(addslashes($monsterLegendary2temp)));
$monsterLegendary3=htmlentities(trim(addslashes($monsterLegendary3temp)));
$monsterLegendary4=htmlentities(trim(addslashes($monsterLegendary4temp)));
$monsterLegendary5=htmlentities(trim(addslashes($monsterLegendary5temp)));
$monsterLegendary6=htmlentities(trim(addslashes($monsterLegendary6temp)));
$monsterLegendary7=htmlentities(trim(addslashes($monsterLegendary7temp)));
$monsterLegendary8=htmlentities(trim(addslashes($monsterLegendary8temp)));
$monsterReaction=htmlentities(trim(addslashes($monsterReactiontemp)));
$spellLevel=htmlentities(trim(addslashes($spellLeveltemp)));
$spellTime=htmlentities(trim(addslashes($spellTimetemp)));
$spellRange=htmlentities(trim(addslashes($spellRangetemp)));
$spellComponents=htmlentities(trim(addslashes($spellComponentstemp)));
$spellDuration=htmlentities(trim(addslashes($spellDurationtemp)));
$spellSchool=htmlentities(trim(addslashes($spellSchooltemp)));
$spellText=htmlentities(trim(addslashes($spellTexttemp)));
$spellClasses=htmlentities(trim(addslashes($spellClassestemp)));
$spellRitual=htmlentities(trim(addslashes($spellRitualtemp)));
$featText=htmlentities(trim(addslashes($featTexttemp)));
$text = $spellText.$itemText.$featText;

if ($monsterStr == '') {
  $monsterStr = 0;
}
if ($monsterDex == '') {
  $monsterDex = 0;
}
if ($monsterCon == '') {
  $monsterCon = 0;
}
if ($monsterInt == '') {
  $monsterInt = 0;
}
if ($monsterWis == '') {
  $monsterWis = 0;
}
if ($monsterCha == '') {
  $monsterCha = 0;
}
if ($monsterCr == '') {
  $monsterCr = 0;
}

if ($lvlskill1name != ''){
  $sql = "INSERT INTO subclasses(name,class,source,lvlskill1name,lvlskill1text,lvlskill2name,lvlskill2text,lvlskill3name,lvlskill3text,lvlskill4name,lvlskill4text,lvlskill5name,lvlskill5text,lvlskill6name,lvlskill6text,lvlskill7name,lvlskill7text,lvlskill8name,lvlskill8text,lvlskill9name,lvlskill9text,lvlskill10name,lvlskill10text,lvlskill11name,lvlskill11text,lvlskill12name,lvlskill12text,lvlskill13name,lvlskill13text,lvlskill14name,lvlskill14text,lvlskill15name,lvlskill15text,lvlskill16name,lvlskill16text,lvlskill17name,lvlskill17text,lvlskill18name,lvlskill18text,lvlskill19name,lvlskill19text)
          VALUES('$name','$subclassClass','$subclassSource','$lvlskill1name','$lvlskill1text','$lvlskill2name','$lvlskill2text','$lvlskill3name','$lvlskill3text','$lvlskill4name','$lvlskill4text','$lvlskill5name','$lvlskill5text','$lvlskill6name','$lvlskill6text','$lvlskill7name','$lvlskill7text','$lvlskill8name','$lvlskill8text','$lvlskill9name','$lvlskill9text','$lvlskill10name','$lvlskill10text','$lvlskill11name','$lvlskill11text','$lvlskill12name','$lvlskill12text','$lvlskill13name','$lvlskill13text','$lvlskill14name','$lvlskill14text','$lvlskill15name','$lvlskill15text','$lvlskill16name','$lvlskill16text','$lvlskill17name','$lvlskill17text','$lvlskill18name','$lvlskill18text','$lvlskill19name','$lvlskill19text')";
}
else {
//Execute the query
$sql = "INSERT INTO compendium(title,type,raceSize,raceSpeed,raceAbility,raceSpellAbility,raceProficiency,raceTraits,text,itemType,itemStock,itemDetail,itemValue,itemMagic,backgroundProficiency,backgroundTraits,monsterSize,monsterType,monsterAlignment,monsterAc,monsterHp,monsterSpeed,monsterStr,monsterDex,monsterCon,monsterInt,monsterWis,monsterCha,monsterSave,monsterSkill,monsterResist,monsterVulnerable,monsterImmune,monsterConditionImmune,monsterSenses,monsterPassive,monsterLanguages,monsterCr,monsterTrait1,monsterTrait2,monsterTrait3,monsterTrait4,monsterTrait5,monsterTrait6,monsterTrait7,monsterTrait8,monsterAction1,monsterAction2,monsterAction3,monsterAction4,monsterAction5,monsterAction6,monsterAction7,monsterAction8,monsterLegendary1,monsterLegendary2,monsterLegendary3,monsterLegendary4,monsterLegendary5,monsterLegendary6,monsterLegendary7,monsterLegendary8,monsterReaction,spellLevel,spellTime,spellRange,spellComponents,spellDuration,spellSchool,spellClasses,spellRitual)
				VALUES('$name','$type','$raceSize','$raceSpeed','$raceAbility','$raceSpellAbility','$raceProficiency','$raceTraits','$text','$itemType','$itemStock','$itemDetail','$itemValue','$itemMagic','$backgroundProficiency','$backgroundTraits','$monsterSize','$monsterType','$monsterAlignment','$monsterAc','$monsterHp','$monsterSpeed','$monsterStr','$monsterDex','$monsterCon','$monsterInt','$monsterWis','$monsterCha','$monsterSave','$monsterSkill','$monsterResist','$monsterVulnerable','$monsterImmune','$monsterConditionImmune','$monsterSenses','$monsterPassive','$monsterLanguages','$monsterCr','$monsterTrait1','$monsterTrait2','$monsterTrait3','$monsterTrait4','$monsterTrait5','$monsterTrait6','$monsterTrait7','$monsterTrait8','$monsterAction1','$monsterAction2','$monsterAction3','$monsterAction4','$monsterAction5','$monsterAction6','$monsterAction7','$monsterAction8','$monsterLegendary1','$monsterLegendary2','$monsterLegendary3','$monsterLegendary4','$monsterLegendary5','$monsterLegendary6','$monsterLegendary7','$monsterLegendary8','$monsterReaction','$spellLevel','$spellTime','$spellRange','$spellComponents','$spellDuration','$spellSchool','$spellClasses','$spellRitual')";
  }
  /*$sql = "INSERT INTO compendium(title,type,raceSize,raceSpeed,raceAbility,raceSpellAbility,raceProficiency,raceTraits,text,itemType,itemStock,itemDetail,itemValue,itemMagic,backgroundProficiency,backgroundTraits,monsterSize,monsterType,monsterAlignment)
  VALUES('$name','$type','$raceSize','$raceSpeed','$raceAbility','$raceSpellAbility','$raceProficiency','$raceTraits','$itemText','$itemType','$itemStock','$itemDetail','$itemValue','$itemMagic','$backgroundProficiency','$backgroundTraits','$monsterSize','$monsterType','$monsterAlignment')";
}*/
        if ($dbcon->query($sql) === TRUE) {
					include('dbsuccess.php');
					include('dbimport.php');
        }
				else {
            echo "Error: " . $sql . "<br>" . $dbcon->error;
        }

    
//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>

