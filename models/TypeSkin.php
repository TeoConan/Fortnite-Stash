<?php

class TypeSkin {
	
	public static function getList($trad = "") {
		
		if (!empty($trad)) {
			$trad = ', ' . $trad;
		}
		
		$query = 'SELECT idType, label' . $trad .' FROM type';
		$list = PDOBridge::getAllSQL($query);
		
		$output = array();
		foreach($list as $i => $type){
			$output[$type->idType] = $type;
		}

		return($output);
	}
	
	public static function getType($id, $trad = "") {
		if (empty($trad)) {
			$trad = "label";
		}
		
		$query = 'SELECT ' . $trad . ' FROM type';
		return(PDOBridge::getSQL($query));
	}
}

?>