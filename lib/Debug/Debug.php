<?php

class Debug
{
	const LOG_FILE = Context::ROOT . "system/logs/log.txt";
	
	private $from = "";
	
	public function __construct($name) {
		Context::defineConst();
		$this->from = $name;
	}
	
	//Session log
	public function Slog($txt) {
		$user = strtolower(User::getNameOf(Context::getUserId()));
		$log = "[SESSION USER " . $user . " | " . date("Y-m-d H:i:s") . "]" . $txt;
		$this->write($log, Context::ROOT . 'system/logs/sessions/' . $user . '.txt');
	}
	
	public function log($txt) {
		$log = "[" . date("Y-m-d H:i:s") . "] " . $this->from . " : " . $txt . "";
		
		$path = self::LOG_FILE;

		return($this->write($log, $path));
	}
	
	private function write($txt, $file) {
		if (file_exists($file)) {
			$current = file_get_contents($file);
			$current = $txt;	
		} else {
			
			var_dump($file);
			$file = fopen($file, 'w');
			$output = fwrite($file, $txt);
			fclose($file);
			return($output);
		}
		
		return(file_put_contents($file, $current . "\r\n", FILE_APPEND));
	}
}
?>