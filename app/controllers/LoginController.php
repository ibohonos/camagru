<?php

class LoginController extends Controller
{
	public function index()
	{
		View::generate("login.php");
	}

	public function auth($req)
	{
		if (!empty($req['password']) && !empty($req['email'])) :
			$user = new UsersModel;
			$pass = hash("whirlpool", trim($req['password']));
			$res = $user->getByEmail(trim($req['email']));
			if ($res) :
				if ($pass === $res[0]['pass']) :
					if ($res[0]['active']) :
						$_SESSION['auth_user'] = $res[0];
						$this->redirect("/");
					else :
						$this->redirect($_SERVER['HTTP_REFERER']);
					endif;
				else :
					$this->redirect($_SERVER['HTTP_REFERER']);
				endif;
			else :
				$this->redirect($_SERVER['HTTP_REFERER']);
			endif;
		else :
			$this->redirect($_SERVER['HTTP_REFERER']);
		endif;
	}

	public function logout()
	{
		unset($_SESSION['auth_user']);
		$this->redirect("/");
	}
}