<?php

class ProfileModel extends Model
{
	public function get_data($id)
	{
		$sql = "SELECT * FROM albums WHERE user_id='" . $id . "' ORDER BY id DESC";
		$data = $this->pdo->select($sql);

		return $data;
	}

	public function save($profile)
	{
		$sql = "INSERT INTO albums (user_id, img) VALUES('$profile->user_id', '$profile->img')";
		$this->pdo->insert($sql);
	}

	public function getById($id)
	{
		$sql = "SELECT * FROM albums WHERE id='" . $id . "'";
		$data = $this->pdo->select($sql);

		return $data;
	}

	public function count_all($id)
	{
		$sql = "SELECT COUNT(*) AS `count` FROM albums WHERE user_id='" . $id . "'";
		$data = $this->pdo->select($sql);

		return $data;
	}

	public function get_limit_data($id, $start, $num)
	{
		$sql = "SELECT * FROM albums WHERE user_id='" . $id . "' ORDER BY id DESC LIMIT $start, $num";
		$data = $this->pdo->select($sql);

		return $data;
	}

	public function delete($id)
	{
		$sql = "DELETE FROM albums WHERE id=" . $id;
		$this->pdo->delete($sql);
	}
}
