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

	public function count_all()
	{
		$sql = "SELECT COUNT(*) AS `count` FROM albums";
		$data = $this->pdo->select($sql);

		return $data;
	}

	public function get_limit_data($start, $num)
	{
		$sql = "SELECT * FROM albums ORDER BY id DESC LIMIT $start, $num";
		$data = $this->pdo->select($sql);

		return $data;
	}
}