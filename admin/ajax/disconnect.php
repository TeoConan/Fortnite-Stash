<?php

require '../../lib/autoloader.php';
Autoloader::register();

$context = Context::check();

if (isset($_SESSION['idUser'])) {
	$context->disconnect();
}



?>