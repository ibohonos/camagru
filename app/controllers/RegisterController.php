<?php

class RegisterController extends Controller
{
	public function index()
	{
		global $auth;

		if ($auth)
			$this->redirect("/");
		View::generate("register.php");
	}

	public function save($req)
	{
		global $auth;

		if ($auth)
			$this->redirect("/");
		if (!empty($req['first_name']) && !empty($req['last_name']) && !empty($req['password']) && !empty($req['email'])) :
			if ($req['password'] == $req['conf_password']) :
				$user = new UsersModel;
				if (!$user->getByEmail(trim(htmlspecialchars($req['email'])))) :
					$user->first_name = trim(htmlspecialchars($req['first_name']));
					$user->last_name = trim(htmlspecialchars($req['last_name']));
					$user->email = trim(htmlspecialchars($req['email']));
					$user->pass = hash("whirlpool", trim(htmlspecialchars($req['password'])));
					$user->token = hash("whirlpool", $user->email);
					$user->save($user);

					$mail_message = "Thank's for registration.\n\nPlease activate Your account for <a href='" . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/profile/active/token=" . $user->token . "&email=" . $user->email . "'>this link</a>.\n";

					Mail::send($user->email, "Registration", $mail_message);

					$msg = $this->redirect("/login/", "Success.");
				else :
					$msg = $this->redirect($_SERVER['HTTP_REFERER'], "Wrong E-mail");
				endif;
			else :
				$msg = $this->redirect($_SERVER['HTTP_REFERER'], "Wrong password");
			endif;
		else :
			$msg = $this->redirect($_SERVER['HTTP_REFERER'], "Empty fields");
		endif;
		return $msg;
	}
}