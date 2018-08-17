<?php 
require 'autoloader.php';
Autoloader::register();

$path = '../' . $_GET['path'] .'/' . $_GET['file'];
$file = $path . '/' . $_GET['file'];
$format = $_GET['format'];
$debug = new Debug('admin-css');

if (file_exists($path)) {
	//$debug->log('CSS found ' . $file . " > " . $path);
	generateCSS($path);
} else {
	$debug->log('Can\'t get CSS file ' . $path);
	echo('404');
}

function generateCSS($path) {
	header ('Content-type: text/css');
	echo(file_get_contents($path));
}
?>