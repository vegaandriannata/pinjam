<?php
include "path/to/qrlib.php"; // Update with the correct path

// Check if the POST data is set
if (isset($_POST['qrData'])) {
    // Get the QR data from POST
    $qrData = $_POST['qrData'];

    // Generate a unique filename for the QR code image
    $filename = "qrcodes/" . uniqid() . ".png";

    // Generate QR code and save it to the file
    QRcode::png($qrData, $filename, 'L', 4, 2);

    // Return the filename (or you can return the full path or any other identifier)
    echo $filename;
} else {
    // If POST data is not set, return an error message
    echo "Error: No data received.";
}
?>