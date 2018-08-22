<?php
require '../../lib/autoloader.php';
Autoloader::register();

if (Context::check() !== false) {
	global $context;
	if ($context->userConnected()) {
		
		var_dump($_GET);
		$user = array(
			'name' => $_GET['name'],
			'user' => $_GET['user'],
			'password' => $_GET['password'],
			'mail' => $_GET['mail'],
			'type' => $_GET['type'],
			'expirate' => $_GET['expirate'],
			'img_profile' => $_GET['img']
		);

		echo(User::newUser($user));
	} else {
		echo('403, not connected');
	}
	
} else {
	echo('403, not connected');
}

?>