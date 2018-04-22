<?php

class RegisterController extends Controller
{
	public function index()
	{
		View::generate("register.php");
	}

	public function save($req)
	{
		if (!empty($req['first_name']) && !empty($req['last_name']) && !empty($req['password']) && !empty($req['email'])) :
			if ($req['password'] == $req['conf_password']) :
				$user = new UsersModel;
				if (!$user->getByEmail(trim($req['email']))) :
					$user->first_name = trim($req['first_name']);
					$user->last_name = trim($req['last_name']);
					$user->email = trim($req['email']);
					$user->pass = hash("whirlpool", trim($req['password']));
					$user->save($user);

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