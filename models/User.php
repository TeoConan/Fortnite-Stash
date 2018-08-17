<?php

class User {
	
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
		//var_dump(debug_backtrace());
		//var_dump($filter);
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
			//var_dump("Direct connect");
			$user = $this->getUser($filter['id']);
			//var_dump($user);
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
			//Redefinition 
			$this->isConnected = true;
			
			$this->defineStrClass($user);
			
			$context->setUser($this);
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
		}
	}
}

?>