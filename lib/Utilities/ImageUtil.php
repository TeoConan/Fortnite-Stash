<?php

class ImageUtil {
	
	public static function resize($src, $w, $h, $saveFile, $quality = 9) {
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
	
	public static function isSquare($file) {
		$sizes = getimagesize($file);

		if ($sizes[0] === $sizes[1]) {
			return(true);
		} else {
			return(false);
		}
	}
	
	public function imageRatio($imageUrl, $maxWidth, $maxHeight)
	{
		$imageDimensions = getimagesize($imageUrl);
		$imageWidth = $imageDimensions[0];
		$imageHeight = $imageDimensions[1];
		$imageSize['width'] = $imageWidth;
		$imageSize['height'] = $imageHeight;
		if($imageWidth > $maxWidth || $imageHeight > $maxHeight)
		{
			if ( $imageWidth > $imageHeight ) {
				$imageSize['height'] = floor(($imageHeight/$imageWidth)*$maxWidth);
				$imageSize['width']  = $maxWidth;
			} else {
				$imageSize['width']  = floor(($imageWidth/$imageHeight)*$maxHeight);
				$imageSize['height'] = $maxHeight;
			}
		}
		return $imageSize;
	}
}

?>