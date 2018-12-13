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

	public function setup_database()
	{
		$sql = "CREATE TABLE IF NOT EXISTS `albums` (
				`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
				`user_id` int(11) NOT NULL,
				`img` varchar(255) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

		$sql .= "CREATE TABLE IF NOT EXISTS `comments` (
				`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
				`album_id` int(11) NOT NULL,
				`user_id` int(11) NOT NULL,
				`text` text NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

		$sql .= "CREATE TABLE IF NOT EXISTS `likes` (
				`user_id` int(11) NOT NULL,
				`post_id` int(11) NOT NULL,
				`type` varchar(255) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

		$sql .= "CREATE TABLE IF NOT EXISTS `users` (
				`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
				`first_name` varchar(255) NOT NULL,
				`last_name` varchar(255) NOT NULL,
				`email` varchar(255) NOT NULL UNIQUE,
				`pass` varchar(128) NOT NULL,
				`avatar` varchar(255) DEFAULT '/uploads/avatars/default.png',
				`token` varchar(255) DEFAULT NULL,
				`active` tinyint(1) NOT NULL DEFAULT '0',
				`is_admin` tinyint(1) NOT NULL DEFAULT '0',
				`notify` tinyint(1) NOT NULL DEFAULT '1'
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

		$sql .= "INSERT INTO `users` (`first_name`, `last_name`, `email`, `pass`, `avatar`, `token`, `active`, `is_admin`) VALUES
			('Ivan', 'Bohonosiuk', 'The.head1993@gmail.com', '9b749b80e2a37abfb38f7029305c2b49ebdeeaa9a7c6dc148eb0cf3396aec575517d61b1f4fe57d70d76817ba7882c386cf9c29fb2fd0b5eaa72e06a709652c5', '/uploads/avatars/default.png', NULL, 1, 1);";

		$this->pdo->insert($sql);
	}
}