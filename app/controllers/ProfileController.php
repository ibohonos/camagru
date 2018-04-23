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

		$img_url = $this->save_img($req['img'], $auth, "avatars");

		$ava = new UsersModel;
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
		// Loop through each file
		for($i = 1; $i < $total + 1; $i++) :
			$img_url = $this->save_img($req['imgs'], $auth, "gallery", $i);
			$profile->img = $img_url;
			$profile->user_id = $auth['id'];
			$profile->save($profile);
		endfor;
		$this->redirect($_SERVER['HTTP_REFERER'], $msg);
	}
}
