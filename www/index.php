<?php

require '../lib/autoloader.php'; 
Autoloader::register();

$debug = new Debug('www');

echo('WWW');
echo('<br/>');
var_dump(scandir('/'));
?>