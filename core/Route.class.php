<?php

class Route
{
	public static function start()
	{
		$controller_name = 'Home';
		$action_name = 'index';

		$gets = explode("?", $_SERVER['REQUEST_URI']);
		$routes = explode('/', $gets[0]);

		$method = $_SERVER['REQUEST_METHOD'];

		if ($method == 'POST') {
			if ($_POST) {
				$post = $_POST;
			} else {
				$post = $_FILES;
			}
		}

		// получаем имя контроллера
		if (!empty($routes[1])) :
			$controller_name = $routes[1];
		endif;

		// получаем имя экшена
		if (!empty($routes[2])) :
			$action_name = $routes[2];
		endif;

		// получаем get запрос
		if (!empty($routes[3])) :
			$get_req = $routes[3];
		elseif (!empty($gets[1])) :
			$get_req = $gets[1];
		endif;

		// добавляем префиксы
		$model_name = $controller_name . "Model";
		$controller_name = $controller_name . "Controller";

		if ($controller_name === "404Controller") :
			$controller_name = "HomeController";
			$action_name = "not_404";
		endif;

		// подцепляем файл с классом модели (файла модели может и не быть)
		$model_file = ucfirst($model_name).'.php';
		$model_path = MODEL_PATH . $model_file;
		if(file_exists($model_path)) :
			include $model_path;
		endif;

		// подцепляем файл с классом контроллера
		$controller_file = ucfirst($controller_name).'.php';
		$controller_path = CONTROLLER_PATH . $controller_file;
		if(file_exists($controller_path)) :
			include $controller_path;
		else :
			self::ErrorPage404();
		endif;

		$controller = new $controller_name;
		$action = $action_name;

		if(method_exists($controller, $action)) :
			if (isset($post) && $post) :
				$controller->$action($post);
			elseif (isset($get_req) && $get_req) :
				$controller->$action($get_req);
			else :
				$controller->$action();
			endif;
		else :
			self::ErrorPage404();
		endif;
	}

	public static function ErrorPage404()
	{
		$host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
		header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:' . $host . '404');
	}
}
