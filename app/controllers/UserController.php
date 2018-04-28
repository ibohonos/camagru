<?php

class UserController extends Controller
{
	public function index($req)
	{
		$user = new UsersModel;
		$gall = new ProfileModel;
		$comments = new CommentsModel;

		$arr = explode("=", $req);
		$numbers = 5;
		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		$start = $page * $numbers - $numbers;
		$count = $gall->count_all($arr[1]);
		$count = $count[0]['count'];

		$data['user'] = $user->getById($arr[1]);
		$data['user'] = $data['user'][0];
		$data['gallery'] = $gall->get_limit_data($arr[1], $start, $numbers);
		$data['comments'] = $comments->get_data();
		$data['users'] = $user;

		$data['pages'] = new Pagination([
			'itemsCount' => $count,
			'itemsPerPage' => $numbers,
			'currentPage' => $page
		]);

		if ($data['user'] != NULL) :
			View::generate("user.php", $data);
		else :
			Route::ErrorPage404();
		endif;
	}

	public function reset()
	{
		View::generate("reset_pass.php");
	}

	public function reset_pass()
	{
		$req = $_POST;

		$user = new UsersModel;

		$res = $user->getByEmail($req['email']);
		if (empty($res)) :
			echo "User for this email not registered.";
			return;
		endif;
		$res = $res[0];
		$mail_message = "Thank's for registration.\n\nPlease activate Your account for <a href='" . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/profile/active/token=" . $user->token . "&email=" . $user->email . "'>this link</a>.\n";

		Mail::send($user->email, "Registration", $mail_message);
	}
}