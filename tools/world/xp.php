<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);
   $id = $_GET['id'];
   $pgtitle = 'Award XP - ';

?>
   <div class="mainbox col-md-12">

     <!-- Page Header -->
     <div class="col-md-12">
     <div class="pagetitle" id="pgtitle">Award XP
   </div>
   </div>
     <div class="body bodytext col-xs-12" id="body">
       <!-- Body Text -->

       <div class="col-centered">
         <div class="row">
         <form method="post" action="xpprocess.php" id="xp">
           <div class="col-md-6" style="padding-bottom:20px;"><input class="searchbox" style="width:100%;" type="text" name="xp-award" id="xp-award" value="<?php echo $id ?>"></div>
           <div class="col-md-2" style="padding-bottom:20px;"><input class="searchbox" style="width:100%;" type="text" name="numplayers" id="numplayers" placeholder="# of players..."></div>

         </div>
         <div class="row">
           <?php
           $sqlcompendium = "SELECT * FROM world WHERE type LIKE 'player character' AND worlduser LIKE '$loguser' AND active=1";
           $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
           $playernum = 1;
           while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
             echo ('<div class="col-md-1 sidebartext" style="padding-bottom:20px;"><input type="checkbox" name="player'.$playernum.'" value="'.$row['title'].'">'.$row['title'].'</div>');
             $playernum++;
           }
           ?>
           <!-- <div class="col-md-1 sidebartext" style="padding-bottom:20px;"><input type="checkbox" name="frukas" value="1">Frukas</div>
           <div class="col-md-1 sidebartext" style="padding-bottom:20px;"><input type="checkbox" name="garfire" value="1">Garfire</div>
           <div class="col-md-1 sidebartext" style="padding-bottom:20px;"><input type="checkbox" name="ac3" value="1">AC3</div>
           <div class="col-md-1 sidebartext" style="padding-bottom:20px;"><input type="checkbox" name="redferd" value="1">Redferd</div>
           <div class="col-md-1 sidebartext" style="padding-bottom:20px;"><input type="checkbox" name="sirknight" value="1">Sir Knight</div>-->
           <div class="col-md-1 sidebartext" style="padding-bottom:20px;"><input type="checkbox" name="all" value="1">All</div>
         </div>
         <div class="row">

           <div class="col-md-1"><input class="btn btn-primary" type="submit" value="Submit"></div></p>
       </form>
     </div>

     </div>

     <div class="sidebartext">
       <p style="margin-top:40px;">Current XP:</p>
       <table id="XP" class="table table-condensed table-striped table-responsive dt-responsive" cellspacing="0" width="100%">
               <thead class="thead-dark">
                   <tr>
                       <th scope="col">Name</th>
                       <th scope="col">Level</th>
                       <th scope="col">Current XP</th>

                   </tr>
               </thead>
               <tfoot>
                   <tr>
                     <th scope="col">Name</th>
                     <th scope="col">Level</th>
                     <th scope="col">Current XP</th>
                   </tr>
               </tfoot>
               <tbody>
                 <?php
                   $sqlcompendium = "SELECT * FROM world WHERE type LIKE 'player character' AND worlduser LIKE '$loguser'";
                   $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
                   while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
                   echo ('<tr><td>');
                   $entry = $row['title'];
                   echo "<a href=\"world.php?id=$entry\">";
                   echo $entry;
                   if ($row['active'] != '1'){
                     echo (' (inactive)');
                   }
                   echo "</a></td>";
                   echo ('<td>'.$row['pc_lvl'].'</td>');
                   echo ('<td>'.$row['pc_xp'].'</td>');
                   echo "</tr>";

                 }
                   ?>

    </tbody>
    </table>
     </div>

     <div class="sidebartext col-md-6">
       <p style="margin-top:40px;">XP Progression:</p>
       <table id="XP" class="table table-condensed table-striped table-responsive dt-responsive" cellspacing="0" width="100%">
               <thead class="thead-dark">
                   <tr>
                       <th scope="col">XP</th>
                       <th scope="col">Level</th>
                       <th scope="col">Proficiency</th>

                   </tr>
               </thead>
               <tfoot>
                   <tr>
                     <th scope="col">XP</th>
                     <th scope="col">Level</th>
                     <th scope="col">Proficiency</th>
                   </tr>
               </tfoot>
               <tbody>
                <tr>
                  <td>0</td>
                  <td>1</td>
                  <td>+2</td>
                </tr>
                <tr>
                  <td>300</td>
                  <td>2</td>
                  <td>+2</td>
                </tr>
                <tr>
                  <td>900</td>
                  <td>3</td>
                  <td>+2</td>
                </tr>
                <tr>
                  <td>2700</td>
                  <td>4</td>
                  <td>+2</td>
                </tr>
                <tr>
                  <td>6500</td>
                  <td>5</td>
                  <td>+3</td>
                </tr>
                <tr>
                  <td>14000</td>
                  <td>6</td>
                  <td>+3</td>
                </tr>
                <tr>
                  <td>23000</td>
                  <td>7</td>
                  <td>+3</td>
                </tr>
                <tr>
                  <td>34000</td>
                  <td>8</td>
                  <td>+3</td>
                </tr>
                <tr>
                  <td>48000</td>
                  <td>9</td>
                  <td>+4</td>
                </tr>
                <tr>
                  <td>64000</td>
                  <td>10</td>
                  <td>+4</td>
                </tr>
                <tr>
                  <td>85000</td>
                  <td>11</td>
                  <td>+4</td>
                </tr>
                <tr>
                  <td>100000</td>
                  <td>12</td>
                  <td>+4</td>
                </tr>
                <tr>
                  <td>120000</td>
                  <td>13</td>
                  <td>+5</td>
                </tr>
                <tr>
                  <td>140000</td>
                  <td>14</td>
                  <td>+5</td>
                </tr>
                <tr>
                  <td>165000</td>
                  <td>15</td>
                  <td>+5</td>
                </tr>
                <tr>
                  <td>195000</td>
                  <td>16</td>
                  <td>+5</td>
                </tr>
                <tr>
                  <td>225000</td>
                  <td>17</td>
                  <td>+6</td>
                </tr>
                <tr>
                  <td>265000</td>
                  <td>18</td>
                  <td>+6</td>
                </tr>
                <tr>
                  <td>305000</td>
                  <td>19</td>
                  <td>+6</td>
                </tr>
                <tr>
                  <td>355000</td>
                  <td>20</td>
                  <td>+6</td>
                </tr>
    </tbody>
    </table>
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
