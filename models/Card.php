<?php

class Card {
	
	private $externalHtml;
	private $innerHtml;
	private $file;
	private $path;
	private $card;
	private $controllers = Context::ROOT . 'controllers/cards/';
	private $debug;
	
	//Conf
	private $icon;				//Icone de la card
	public $title;				//Titre simple
	public $subtitle;			//SousTitre simple
	public $innerTitle;			//HTML titre, utilisé si $title est vide
	public $inner;				//Inner body (bool)
	public $css;
	public $list;				//List à intégrer
	public $body;
	public $secondary;			//Partie header secondaire
	
	public $height;				//Hauteur de la carte
	public $width;				//Largeur de la carte
	public $minheight;			//
	public $minwidth;			//
	
	
	public function __construct($file, $echo = true) {
		//include('../controllers/cards/overview-web.php');
		//include('../controllers/cards/overview-storage.php');
		$this->debug = new Debug('Card Model');
		//$this->debug->log('New Card ' . $file);
		//var_dump('Class Card');
		
		$this->path = $this->controllers . $file . '.php';
		$path = $this->path;
		//var_dump($path);
		if (!file_exists($path)) {
			var_dump('File not found');
			$this->debug->log('File not found');
			return(false);
		}
		
		ob_start();
		include($path);
		$this->innerHtml = ob_get_contents();
		ob_end_clean();
		//var_dump($this->innerHtml);
		
		if (!isset($card)) {
			var_dump('Card var not found');
			$this->debug->log('Card var not found');
		}
		
		//CSS
		$css = "";
		if (!empty($card['css'])) {
			$this->css = $card['css'];
		}
		
		if (!empty($this->css) && $this->css != "") {
			$css = '<style>' . $this->css . '</style>';
		}
		
		//Icon
		if (!empty($card['icon'])) {
			$this->icon = $card['icon'];
		}
		
		if (!empty($this->icon)) {
			$icon = $this->icon;
		}
		
		//Title
		if (isset($card['title'])) {
			$this->title = $card['title'];
		}
		
		if (!empty($this->title)) {
			$title = '<p>' . $this->title . '</p>';
		}
		
		//SubTitle
		$subtitle = "";
		if (isset($card['subtitle'])) {
			$this->subtitle = $card['subtitle'];
		}
		
		if (!empty($this->subtitle)) {
			$subtitle = '<p>' . $this->subtitle . '</p>';
		}
		
		//Inner title
		if (!empty($card['innerTitle'])) {
			$this->innerTitle = $card['innerTitle'];
		}
		
		if (!empty($this->innerTitle)) {
			$title = $this->innerTitle;
		}
		
		if (!empty($card['innerTitle'])) {
			$this->innerTitle = $card['innerTitle'];
		}
		
		if (!empty($this->innerTitle)) {
			$title = $this->innerTitle;
		}
		
		//Secondary
		$secondary = "";
		if (isset($card['secondary'])) {
			$this->secondary = $card['secondary'];
		}
		
		if (!empty($this->secondary)) {
			$secondary = '<div class="secondary">' . $this->secondary . '</div>';
		}
		
		//List
		$list = "";
		if (!empty($card['list'])) {
			$this->list = $card['list'];
		}
		
		if (!empty($this->list)) {
			$list = $this->buildList($this->list);
		}
		
		//Inner
		if (!isset($card['inner'])) {
			$this->inner = true;
		}
		
		
		//Sizes
		$style = ' style="';
		if (isset($card['dimensions'])) {
			
			if (!empty($card['dimensions']['height'])) {$this->height = $card['dimensions']['height']; $style .= 'height : ' . $this->height . ';';}
			if (!empty($card['dimensions']['width'])) {$this->width = $card['dimensions']['width']; $style .= 'width : ' . $this->width . ';';}
			if (!empty($card['dimensions']['minheight'])) {$this->minheight = $card['dimensions']['height']; $style .= 'minheight : ' . $this->minheight . ';';}
			if (!empty($card['dimensions']['minwidth'])) {$this->minwidth = $card['dimensions']['minwidth']; $style .= 'minwidth : ' . $this->minwidth . ';';}
			
		}
		$style .= '" ';
		
		$this->externalHtml = '
		<!-- Card ' . $card['name'] . ' -->
		' . $css . '
		<div class="card card-'. $card['class'] .'"' . $style . '>
			<div class="card-header">
				<div class="icon">
					<img src="' . $this->icon . '?color=ffffff"/>
				</div>

				<div class="title">
					' . $title . '
					' . $subtitle . '
				</div>
				
				' . $secondary . '
			</div>

			<div class="card-body">
				' . (($this->inner) ? '<div class="inner">' : '') . '
					' . $this->innerHtml . '
					' . $list . '
				' . (($this->inner) ? '</div>' : '') . '
			</div>
		</div>
		';
		
		if ($echo){
			echo($this->externalHtml);
		}
		return($this->externalHtml);

	}
	
	private function buildList($list) {
		
			
		if (!is_array($list) || empty($list) || sizeof($list) == 0){
			return(false);
		}
		
		$nbrCells = 0;
		
		if (is_array($list[0])) {
			$nbrCells = sizeof($list[0]);
		} else {
			$nbrCells = 1;
		}
		
		$output = array();
		
		foreach($list as $i => $item){
			$html = '
			<li class="card-item">
				<div class="inner">
			';
			
			foreach ($item as $c => $cell) {
				$html .= '<div class="cell">';

				if (StringUtil::is_html($cell)) {
					$html .= $cell;
				} else {
					$html .= "<p>" . $cell . "</p>";
				}

				$html .= "</div>";
			}
			
			$html .= "</div></li>";
			$output[$i] = $html;
		}
		
		$list = '<ul class="card-list list-' . $nbrCells . '">';
		foreach($output as $item) {
			$list .= $item;
		}
		$list .= '</ul>';
		
		return($list);
	}

}

?>