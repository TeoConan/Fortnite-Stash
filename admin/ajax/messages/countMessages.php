<?php
require '../../../lib/autoloader.php';
Autoloader::register();

if (Context::check() !== false) {
	global $context;
	if ($context->userConnected()) {

		echo(Message::countMessages());
	} else {
		echo('403, not connected');
	}
	
} else {
	echo('403, not connected');
}

?>