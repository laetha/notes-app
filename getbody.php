<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$bodyID = $_REQUEST['bodyID'];

$noteBody = array();
$viewed = date('ymdHisu');
$allTags= ['#stop'];
$sql = "SELECT * FROM notes WHERE lineage LIKE '%-1515-%'";
$sqldata = mysqli_query($dbcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
  $notetitle = $row['title'];
  array_push($allTags,'#'.$notetitle);
}


$sql = "SELECT * FROM notes WHERE id = $bodyID";
$sqldata = mysqli_query($dbcon, $sql) or die('error getting data');
while($row =  mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {

  $title = $row['title'];
  $lineage = $row['lineage'];
  $newBody = '<h2>'.$title.'</h2>';


  if (strpos($lineage,'-1515-') !== false && strpos($lineage,'-1515-1530') == false){
    $checktag = '#'.$title;

    $sql1 = "SELECT * FROM notes WHERE body LIKE '%$checktag%' ORDER BY edited DESC";
    $sql1data = mysqli_query($dbcon, $sql1) or die('error getting data');
    while($row1 =  mysqli_fetch_array($sql1data, MYSQLI_ASSOC)) {

      $checkbody = $row1['body'];
      
// Escape special characters for regex
$escapedChecktag = preg_quote($checktag, '/');
$escapedAllTags = array_map(function($tag) {
    return preg_quote($tag, '/');
}, $allTags);

// Create the regex pattern to capture text immediately after the $checktag on the same line
$pattern = '/(' . $escapedChecktag . ')\s*(.*?)(?=\s*(?:' . implode('|', $escapedAllTags) . ')|$)/s';

// Find all matches
if (preg_match_all($pattern, $checkbody, $matches)) {
    // $matches[2] contains all the captured sections
    foreach ($matches[2] as $match) {
        // Strip "]()" from the start of the match if it exists
            $match = str_replace(']()','',$match);  // Remove the "]()" part
            if (substr($match, -1) === '[') {
              // Remove the trailing '['
              $match = rtrim($match, '# [');
          }
        
        // Append each match to $newBody
        $newBody .= "\n".'<h2><a href="https://notes.bkconnor.com?id='.$row1['id'].'">'.$row1['title'].'</a></h2>'.trim($match) . "\n";
    }
}
 
}
  
// Display the result
array_push($noteBody, $row['title'], $newBody, $row['id'], $row['lineage']);
  
  
  
  }

else if (strpos($lineage,'-1515-1530') !== false){
  $todoNew = '# To-do'."\n";

  $sql2 = "SELECT * FROM notes WHERE body LIKE '%[ ]%' ORDER BY edited DESC";
  $sql2data = mysqli_query($dbcon, $sql2) or die('error getting data');
  while($row2 =  mysqli_fetch_array($sql2data, MYSQLI_ASSOC)) {

    $todoBody = $row2['body'];
    $todoNew .= '## <a href="https://notes.bkconnor.com?id='.$row2['id'].'">'.$row2['title']."</a>\n";

// Use preg_match_all to find all lines with '[ ]' or '[x]'
if (preg_match_all('/^.*(\[\s\]).*$/mi', $todoBody, $matches)) {
  // Loop through the matched lines
  foreach ($matches[0] as $line) {
      // Append the matched line to $todoNew
      $todoNew .= $line . "\n";
  }

  // Add an additional newline after the last matched line
  $todoNew .= "\n";
}


  }
  array_push($noteBody, $row['title'], $todoNew, $row['id'], $row['lineage']);
}

else {
    array_push($noteBody, $row['title'], $row['body'], $row['id'], $row['lineage']);
  }
}

$sql = "UPDATE notes SET viewed='$viewed' WHERE id=$bodyID";
if ($dbcon->query($sql) === TRUE) {
  echo json_encode($noteBody);
}
else {
  echo "Error: " . $sql . "<br>" . $dbcon->error;
}

?>