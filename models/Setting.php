<?php

class Setting {
	public $setting;
	
	public $id;
	public $idValue;
	public $name;
	
	public $value;
	public $value2;
	
	public $json;
	public $status;
	
	public $start;
	public $end;
	
	public function __construct($nameId) {
		
		if (is_numeric($nameId)) {
			$w = 'idValue = ' . $nameId;
		} else {
			$w = 'name = "' . $nameId . '"';
		}
		
		$query = 'SELECT id, idValue, name, value, value2, json, status, start, end FROM setting WHERE ' . $w;
		
		$output = PDOBridge::getSQL($query);
		$this->setting = $output;
		
		$this->id = $output->id;
		$this->idValue = $output->idValue;
		$this->name = $output->name;
		
		$this->value = $output->value;
		$this->value2 = $output->value2;
		
		$this->json = $output->json;
		$this->status = $output->status;
		
		$this->start = $output->start;
		$this->end = $output->end;
		
	}
	
	public function getIds(){
		return(array(
			'id' 		=> $this->id,
			'idValue' 	=> $this->idValue,
			'name' 		=> $this->name,
		));
	}
	
	public function getTime() {
		return(array(
			$this->start,
			$this->end,
		));
	}
	
	public function getVal(){return($this->value);}
	public function getVal2(){return($this->value2);}
	
	public function getJson(){return($this->json);}
	public function getStatus(){return($this->status);}
}

?>