<?php

class Rarity {
	
	public static function getList() {
		
		$query = 'SELECT * FROM rarity';
		$list = PDOBridge::getAllSQL($query);
		
		$output = array();
		foreach($list as $i => $rarity){
			$rarity->trad_fr = utf8_encode($rarity->trad_fr);
			$output[$rarity->idRarity] = $rarity;
			
		}

		return($output);
	}
	
	public static function getType($id) {
		
		$query = 'SELECT * FROM rarity';
		return(PDOBridge::getSQL($query));
	}
}

?>