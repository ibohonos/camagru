<?php

class HomeController extends Controller
{

	public function index()
	{
		$home = new HomeModel;
		$user = new UsersModel;
		$numbers = 5;
		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		$start = $page * $numbers - $numbers;

		$data['gallery'] = $home->get_limit_data($start, $numbers);
		$data['comments'] = new CommentsModel;
		$data['users'] = $user;
		$count = $home->count_all();
		$count = $count[0]['count'];

		$data['pages'] = new Pagination([
			'itemsCount' => $count,
			'itemsPerPage' => $numbers,
			'currentPage' => $page
		]);

		View::generate("index.php", $data);
	}

	public function not_404()
	{
		View::generate("404.php");
	}

	public function likes()
	{
		$req = $_POST;

		$likes = new LikesModel;

		$like = $likes->getByIds($req['user_id'], $req['img_id'], $req['type']);
		$likes->user_id = $req['user_id'];
		$likes->post_id = $req['img_id'];
		$likes->type = $req['type'];
		if (empty($like)) :
			$likes->like($likes);
			$like = $likes->getByIds($req['user_id'], $req['img_id'], $req['type']);
			if (empty($like)) :
				echo "error";
			else :
				echo "liked";
			endif;
		else :
			$likes->dislike($likes);
			$like = $likes->getByIds($req['user_id'], $req['img_id'], $req['type']);
			if (!empty($like)) :
				echo "error";
			else :
				echo "disliked";
			endif;
		endif;
	}

	public function all_comments($req)
	{
		global $auth;

		$comments_m = new CommentsModel;
		$users = new UsersModel;

		$comments = $comments_m->get_data($req['id']);
		foreach ($comments as $comment) : ?>
			<?php
				if ($auth && LikesModel::liked($auth['id'], $comment['id'], 'comment')) :
					$like = "dislike";
				else :
					$like = "like";
				endif;
			?>
			<?php $user = $users->getById($comment['user_id']); ?>
			<?php $user = $user[0]; ?>
			<div class="pure-u-1 comment">
				<a href="/user?id=<?php echo $user['id']; ?>"><?php echo $user['first_name'] . " " . $user['last_name']; ?></a>
				<p><?php echo $comment['text']; ?></p>
				<div class="content_likes">
					<div class="likes <?php echo $like; ?>" id="likes<?php echo $comment['id']; ?>" onclick="likes(<?php echo $comment['id']; ?>, <?php echo $auth['id']; ?>, 'comment')"></div>
					<span class="count_l" id="count_l<?php echo $comment['id']; ?>"><?php echo LikesModel::count_likes($comment['id'], 'comment'); ?></span>
					<div class="clearfix"></div>
				</div>
				<?php if ($auth && ($auth['id'] === $user['id'] || $auth['is_admin'])) : ?>
					<a href="#" onclick="delete_comment(<?php echo $comment['id']; ?>, <?php echo $req['id']; ?>); return false;" class="del_comment">X</a>
				<?php endif; ?>
			</div>
		<?php endforeach;
	}

	public function delete_comment($req)
	{
		global $auth;

		$comments_m = new CommentsModel;
		$users = new UsersModel;
		$likes = new LikesModel;

		$comments_m->delete($req['comment_id']);
		$likes->delete($req['comment_id'], "comment");
		$comments = $comments_m->getById($req['post_id']);
		$count = $comments_m->countById($req['post_id']); ?>
		<?php if ($count > 2) : ?>
			<a href="#" onclick="all_comments(<?php echo $req['post_id']; ?>);return false;" class="all_comments">Show all (<?php echo $count; ?>) comments</a>
		<?php endif;
		foreach ($comments as $comment) : ?>
			<?php
			if ($auth && LikesModel::liked($auth['id'], $comment['id'], 'comment')) :
				$like = "dislike";
			else :
				$like = "like";
			endif;
			?>
			<?php $user = $users->getById($comment['user_id']); ?>
			<?php $user = $user[0]; ?>
			<div class="pure-u-1 comment">
				<a href="/user?id=<?php echo $user['id']; ?>"><?php echo $user['first_name'] . " " . $user['last_name']; ?></a>
				<p><?php echo $comment['text']; ?></p>
				<div class="content_likes">
					<div class="likes <?php echo $like; ?>" id="likes<?php echo $comment['id']; ?>" onclick="likes(<?php echo $comment['id']; ?>, <?php echo $auth['id']; ?>, 'comment')"></div>
					<span class="count_l" id="count_l<?php echo $comment['id']; ?>"><?php echo LikesModel::count_likes($comment['id'], 'comment'); ?></span>
					<div class="clearfix"></div>
				</div>
				<?php if ($auth && ($auth['id'] === $user['id'] || $auth['is_admin'])) : ?>
					<a href="#" onclick="delete_comment(<?php echo $comment['id']; ?>, <?php echo $req['post_id']; ?>); return false;" class="del_comment">X</a>
				<?php endif; ?>
			</div>
		<?php endforeach;
	}

	public function delete_img($req)
	{
		$comments_m = new CommentsModel;
		$likes = new LikesModel;
		$photos = new ProfileModel;

		$photo = $photos->getById($req['id']);
		$photo = $photo[0];
		unlink($_SERVER['DOCUMENT_ROOT'] . $photo['img']);
		$photos->delete($req['id']);
		$comments_m->deleteAlbum($req['id']);
		$likes->delete($req['id'], "photo");
		echo "Success";
	}
}
