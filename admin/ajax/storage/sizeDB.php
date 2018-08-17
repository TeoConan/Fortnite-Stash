<?php
require '../../../lib/autoloader.php';
Autoloader::register();

if (Context::check() !== false) {
	global $context;
	if ($context->isConnected()) {
		echo(Storage::getDBSize());
	} else {
		var_dump($_SESSION);
		echo('403, not connected');
	}
	
} else {
	echo('403, not connected');
}


?>