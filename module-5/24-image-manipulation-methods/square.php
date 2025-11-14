<?php

// Let's start by creating an image object that is 512px x 512px large.
$image = imagecreate(512, 512);

// We need to do something with this blank canvas we've just created. Let's fill it with a colour. 
// chartreuse -> rgb(223, 255, 0);
$chartreuse = imagecolorallocate($image, 223, 255, 0);

// When we created our canvas, it was completely empty. Here, let's fill it with the green we made, starting at (0, 0). This means we're a starting at the origin (upper left corner), not a little ways into the canvas.
imagefill($image, 0, 0, $chartreuse);

// This tells the browser what MIME type we're dealing with. It says 'get ready to display an image, not HTML'.
header("Content-type: image/png");

imagepng($image);

// Now that we have our output, we need to destroy the image object in order to freeup resources for the server. 
imagedestroy($image);

?>