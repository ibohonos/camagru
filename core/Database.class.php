<?php


class Database
{
	public function select($sql)
	{
		include CONFIG_PATH . "database.php";

		try {
			$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			$data = $stmt->fetchAll();

			return $data;
		} catch (PDOException $e) {
			echo "SELECT ERROR: " . $e->getMessage();
			exit(-1);
		}
	}

	public function insert($sql)
	{
		include CONFIG_PATH . "database.php";

		try {
			$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$pdo->exec($sql);
		} catch (PDOException $e) {
			echo "INSERT ERROR: " . $e->getMessage();
			exit(-1);
		}
	}

	public function update($sql)
	{
		include CONFIG_PATH . "database.php";

		try {
			$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$pdo->exec($sql);
		} catch (PDOException $e) {
			echo "UPDATE ERROR: " . $e->getMessage();
			exit(-1);
		}
	}
}
