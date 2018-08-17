<?php

require '../../lib/autoloader.php';
Autoloader::register();

$context = Context::check();
if ($context === false || !isset($_SESSION['idUser'])) {
	//header("Location: ./");
	var_dump($context);
	var_dump($_SESSION);
}

$context->setCurrentPage('skins-manager');
$user = new User(array('id' =>$_SESSION['idUser']));
$context->setUser($user);

?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Fortnite-Stash - Skin Manager</title>
	<link rel="stylesheet" href="/res/css/admin/style.css"/>
	<link rel="icon" type="image/png" href="../icon-admin.ico" />
	<script type="text/javascript" src="res/vendors/jquery.min.js">
	</script>
</head>

<body class="page page-skin-manager">

	<?php include('../includes/nav.php'); ?>
	
	<main class="block-main">
		<div class="inner">
			<div class="col">
				<?php  new Card('skin-manager-skins'); ?>
			</div>
			<div class="col">
				<?php new Card('skin-manager-edit'); ?>
			</div>
		</div>
	</main>
	<div/>
</body>
</html>