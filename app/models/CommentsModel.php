<?php

class CommentsModel extends Model
{
	public function get_data()
	{
		$sql = "SELECT * FROM comments";
		$res = $this->pdo->select($sql);

		return $res;
	}

	public function save($comment)
	{
		$sql = "INSERT INTO comments (album_id, user_id, text) VALUES('$comment->album_id', '$comment->user_id', '$comment->text')";
		$this->pdo->insert($sql);;
	}
}