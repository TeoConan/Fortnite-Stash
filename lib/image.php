<?php 
require 'autoloader.php';
Autoloader::register();

//include('Utilities/Resize.php');
//include('Utilities/ImageUtil.php');
//include('Cache.php');

$path = Context::ROOT . $_GET['path'];
$file = $path . '/' . $_GET['file'];
$format = $_GET['format'];
$debug = new Debug('admin-image');

if (file_exists($path)) {
	//$debug->log('Image found ' . $file . " > " . createImage($file, $format));
	createImage($file, $format);
} else {
	$debug->log('Can\'t get image ' . $path);
	echo('404');
}

function createImage($path, $format) {
	$output = "";
	
	switch($format) {
		case 'svg':
			$format = 'svg+xml';
			break;
	}
	
	header ('Content-type: image/' . $format);
	
	if (isset($_GET['size']) ||
	   isset($_GET['width']) ||
	   isset($_GET['height'])) {
		$width = null;
		$height = null;
		
		if (isset($_GET['size'])) {
			$width = $_GET['size'];
			$height = $_GET['size'];
			
			if (!ImageUtil::isSquare($path)) {
				e('L\'image n\'est pas carrée');
			}
		}
		
		if (isset($_GET['width'])){
			$width = $_GET['width'];
		}
		
		if (isset($_GET['height'])){
			$height = $_GET['height'];
		}
		
		e('Demande de cache');
		$sizes = getimagesize($path);

		if ($sizes[0] == $width && $sizes[1] == $height) {

		} else {
			if (!checkCache($path, $width, $height)) {
				$path = cacheImage($path, $width, $height);
			}
		}			
		
	}
	

	switch($format) {
			
		case 'jpeg':
			$output = "Compile " . $path . " as jpeg";
			$image = imagecreatefromjpeg($path);
			imagejpeg($image);
			break;
			
		case 'jpg':
			//ini_set("memory_limit","256M");
			$output = "Compile " . $path . " as jpg";
			//var_dump($path);
			$image = imagecreatefromjpeg($path);
			imagejpeg($image);
			break;
			
		case 'png':
			
			
			$output = "Compile " . $path . " as png";
			$image = imagecreatefrompng($path);
			imageAlphaBlending($image, true);
			imageSaveAlpha($image, true);
			imagepng($image);
			break;
			
		case 'svg+xml':
			
			//Compilation
			$output = "Compile " . $path . " as svg+xml";
			$image = file_get_contents($path);
			
			//Nettoyage des br (bug)
			ob_start();
			echo($image);
			$buffer = ob_get_clean();
			$buffer = str_replace("<br/>","", $buffer);
			$buffer = str_replace("<br>","", $buffer);
			
			//Couleur
			if (isset($_GET['color'])) {
				//Pour trouver le fill
				$regexColor = '/(<path.+)(fill=")(#[a-zA-Z0-9]{6})(")/';
				//Pour remplacer le fill
				$regexReplace = '$1$2#' . $_GET['color'] . '$4';
				
				preg_match($regexColor, $buffer, $match);
				
				//Si "fill" est manquant
				if (empty($match)) {
					$buffer = preg_replace('/(<path)/', '$1 fill="#' . $_GET['color'] . '"', $buffer);
				} else {
					$buffer = preg_replace(
						$regexColor, 
						$regexReplace, 
						$buffer);
				}
			}

			
			echo($buffer);
			break;
			
		default :
			$output = "Compile " . $path . " as default jpeg";
			$image = imagecreatefromjpeg($path);
			imagejpeg($image);
			break;
	}

	if (!is_bool($image) && !is_string($image)) {
		imagedestroy($image);
	}
	return($output);
}

function cacheImage($path, $width, $height) {
	Context::defineConst();
	
	//var_dump(array($path, $width, $height, $_GET));

	$cache = new Cache(Cache::CACHE_TYPE_IMAGE, $path, $_GET['path']);
	$cache->setArguments(array('width' => $width, 'height' => $height));
	$cache->resize();
	
	e('Image créée');
	return($cache->getCachePath());
}

function checkCache($path, $width, $height) {
	$cachePath = IMG_CACHE . $path;
	if (file_exists($cachePath)) {
		e('Fichier cache existant');
		$sizes = getimagesize($cachePath);
		
		if ($size[0] == $width && $size[1] == $height) {
			return($cachePath);
		} else {
			return(false);
		}
	} else {
		e('Aucune image en cache');
		return(false);
	}
}

function e($txt) {
	//echo($txt . '<br/>');
}
?>