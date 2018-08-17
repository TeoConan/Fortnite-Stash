<?php

$css = '
	
';

$card = array(
	'icon'		=> "/res/icons/web.svg",
	'name'		=> "Fortnite-Stash.com",
	'class'		=> "web mba",
	'title'		=> "Fortnite-Stash.com",
	'css'		=> $css,
	
);

?>

<style>
	.card-web {
		width: 345px;
	}
	
	.card-web .visits, .card-web .visits-month {
		text-align: center;
		padding: 0.75rem;
	}
	
	.card-web .card-body > .inner {
		padding: 0.75rem 0;
		background-image: url(/res/images/admin/stash-background.jpg);
		background-repeat: no-repeat;
		background-position: left;
		background-size: cover;
	}
	
	.card-web .web-switch {
		display: flex;
		margin-top: 1rem;
		margin-bottom: 0.75rem;
	}
	
	.card-web .web-switch > .button {margin: auto;}
</style>


			<div class="visits">
				<p class="text big white">12 058</p>
				<p class="text white">Visites total</p>
			</div>

			<div class="visits-month">
				<p class="text big white">6 020</p>
				<p class="text white">Visites du mois</p>
			</div>

			<div class="web-switch">
				<div class="button green">
					<span>Site On Air</span>
				</div>
			</div>