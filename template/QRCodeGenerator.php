<?php

class QRCodeGenerator
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function generateQRCode()
    {
        // Create a QR code image using the GD library
        $size = 200;
        $margin = 10;
        $qr = imagecreate($size, $size);
        $background = imagecolorallocate($qr, 255, 255, 255);
        $color = imagecolorallocate($qr, 0, 0, 0);

        // Generate QR code
        imagestring($qr, 10, $margin, $margin, $this->data, $color);

        // Output the image
        header('Content-type: image/png');
        imagepng($qr);
        imagedestroy($qr);
    }
}
?>
