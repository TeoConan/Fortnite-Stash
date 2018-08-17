<?php

$list = array(
	array("Nombre d'images (skins)", '<p id="StatImages">...</p>'),
	array("Nombre de skins", '<p id="StatSkins">...</p>'),
	array("Stockage BDD", '<p id="StatDB">...</p>'),
	array("Stockage fichiers", '<p id="StatFiles">...</p>'),
	array("Nombre d'utilisateurs", "12"),
	array('<p>Taille du cache : <span id="StatCache">...</span></p>', '<div class="button green" style="padding: 7px 17px 8px;"><span style="white-space: nowrap;font-size: 14px;">Vider le cache</span></div>')
);

$card = array(
	'icon'		=> "/res/icons/database.svg",
	'name'		=> "Storage",
	'class'		=> "storage mbA",
	'title'		=> "Stockage",
	'dimensions'=> array('width' => '345px'),
	'list'		=> $list
);

?>