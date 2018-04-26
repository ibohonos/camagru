<div class="pure-g comments" id="comments<?php echo $val['id']; ?>">
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
<?php if ($auth) : ?>
	<form class="pure-form pure-form-stacked" onsubmit="save_comment(this); return false;" method="post">
		<div class="pure-control-group">
			<textarea class="pure-input-1" name="comment" placeholder="You comment here!" rows="1"></textarea>
			<input type="hidden" name="img_id" value="<?php echo $val['id']; ?>">
			<button type="submit" class="pure-button pure-button-primary pure-u-1">Send</button>
		</div>
	</form>
<?php endif; ?>
