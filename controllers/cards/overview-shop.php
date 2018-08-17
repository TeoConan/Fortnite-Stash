<?php

function buildShopItem($data) {
	
	$html = "";
	foreach($data['rows'] as $row){
		$html .= "<tr>";
		
		foreach($row as $item) {
			$html .= "<td>" . $item . "</td>";
		}
		
		$html .= "</tr>";
	}
	
	$output = 
		'<li class="card-item">
			<div class="preview" style="background-image: url(' . $data['preview'] . '?size=300);"></div>
			<img class="remove" src="/res/icons/close-circle.svg?color=ffffff"/>
			<div class="legend">
				<table>
					' . $html . '
				</table> 
			</div>
		</li>';
	
	return($output);
}

$list = array(
	array(
		'preview'		=> "/res/images/skins/22.png",
		'rows'			=> array(
			array("Raven", "ID 268"),
			array("2 000 V-bucks", "Featured"),
		),
	),
	array(
		'preview'		=> "/res/images/skins/269.png",
		'rows'			=> array(
			array("Bandolier", "ID 458"),
			array("1 000 V-bucks", "Daily"),
		),
	),
	array(
		'preview'		=> "/res/images/skins/22.png",
		'rows'			=> array(
			array("Raven", "ID 268"),
			array("2 000 V-bucks", "Featured"),
		),
	),
	array(
		'preview'		=> "/res/images/skins/22.png",
		'rows'			=> array(
			array("Raven", "ID 268"),
			array("2 000 V-bucks", "Featured"),
		),
	),
	array(
		'preview'		=> "/res/images/skins/22.png",
		'rows'			=> array(
			array("Raven", "ID 268"),
			array("2 000 V-bucks", "Featured"),
		),
	),
	array(
		'preview'		=> "/res/images/skins/22.png",
		'rows'			=> array(
			array("Raven", "ID 268"),
			array("2 000 V-bucks", "Featured"),
		),
	),
	array(
		'preview'		=> "/res/images/skins/22.png",
		'rows'			=> array(
			array("Raven", "ID 268"),
			array("2 000 V-bucks", "Featured"),
		),
	),
	array(
		'preview'		=> "/res/images/skins/269.png",
		'rows'			=> array(
			array("Bandolier", "ID 458"),
			array("1 000 V-bucks", "Daily"),
		),
	),
	array(
		'preview'		=> "/res/images/skins/22.png",
		'rows'			=> array(
			array("Raven", "ID 268"),
			array("2 000 V-bucks", "Featured"),
		),
	),
	array(
		'preview'		=> "/res/images/skins/22.png",
		'rows'			=> array(
			array("Raven", "ID 268"),
			array("2 000 V-bucks", "Featured"),
		),
	),
	array(
		'preview'		=> "/res/images/skins/22.png",
		'rows'			=> array(
			array("Raven", "ID 268"),
			array("2 000 V-bucks", "Featured"),
		),
	),
);

$card = array(
	'icon'		=> "/res/icons/calendar.svg",
	'name'		=> "shop",
	'class'		=> "shop",
	'title'		=> "Shop du jour",
	'subtitle'	=> "18 items",
	'secondary'	=> "<p>Daily : 5h28m55s</p><p>Featured : 25h38m05s</p>",
	'inner'		=> false,
);

?>

<style>
	.card-shop {
		width: auto;
		min-width: 400px;
		height: 370px;
	}
	
	.shop-list {
		display: flex;
		overflow-x: auto;
		max-width: 100%;
	}
	
	.shop-list > .card-item {
		min-height: 300px;
		min-width: 200px;
		background: linear-gradient(to bottom right, #37474f, #b0bec5);
		position: relative;
	}
	
	.shop-list > .card-item > .preview {
		background-repeat: no-repeat;
		background-position: center;
		background-size: cover;
		position: absolute;
		height: 100%;
		width: 100%;
		top: 0;
		left: 0;
	}
	
	.shop-list > .card-item > .remove {
		position: absolute;
		right: 0;
		padding: 10px;
		top: 0;
		cursor: pointer;
	}
	
	.shop-list > .card-item > .legend {
		position: absolute;
		bottom: 0;
		width: 100%;
		box-sizing: border-box;
		padding: 10px;
		background-color: rgba(0,0,0,0.50);
	}
	
	.shop-list table, .shop-list tbody, .shop-list tr {
		width: 100%;
	}
	
	.shop-list .legend > table > tbody > tr > td:last-child {
		text-align: right;
	}
	
	.shop-list td {
		font-family: Myriad Pro, sans-serif;
		color: white;
		font-size: 0.75rem;
	}

</style>

<ul class="shop-list">
	<?php

	foreach($list as $i => $item) {
		echo(buildShopItem($item));
	}

	?>
</ul>