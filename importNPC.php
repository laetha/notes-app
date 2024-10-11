<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$sql = "SELECT * FROM world WHERE id = 4097";
$sqldata = mysqli_query($dndcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
  $cleantitle = str_replace(' ', '_', $row['title']);
  $notetitle = $row['title'];
  $lineage = '247-86-276';
  $race = $row['npc_race'];
  $npcbody = $row['body'];
  if ($race != ''){
    $race = '@'.$race;
  }
  $establishment = $row['npc_est'];
  if ($establishment != ''){
    $establishment = '@'.$establishment;
  }
  $location = $row['npc_location'];
  if ($location != ''){
    $location = '@'.$location;
  }
  $faction = $row['npc_faction'];
  if ($faction != ''){
    $faction = '@'.$faction;
  }
  $deity = $row['npc_deity'];
  if ($deity != ''){
    $deity = '@'.$deity;
  }
  $npctitle = $row['npc_title'];

  $edited = date('ymdHi');

  $sql1 = "INSERT INTO notes (title,type,body,lineage,edited,viewed) VALUES ('$notetitle','','','$lineage','$edited','$edited')";

  if ($dbcon->query($sql1) === TRUE) {
    $last_id = $dbcon->insert_id;
    $lineage = $lineage.'-'.$last_id;

    $directory = 'uploads/';
    
    $body = "# " . $notetitle . "\r\n\r\n"; // Initialize the body with the title
    
    $image_found = false; // Flag to track if an image is found
    
    // Open the directory
    if ($handle = opendir($directory)) {
        // Loop through the directory contents
        while (false !== ($file = readdir($handle))) {
            // Get the file's extension
            $file_extension = pathinfo($file, PATHINFO_EXTENSION);
    
            // Get the filename without the extension
            $filename_without_extension = pathinfo($file, PATHINFO_FILENAME);
    
            // Check if the filename matches $notetitle
            if ($filename_without_extension === $notetitle) {
                // New file name with $last_id-$cleantitle
                $new_filename = $last_id . '-' . $cleantitle . '.' . $file_extension;
    
                // Full path of the current file and the new file
                $current_file = $directory . $file;
                $new_file = $directory . $new_filename;
    
                // Rename the file
                if (rename($current_file, $new_file)) {
                    // If the image was found and renamed, update the body with the image in markdown format
                    $body .= '![](' . $new_file . ')' . "\r\n";
                    $image_found = true; // Set the flag to true
                } else {
                    echo "Error renaming file: $file to $new_filename.\r\n";
                }
            }
        }
        closedir($handle);
    }
    
    // If no image was found, $body will only have the title
    if (!$image_found) {
        echo "No image found matching $notetitle.\r\n"; // Optional message
    }
    
    
    
    $body = $body.
    'Race: '.$race."\r\n" .
    'Establishment: '.$establishment."\r\n" .
    'Location: '.$location."\r\n" .
    'Faction: '.$faction."\r\n" .
    'Deity: '.$deity."\r\n" .
    'Title: '.$npctitle."\r\n\r\n" .
    $npcbody;

  $body = html_entity_decode(trim(addslashes($body)));

    $sql1 = "UPDATE notes SET lineage= '$lineage', body= '$body' WHERE id LIKE '$last_id'";
    if ($dbcon->query($sql1) === TRUE) {
      echo $last_id;
    }


    echo $notetitle. 'successfully created!';
  }
  else {
      echo "Error: " . $sql1 . "<br>" . $dbcon->error;
  }
}

?>