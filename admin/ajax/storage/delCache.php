<?php
require '../../../lib/autoloader.php';
Autoloader::register();

if (Context::check() !== false) {
	global $context;
	if ($context->userConnected()) {
		echo(Storage::delCache());
	} else {
		echo('403, not connected');
	}
	
} else {
	echo('403, not connected');
}

?>