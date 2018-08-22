<?php
require '../../../lib/autoloader.php';
Autoloader::register();

if (Context::check() !== false) {
	global $context;
	if ($context->userConnected()) {

		$visitors = new Setting('MonthVisitors');
		echo($visitors->getVal());
	} else {
		echo('403, not connected');
	}
	
} else {
	echo('403, not connected');
}

?>