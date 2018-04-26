<h1 class="title">Profile</h1>
<video id="video">Video stream not available.</video>
<button id="startbutton">Take photo</button>
<canvas id="canvas"></canvas>
<img src="http://placekitten.com/g/320/261" id="photo" alt="photo">
<form class="pure-form pure-form-aligned" method="post" enctype="multipart/form-data" action="/profile/save_image/">
	<fieldset>
		<div class="pure-control-group">
			<label for="img">Upload avatar</label>
			<input id="img" type="file" name="img" accept="image/*" required>
		</div>

		<div class="pure-controls">
			<button type="submit" class="pure-button pure-button-primary">Submit</button>
		</div>
	</fieldset>
</form>
<div>
	<?php if ($auth['avatar']) : ?>
		<img class="pure-img" src="<?php echo $auth['avatar']; ?>" alt="avatar" title="avatar">
	<?php endif; ?>
</div>

<form class="pure-form pure-form-aligned" method="post" enctype="multipart/form-data" action="/profile/save_gallery/">
	<fieldset>
		<div class="pure-control-group">
			<label for="imgs">Upload Images</label>
			<input id="imgs" type="file" name="imgs[]" accept="image/*" multiple required>
		</div>

		<div class="pure-controls">
			<button type="submit" class="pure-button pure-button-primary">Submit</button>
		</div>
	</fieldset>
</form>

<div class="pure-g gallery">
	<?php foreach ($data['gallery'] as $val) : ?>
		<div class="pure-u-1 image">
			<img class="pure-img" src="<?php echo $val['img']; ?>">
			<div class="likes like"></div>
			<div class="pure-g comments">
				<?php foreach ($data['comments'] as $comment) : ?>
					<?php if ($comment['album_id'] === $val['id']) : ?>
						<?php $user = $data['user']->getById($comment['user_id']); ?>
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
			<form class="pure-form pure-form-stacked" onsubmit="save_comment(this); return false;" method="post" action="/profile/saveComment/">
				<div class="pure-control-group">
					<textarea class="pure-input-1" name="comment" placeholder="You comment here!" rows="1"></textarea>
					<input type="hidden" name="img_id" value="<?php echo $val['id']; ?>">
					<button type="submit" class="pure-button pure-button-primary pure-u-1">Send</button>
				</div>
			</form>
		</div>
	<?php endforeach; ?>
</div>
<script src="/public/js/cams.js"></script>
