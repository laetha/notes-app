<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$worldtitle = "SELECT * FROM world WHERE worlduser LIKE 'tarfuin' AND type LIKE 'npc' ORDER BY rand() LIMIT 1";
           $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
           while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
            $npcname = $row['title'];
            $npcrace = $row['npc_race'];
            $npcdistrict = $row['npc_location'];
            $npcfaction = $row['npc_faction'];
            $npcdeity = $row['npc_deity'];
            $npctitle = $row['npc_title'];
            $npcbody = $row['body'];
            $npcest = $row['npc_est'];
           }
           echo ('<p>'.$npcname.' is a '.$npcrace. ' '.$npctitle. ' who is described as '.$npcbody.'. They worship '.$npcdeity.' and live in '.$npcdistrict.'.');
           if (!empty($npcest)){
            echo (' They are located at <a href="/tools/world/world.php?id='.$npcest.'">'.$npcest.'</a>.');
           }
        