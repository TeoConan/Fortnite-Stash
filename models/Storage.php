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
	
	public static function convertOctetReadable($size, $postfix = true, $round = false){
		$postfix = array(
			'o',
			'ko',
			'mo',
			'go',
			'to'
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
	
	public static function _getDBSize() {
		global $context;
		var_dump($context->getTypeConnect());
		$context->printContext();
		
		// Execute query
		$dbl = PDOBridge::getConnexion();
		var_dump($dbl);
		$sth = $dbl->query('SHOW TABLE STATUS');

		// Get size from array
		$size = $sth->fetch(PDO::FETCH_ASSOC)["Data_length"];
		
		var_dump($size);
	}
}

?>