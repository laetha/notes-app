<?php
$sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

// First query: get all titles and IDs into an array
$sql = "SELECT title, id FROM notes WHERE lineage LIKE '247-86-%'";
$sqldata = mysqli_query($dbcon, $sql) or die('error getting data');

$notes_array = [];
while ($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
    // Add each title and ID as key-value pairs to the array
    $notes_array[] = [
        'title' => $row['title'],
        'id' => $row['id']
    ];
}

// Second query: Get all rows that need to be updated
$sql1 = "SELECT id, body FROM notes WHERE lineage LIKE '247-86-%'";
$sql1data = mysqli_query($dbcon, $sql1) or die('error getting data');

while ($row1 = mysqli_fetch_array($sql1data, MYSQLI_ASSOC)) {
    $newid = $row1['id'];
    $checkbody = mysqli_real_escape_string($dbcon, $row1['body']);

    // Loop through the notes array and perform the replacements
    foreach ($notes_array as $note) {
        $fullcheck = "#" . mysqli_real_escape_string($dbcon, $note['title']); // The format to match
        $newstring = "[@".$note['title']."](https://notes.bkconnor.com?id=".$note['id'].")"; // The new format

        // Regex to find patterns like [#text](https://dnd.bkconnor.com?id=(some numbers))
        $pattern = "/\[\#" . preg_quote($note['title'], '/') . "\]\(https:\/\/dnd\.bkconnor\.com\/tools\/world\/world\.php\?id=\d+\)/";

        // Perform the replacement if the pattern exists
        if (preg_match($pattern, $checkbody)) {
            $checkbody = preg_replace($pattern, $newstring, $checkbody);
        }
    }

    // Update the body with the replaced text
    $sql2 = "UPDATE notes SET body = '$checkbody' WHERE id = '$newid'";
    if ($dbcon->query($sql2) === TRUE) {
        echo ('WORKED!');
    } else {
        echo "Error updating record: " . $dbcon->error;
    }
}
?>