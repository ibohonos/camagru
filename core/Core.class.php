<?php

class Core
{
	public function ft_run()
	{
		self::ft_init();
		self::ft_autoload();
		self::ft_dispatch();
		Route::start();
	}

	private function ft_init()
	{
		define("DS", DIRECTORY_SEPARATOR);
		define("ROOT", getcwd() . DS);
		define("APP_PATH", ROOT . 'app' . DS);
		define("CORE_PATH", ROOT . "core" . DS);
		define("PUBLIC_PATH", ROOT . "public" . DS);
		define("CONFIG_PATH", ROOT . "config" . DS);
		define("CONTROLLER_PATH", APP_PATH . "controllers" . DS);
		define("MODEL_PATH", APP_PATH . "models" . DS);
		define("VIEW_PATH", APP_PATH . "views" . DS);
		define("UPLOAD_PATH", PUBLIC_PATH . "uploads" . DS);
		// define("PLATFORM", isset($_REQUEST['p']) ? $_REQUEST['p'] : 'home');
		define("CONTROLLER", isset($_REQUEST['c']) ? $_REQUEST['c'] : 'Home');
		define("ACTION", isset($_REQUEST['a']) ? $_REQUEST['a'] : 'index');
		// define("CURR_CONTROLLER_PATH", CONTROLLER_PATH . PLATFORM . DS);
		// define("CURR_VIEW_PATH", VIEW_PATH . PLATFORM . DS);

		require CORE_PATH . "Model.class.php";
		require CORE_PATH . "View.class.php";
		require CORE_PATH . "Controller.class.php";
		require CORE_PATH . "Route.class.php";

		$GLOBALS['config'] = include CONFIG_PATH . "database.php";
		session_start();
	}

	private function ft_autoload()
	{
		spl_autoload_register(function ($class) {
			self::ft_load($class);
		});
	}

	private function ft_load($class)
	{
		if (substr($class, -10) == "Controller") :
			require CONTROLLER_PATH . $class . ".php";
		elseif (substr($class, -5) == "Model") :
			require MODEL_PATH . $class . ".php";
		endif;
	}

	private function ft_dispatch()
	{
		$controller = new CONTROLLER;
		$controller->ACTION;
	}
}