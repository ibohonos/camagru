<?php

class Controller
{
	public $model;
	public $view;

	public function __construct()
	{
		$this->view = new View();
	}

	public function save_img($req, $auth, $path, $i = "")
	{
		$target_dir = UPLOAD_PATH . $path . DS;
		if ($i != "") :
			$img_name = time() . "-" . $auth['first_name'] . "-" . $auth['last_name'] . "-" . ($i - 1) . "." . strtolower(pathinfo($req["name"][$i - 1],PATHINFO_EXTENSION));
		else :
			$img_name = time() . "-" . $auth['first_name'] . "-" . $auth['last_name'] . "." . strtolower(pathinfo($req["name"],PATHINFO_EXTENSION));
		endif;
		$target_file = $target_dir . $img_name;
		$uploadOk = 1;
		// Check if image file is a actual image or fake image
		if ($i != "") :
			$check = getimagesize($req["tmp_name"][$i - 1]);
		else :
			$check = getimagesize($req["tmp_name"]);
		endif;
		if($check !== false) {
			$msg = "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			$msg = "File is not an image.";
			$uploadOk = 0;
		}
		// Check if file already exists
		if (file_exists($target_file)) {
			$msg = "Sorry, file already exists.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			$msg = "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
		} else {
			if ($i != "") :
				if (move_uploaded_file($req["tmp_name"][$i - 1], $target_file)) {
					$msg = "The file ". basename($req["name"][$i - 1]). " has been uploaded.";
				} else {
					$msg = "Sorry, there was an error uploading your file.";
				}
			else :
				if (move_uploaded_file($req["tmp_name"], $target_file)) {
					$msg = "The file ". basename($req["name"]). " has been uploaded.";
				} else {
					$msg = "Sorry, there was an error uploading your file.";
				}
			endif;
		}
		$img_url = "/uploads/" . $path . "/" . $img_name;

		return $img_url;
	}

	public function redirect($url, $msg = "")
	{
		header('Location: ' . $url);
		return $msg;
	}
}
