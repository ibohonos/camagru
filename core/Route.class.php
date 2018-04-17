<?php

class Route
{
	public static function start()
	{
		$controller_name = 'HomeController';
		$action_name = 'index';

		$routes = explode('/', $_SERVER['REQUEST_URI']);

		// получаем имя контроллера
		if (!empty($routes[1])) :
			$controller_name = $routes[1];
		endif;

		// получаем имя экшена
		if (!empty($routes[2])) :
			$action_name = $routes[2];
		endif;

		// добавляем префиксы
		$model_name = $controller_name . "Model";
		$controller_name = $controller_name . "Controller";
		$action_name = $action_name . "Action";

		// подцепляем файл с классом модели (файла модели может и не быть)

		$model_file = strtolower($model_name).'.php';
		$model_path = MODEL_PATH . $model_name . ".php";
		if(file_exists($model_path)) :
			include $model_path;
		endif;

		// подцепляем файл с классом контроллера
		// $controller_file = strtolower($controller_name).'.php';
		$controller_path = CONTROLLER_PATH . $controller_file . ".php";
		if(file_exists($controller_path)) :
			include $controller_path;
		else :
			self::ErrorPage404();
		endif;

		$controller = new $controller_name;
		$action = $action_name;
		
		if(method_exists($controller, $action)) :
			$controller->$action();
		else :
			Route::ErrorPage404();
		endif;
	}

	function ErrorPage404()
	{
		$host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
		header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:' . $host . '404');
	}
}