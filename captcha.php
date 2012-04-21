<?php

header ("Content-type: image/png");
$image = imagecreate(75,20);
$blanc = imagecolorallocate($image, 242, 242, 242);
$noir = imagecolorallocate($image, 0, 0, 0);

imagestring($image, 4, 5, 2, $_GET['captcha'], $noir);

imagepng($image);

?>