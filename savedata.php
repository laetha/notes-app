<?php
$sqlpath = $_SERVER['DOCUMENT_ROOT'] . "/sql-connect.php";
include_once($sqlpath);

$id = (int) $_REQUEST['noteID'];
$notebodytemp = $_REQUEST['noteBody'];
$notetitletemp = $_REQUEST['noteTitle'];
$notebody = mysqli_real_escape_string($dbcon, $notebodytemp);
$notetitle = html_entity_decode(trim($notetitletemp));
$edited = date('ymdHi');

// Fetch the original title from the database without extra processing
$sql = "SELECT title FROM notes WHERE id = $id";
$result = mysqli_query($dbcon, $sql);

if ($row = mysqli_fetch_assoc($result)) {
    $originalTitle = html_entity_decode(trim($row['title']));

    // Check if the title has changed (decode both sides to ensure consistency)
    $titleUnchanged = ($originalTitle === $notetitle);

    // Update the note in the database
    $sql = "UPDATE notes SET title='" . mysqli_real_escape_string($dbcon, $notetitle) . "', body='$notebody', edited='$edited' WHERE id=$id";
    if ($dbcon->query($sql) === TRUE) {
        $exportID = $id;
        $sql = "SELECT title, body, lineage FROM notes WHERE id = $exportID";
        $sqldata = mysqli_query($dbcon, $sql) or die('Error getting data');
        
        while ($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
            $title = $row['title'];
            $remtitle = '# ' . $row['title'];
            $body = ltrim(substr($row['body'], strlen($remtitle)));
            $path = explode('-', $row['lineage']);
            array_pop($path);
            $newpath = '';

            foreach ($path as $x) {
                $sql = "SELECT title FROM notes WHERE id = '$x'";
                $sqldata = mysqli_query($dbcon, $sql) or die('Error getting data');
                
                while ($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
                    $newpath .= $row['title'] . '/';
                }
            }

            if (!is_dir('exports/' . $newpath)) {
                mkdir('exports/' . $newpath, 0777, true);
            }

            file_put_contents('exports/' . $newpath . $title . '.md', $body);
        }

        // Echo the result: true if title is unchanged, false if it changed
        echo json_encode(["titleUnchanged" => $titleUnchanged]);
    } else {
        echo "Error: " . $sql . "<br>" . $dbcon->error;
    }
} else {
    echo "Error: Could not fetch the original title.";
}
?>
