<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Fortnite-Stash - Admin Login</title>
	<link rel="stylesheet" href="/res/css/admin/style.css"/>
	<link rel="icon" type="image/png" href="icon-admin.ico" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</script>
</head>

<body class="page-login">
	<main class="block-login">
		<div class="logo">
			<img class="admin-logo" src="/res/images/admin/stash-logo-bw.png" alt="Fortnite Stash admin"/>
		</div>
		
		<div class="login-form">
			<form class="login" action="./" method="post">
				<div class="separator small max-width"></div>
				<div class="login-user login-input">
					<label for="user">Utilisateur</label>
					<input type="text" name="user" value="<?php echo($var['user']['input']['user']) ?>" id="user-login" placeholder="Votre identifiant"/>
				</div>
				
				<div class="separator small max-width"></div>
				
				<div class="login-password login-input">
					<label for="password">Mot de passe</label>
					<input type="password" name="password" value="<?php echo($var['user']['input']['password']) ?>" id="password-login" placeholder="Votre mot de passe"/>
				</div>
				
				<div class="submit-login">
					<input type="submit" name="login" id="submit-login" value="Login">
				</div>
				
				<div class="mt1 box-messages">
					<?php foreach ($var['messages'] as $message) { ?>
						<div class="message <?php echo($message['type']); ?>">
							<p><?php echo($message['text']); ?></p>
						</div>
					<?php } ?>
				</div>
			</form>
		</div>
	</main>
	
	<script type="text/javascript">
		
	</script>
</body>
</html>