<?php

$config = array(
	'sites'		=> array(
		'admin'		=> array(
			'name'	=> 'admin',
			'displayName'	=> 'Administration',
			'sitePath'	=> '/admin',
			'needConnect'	=> true,
			'version'	=>	'1.0',
		),
		'www'		=> array(),
	),
	
	'context'	=> array(
		'root'	=> 'D:/xampp/htdocs/fortnite-stash.local/',
		'currentPage'	=> false,
		'currentSite'	=> 0,
		'listSite'		=> array(
			0 => 'admin',
			1 => 'www'
		),
	),
	
	'user'		=> array(
		'connected'		=> false,
		'connectIn'		=> '',
		'name'			=> "",
		'user'			=> "",
		'id'			=> 0,
		'type'			=> 'none',
		'crea'			=> 0,
	),
);

?>