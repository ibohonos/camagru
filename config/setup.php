<?php
include_once "database.php";

try {
	$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
		  `avatar` varchar(255) DEFAULT '/public/uploads/avatars/default.png',
		  `token` varchar(255) DEFAULT NULL,
		  `active` int(2) DEFAULT '0',
		  `is_admin` int(2) NOT NULL DEFAULT '0'
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

	$sql .= "INSERT INTO `users` (`first_name`, `last_name`, `email`, `pass`, `avatar`, `token`, `active`, `is_admin`) VALUES
		('Ivan', 'Bohonosiuk', 'The.head1993@gmail.com', '9b749b80e2a37abfb38f7029305c2b49ebdeeaa9a7c6dc148eb0cf3396aec575517d61b1f4fe57d70d76817ba7882c386cf9c29fb2fd0b5eaa72e06a709652c5', NULL, NULL, 1, 1);";

	$pdo->exec($sql);

	header('Location: /');

} catch (PDOException $e) {
	echo 'Error: ' . $e->getMessage();
}
