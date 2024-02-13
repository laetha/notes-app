
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath); ?>

<!-- Header -->


<!-- Map Gen -->

<?php
$coordx = 0.655793;

for ($x=0; $x < 27; $x++) { 
	# code...
	$coordy = -1.21875;


for ($i=0; $i < 33; $i++) { 
	$rand1 = rand(0,99);
	$type = '';
	$text1 = '';
	$text2 = '';
	$foundOverall = 0;
	$found2 = 0;
?>
 <?php
 $typeedit = "SELECT * FROM `encounters` ORDER BY num";
 $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
 while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
   if ($rand1 <= $row['num'] && $foundOverall == 0 && $row['type'] == 'overallpre') {
      $foundOverall = 1;
      $type = $row['text'];
      $rand2 = rand(0,99);
   }


}

 $typeedit = "SELECT * FROM `encounters` ORDER BY num";
 $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
 while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
   if ($type == 'lair' && $rand2 <= $row['num'] && $found2 == 0 && $row['type'] == 'lair') {
       $found2 = 1;
     $text1 = $row['text'];

     if ($rand2 >= 0 && $rand2 <= 64) {
       $rand3 = rand(0,99);
       $found3 = 0;
       $typeedit = "SELECT * FROM `encounters` ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand3 <= $row['num'] && $found3 == 0 && $row['type'] == 'commonlair') {
           $found3 = 1;
           $text2 = $row['text'];
         }

       }

     }

    else if ($rand2 >= 65 && $rand2 <= 94) {
       $rand3 = rand(0,99);
       $found3 = 0;
       $typeedit = "SELECT * FROM `encounters` ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand3 <= $row['num'] && $found3 == 0 && $row['type'] == 'uncommonlair') {
           $found3 = 1;
           $text2 = $row['text'];
         }

       }

     }

     else if ($rand2 >= 95 && $rand2 <= 99) {
       $rand3 = rand(0,99);
       $found3 = 0;
       $typeedit = "SELECT * FROM `encounters` ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand3 <= $row['num'] && $found3 == 0 && $row['type'] == 'legendarylair') {
           $found3 = 1;
           $text2 = $row['text'];
         }

       }

     }

   }

   if ($type == 'Remote Structure' && $rand2 <= $row['num'] && $found2 == 0 && $row['type'] == 'remotestructure') {
     $found2 = 1;
     $text1 = $row['text'];

     if ($rand2 >= 0 && $rand2 <= 9) {
       $rand3 = rand(0,99);
       $found3 = 0;
       $typeedit = "SELECT * FROM `encounters` ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand3 <= $row['num'] && $found3 == 0 && $row['type'] == 'singlehouse') {
           $found3 = 1;
           $text2 = $row['text'];
         }

       }

     }

     else if ($rand2 >= 50 && $rand2 <= 54) {
       $rand3 = rand(0,99);
       $found3 = 0;
       $typeedit = "SELECT * FROM `encounters` ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand3 <= $row['num'] && $found3 == 0 && $row['type'] == 'tower') {
           $found3 = 1;
           $text2 = $row['text'];
         }

       }

     }

     else if ($rand2 >= 63 && $rand2 <= 65) {
       $rand3 = rand(0,99);
       $found3 = 0;
       $typeedit = "SELECT * FROM `encounters` ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand3 <= $row['num'] && $found3 == 0 && $row['type'] == 'woodenpole') {
           $found3 = 1;
           $text2 = $row['text'];
         }

       }

     }

     else if ($rand2 >= 79 && $rand2 <= 82) {
       $rand3 = rand(0,99);
       $found3 = 0;
       $typeedit = "SELECT * FROM `encounters` ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand3 <= $row['num'] && $found3 == 0 && $row['type'] == 'workingmine') {
           $found3 = 1;
           $text2 = $row['text'];
         }

       }

     }

   }


   if ($type == 'Ruined Structure' && $rand2 <= $row['num'] && $found2 == 0 && $row['type'] == 'ruinedstructure') {
     $found2 = 1;
     $text1 = $row['text'];
   }

   if ($type == 'Natural Structure' && $rand2 <= $row['num'] && $found2 == 0 && $row['type'] == 'naturalstructure') {
     $found2 = 1;
     $text1 = $row['text'];
   }

   if ($type == 'Remarkable Event' && $rand2 <= $row['num'] && $found2 == 0 && $row['type'] == 'remarkableevent') {
     $found2 = 1;
     $text1 = $row['text'];

     if ($rand2 >= 15 && $rand2 <= 19) {
       $rand3 = rand(0,99);
       $found3 = 0;
       $typeedit = "SELECT * FROM `encounters` ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand3 <= $row['num'] && $found3 == 0 && $row['type'] == 'glowingpillar') {
           $found3 = 1;
           $text2 = $row['text'];
         }

       }

     }

     else if ($rand2 >= 20 && $rand2 <= 24) {
       $rand3 = rand(0,99);
       $found3 = 0;
       $typeedit = "SELECT * FROM `encounters` ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand3 <= $row['num'] && $found3 == 0 && $row['type'] == 'blacktree') {
           $found3 = 1;
           $text2 = $row['text'];
         }

       }

     }


   }
 }

$mapgen = $type.' :: '. $text1.' :: '.$text2;

if (preg_match('/\bSmall Ruins\b/', $mapgen)) {

	$rand4 = rand(1,100);
       $found4 = 0;
       $typeedit = "SELECT * FROM `encounters` WHERE type LIKE 'smallruins' ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand4 <= $row['num'] && $found4 == 0) {
			 $found4 = 1;
		   $mapgen = $mapgen.' '.$row['text'];
         }
	}
}

else if (preg_match('/\bLarge Ruins\b/', $mapgen)) {

	$rand5 = rand(1,100);
       $found5 = 0;
       $typeedit = "SELECT * FROM `encounters` WHERE type LIKE 'largeruins' ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand5 <= $row['num'] && $found5 == 0) {
			$found5 = 1;
           $mapgen = $mapgen.' '.$row['text'];
         }
	}
}

else if (preg_match('/\bSmall Castle\b/', $mapgen)) {

	$rand6 = rand(1,100);
       $found6 = 0;
       $typeedit = "SELECT * FROM `encounters` WHERE type LIKE 'smallcastle' ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand6 <= $row['num'] && $found6 == 0) {
			$found6 = 1;
           $mapgen = $mapgen.' '.$row['text'];
         }
	}
}

else if (preg_match('/\bLarge Castle\b/', $mapgen)) {

	$rand7 = rand(1,100);
       $found7 = 0;
       $typeedit = "SELECT * FROM `encounters` WHERE type LIKE 'largecastle' ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand7 <= $row['num'] && $found7 == 0) {
			$found7 = 1;
           $mapgen = $mapgen.' '.$row['text'];
         }
	}
}

else if (preg_match('/\bDressing\b/', $mapgen)) {

	$rand8 = rand(1,100);
       $found9 = 0;
       $typeedit = "SELECT * FROM `encounters` WHERE type LIKE 'plainsdressing' ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand8 <= $row['num'] && $found9 == 0) {
			$found9= 1;
           $mapgen = '<b>Plains:</b> '.$row['text'];
         }
  }
  
  $found10 = 0;
       $typeedit = "SELECT * FROM `encounters` WHERE type LIKE 'mountainsdressing' ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand8 <= $row['num'] && $found10 == 0) {
			$found10 = 1;
           $mapgen = $mapgen.'<p><b>Mountains:</b> '.$row['text'];
         }
  }


  $found11 = 0;
       $typeedit = "SELECT * FROM `encounters` WHERE type LIKE 'desertdressing' ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand8 <= $row['num'] && $found11 == 0) {
			$found11 = 1;
           $mapgen = $mapgen.'<p><b>Desert:</b> '.$row['text'];
         }
  }

  $found12 = 0;
       $typeedit = "SELECT * FROM `encounters` WHERE type LIKE 'swampdressing' ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand8 <= $row['num'] && $found12 == 0) {
			$found12 = 1;
           $mapgen = $mapgen.'<p><b>Swamp:</b> '.$row['text'];
         }
  }

  $found13 = 0;
       $typeedit = "SELECT * FROM `encounters` WHERE type LIKE 'forestdressing' ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand8 <= $row['num'] && $found13 == 0) {
			$found13 = 1;
           $mapgen = $mapgen.'<p><b>Forest:</b> '.$row['text'];
         }
  }

  $found14 = 0;
       $typeedit = "SELECT * FROM `encounters` WHERE type LIKE 'coastdressing' ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand8 <= $row['num'] && $found14 == 0) {
			$found14 = 1;
           $mapgen = $mapgen.'<p><b>Coast:</b> '.$row['text'];
         }
  }

  $found15 = 0;
       $typeedit = "SELECT * FROM `encounters` WHERE type LIKE 'hillsdressing' ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand8 <= $row['num'] && $found15 == 0) {
			$found15 = 1;
           $mapgen = $mapgen.'<p><b>Hills:</b> '.$row['text'];
         }
  }

}

$active = 1;

$entry=htmlentities(trim(addslashes($mapgen)));
$coord= $coordy.', '.$coordx;
//$map=htmlentities(trim(addslashes($maptemp)));
$worlduser= 'tarfuin';
$maptype= 'region';


//Execute the query
echo $coord.', '.$entry.', '.$active.', '.$maptype;
	$sql = "INSERT INTO mapfeatures(coord,text,active,maptype)
					VALUES('$coord','$entry','$active','$maptype')";

if ($dbcon->query($sql) === TRUE) {
					
}
		else {
	echo "Error: " . $sql . "<br>" . $dbcon->error;
}

$coordy = $coordy - 3.96;
}
$coordx = $coordx + 6.03;
}
?>
