<?php

class Core
{
	public static function ft_run()
	{
		self::ft_init();
		self::ft_autoload();
		self::ft_dispatch();
	}

	private static function ft_init()
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

		$GLOBALS['config'] = include CONFIG_PATH . "config.php";
		session_start();
	}

	private static function ft_autoload()
	{
		spl_autoload_register(array(__CLASS__, 'ft_load'));
	}

	private static function ft_load($class)
	{
		if (substr($class, -10) == "Controller") :
			require CONTROLLER_PATH . $class . ".php";
		elseif (substr($class, -5) == "Model") :
			require MODEL_PATH . $class . ".php";
		endif;
	}

	private static function ft_dispatch()
	{
		$controller_name = CONTROLLER . "Controller";
		$action_name = ACTION . "Action";
		$controller = new $controller_name;
		// $controller->$action_name();
	}



	// protected $data;
	// private $content;

	// public function __construct(array $views)
	// {
	// 	$this->loadView($views);
	// }

	// protected function getData(): array {
	// 	return $this->data;
	// }

	// protected function loadView(array $views) {
	// 	ob_start();
	// 	$data = $this->getData();
	// 	foreach ($views as $view) {
	// 		include $view;
	// 	}
	// 	$content = ob_get_contents();
	// 	ob_end_clean();
	// 	$this->content = $content;
	// }

	// public function out() : string {
	// 	return $this->content;
	// }
}