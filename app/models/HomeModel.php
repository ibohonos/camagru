<?php

class HomeModel extends Model
{
	public function get_data()
	{
		$sql = "SELECT * FROM users";
		$data = $this->pdo->select($sql);

		return $data;
	}
}