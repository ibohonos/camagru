<?php

class HomeModel extends Model
{
	public function get_data()
	{
		global $pdo;
		$sql = "SELECT * FROM users";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$data = $stmt->fetchAll();

		return $data;
	}
}