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

		$numbers = 5;
		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		$start = $page * $numbers - $numbers;
		$count = $profile->count_all($auth['id']);
		$count = $count[0]['count'];

		$data['gallery'] = $profile->get_limit_data($auth['id'], $start, $numbers);
		$data['comments'] = $comments->get_data();
		$data['users'] = $user;

		$data['pages'] = new Pagination([
			'itemsCount' => $count,
			'itemsPerPage' => $numbers,
			'currentPage' => $page
		]);

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
		$users = new UsersModel;
		$imgs = new ProfileModel;

		$comment->user_id = $auth['id'];
		$comment->album_id = $req['img_id'];
		$comment->text = nl2br(htmlspecialchars($req['comment']));
		$id = $comment->save($comment);
		$user = $users->getById($comment->user_id);
		$user = $user[0];
		$img = $imgs->getById($comment->album_id);
		$img = $img[0];
		$mail_user = $users->getById($img['user_id']);
		$mail_user = $mail_user[0];
		$mail_message = "User leave a comment for you image.\n\ncomment: " . $comment->text . "\nUser: <a href='" . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/user?id=" . $user['id'] . "'>" . $user['first_name'] . " " . $user['last_name'] . "</a>\n";
		Mail::send($mail_user['email'], "Comment", $mail_message);
		?>
			<a href="/user?id=<?php echo $user['id']; ?>"><?php echo $user['first_name'] . " " . $user['last_name']; ?></a>
			<p><?php echo $comment->text; ?></p>
			<div class="content_likes">
				<div class="likes like" id="likes<?php echo $id; ?>" onclick="likes(<?php echo $id; ?>, <?php echo $auth['id']; ?>, 'comment')"></div>
				<span class="count_l" id="count_l<?php echo $id; ?>">0</span>
				<div class="clearfix"></div>
			</div>
		<?php
	}
}
