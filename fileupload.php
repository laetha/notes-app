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
    $doctitle = $row['id'].'-'.$row['title'];
}

// Base upload directory
$upload_base = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
$final_directory = $upload_base . $fullpath;

if (!is_dir($final_directory)) {
    mkdir($final_directory, 0777, true);
}

$sepext = explode('.', strtolower($_FILES['upload']['name']));
$type = end($sepext);
$cleanname = str_replace(["'", '"'], '', $doctitle);
$cleanname = str_replace(' ', '_', $doctitle);
$filename = $cleanname ? $cleanname . '.' . $type : 'uploaded_file.' . $type;

function getUniqueFilename($path, $filename) {
    $counter = 1;
    $file_parts = pathinfo($filename);
    $new_filename = $filename;
    while (file_exists($path . $new_filename)) {
        $new_filename = $file_parts['filename'] . '_' . $counter . '.' . $file_parts['extension'];
        $counter++;
    }
    return $new_filename;
}

$filename = getUniqueFilename($final_directory, $filename);
$uploadpath = $final_directory . $filename;

$max_width = 800;
$max_height = 800;

if (isset($_FILES['upload']) && strlen($_FILES['upload']['name']) > 1) {
    list($width, $height, $image_type) = getimagesize($_FILES['upload']['tmp_name']);
    
    if ($width > $max_width || $height > $max_height) {
        // Load image based on type
        switch ($image_type) {
            case IMAGETYPE_JPEG:
                $src_img = imagecreatefromjpeg($_FILES['upload']['tmp_name']);
                break;
            case IMAGETYPE_PNG:
                $src_img = imagecreatefrompng($_FILES['upload']['tmp_name']);
                break;
            case IMAGETYPE_WEBP:
                $src_img = imagecreatefromwebp($_FILES['upload']['tmp_name']);
                break;
            default:
                die("Unsupported image type.");
        }

        $ratio = min($max_width / $width, $max_height / $height);
        $new_width = $width * $ratio;
        $new_height = $height * $ratio;

        $resized_img = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($resized_img, $src_img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        // Save the resized image
        switch ($image_type) {
            case IMAGETYPE_JPEG:
                imagejpeg($resized_img, $uploadpath, 80);
                break;
            case IMAGETYPE_PNG:
                imagepng($resized_img, $uploadpath, 8);
                break;
            case IMAGETYPE_WEBP:
                imagewebp($resized_img, $uploadpath, 80);
                break;
        }
        imagedestroy($resized_img);
        imagedestroy($src_img);
    } else {
        move_uploaded_file($_FILES['upload']['tmp_name'], $uploadpath);
    }

    $url = 'uploads/' . $fullpath . $filename;
    $msg = $filename . ' successfully uploaded! >>> Size: ' . number_format($_FILES['upload']['size'] / 1024, 2, '.', '') . ' KB';
    $response = ['url' => $url];
} else {
    $response = ['error' => ['message' => 'Unable to upload the file!']];
}

echo json_encode($response);
?>
