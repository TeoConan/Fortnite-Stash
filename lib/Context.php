<?php

class Context {
	
	const ROOT = "D:/xampp/htdocs/fortnite-stash.local/";
	const ADMIN_URL = "http://admin.fortnite-stash.local/";
	const WWW_URL = "http://www.fortnite-stash.local/";
	const STR_SITE = "fortnite-stash.local";
	
	const UTILITIES = "D:/xampp/htdocs/fortnite-stash.local/lib/Utilities/";
	const IMG_CACHE = "D:/xampp/htdocs/fortnite-stash.local/cache/images/";
	const CACHE = "D:/xampp/htdocs/fortnite-stash.local/cache/";
	
	const RES_SKINS = "D:/xampp/htdocs/fortnite-stash.local/res/images/skins/";
	const RES_PROFILES = "D:/xampp/htdocs/fortnite-stash.local/res/images/profiles/";
	
	private $connected = false;
	private $user = false;
	private $typeDBConnect = false;
	private $conf = false;
	public $site = false;
	public $debug = false;
	
	
	public function __construct($site) {
		$this->debug = new Debug('Context');
		$this->connectDB('visitor');
		$this->site = $site;
		
		if (session_status() != PHP_SESSION_NONE && isset($_SESSION)) {
			session_destroy();
		}
		
		session_start();
		
		self::defineConst();
		$this->loadConf();
		
		self::save($this);
	}
	
	
	//Pour définir les constantes
	public static function defineConst () {
		//Const
		if (!defined('ROOT')) {
    		define('ROOT', self::ROOT);
		}
		
		if (!defined('WWW_URL')) {
    		define('WWW_URL', self::WWW_URL);
		}
		
		if (!defined('ADMIN_URL')) {
    		define('ADMIN_URL', self::ADMIN_URL);
		}
		
		if (!defined('UTILITIES')) {
    		define('UTILITIES', self::UTILITIES);
		}
		
		if (!defined('IMG_CACHE')) {
    		define('IMG_CACHE', self::IMG_CACHE);
		}
	}
	
	public function loadConf(){
		
		include(ROOT . '/conf/config.php');
		
		if ($this->site !== false) {
			include(ROOT . '/conf/' . $this->site . '/config.php');
			include(ROOT . '/conf/' . $this->site . '/menu.php');
			$config['menu'] = $menu;
		}
		
		$this->conf = $config;
	}
	
	public function printContext(){
		var_dump(debug_backtrace());
		var_dump('connected : ' . $this->connected);
		var_dump('site : ' . $this->site);
		var_dump($this->conf);
		var_dump($this->user);
		var_dump($this->typeDBConnect);
		var_dump($this);
	}
	
	public function connectDB($type) {
		$connect = null;
		$this->typeDBConnect = $type;
		
		include(self::ROOT . "system/db.php");
		//var_dump($db_admin);
		//var_dump($db_root);
		//var_dump($db_visitor);
		switch ($type) {
			case 'admin':
				$connect = $db_admin;
				break;
			case 'root':
				$connect = $db_root;
				break;
			case 'visitor':
				$connect = $db_visitor;
				break;
			case 'www':
				$connect = $db_www;
				break;
			case 'test':
				$connect = $db_test;
				break;
		}
		
		$result = PDOBridge::connectDB($db_host, $connect['user'], $connect['password'], $db_name);
		return($result);
	}
	
	public function reconnectDB() {
		if (!empty($this->typeDBConnect)) {
			$this->connectDB($this->typeDBConnect);
		}
		
	}
	
	public function conf($index = null) {
		if ($index !== null) {
			if (isset($this->conf[$index])) {
				return($this->conf[$index]);
			} else {
				return(null);
			}
		} else {
			return($this->conf);
		}
	}
	
	public function setCurrentPage($page) {
		$this->conf['context']['currentPage'] = $page;
	}
	
	public function getCurrentPage(){return($this->conf['context']['currentPage']);}
	
	public function setUser($user) {
		$this->user = $user;
		$_SESSION['idUser'] = $user->id;
		$this->connectDB($user->type);
	}
	
	public static function getUserId() {
		if (!isset($_SESSION['idUser'])) {
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
				
				if (isset($_SESSION['idUser'])) {
					return($_SESSION['idUser']);
				} else {
					die('No idUser');
				}
				
			}
		} else {
			return($_SESSION['idUser']);
		}	
	}
	
	public function getUser() {
		if (empty($this->user)) {
			if (isset($_SESSION['idUser'])) {
				$this->user = new User(array('id' => $_SESSION['idUser']));
				return($this->user);
			}
		} else {
			return($this->user);
		}
	}
	
	public function isConnected(){return($this->connected);}
	
	public function userConnected(){		
		if (isset($_SESSION['idUser'])) {
			$user = new User(array('id' =>$_SESSION['idUser']));
			$this->setUser($user);
		}
		
		if (is_numeric($this->user->id)) {
			return(true);
		}
		return(false);
	}
	
	public function getTypeConnect(){return($this->typeDBConnect);}

	public function disconnect(){
		$this->debug->Slog('Disconnect ' . $_SESSION['idUser'] . ' to ' . $this->site . '');
		$_SESSION['idUser'] = -1;
		$this->connected = false;
		session_destroy();
		echo('Disconnected');
		header('Location: ' . self::ADMIN_URL);
	}
	
	//Vérifier si le context est present
	public static function check($create = false, $site = false) {
		global $context;
		
		if (session_status() == PHP_SESSION_NONE && !isset($context)) {
			if ($create) {
				$context = new Context($site);
				$_SESSION['context'] = serialize($context);
				return($context);
			}
			
			session_start();
			if (isset($_SESSION['context'])) {
				$context = unserialize($_SESSION['context']);
				return($context);
			}
			
    		return(false);
		} else if ($context != null && isset($_SESSION) && isset($_SESSION['idUser'])) {
			$context->setUser($_SESSION['idUser']);
			return(true);
		}
		
		return(false);
	}
	
	public static function getContext() {
		global $context;
		
		if (isset($context)) {
			return($context);
		} else {
			if (session_status() != PHP_SESSION_NONE && isset($_SESSION['context'])) {
				
			} else {
				session_start();
			}
			
			return(unserialize($_SESSION['context']));
		}
		
	}
	
	public static function save($context = null) {
		if ($context == null) {
			global $context;
		}
		
		if ($context != null) {
			$_SESSION['context'] = serialize($context);
			return(true);
		} else {
			return(false);
		}
	}
	
	
}

?>