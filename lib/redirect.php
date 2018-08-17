<?php 

if (isset($_GET['type'])) {
	$type = $_GET['type'];
	
	switch ($type) {
		case 'image':
			include('../lib/image.php');
			break;
			
		case 'css':
			include('../lib/style.php');
			break;		
	}
}

?>