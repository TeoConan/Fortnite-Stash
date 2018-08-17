<?php

require '../../lib/autoloader.php';
Autoloader::register();

$context = Context::check();
if ($context === false || !isset($_SESSION['idUser'])) {
	//var_dump($_SESSION);
	//header("Location: " . Context::ADMIN_URL);
	
	$context = unserialize($_SESSION['context']);
	//var_dump($context);
	die('Unconnected');
}
//var_dump($_SESSION);
$context->setCurrentPage('overview');
//var_dump($_SESSION);
$user = new User(array('id' =>$_SESSION['idUser']));
//var_dump($_SESSION);
//var_dump($user);
$context->setUser($user);
//var_dump($_SESSION);

//$context->printContext();
//var_dump($context);


?>



<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Fortnite-Stash - Accueil Admin</title>
		<link rel="stylesheet" href="/res/css/admin/style.css"/>
		<link rel="icon" type="image/png" href="../icon-admin.ico" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		</script>
	</head>

	<body class="page page-overview">

		<?php include('../includes/nav.php'); ?>

		<main class="block-main">
			<div class="inner">
				<div class="col">
					<div class="row">
		

						<?php
							new Card('overview-new-skins');

							new Card('overview-web');

							new Card('overview-storage');

							new Card('overview-alerts');
						?>
					</div>

					<div class="row mt1">

						<?php
							new Card('overview-shop');
						?>

					</div>
				</div>
		</main>

		<script type="text/javascript">
			
			//storageStat('../ajax/storage/sizeCache.php', 'StatCache');
			//storageStat('../ajax/storage/sizeFiles.php', 'StatFiles');
			//storageStat('../ajax/storage/sizeDB.php', 'StatDB');
			
			function storageStat(link, id) {
				$.ajax({
				   	url : link,
					type : 'GET',
					
					success : function(code_html, statut) {
						$('#' + id).text(code_html);
					},
					
					error : function(result, statut, error) {
						console.error(result + ' / status ' + statut + ' : ' + error);
					},
				});
			}
		</script>
	</body>
</html>