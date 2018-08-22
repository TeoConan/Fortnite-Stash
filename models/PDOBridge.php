<?php

class PDOBridge
{
	public static $link;
	public static $db_connexion;
	public static $host_info;
	public static $dbh;
	
	//CONNECTION
	
	//Connection /!\ à faire en premier pour pouvoir utiliser le PDO
	public static function connectDB($host, $user, $password, $db){
		//var_dump(debug_backtrace());
		
		if (empty($user) || empty($passord)) {
			include(Context::ROOT . 'system/db.php');
			$user = $db_admin['user'];
			$password = $db_admin['password'];
		}
		self::$link = new PDO('mysql:host=' . $host . ';dbname=' . $db, $user, $password);
		
		self::$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		self::$link->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'UTF-8'");
		self::$link->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		
		//var_dump(self::$link);
		return(self::$link);
	}
	
	public static function getConnexion(){
		return(self::$link);
	}
	
	public static function isConnected(){
		if (!empty(self::$link)){
			return(true);
		}
		return(false);
	}
	
	//SQL
	
	//Inserer une ligne
	public static function insertSQL($table, $cln, $value) {
			$query = 'INSERT INTO `' . $table . '` (' . $cln . ') VALUE (' . $value . ')';
			return (self::exeSQL($query));
	}
	
	//Obtenir un array d'objects de la BDD
	public static function getAllSQL($query) {
		$selector = self::returnSQL($query);
		$output = array();
		
		while( $obj = $selector->fetch() ) {
			$output[] = $obj;
		}
		return($output);
	}
	
	
	//Obtenir 1 object de la BDD
	//Si plusieur elements existe seulement le 1er sera retourné
	public static function getSQL($query) {
		$output = self::returnSQL($query);
		return($output->fetch());
	}
	
	
	//Executer en brut une requete select
	//Retourne le selector PDO
	public static function returnSQL($query){
		global $context;
		if (!empty($context) && empty(self::$link)) {
			$context->reconnectDB();
		}
		
		$selector = self::$link->query($query);
		return $selector;
	}
	
	//Executer une requete SQL
	public static function exeSQL($query){
		//echo $query;
		return (self::$link->query($query));
	}
	
	//Mettre à jour la BDD
	public static function updateSQL($table, $id, $cln){
		$query = "UPDATE `" . $table . "` SET " . $cln . " WHERE `" . $table . "`.`id` = " . $id . ";";
		
		
		//$query = "UPDATE `user` SET `img_present` = 'sfbdg,h;jkvf', `img_banner` = 'fbdg,h;jkedr', `adresse` = 'sfdgbdfnh,jre', `user_name` = 'dfvergbnth,yjk;ve', `user_firstname` = 'vfegbr,tjhyuve', `user_mail` = 'dcfvgbrhnty,juk;rev', `user_password` = 'd fghjklre' WHERE `user`.`id` = 4;";
		return(self::exeSQL($query));
	}
}

?>