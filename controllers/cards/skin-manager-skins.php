<?php

function getItem($item) {
	$output = '
	<tr>
		<td class="name">' . $item['name'] . '</td>
		<td><div class="tag"><p>' . $item['type'] . '</p></div></td>
		<td>' . $item['price'] . '</td>
		<td><div class="tag"><p>' . $item['rarity'] . '</p></div></td>
		<td><div class="table-separator"></div></td>
		<td class="shop-icon">' . $item['icons'] . '</td>
		<td><div class="preview"><img src="' . $item['preview'] . '?size=50"/></div></td>
	</tr>
	';
	
	return($output);
}

$list = array();
$skins = Skin::getList();

$devises = Devise::getList();
$types = TypeSkin::getList('trad_fr');
$rarities = Rarity::getList();

foreach($skins as $skin) {
	
	$season = "";
	if (isset($skin->season)) {
		$season = ' (S' . $skin->season . ')';
	}
	
	
	
	$list[] = array(
		'name'	=> $skin->name,
		'type'	=> $types[$skin->type]->trad_fr,
		'price'	=> $skin->price . ' ' . $devises[$skin->devise] . $season,
		'rarity'=> $rarities[$skin->rarity]->trad_fr,
		'icons'	=> "",
		'preview'	=> '/res/images/skins/' . $skin->img_default,
	);
}

$card = array(
	'icon'		=> "/res/icons/tie.svg",
	'name'		=> "Skins",
	'class'		=> "list-skins",
	'title'		=> "Liste des skins",
	'secondary'	=> '<div class="button circle" onClick=""><img src="/res/icons/plus-circle.svg?color=ffffff"/></div>',
);

?>

<style>

	.card-list-skins {
		width: 800px;
		max-height: 700px;
	}
	
	.card-list-skins .card-body > .inner {
		padding: 1.5rem;
	}
	
	.card-list-skins .search > .inner {
		display: flex;
		border-bottom: 2px solid #cccccc;
	}
	
	.card-list-skins .search input {
		flex-grow: 1;
		border: none;
		height: 1.5rem;
		padding: 0.5rem 0 0.5rem 0.66rem;
		font-family: Myriad Pro;
		font-size: 1rem;
	}
	
	.card-list-skins .list-skins {
		max-width: 100%;
		width: 100%;
		margin-top: 2rem;
		font-family: Myriad Pro, sans-serif;
	}
	
	.card-list-skins .list-skins td {
		height: 3rem;
		text-align: center;
		justify-content: center;
	}
	
	.card-list-skins .list-skins .name {
		font-weight: 600;
		font-size: 1.15rem;
	}
	
	.card-list-skins .list-skins .table-separator {
		width: 2px;
		height: 70%;
		background-color: #626262;
	}
	
	.card-list-skins .list-skins .preview {
		border-radius: 50%;
		background-color: white;
		height: 50px;
		width: 50px;
		margin: auto;
	}
	
	.card-list-skins .list-skins .shop-icon {
		display: flex;
	}
	
	.card-list-skins .list-skins .shop-icon > img {
		margin: auto 10px;
	}
	
	.card-list-skins .list-skins .preview > img {
		height: 50px;
		width: 50px;
	}
	
</style>

<div class="search">
	<div class="inner">
		<img class="ml1" src="/res/icons/magnify.svg"/>
		<input type="text" id="skin-search" placeholder="Rechercher" value=""/>
	</div>
	
	<p class="result mt1" id="nbrResult"><?php echo(sizeof($list)); ?> résultats</p>
</div>

<table class="list-skins">
	<tbody>
		<?php
		foreach ($list as $item) {
			echo(getItem($item));
		}
		?>
	</tbody>
</table>