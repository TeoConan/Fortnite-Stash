<?php
require '../../../lib/autoloader.php';
Autoloader::register();

if (Context::check() !== false) {
	echo(Storage::getFilesSize());
} else {
	echo('403, not connected');
}


?>