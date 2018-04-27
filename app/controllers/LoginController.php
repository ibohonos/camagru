<?php

class LoginController extends Controller
{
	public function index()
	{
		global $auth;

		if ($auth)
			$this->redirect("/");
		View::generate("login.php");
	}

	public function auth()
	{
		global $auth;
		$req = $_POST;

		if ($auth)
			echo "loginned";
		if (!empty($req['password']) && !empty($req['email'])) :
			$user = new UsersModel;
			$pass = hash("whirlpool", trim(htmlspecialchars($req['password'])));
			$res = $user->getByEmail(trim(htmlspecialchars($req['email'])));
			if ($res) :
				if ($pass === $res[0]['pass']) :
					if ($res[0]['active']) :
						$_SESSION['auth_user'] = $res[0];
						echo "Success";
					else :
						echo "Please activate your account.";
					endif;
				else :
					echo "Password not matches.";
				endif;
			else :
				echo "Wrong e-mail.";
			endif;
		else :
			echo "Please enter all fields.";
		endif;
	}

	public function logout()
	{
		unset($_SESSION['auth_user']);
		$this->redirect("/");
	}
}