<?php

/**
 * Class Autoloader
 */
class Autoloader{

    /**
     * Enregistre notre autoloader
     */
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Inclue le fichier correspondant à notre classe
     * @param $class string Le nom de la classe à charger
     */
    static function autoload($class){
		
		$folders = array(
			'models/',
			'lib/',
			'lib/Debug/',
			'lib/Utilities/',
			'system/',
		);
		
		foreach($folders as $i => $folder) {
			$path = "D:/xampp/htdocs/fortnite-stash.local/" . $folder . $class . '.php';
			//var_dump('Checking ' . $path . ' from ' . getcwd());
			if (file_exists($path)) {
				require $path;
			}
		}
    }

}

?>