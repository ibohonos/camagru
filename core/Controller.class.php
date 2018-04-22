<?php

class Controller
{
	public $model;
	public $view;

	public function __construct()
	{
		$this->view = new View();
	}

	public function index()
	{
	}

	public function redirect($url, $msg = "")
	{
		header('Location: ' . $url);
		return $msg;
	}
}