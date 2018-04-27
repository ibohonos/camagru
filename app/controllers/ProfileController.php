<?php

class ProfileController extends Controller
{
	public function index()
	{
		global $auth;

		if (!$auth)
			$this->redirect("/login/");
		$profile = new ProfileModel;
		$comments = new CommentsModel;
		$user = new UsersModel;

		$data['gallery'] = $profile->get_data($auth['id']);
		$data['comments'] = $comments->get_data();
		$data['users'] = $user;
		View::generate("profile.php", $data);
	}

	public function upload()
	{
		global $auth;

		if (!$auth)
			$this->redirect("/login/");
		View::generate("upload_images.php");
	}

	public function make()
	{
		global $auth;

		if (!$auth)
			$this->redirect("/login/");
		View::generate("make_images.php");
	}

	public function save_image($req)
	{
		global $auth;

		if (!$auth)
			$this->redirect("/login/");
		$img_url = $this->save_img($req['img'], $auth, "avatars");

		$ava = new UsersModel;
		$ava->img = $img_url;
		$ava->user_id = $auth['id'];
		$ava->save_avatar($ava);

		$this->redirect($_SERVER['HTTP_REFERER']);
	}

	public function save_gallery($req)
	{
		global $auth;

		if (!$auth)
			$this->redirect("/login/");
		$profile = new ProfileModel;

		$total = count($req['imgs']['name']);
		for($i = 1; $i < $total + 1; $i++) :
			$img_url = $this->save_img($req['imgs'], $auth, "gallery", $i);
			$profile->img = $img_url;
			$profile->user_id = $auth['id'];
			$profile->save($profile);
		endfor;
		$this->redirect($_SERVER['HTTP_REFERER']);
	}

	public function active($req)
	{
		$arr = explode("&", $req);
		$token = explode("=", $arr[0]);
		$email = explode("=", $arr[1]);
		$user = new UsersModel;

		$res = $user->getByEmail($email[1]);
		if ($token[1] === $res[0]['token']) :
				$user->activate($email[1]);
				$this->redirect("/login/");
		else :
			$this->redirect("/");
		endif;
	}

	public function saveComment()
	{
		global $auth;

		$req = $_POST;

		$comment = new CommentsModel;
		$user = new UsersModel;

		$comment->user_id = $auth['id'];
		$comment->album_id = $req['img_id'];
		$comment->text = nl2br(htmlspecialchars($req['comment']));
		$comment->save($comment);
		$user = $user->getById($comment->user_id);
		$user = $user[0];
		?>
			<p>
				<a href="/user?id=<?php echo $user['id']; ?>"><?php echo $user['first_name'] . " " . $user['last_name']; ?></a><br>
				<?php echo $comment->text; ?>
			</p>
		<?php
	}
}
