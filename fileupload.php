<?php
$sqlpath = $_SERVER['DOCUMENT_ROOT'] . "/sql-connect.php";
include_once($sqlpath);

$docid = $_GET['docid'];
$sql = "SELECT * FROM notes WHERE id LIKE '$docid'";
$sqldata = mysqli_query($dbcon, $sql) or die('error getting data');
$fullpath = '';
$doctitle = '';

// Fetch the document title and lineage
while ($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
    $doctitle = $row['title'];
    $heirarchy = explode('-', $row['lineage']);
    array_pop($heirarchy); // Exclude the last entry

    // Build the full path based on the hierarchy
    foreach ($heirarchy as $x) {
        $sql1 = "SELECT title FROM notes WHERE id LIKE '$x'";
        $sql1data = mysqli_query($dbcon, $sql1) or die('error getting data');
        
        while ($row1 = mysqli_fetch_array($sql1data, MYSQLI_ASSOC)) {
            if ($fullpath !== '') {
                $fullpath .= '/'; // Add a slash if $fullpath is not empty
            }
            // Replace spaces with underscores in directory names
            $fullpath .= str_replace(' ', '_', $row1['title']); // Append the title to the path
        }
    }

    // Ensure fullpath ends with a trailing slash
    if ($fullpath !== '') {
        $fullpath .= '/';
    }
}

// Base upload directory
$upload_base = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';

// Final directory path
$final_directory = $upload_base . $fullpath;

// Create directories if they do not exist
if (!is_dir($final_directory)) {
    mkdir($final_directory, 0777, true); // Create the directory structure
}

// Get the file extension from the uploaded file
$sepext = explode('.', strtolower($_FILES['upload']['name']));
$type = end($sepext); // Get the file extension

// Clean the document title for the filename
$cleanname = str_replace(' ', '_', $doctitle);
if ($cleanname) {
    $filename = $cleanname . '.' . $type; // Combine cleaned title with extension
} else {
    // Default filename if $doctitle is empty
    $filename = 'uploaded_file.' . $type;
}

// Complete upload path
$uploadpath = $final_directory . $filename;

// Function to handle filename iteration if it already exists
function getUniqueFilename($path, $filename) {
    $counter = 1;
    $file_parts = pathinfo($filename);
    $new_filename = $filename;

    // Check if the file exists
    while (file_exists($path . $new_filename)) {
        // Append "_#"
        $new_filename = $file_parts['filename'] . '_' . $counter . '.' . $file_parts['extension'];
        $counter++;
    }

    return $new_filename;
}

// Ensure the filename is unique
$filename = getUniqueFilename($final_directory, $filename);

// Complete upload path with the unique filename
$uploadpath = $final_directory . $filename;

// Attempt to upload the file
$re = '';
if (isset($_FILES['upload']) && strlen($_FILES['upload']['name']) > 1) {
    // Validate the file type, size, etc. (this should be done before this point)
    
    if ($re == '') {
        if (move_uploaded_file($_FILES['upload']['tmp_name'], $uploadpath)) {
            $url = 'uploads/' . $fullpath . $filename; // Adjust URL as needed
            $msg = $filename . ' successfully uploaded! >>> Size: ' . number_format($_FILES['upload']['size'] / 1024, 2, '.', '') . ' KB';
            $response = [
                'url' => $url
            ];
        } else {
            $response = [
                'error' => [
                    'message' => 'Unable to upload the file!'
                ]
            ];
        }
    } else {
        $response = [
            'error' => [
                'message' => 'Error: ' . $re
            ]
        ];
    }
}

// Return response in JSON format
echo json_encode($response);
?>
