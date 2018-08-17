<?php

function getItem($item) {
	$output = '
		<tr>
			<td class="name">' . $item['name'] . '</td>
			<td>Créé le ' . $item['date'] . '</td>
			<td><div class="tag"><p>' . $item['type'] . '</p></div></td>
			<td><div class="preview"><img src="' . $item['preview'] . '?size=50"/></div></td>
		</tr>
	';
	
	return($output);
}

$list = array(
	array(
		'name'	=> 'Téo Conan',
		'type'	=> 'Administrateur',
		'date'	=> '07/08/2018',
		'preview'	=> '/res/images/profiles/755.png'
	),
);

$card = array(
	'icon'		=> "/res/icons/account.svg",
	'name'		=> "Users",
	'class'		=> "list-users",
	'title'		=> "Liste des utilisateurs",
);

?>

<style>

	.card-list-users {
		width: 800px;
		max-height: 700px;
	}
	
	.card-list-users .card-body > .inner {
	}
	
	.card-list-users .list-users {
		max-width: 100%;
		width: 100%;
		font-family: Myriad Pro, sans-serif;
	}
	
	.card-list-users .list-users tr {
		padding: 1rem 0;
		cursor: pointer;
	}
	
	.card-list-users .list-users td {
		height: 5rem;
		text-align: center;
		justify-content: center;
	}
	
	.card-list-users .list-users .name {
		font-weight: 600;
		font-size: 1.15rem;
	}
	
	.card-list-users .list-users .table-separator {
		width: 2px;
		height: 70%;
		background-color: #626262;
	}
	
	.card-list-users .list-users .preview {
		overflow: hidden;
		border-radius: 50%;
		background-color: white;
		height: 50px;
		width: 50px;
		margin: auto;
	}
	
	.card-list-users .list-users .shop-icon {
		display: flex;
	}
	
	.card-list-users .list-users .shop-icon > img {
		margin: auto 10px;
	}
	
	.card-list-users .list-users .preview > img {
		height: 50px;
		width: 50px;
	}
	
</style>

<table class="list-users">
	<tbody>
		<?php
		foreach ($list as $item) {
			echo(getItem($item));
		}
		?>
		<tr>
			<td class="name">Téo Conan</td>
			<td>Créé le 07/08/2018</td>
			<td><div class="tag"><p>Administrateur</p></div></td>
			<td><div class="preview"><img src="/res/images/profiles/755.png"/></div></td>
		</tr>
	</tbody>
</table>