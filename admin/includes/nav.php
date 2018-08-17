<header class="block-header">
	<div class="logo-nav">
		<img src="/res/images/admin/stash-logo-bw.png?size=64"/>
	</div>
	<div class="inner">
		<div class="titles">
			<h1>Fortnite-Stash Admin Page</h1>
			<h2>Version Site FTS-V2.1 | Version CRM V1.0</h2>
		</div>

		<div class="profile">
			<p class="user">Téo Conan</p>
			<div class="picture">
				<img src="/res/icons/account.svg?color=ffffff"/>
			</div>
			<a class="disconnect" onClick="" href="../ajax/disconnect.php">
				<img src="/res/icons/power.svg?color=444444"/>
			</a>
		</div>
	</div>
</header>

<div class="crm-content">
	<nav class="block-nav">
		<ul class="nav-list">

			<?php 
			global $context;

			$menu = $context->conf('menu');

			foreach ($menu as $i => $link) {
				if ($context->getCurrentPage() == $link['name']) {
					$isSelect = " selected ";
					$link['icon'] .= '?color=ffffff';
				} else {
					$isSelect = "";
					$link['icon'] .= '?color=78909c';
				}

			?>
			<li class="nav-item<?php echo($isSelect); ?> item-<?php echo($link['name']); ?>">
				<div class="select-bar"></div>
				<a class="nav-inner" href="<?php echo($link['link']); ?>">
					<img src="<?php echo($link['icon']); ?>" alt="<?php echo($link['label']); ?>"/>
				</a>
			</li>
			<?php } ?>
		</ul>
	</nav>