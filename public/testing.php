<?php
// list($width, $height) = getimagesize('http://www.irdrinternational.org/wp-content/uploads/2015/04/JRC-137x195.jpg');
// echo "width: " . $width . "<br />";
// echo "height: " .  $height;
$link= 'http://www.irdrinternational.org/wp-content/uploads/2015/04/JRC-137x195.jpg';
$diff = strlen($link)-14;
$substr = substr($link,$diff);
$check =strpos($substr,'x');
if($check){
    $check =strpos($substr,'-');
    $link = substr($link,0,-(14-$check)).'.jpg';
    echo $link;
};
 ?>
