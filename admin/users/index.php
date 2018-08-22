<?php

require '../../lib/autoloader.php';
Autoloader::register();

$context = Context::check();
if ($context === false || !isset($_SESSION['idUser'])) {
	header("Location: ./");
}

$context->setCurrentPage('users');
$user = new User(array('id' =>$_SESSION['idUser']));
$context->setUser($user);


//include("../../controllers/cards/users-add.php");

?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Fortnite-Stash - Users</title>
	<link rel="stylesheet" href="/res/css/admin/style.css"/>
	<link rel="icon" type="image/png" href="../icon-admin.ico" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<body class="page page-skin-manager">

	<?php include('../includes/nav.php'); ?>
	
	<main class="block-main">
		<div class="inner">
			<div class="col col-5">
				<?php  new Card('users-edit'); ?>
				<?php  new Card('users-add'); ?>
			</div>
			<div class="col">
				<?php  new Card('users-list'); ?>
			</div>
		</div>
	</main>
	<div/>
</body>
</html>