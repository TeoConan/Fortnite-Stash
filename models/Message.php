<?php

class Message {
	
	public static function countAlerts() {
		global $context;
		$context->reconnectDB();
		$output = PDOBridge::getSQL("SELECT COUNT('id') as size FROM message WHERE type = 'alert'");
		return($output->size);
	}
	
	public static function countMessages() {
		global $context;
		$context->reconnectDB();
		$output = PDOBridge::getSQL("SELECT COUNT('id') as size FROM message WHERE type = 'message'");
		return($output->size);
	}
}

?>