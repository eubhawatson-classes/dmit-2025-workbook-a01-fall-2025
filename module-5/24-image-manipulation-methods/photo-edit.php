<?php

// Instead of creating an image object from nothing, here we're creating an image object from a file that already exists.
$image = imagecreatefromjpeg("test-imgs/1x1.jpg");

// This method changes the gamma in an image (how much light is present in the image).

imagegammacorrect($image, 1.0, 3.0);

// Instead of outputting to the browser, let's try saving the image this time. 
imagejpeg($image, "image-output.jpeg");

// After running this in your browser, a new file should appear in the lesson files (in the same directory as this script).

imagedestroy($image);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Image Correction Demo</title>
</head>
<body>
    <h1>Image Correction Demo</h1>
    <img src="image-output.jpeg" alt="This should be a brighter version of the camera on the sheepskin.">
</body>
</html>