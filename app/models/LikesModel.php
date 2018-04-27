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

	public function like($likes)
	{
		$sql = "INSERT INTO likes (user_id, post_id, type) VALUES ('$likes->user_id', '$likes->post_id', '$likes->type')";
		$this->pdo->insert($sql);
	}

	public function dislike($likes)
	{
		$sql = "DELETE FROM likes WHERE user_id = " . $likes->user_id . " AND post_id = " . $likes->post_id . " AND type = '" . $likes->type . "'";
		$this->pdo->delete($sql);
	}

	public static function liked($user_id, $post_id, $type)
	{
		$pdo = new Database;
		$sql = "SELECT * FROM likes WHERE user_id = " . $user_id . " AND post_id = " . $post_id . " AND type = '" . $type . "'";
		$like = $pdo->select($sql);
		if (!empty($like)) :
			return true;
		else :
			return false;
		endif;
	}

	public static function count_likes($post_id, $type)
	{
		$pdo = new Database;
		$sql = "SELECT * FROM likes WHERE post_id = " . $post_id . " AND type = '" . $type . "'";
		$like = $pdo->select($sql);
		return count($like);
	}
}