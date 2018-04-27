<div class="pure-g comments" id="comments<?php echo $val['id']; ?>">
	<?php foreach ($data['comments'] as $comment) : ?>
		<?php if ($comment['album_id'] === $val['id']) : ?>
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
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
</div>
<?php if ($auth) : ?>
	<form class="pure-form pure-form-stacked" onsubmit="save_comment(this); return false;" method="post">
		<div class="pure-control-group">
			<textarea class="pure-input-1" name="comment" placeholder="You comment here!" rows="1"></textarea>
			<input type="hidden" name="img_id" value="<?php echo $val['id']; ?>">
			<button type="submit" class="pure-button pure-button-primary pure-u-1">Send</button>
		</div>
	</form>
<?php endif; ?>
