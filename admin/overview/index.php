<?php

require '../../lib/autoloader.php';
Autoloader::register();

$context = Context::check();
if ($context === false || !isset($_SESSION['idUser'])) {
	//var_dump($_SESSION);
	header("Location: " . Context::ADMIN_URL . '?e=unconnected');
	
	$context = unserialize($_SESSION['context']);
	//var_dump($context);
	die('Unconnected');
}

$context->setCurrentPage('overview');
$user = new User(array('id' =>$_SESSION['idUser']));
$context->setUser($user);




?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Fortnite-Stash - Accueil Admin</title>
		<link rel="stylesheet" href="/res/css/admin/style.css"/>
		<link rel="icon" type="image/png" href="../icon-admin.ico" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
			
			var ajaxPath = '../ajax/';
			
			requestAndSet( ajaxPath + 'storage/sizeCache.php', 'StatCache');
			requestAndSet( ajaxPath + 'storage/sizeFiles.php', 'StatFiles');
			requestAndSet( ajaxPath + 'storage/sizeDB.php', 'StatDB');
			requestAndSet( ajaxPath + 'storage/countImages.php', 'StatImages');
			requestAndSet( ajaxPath + 'storage/countSkins.php', 'StatSkins');
			requestAndSet( ajaxPath + 'storage/countUsers.php', 'StatUsers');
			
			requestAndSet(ajaxPath + 'web/month.php', 'StatMonthVisitors');
			requestAndSet(ajaxPath + 'web/visitors.php', 'StatVisitors');
			
			requestAndSet(ajaxPath + 'messages/countAlerts.php', 'StatAlerts');
			requestAndSet(ajaxPath + 'messages/countMessages.php', 'StatMessages');
			
			$("#delCache").click(function() {
				$.ajax({
					url : '../ajax/storage/delCache.php',
					type : 'GET',
					
					success : function(code_html, statut) {
						$('#delCache').text('Cache vidé');
						$('#StatCache').text('0 Ko');
					},
					
					error : function(result, statut, error) {
						console.error(result + ' / status ' + statut + ' : ' + error);
					},
				})
			});
			
			$("switchSite").click(function() {
				
			});
			
			function switchSite() {
				
			}
			
			function requestAndSet(link, id) {
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