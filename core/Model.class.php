<?php

class Model
{
	public $pdo;

	public function __construct()
	{
		$pdo = new Database;
		$this->pdo = $pdo;
	}

	public function get_data()
	{
	}
}
