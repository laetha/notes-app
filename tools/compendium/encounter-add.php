
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$monster = $_REQUEST['monster'];

$sqlcompendium = "SELECT * FROM compendium WHERE type LIKE 'monster' AND title LIKE '$monster' OR title LIKE '$monster(monster)'";
$compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
  $cr = $row['monsterCr'];

  if($cr == 0){
    $monsterxp = 10;
  }
  if($cr == 0.125){
    $monsterxp = 25;
  }
  if($cr == 0.25){
    $monsterxp = 50;
  }
  if($cr == 0.5){
    $monsterxp = 100;
  }
  if($cr == 1){
    $monsterxp = 200;
  }
  if($cr == 2){
    $monsterxp = 450;
  }
  if($cr == 3){
    $monsterxp = 700;
  }
  if($cr == 4){
    $monsterxp = 1100;
  }
  if($cr == 5){
    $monsterxp = 1800;
  }
  if($cr == 6){
    $monsterxp = 4100;
  }
  if($cr == 7){
    $monsterxp = 2900;
  }
  if($cr == 8){
    $monsterxp = 3900;
  }
  if($cr == 9){
    $monsterxp = 5000;
  }
  if($cr == 10){
    $monsterxp = 5900;
  }
  if($cr == 11){
    $monsterxp = 7200;
  }
  if($cr == 12){
    $monsterxp = 8400;
  }
  if($cr == 13){
    $monsterxp = 10000;
  }
  if($cr == 14){
    $monsterxp = 11500;
  }
  if($cr == 15){
    $monsterxp = 13000;
  }
  if($cr == 16){
    $monsterxp = 15000;
  }
  if($cr == 17){
    $monsterxp = 18000;
  }
  if($cr == 18){
    $monsterxp = 20000;
  }
  if($cr == 19){
    $monsterxp = 22000;
  }
  if($cr == 20){
    $monsterxp = 25000;
  }
  if($cr == 21){
    $monsterxp = 33000;
  }
  if($cr == 22){
    $monsterxp = 41000;
  }
  if($cr == 23){
    $monsterxp = 50000;
  }
  if($cr == 24){
    $monsterxp = 62000;
  }
  if($cr == 25){
    $monsterxp = 75000;
  }
  if($cr == 26){
    $monsterxp = 90000;
  }
  if($cr == 27){
    $monsterxp = 105000;
  }
  if($cr == 28){
    $monsterxp = 120000;
  }
  if($cr == 29){
    $monsterxp = 135000;
  }
  if($cr == 30){
    $monsterxp = 155000;
  }
  echo (int)$monsterxp;
}

      /*  if ($dbcon->query($sqlcompendium) === TRUE) {
        }
				else {
        }*/

//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
