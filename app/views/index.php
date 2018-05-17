<h1 class="title">Camagru</h1>
<div class="index">
	<div class="gallery">
		<?php foreach ($data['gallery'] as $val) : ?>
			<div class="image" id="image<?php echo $val['id']; ?>">
				<div class="name">
					<?php
					$user = $data['users']->getById($val['user_id']);
					$user = $user[0];
					?>
					<a href="/user?id=<?php echo $user['id']; ?>" class="user_link">
						<img src="<?php echo $user['avatar']; ?>" class="avatar">
						<span><?php echo $user['first_name'] . " " . $user['last_name']; ?></span>
					</a>
				</div>
				<?php if ($auth && ($auth['id'] === $user['id'] || $auth['is_admin'])) : ?>
					<a href="#" onclick="delete_img(<?php echo $val['id']; ?>); return false;" class="del_comment del_img">X</a>
				<?php endif; ?>
				<img class="pure-img" src="<?php echo $val['img']; ?>">
				<?php include VIEW_PATH . "blocks" . DS . "likes.php"; ?>
				<?php include VIEW_PATH . "blocks" . DS . "comments.php"; ?>
			</div>
		<?php endforeach; ?>
	</div>
</div>
<?php include VIEW_PATH . "blocks" . DS . "pagination.php"; ?>
