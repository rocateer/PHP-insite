<?php
// Including all required classes
require('class/BCGFont.php');
require('class/BCGColor.php');
require('class/BCGDrawing.php'); 

$card_num = $_REQUEST['card_num'];
$scale="2";
if(isset($_REQUEST['scale'])){
    $scale = $_REQUEST['scale'];
}

$font="0";
if(isset($_REQUEST['font'])){
    $font = $_REQUEST['font'];
}

$height="30";
if(isset($_REQUEST['height'])){
    $height = $_REQUEST['height'];
}


// Including the barcode technology
include('class/BCGcode128.barcode.php'); 

// Loading Font
$font = new BCGFont('class/font/Arial.ttf', $font);

// The arguments are R, G, B for color.
$color_black = new BCGColor(0, 0, 0);
$color_white = new BCGColor(255, 255, 255); 

$code = new BCGcode128();
$code->setScale((int)$scale); // Resolution
$code->setThickness((int)$height); // Thickness
$code->setForegroundColor($color_black); // Color of bars
$code->setBackgroundColor($color_white); // Color of spaces
$code->setFont($font); // Font (or 0)
$code->parse($card_num); // Text


/* Here is the list of the arguments
1 - Filename (empty : display on screen)
2 - Background color */
$drawing = new BCGDrawing('', $color_white);
$drawing->setBarcode($code);
$drawing->draw();


// Header that says it is an image (remove it if you save the barcode to a file)
header('Content-Type: image/png');

// Draw (or save) the image into PNG format.
$drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
?>