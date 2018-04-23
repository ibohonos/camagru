<?php

class UsersModel extends Model
{
	public function get_data()
	{
		$sql = "SELECT * FROM users";
		$res = $this->pdo->select($sql);

		return $res;
	}

	public function save($user)
	{
		$sql = "INSERT INTO users (first_name, last_name, email, pass, active) VALUES('$user->first_name', '$user->last_name', '$user->email', '$user->pass', '0')";
		$this->pdo->insert($sql);
	}

	public function getByEmail($email)
	{
		$sql = "SELECT * FROM users WHERE email='$email'";
		$res = $this->pdo->select($sql);

		return $res;
	}

	public function getById($id)
	{
		$sql = "SELECT * FROM users WHERE id='$id'";
		$res = $this->pdo->select($sql);

		return $res;
	}

	public function save_avatar($ava)
	{
		$sql = "UPDATE users SET avatar='$ava->img' WHERE id='$ava->user_id'";
		$this->pdo->update($sql);
		$user = $this->getById($ava->user_id);
		$_SESSION['auth_user'] = $user[0];
	}
}