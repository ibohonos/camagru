<?php

class UserController extends Controller
{
	public function index($req)
	{
		$user = new UsersModel;
		$gall = new ProfileModel;

		$arr = explode("=", $req);
		$numbers = 5;
		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		$start = $page * $numbers - $numbers;
		$count = $gall->count_all($arr[1]);
		$count = $count[0]['count'];

		$data['user'] = $user->getById($arr[1]);
		$data['user'] = $data['user'][0];
		$data['gallery'] = $gall->get_limit_data($arr[1], $start, $numbers);
		$data['comments'] = new CommentsModel;
		$data['users'] = $user;
		$data['title'] = $data['user']['first_name'] . " " . $data['user']['last_name'];

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
		global $auth;

		$data['title'] = "Reset password";
		if ($auth)
			$this->redirect("/profile/");
		else
			View::generate("reset_pass.php", $data);
	}

	public function reset_pass($req)
	{
		$user = new UsersModel;

		$res = $user->getByEmail($req['email']);
		if (empty($res)) :
			echo "User for this email not registered.";
			return;
		endif;
		$res = $res[0];
		if ($res['token'] != NULL) :
			$token = $res['token'];
		else :
			$token = hash("whirlpool", time());
			$user->update_token($res['id'], $token);
		endif;
			$mail_message = "Reset pass.\n\nPlease follow to <a href='" . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/user/reset_password/token=" . $token . "&email=" . $res['email'] . "'>this link</a>.\n";
		Mail::send($res['email'], "Reset password", $mail_message);
		echo "Success";
	}

	public function reset_password($req)
	{
		$arr = explode("&", $req);
		$token = explode("=", $arr[0]);
		$email = explode("=", $arr[1]);
		$user = new UsersModel;

		$res = $user->getByEmail($email[1]);
		if ($token[1] === $res[0]['token']) :
			$this->redirect("/user/new_password/email=" . $res[0]['email']);
		else :
			$this->redirect("/user/reset/");
		endif;
	}

	public function new_password($req)
	{
		$email = explode("=", $req);
		$data['email'] = $email[1];
		$data['title'] = "New password";
		View::generate("new_pass.php", $data);
	}

	public function new_pass($req)
	{
		$user = new UsersModel;

		if (count($req['password']) >= 6) :
			if ($req['pass'] === $req['conf_pass']) :
				$pass = hash("whirlpool", $req['pass']);
				$user->update_pass($req['email'], $pass);
				$user->activate($req['email']);
				echo "Success";
			else :
				echo "Passwords not math.";
			endif;
		else :
			$msg = "Password too short. Minimum 6 charset.";
		endif;
	}
}