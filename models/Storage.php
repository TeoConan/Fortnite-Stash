<?php

class Storage {
	
	public static function getCacheSize() {
		$path = Context::ROOT . 'cache/';
		$size = self::folderSize($path);
		$size = self::convertOctetReadable($size, true, true);
		
		return($size);
	}
	
	public static function getFilesSize() {
		$path = Context::ROOT;
		$size = self::folderSize($path);
		$size = self::convertOctetReadable($size, true, true);
		
		return($size);
	}
	
	public static function folderSize ($dir) {
		$size = 0;
		foreach (glob(rtrim($dir, '/').'/*', GLOB_NOSORT) as $each) {
			$size += is_file($each) ? filesize($each) : self::folderSize($each);
		}
		return $size;
	}
	
	public static function countImagesSkins() {
		
		$path = Context::RES_SKINS;
		
		$files = scandir($path);
		$files = sizeof($files) - 2;
		
		return($files);
	}
	
	public static function convertOctetReadable($size, $postfix = true, $round = false){
		$postfix = array(
			'o',
			'Ko',
			'Mo',
			'Go',
			'To'
		);
		
		for ($i = 0; $size > 1024; $i++) {
			if($i > sizeof($postfix)) {break;}
			
			if ($size > 1024) {
				$size = $size / 1024;
			}
		}
		
		if ($round) {
			$size = round($size);
		}
		
		if ($postfix) {
			$size .= ' ' . $postfix[$i];
		}
		
		return($size);
	}
	
	public static function delCache() {
		self::rrmdir(Context::CACHE);
		mkdir(Context::ROOT . 'cache/');
		$debug = new Debug('Admin-cache');
		$debug->log('Cache removed');
	}
	
	public static function rrmdir($dir) { 
		if (is_dir($dir)) { 
			$objects = scandir($dir); 
			foreach ($objects as $object) {
				if ($object != "." && $object != "..") {
					if (is_dir($dir."/".$object))
						self::rrmdir($dir."/".$object);
					else
						unlink($dir."/".$object);
				}
			}
			rmdir($dir); 
		}
	}
	
	public static function getDBSize() {
		global $context;
		$context->reconnectDB();
		$dbl = PDOBridge::getConnexion();
		$sth = $dbl->query('SHOW TABLE STATUS');

		$size = $sth->fetch(PDO::FETCH_ASSOC)["Data_length"];
		$size = self::convertOctetReadable($size);
		
		return($size);
	}
}

?>