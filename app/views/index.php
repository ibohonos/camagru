<h1 class="title">Camagru</h1>
<div class="index">
	<div class="pure-g gallery">
		<?php foreach ($data['gallery'] as $val) : ?>
			<div class="pure-u-1 image">
				<img class="pure-img" src="<?php echo $val['img']; ?>">
				<div class="likes like"></div>
				<div class="pure-g comments">
					<?php foreach ($data['comments'] as $comment) : ?>
						<?php if ($comment['album_id'] === $val['id']) : ?>
							<?php $user = $data['users']->getById($comment['user_id']); ?>
							<?php $user = $user[0]; ?>
							<div class="pure-u-1 comment">
								<p>
									<a href="/user?id=<?php echo $user['id']; ?>"><?php echo $user['first_name'] . " " . $user['last_name']; ?></a><br>
									<?php echo $comment['text']; ?>
								</p>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
				<?php global $auth; ?>
				<?php if ($auth) : ?>
					<form class="pure-form pure-form-stacked" action="/profile/saveComment/" method="post">
						<div class="pure-control-group">
							<textarea class="pure-input-1" name="comment" placeholder="You comment here!" rows="1"></textarea>
							<input type="hidden" name="img_id" value="<?php echo $val['id']; ?>">
							<button type="submit" class="pure-button pure-button-primary pure-u-1">Send</button>
						</div>
					</form>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
</div>
