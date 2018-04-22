<?php

class ProfileController extends Controller
{
	public function index()
	{
		$profile = new ProfileModel;

		$data = $profile->get_data();
		View::generate("profile.php", $data);
	}

	public function save_image($req)
	{
		global $auth;

		$ava = new UsersModel;

		$target_dir = UPLOAD_PATH . "avatars" . DS;
		$img_name = time() . "-" . $auth['first_name'] . "-" . $auth['last_name'] . "." . strtolower(pathinfo($req['img']["name"],PATHINFO_EXTENSION));
		$target_file = $target_dir . $img_name;
		$uploadOk = 1;
		// Check if image file is a actual image or fake image
		$check = getimagesize($req['img']["tmp_name"]);
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
			if (move_uploaded_file($req['img']["tmp_name"], $target_file)) {
				$msg = "The file ". basename($req['img']["name"]). " has been uploaded.";
			} else {
				$msg = "Sorry, there was an error uploading your file.";
			}
		}

		$img_url = "/public/uploads/avatars/" . $img_name;
		$ava->img = $img_url;
		$ava->user_id = $auth['id'];
		$ava->save_avatar($ava);

		$this->redirect($_SERVER['HTTP_REFERER'], $msg);
	}

	public function save_gallery($req)
	{
		global $auth;

		$profile = new ProfileModel;

		$total = count($req['imgs']['name']);
		$target_dir = UPLOAD_PATH . "gallery" . DS;
		// Loop through each file
		for($i = 0; $i < $total; $i++) :
			//Get the temp file path
			$img_name = time() . "-" . $auth['first_name'] . "-" . $auth['last_name'] . "-" . $i . "." . strtolower(pathinfo($req['imgs']["name"][$i],PATHINFO_EXTENSION));
			$target_file = $target_dir . $img_name;
			$uploadOk = 1;

			$check = getimagesize($req['imgs']["tmp_name"][$i]);
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
				if (move_uploaded_file($req['imgs']["tmp_name"][$i], $target_file)) {
					$msg = "The file ". basename($req['imgs']["name"][$i]). " has been uploaded.";
				} else {
					$msg = "Sorry, there was an error uploading your file.";
				}
			}
			$img_url = "/public/uploads/gallery/" . $img_name;
			$profile->img = $img_url;
			$profile->user_id = $auth['id'];
			$profile->save($profile);
		endfor;
		$this->redirect($_SERVER['HTTP_REFERER'], $msg);
	}
}