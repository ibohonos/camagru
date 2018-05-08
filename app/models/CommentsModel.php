<?php

class CommentsModel extends Model
{
	public function get_data($id)
	{
		$sql = "SELECT * FROM comments WHERE album_id=" . $id;
		$res = $this->pdo->select($sql);

		return $res;
	}

	public function getById($id)
	{
		$sql = "SELECT * FROM comments WHERE album_id=" . $id . " ORDER BY id DESC LIMIT 3";
		$res = $this->pdo->select($sql);

		return $res;
	}

	public function countById($id)
	{
		$sql = "SELECT * FROM comments WHERE album_id=" . $id;
		$res = $this->pdo->select($sql);

		return count($res);
	}

	public function save($comment)
	{
		$sql = "INSERT INTO comments (album_id, user_id, text) VALUES('$comment->album_id', '$comment->user_id', '$comment->text')";
		return $this->pdo->insert($sql);
	}

	public function delete($id)
	{
		$sql = "DELETE FROM comments WHERE id='$id'";
		$this->pdo->delete($sql);
	}

	public function deleteAlbum($id)
	{
		$sql = "DELETE FROM comments WHERE album_id=" . $id;
		$this->pdo->delete($sql);
	}
}
