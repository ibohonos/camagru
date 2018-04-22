<?php

class UsersModel extends Model
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

	public function save($user)
	{
		global $pdo;

		$sql = "INSERT INTO users (first_name, last_name, email, pass, active) VALUES('$user->first_name', '$user->last_name', '$user->email', '$user->pass', '0')";
		$pdo->exec($sql);
	}

	public function getByEmail($email)
	{
		global $pdo;

		$sql = "SELECT * FROM users WHERE email='$email'";
		$res = $pdo->prepare($sql);
		$res->execute();
		$res = $res->fetchAll();
		return $res;
	}

	public function getById($id)
	{
		global $pdo;

		$sql = "SELECT * FROM users WHERE id='$id'";
		$res = $pdo->prepare($sql);
		$res->execute();
		$res = $res->fetchAll();
		return $res;
	}

	public function save_avatar($ava)
	{
		global $pdo;

		$sql = "UPDATE users SET avatar='$ava->img' WHERE id='$ava->user_id'";
		$pdo->exec($sql);
		$user = $this->getById($ava->user_id);
		$_SESSION['auth_user'] = $user[0];
	}
}