<?php

class Devise {
	
	public static function getList() {
		$query = 'SELECT idDevise, label FROM devise';
		$list = PDOBridge::getAllSQL($query);
		
		$output = array();
		foreach($list as $i => $devise){
			$output[$devise->idDevise] = $devise->label;
		}

		return($output);
	}
	
	public static function getDevise($id) {
		$query = 'SELECT label FROM devise WHERE idDevise = ' . $id;
		return(PDOBridge::getSQL($query));
	}
}

?>