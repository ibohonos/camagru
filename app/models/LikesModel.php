<?php

class LikesModel extends Model
{
	public function getLikes()
	{
		$sql = "SELECT * FROM likes";
		$data = $this->pdo->select($sql);

		return $data;
	}
}