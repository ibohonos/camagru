<?php

class ProfileModel extends Model
{
	public function get_data()
	{
		global $pdo;
		global $auth;

		$sql = "SELECT * FROM albums WHERE user_id='" . $auth['id'] . "'";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$data = $stmt->fetchAll();

		return $data;
	}

	public function save($profile)
	{
		global $pdo;

		$sql = "INSERT INTO albums (user_id, img) VALUES('$profile->user_id', '$profile->img')";
		$pdo->exec($sql);
	}
}