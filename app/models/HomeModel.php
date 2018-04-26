<?php

class HomeModel extends Model
{
	public function get_data()
	{
		$sql = "SELECT * FROM albums ORDER BY id DESC";
		$data = $this->pdo->select($sql);

		return $data;
	}

	public static function get_last()
	{
		$pdo = new Database;

		$sql = "SELECT * FROM albums ORDER BY id DESC LIMIT 9";
		$data = $pdo->select($sql);

		return $data;
	}
}