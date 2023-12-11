<?php

class MyQrCodeLibrary
{
    public static function generateQRCode($data, $size = 200)
    {
        // Adjust the error correction level and margin as needed
        $errorCorrectionLevel = 'L'; // L, M, Q, H
        $margin = 2;

        // Create a QR code instance
        $qrCode = new QRcode();
        $qrCode->text($data);
        $qrCode->size($size);
        $qrCode->errorCorrection($errorCorrectionLevel);
        $qrCode->margin($margin);

        // Return the QR code image data
        return $qrCode->image();
    }
}

class QRcode
{
    private $text;
    private $size;
    private $errorCorrection;
    private $margin;

    public function text($text)
    {
        $this->text = $text;
    }

    public function size($size)
    {
        $this->size = $size;
    }

    public function errorCorrection($errorCorrection)
    {
        $this->errorCorrection = $errorCorrection;
    }

    public function margin($margin)
    {
        $this->margin = $margin;
    }

    public function image()
    {
        // This is a placeholder function; you would implement the QR code generation logic here
        // Use a QR code library or algorithm to generate the QR code image data

        // For demonstration purposes, we'll just return a string indicating the QR code data
        return "QR Code Data: " . $this->text;
    }
}
