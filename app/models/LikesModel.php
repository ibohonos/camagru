<?php

class LikesModel extends Model
{
	public function getLikes()
	{
		$sql = "SELECT * FROM likes";
		$data = $this->pdo->select($sql);

		return $data;
	}

	public function getByIds($user_id, $post_id, $type)
	{
		$sql = "SELECT * FROM likes WHERE user_id = " . $user_id . " AND post_id = " . $post_id . " AND type = '" . $type . "'";
		$data = $this->pdo->select($sql);

		return $data;
	}
}