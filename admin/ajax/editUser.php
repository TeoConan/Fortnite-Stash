<?php
require '../../lib/autoloader.php';
Autoloader::register();

if (Context::check() !== false) {
	global $context;
	if ($context->userConnected()) {
		if ($_GET['type'] == 'get') {
			$user = User::getUser($_GET['id']);
			
			if ($user['expirate'] == -1 || empty($user['expirate'])) {
				$user['expirate'] = "";
			} else {
				$user['expirate'] = date('d/m/Y', $user['expirate']);
			}
			
			$user['utsCreate'] = date('d/m/Y', $user['utsCreate']);
			
			$user = json_encode($user);
			echo($user);
		}
		
		if ($_GET['type'] == 'update') {
			$user = array(
				'id'	=> $_GET['id'],
				'name' => $_GET['name'],
				'user' => $_GET['user'],
				'mail' => $_GET['mail'],
				'type' => $_GET['type'],
				'expirate' => $_GET['expirate'],
				'img_profile' => $_GET['img']
			);
		}		

	} else {
		echo('403, not connected');
	}
	
} else {
	echo('403, not connected');
}

?>