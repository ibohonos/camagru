<?php

class HomeController extends Controller
{

	public function index()
	{
		$home = new HomeModel;
		$user = new UsersModel;
		$comments = new CommentsModel;
		$numbers = 5;
		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		$start = $page * $numbers - $numbers;

		$data['gallery'] = $home->get_limit_data($start, $numbers);
		$data['comments'] = $comments->get_data();
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
}
