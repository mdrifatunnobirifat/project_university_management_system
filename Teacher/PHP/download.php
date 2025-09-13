<?php
// Database connection
include '../../main/DB/DB.php';
// Check if id is passed
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Prevent SQL injection

    $sql = "SELECT Title, Upload_File FROM material WHERE Material_ID = $id";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $fileContent = $row['Upload_File'];
        $fileName = $row['Title'] . ".pdf"; // You can also store real file name in DB

        // Send headers for download
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header("Content-Length: " . strlen($fileContent));

        echo $fileContent;
        exit;
    } else {
        echo "File not found!";
    }
} else {
    echo "Invalid request!";
}

mysqli_close($conn);
?>
