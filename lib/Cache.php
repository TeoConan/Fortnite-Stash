<?php

class Cache {
	const CACHE_TYPE_IMAGE = 1;
	
	private $srcFile;				//Chemin du fichier à mettre en cache
	private $type;					//Image |
	private $extension;				//Extension du fichier
	private $subFolders;			//Sous dossier du cache
	private $nameFile;				//Nom du fichier sans extension
	private $cacheFile;				//Nom du fichier en cache
	private $cachePath;				//Chemin du fichier en cache
	private $cacheFolder;			//Parent de cacheFile
	private $debug;
	
	//Image
	private $imageWidth;
	private $imageHeight;
	
	public function __construct($type, $file, $subfolder) {
		$this->debug = new Debug('Cache');
		$this->subFolders = $subfolder;
		if ($type == self::CACHE_TYPE_IMAGE || $type == 'image') {
			//var_dump('New type ' . $type);
			$this->type = self::CACHE_TYPE_IMAGE;
		}
		
		if (file_exists($file)) {
			$this->srcFile = $file;
			$this->extension = pathinfo($file, PATHINFO_EXTENSION);
			$this->nameFile = pathinfo($file, PATHINFO_FILENAME);
			//var_dump($file);
			$this->defineCacheInfos();
		} else {
			$this->debug->log('Impossible de trouver le fichier : ' . $file);
		}
		
		if (!is_dir($this->cacheFolder)) {
			if (!mkdir($this->cacheFolder, 0777, true)) {
				$this->debug->log('Impossible de créé les répertoire de cache pour ' . $this->cacheFolder);
			}
		}
	}
	
	public function setArguments($args) {
		
		switch($this->type) {
			case self::CACHE_TYPE_IMAGE :
				$this->imageHeight = $args['height'];
				$this->imageWidth = $args['width'];
				$srcSizes = getimagesize($this->srcFile);
				//var_dump($srcSizes);
				if (empty($this->imageHeight) && !empty($this->imageWidth)) {
					$this->imageHeight = ImageUtil::imageRatio($this->srcFile, $this->imageWidth, $srcSizes['1']);
					$this->imageHeight = (int)$this->imageHeight['height'];
				}

				$this->defineCacheInfos(true);
				break;
		}
	}
	
	public function resize($quality = 9) {
		
		//Si fichier cache identique
		if (file_exists($this->cachePath)) {
			$sizes = getimagesize($this->cachePath);
			
			if($sizes[0] == $this->imageWidth && $sizes[1] == $this->imageHeight) {
				//var_dump('Image already in cache');
				return($this->cachePath);
			}
		}
		
		if ($this->type != self::CACHE_TYPE_IMAGE) {
			die("Bad ressource for resize");
		}
		
		
		switch($this->extension) {
			
		case 'jpeg':
		case 'jpg':
			$image = imagecreatefromjpeg($this->srcFile);
			imagejpeg($image, $this->cacheFile, $quality);
			break;
			
		case 'png':
			$srcImage = imagecreatefrompng($this->srcFile); 
			//var_dump(array($this->imageHeight, $this->imageWidth));
			$targetImage = imagecreatetruecolor($this->imageWidth, $this->imageHeight);   
			imagealphablending($targetImage, false);
			imagesavealpha( $targetImage, true );
			$sizes = getimagesize($this->srcFile);
			imagecopyresampled( $targetImage, $srcImage, 
								0, 0, 
								0, 0, 
								$this->imageWidth, $this->imageHeight,
								$sizes[0], $sizes[1]);

			//var_dump("Save image in " . $this->cachePath);
			$this->debug->log('Nouvelle image en cache : ' . $this->cacheFile);
			imagepng($targetImage, $this->cachePath, $quality);
			return($this->cachePath);
			break;
				
			default :
				var_dump('Missing ext');
				break;
		}
		
		
			
	}
	
	private function defineCacheInfos($force = false) {
		if (empty($this->cacheFile) || $force) {
			switch ($this->type) {
				case self::CACHE_TYPE_IMAGE :
					$this->cacheFile = $this->nameFile . '_' . $this->imageWidth . "x" . $this->imageHeight . '.' . $this->extension;
					$this->cachePath = Context::IMG_CACHE . $this->subFolders . '/' . $this->cacheFile;
					$this->cacheFolder = dirname($this->cachePath);
					//var_dump(array($this->cacheFile, $this->cachePath, $this->subFolders, $this->cacheFolder));
					break;
			}
		} else {
			//var_dump('Already defined cache infos');
			return($this->cacheFile);
		}
	}
	
	public function getCachePath(){return($this->cachePath);}
	public function getCacheFile(){return($this->cacheFile);}
}

?>