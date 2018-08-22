<?php
global $context;

$site = new Setting('SiteVersion');
$crm = new Setting('CRMVersion');

$user = $context->getUser();

$img = "/res/icons/account.svg?color=ffffff";
$classimg = " default ";

if (!empty($user->profile)) {
	$img = '/res/images/profiles/' . $user->profile . '?size=40';
	$classimg = "";
}

?>

<header class="block-header">
	<div class="logo-nav">
		<img src="/res/images/admin/stash-logo-bw.png?size=64"/>
	</div>
	<div class="inner">
		<div class="titles">
			<h1>Fortnite-Stash Admin Page</h1>
			<h2>Version Site <?php echo($site->getVal()); ?> | Version CRM <?php echo($crm->getVal()); ?></h2>
		</div>

		<div class="profile">
			<p class="user"><?php echo($user->name); ?></p>
			<div class="picture">
				<img class="<?php echo($classimg); ?>" src="<?php echo($img); ?>"/>
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