<?php

class Skin {
	
	public static function countSkinsDB() {
		global $context;
		$context->reconnectDB();
		$output = PDOBridge::getSQL("SELECT COUNT('id') as size FROM skin");
		return($output->size);
	}
	
	public static function getList(){
		global $context;
		
		$output = PDOBridge::getAllSQL("SELECT * FROM skin");
		return($output);
	}
}

?>