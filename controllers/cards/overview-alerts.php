<?php

$list = array(
	array("Nombre d'alertes :", '<p id="StatAlerts">...</p>'),
	array("Nombre d'erreurs :", '<p id="StatMessages">...</p>'),
);

$card = array(
	'icon'		=> "/res/icons/database.svg",
	'name'		=> "Alerts",
	'class'		=> "alerts mbA",
	'title'		=> "Alertes et erreurs",
	'dimensions'=> array('width' => '345px'),
	'list'		=> $list
);

?>