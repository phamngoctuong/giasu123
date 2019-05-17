<?php 
session_start();
function create_image()
{
 $md5_hash = md5(rand(0,999));
 $security_code = substr($md5_hash, 15, 5);
 $width = 80;
 $height = 30;
 $image = imagecreate($width, $height);
 $white = imagecolorallocate($image, 255, 255, 255);
 $black = imagecolorallocate($image, 0, 0, 0);
 imagefill($image, 0, 0, $black);
 imagestring($image, 5, 17, 6, $security_code, $white);
 header("Content-Type: image/jpeg");
 imagejpeg($image);
 imagedestroy($image);
 $_SESSION["img"] = $security_code;
}
create_image() ;
exit();
?>