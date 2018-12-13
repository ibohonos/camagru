<?php

class ProfileController extends Controller
{
	public function index()
	{
		global $auth;

		if (!$auth)
			$this->redirect("/login/");
		$profile = new ProfileModel;
		$user = new UsersModel;

		$numbers = 5;
		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		$start = $page * $numbers - $numbers;
		$count = $profile->count_all($auth['id']);
		$count = $count[0]['count'];

		$data['gallery'] = $profile->get_limit_data($auth['id'], $start, $numbers);
		$data['comments'] = new CommentsModel;
		$data['users'] = $user;
		$data['title'] = $auth['first_name'] . " " . $auth['last_name'];

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
		$data['title'] = "Upload images";

		View::generate("upload_images.php", $data);
	}

	public function make()
	{
		global $auth;

		if (!$auth)
			$this->redirect("/login/");
		$data['title'] = "Make images";

		View::generate("make_images.php", $data);
	}

	public function edit()
	{
		global $auth;

		if (!$auth)
			$this->redirect("/login/");
		$data['title'] = "Edit profile";

		View::generate("edit_profile.php", $data);
	}

	public function save_profile($req)
	{
		global $auth;

		if (!$auth) :
			echo "notloginned";
			return;
		endif;
		$profile = new UsersModel;

		$profile->user_id = $req['user_id'];
		if (!empty($req['first_name']))
			$profile->first_name = trim(htmlspecialchars($req['first_name']));
		if (!empty($req['last_name']))
			$profile->last_name = trim(htmlspecialchars($req['last_name']));
		if (!empty($req['email']))
			$profile->email = trim(htmlspecialchars($req['email']));
		if (!empty($req['password'])) :
			if (count($req['password']) >= 6) :
				if ($req['password'] === $req['conf_password']) :
					$profile->pass = hash("whirlpool", trim(htmlspecialchars($req['password'])));
				else :
					echo "Fail! Password not match!";
					return;
				endif;
			else :
				echo "Password too short. Minimum 6 charset.";
				return;
			endif;
		endif;
		$profile->notify = $req['notify'];
		$profile->save_edit($profile);
		$_SESSION['auth_user'] = $profile->getById($req['user_id'])[0];
		echo "Success";
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

	public function saveComment($req)
	{
		global $auth;

		$comment = new CommentsModel;
		$users = new UsersModel;
		$imgs = new ProfileModel;

		$comment->user_id = $auth['id'];
		$comment->album_id = $req['img_id'];
		$req['comment'] = str_replace("'", "\"", $req['comment']);
		$comment->text = nl2br(htmlspecialchars($req['comment']));
		$id = $comment->save($comment);
		$user = $users->getById($comment->user_id);
		$user = $user[0];
		$img = $imgs->getById($comment->album_id);
		$img = $img[0];
		$mail_user = $users->getById($img['user_id']);
		$mail_user = $mail_user[0];
		if ($mail_user['notify']) :
			$mail_message = "User leave a comment for you image.\n\ncomment: " . $comment->text . "\nUser: <a href='" . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/user?id=" . $user['id'] . "'>" . $user['first_name'] . " " . $user['last_name'] . "</a>\n";
			Mail::send($mail_user['email'], "Comment", $mail_message);
		endif;
		?>
			<a href="/user?id=<?php echo $user['id']; ?>"><?php echo $user['first_name'] . " " . $user['last_name']; ?></a>
			<p><?php echo $comment->text; ?></p>
			<div class="content_likes">
				<div class="likes like" id="likes<?php echo $id; ?>" onclick="likes(<?php echo $id; ?>, <?php echo $auth['id']; ?>, 'comment')"></div>
				<span class="count_l" id="count_l<?php echo $id; ?>">0</span>
				<div class="clearfix"></div>
			</div>
			<a href="#" onclick="delete_comment(<?php echo $id; ?>, <?php echo $comment->album_id; ?>); return false;" class="del_comment">X</a>
		<?php
	}

	public function make_photo($req)
	{
		$overlayPath = $req['overlay'];
		$photo = preg_replace("/^.+base64,/", "", $req['photo']);
		$photo = str_replace(' ','+',$photo);
		$photo = base64_decode($photo); 
		$gd_photo = imagecreatefromstring($photo);
		$gd_filter = imagecreatefrompng($overlayPath);
		imagecopy($gd_photo, $gd_filter, 0, 0, 0, 0, imagesx($gd_filter), imagesy($gd_filter));
		ob_start();
			imagepng($gd_photo);
			$image_data = ob_get_contents();
		ob_end_clean();
		echo "data:image/png;base64," . base64_encode($image_data);
	}

	public function save_photo($req)
	{
		global $auth;

		if (!$auth) :
			echo "notloginned";
			return;
		endif;
		$profile = new ProfileModel;

		$patch = "uploads/gallery/" . time() . "-" . $auth['first_name'] . "-" . $auth['last_name'] . ".png";
		$photo = str_replace('data:image/png;base64,', '', $req['pic']);
		$photo = str_replace(' ', '+', $photo);
		$data = base64_decode($photo);
		file_put_contents(PUBLIC_PATH . str_replace("/", DS, $patch), $data);
		$profile->user_id = $req['id_user'];
		$profile->img = "/" . $patch;
		$profile->save($profile);
		echo "Success";
	}
}
