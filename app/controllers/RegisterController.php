<?php

class RegisterController extends Controller
{
	public function index()
	{
		global $auth;

		if ($auth)
			$this->redirect("/");
		$data['title'] = "Register";

		View::generate("register.php", $data);
	}

	public function save($req)
	{
		global $auth;

		if ($auth) :
			echo "loginned";
			return;
		endif;
		if (!empty($req['first_name']) && !empty($req['last_name']) && !empty($req['password']) && !empty($req['email'])) :
			if (count($req['password']) >= 6) :
				if ($req['password'] == $req['conf_password']) :
					$user = new UsersModel;
					if (!$user->getByEmail(trim(htmlspecialchars($req['email'])))) :
						$user->first_name = trim(htmlspecialchars($req['first_name']));
						$user->last_name = trim(htmlspecialchars($req['last_name']));
						$user->email = trim(htmlspecialchars($req['email']));
						$user->pass = hash("whirlpool", trim(htmlspecialchars($req['password'])));
						$user->token = hash("whirlpool", time());
						$user->save($user);

						$mail_message = "Thank's for registration.\n\nPlease activate Your account for <a href='" . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/profile/active/token=" . $user->token . "&email=" . $user->email . "'>this link</a>.\n";

						Mail::send($user->email, "Registration", $mail_message);

						$msg = "Success";
					else :
						$msg = "E-mail is already busy";
					endif;
				else :
					$msg = "Password not matches";
				endif;
			else :
				$msg = "Password too short. Minimum 6 charset.";
			endif;
		else :
			$msg = "Empty fields";
		endif;
		echo $msg;
	}
}
