<?php

$srcImage = imagecreatefrompng('php.png'); 

$targetImage = imagecreatetruecolor( 128, 128 );   
imagealphablending( $targetImage, false );
imagesavealpha( $targetImage, true );

imagecopyresampled( $targetImage, $srcImage, 
                    0, 0, 
                    0, 0, 
                    128, 128, 
                    512, 512 );

imagepng(  $targetImage, 'out.png', 9 );


function resize($src, $w, $h, $saveFile, $quality = 9) {
	$srcImage = imagecreatefrompng($src); 

	$targetImage = imagecreatetruecolor($w, $h);   
	imagealphablending( $targetImage, false );
	imagesavealpha( $targetImage, true );
	$sizes = getimagesize($src);
	imagecopyresampled( $targetImage, $srcImage, 
						0, 0, 
						0, 0, 
						$w, $h,
						$sizes[0], $sizes[1]);

	imagepng(  $targetImage, $saveFile, $quality);
}


resize('22.png', 128, 128, 'out22.png');

?>

<img src="php.png"/>

<img src="out.png"/>