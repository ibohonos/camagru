<div class="pure-g comments" id="comments<?php echo $val['id']; ?>">
	<?php $comments = $data['comments']->getById($val['id']); ?>
	<?php krsort($comments); ?>
	<?php $count = $data['comments']->countById($val['id']); ?>
	<?php if ($count > 2) : ?>
		<a href="#" onclick="all_comments(<?php echo $val['id']; ?>);return false;" class="all_comments">Show all (<?php echo $count; ?>) comments</a>
	<?php endif; ?>
		<?php foreach ($comments as $comment) : ?>
			<?php
				if ($auth && LikesModel::liked($auth['id'], $comment['id'], 'comment')) :
					$like = "dislike";
				else :
					$like = "like";
				endif;
			?>
			<?php $user = $data['users']->getById($comment['user_id']); ?>
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
					<a href="#" onclick="delete_comment(<?php echo $comment['id']; ?>, <?php echo $val['id']; ?>); return false;" class="del_comment">X</a>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
</div>
<?php if ($auth) : ?>
	<form class="pure-form pure-form-stacked" onsubmit="save_comment(this); return false;" method="post">
		<div class="pure-control-group">
			<input type="text" class="pure-input-1" name="comment" placeholder="You comment here!">
			<input type="hidden" name="img_id" value="<?php echo $val['id']; ?>">
			<button type="submit" class="pure-button pure-button-primary pure-u-1">Send</button>
		</div>
	</form>
<?php endif; ?>
