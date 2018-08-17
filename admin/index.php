<?php 

require '../lib/autoloader.php'; 
Autoloader::register();

$var = array(
	'context'	=> array(
		'page'	=> 'login',
		'submit' => false,
		'get'	=> $_GET,
		'post'	=> $_POST,
	),
	
	'user'	=> array(
		'connected'	=> false,
		'input'	=> array(
			'user'	=> "",
			'password' => "",
		),
	),
	
	'messages'	=> array(),
);


session_start();
if (isset($_SESSION['idUser'])) {
	$id = $_SESSION['idUser'];
	
	if (is_numeric($id)) {
		$var['user']['connected'] = true;
		$var['context']['page'] = 'home';
	}
}

//Check du submit
if (isset($_POST['login'])) {	
	$var['context']['submit'] = true;
	
	if (isset($_POST['user']) && !empty($_POST['user'])) {
		$var['user']['input']['user'] = $_POST['user'];
	}
	
	if (isset($_POST['password']) && !empty($_POST['password'])) {
		$var['user']['input']['password'] = $_POST['password'];
	}
}


//Connection
if ($var['context']['submit'] === true) {
	
	$context = new Context('admin');

	$user = new User();
	$connect = $user->connect($var['user']['input']['user'], $var['user']['input']['password']);
	var_dump($_SESSION);
	
	if ($connect === true) {
		$var['user']['connected'] = true;
		$var['context']['page'] = 'home';
	} else {
		$var['messages'][] = array('type' => 'error', 'text' => $connect);
	}
}

switch ($var['context']['page']) {
	case 'login' :
		include('login.php');
		break;
		
	case 'home' :
		header("Location: overview/");
		die();
		break;
		
	default:
		include('login.php');
		break;
}

if ($var['context']['page'] == 'login') {
	
}

//var_dump($var);	

?>