<?php

class User {
	
	private $debug;
	
	//Data SQL
	public $id;
	private $password;
	public $user;
	public $name;
	public $mail;
	public $type;
	public $expirate;
	public $profile;
	public $create;
	public $delete;
	
	//Data
	public $isExpirate;
	public $isConnected;
	public $isDeleted;
	
	public function __construct($filter = array()) {

		$this->debug = new Debug('User');
		if (sizeof($filter) == 0) {
			//Empty default
			$this->isConnected = false;

			$this->user = false;
			$this->password = false;
			$this->name = false;
			$this->id = false;
			$this->mail = false;
			$this->type = false;
			$this->expirate = false;
			$this->profile = false;
			$this->create = false;
		} else if (isset($filter['id'])) {
			$user = $this->getUser($filter['id']);
			$this->defineStrClass($user);
		} else if (isset($filter['user']) && isset($filter['password'])) {
			return($this->connect($filter['user'], $filter['password']));
		}
	}
	
	private function defineStrClass($user) {
		//var_dump(debug_backtrace());
		//var_dump($user);
		if (is_array($user)) {
			$this->user = $user['user'];
			$this->name = $user['name'];
			$this->id = $user['id'];
			$this->mail = $user['mail'];
			$this->type = $user['type'];
			$this->expirate = $user['expirate'];
			$this->profile = $user['img_profile'];
			$this->create = $user['utsCreate'];
			$this->utsUpdate = $user['utsUpdate'];
			$this->delete = $user['utsDelete'];
		} else {
			$this->user = $user->user;
			$this->name = $user->name;
			$this->id = $user->id;
			$this->mail = $user->mail;
			$this->type = $user->type;
			$this->expirate = $user->expirate;
			$this->profile = $user->img_profile;
			$this->create = $user->utsCreate;
			$this->utsUpdate = $user->utsUpdate;
			$this->delete = $user->utsDelete;
		}
	}
	
	public function connect($user, $password) {
				//var_dump(debug_backtrace());

		global $context;
		
		$output = "Une erreur c'est produite";
		
		$user = PDOBridge::getSQL('SELECT id, user, password, name, mail, type, expirate, img_profile, utsCreate, utsUpdate, utsDelete FROM user WHERE user = "' . $user . '" AND password = "' . $password . '"');
		
		if (!empty($user) && !empty($user->id)) {
			
			if ($user->expirate != -1 && $user->expirate < time()) {
				return('Compte expiré');
			}
			
			//Redefinition 
			$this->isConnected = true;
			
			$this->defineStrClass($user);
			
			$context->setUser($this);
			$this->debug->Slog('Connect ' . $user->user . ' to ' . $context->site . '');
			return(true);
		} else {
			$output = "Utilisateur ou mot de passe inconnue";
		}
		
		return($output);
	}
	
	//Connection par ID sans mot de passe ni user
	public function directConnect($id) {
		
	}
	
	public static function getNameOf($user) {
		//var_dump(debug_backtrace());
		//var_dump($user);
		$user = PDOBridge::getSQL('SELECT user FROM user WHERE id = "' . $user . '"');
		if (!$user) {
			return(false);
		} else {
			return($user->user);
		}
		

	}
	
	public static function getUser($user, $type = 'array') {
		if (is_numeric($user)) {
			global $context;
			$context->reconnectDB();
			//var_dump(PDOBridge::isConnected());
			$user = PDOBridge::getSQL('SELECT id, user, password, name, mail, type, expirate, img_profile, utsCreate, utsUpdate, utsDelete FROM user WHERE id = "' . $user . '"');
			
			if ($type == 'array') {
				$user = array(
					'user' => $user->user,
					'name' => $user->name,
					'id' => $user->id,
					'mail' => $user->mail,
					'type' => $user->type,
					'expirate' => $user->expirate,
					'img_profile' => $user->img_profile,
					'utsCreate' => $user->utsCreate,
					'utsDelete' => $user->utsDelete,
					'utsUpdate' => $user->utsUpdate,
				);
			}
			
			return($user);
		} else {
			die('No user ID in getUser');
		}
	}
	
	public static function newUser($data) {
		var_dump($data);
		$output = "";
		
		$set = array(
			'user' => false,
			'password' => false,
			'name' => 'user',
			'mail' => '',
			'type' => false,
			'expirate' => -1,
			'img_profile' => ''
		);
		
		foreach($set as $i => $field) {
			if (!isset($data[$i]) || empty($data[$i])) {
				if($field === false) {
					die('Missing data for new user (' . $$i . ')');
				}
				
				$data[$i] = $field;
				
				if ($i == 'name') {
					$data['name'] = $data['user'];
				}
			}
		}
		
		if ($data['expirate'] != -1 && !is_numeric($data['expirate'])) {
			
			$data['expirate'] = strtotime($data['expirate']);
			
			if (!$data['expirate']) {
				$data['expirate'] = -1;
				$output = "Mauvais format de date";
			}
		}
		
		$query = "INSERT INTO `user` (`id`, `user`, `password`, `name`, `mail`, `type`, `expirate`, `img_profile`, `utsCreate`, `utsUpdate`, `utsDelete`) VALUES (NULL, '".$data['user']."', '".$data['password']."', '".$data['name']."', '".$data['mail']."', '".$data['type']."', ".$data['expirate'].", '".$data['img_profile']."', " . time() . ", '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000')";
		
		global $context;
		$context->reconnectDB();
		$result = PDOBridge::exeSQL($query);
	}
	
	public static function getList(){
		global $context;
		
		$output = PDOBridge::getAllSQL("SELECT * FROM user");
		return($output);
	}
	
	
	public static function countUsersDB() {
		global $context;
		$context->reconnectDB();
		$output = PDOBridge::getSQL("SELECT COUNT('id') as size FROM user");
		return($output->size);
	}
}

?>