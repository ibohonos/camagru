<?php

class UserController extends Controller
{
	public function index($req)
	{
		$user = new UsersModel;
		$gall = new ProfileModel;
		$comments = new CommentsModel;

		$arr = explode("=", $req);
		$data['user'] = $user->getById($arr[1]);
		$data['user'] = $data['user'][0];
		$data['gallery'] = $gall->get_data($arr[1]);
		$data['comments'] = $comments->get_data();
		$data['users'] = $user;
		if ($data['user'] != NULL) :
			View::generate("user.php", $data);
		else :
			Route::ErrorPage404();
		endif;
	}
}