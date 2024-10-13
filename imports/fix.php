<?php
$sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

// First query: get all titles and IDs into an array
$sql = "SELECT id, body FROM notes WHERE lineage LIKE '247-86-%'";
$sqldata = mysqli_query($dbcon, $sql) or die('error getting data');

while ($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
    // Get the current body
    $body = $row['body'];
    
    // Split the body into lines
    $lines = explode("\n", $body);
    
    // Check if there is at least one line to process
    if (count($lines) > 0) {
        // Use a regex to replace [@text](url) with text in the first line
        $lines[0] = preg_replace('/\[@(.*?)\]\(.*?\)/', '$1', $lines[0]);
        
        // Join the lines back together
        $updatedBody = implode("\n", $lines);
        
        // Update the database with the new body
        $id = $row['id']; // Assuming there's an 'id' field in the notes table
        $updateSql = "UPDATE notes SET body = ? WHERE id = ?";
        $stmt = mysqli_prepare($dbcon, $updateSql);
        mysqli_stmt_bind_param($stmt, 'si', $updatedBody, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

// Close the database connection
mysqli_close($dbcon);
?>
