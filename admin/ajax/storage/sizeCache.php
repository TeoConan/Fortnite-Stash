<?php
require '../../../lib/autoloader.php';
Autoloader::register();

if (Context::check() !== false) {
	echo(Storage::getCacheSize());
} else {
	echo('403, not connected');
}


?>