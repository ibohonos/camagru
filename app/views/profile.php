<h1 class="title">Profile</h1>
<form class="pure-form pure-form-aligned" method="post" enctype="multipart/form-data" action="/profile/save_image/">
	<fieldset>
		<div class="pure-control-group">
			<label for="img">Upload avatar</label>
			<input id="img" type="file" name="img" accept="image/*" required>
			<span class="pure-form-message-inline">This is a required field.</span>
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
			<span class="pure-form-message-inline">This is a required field.</span>
		</div>

		<div class="pure-controls">
			<button type="submit" class="pure-button pure-button-primary">Submit</button>
		</div>
	</fieldset>
</form>

<div class="pure-g gallery">
	<?php foreach ($data as $val) : ?>
		<div class="pure-u-1 image">
			<img class="pure-img" src="<?php echo $val['img']; ?>">
			<form class="pure-form pure-form-stacked">
				<div class="pure-control-group">
					<textarea class="pure-input-1" placeholder="You comment here!" rows="1"></textarea>
					<input type="hidden" name="img_id" value="<?php echo $val['id']; ?>">
					<button type="submit" class="pure-button pure-button-primary pure-u-1">Send</button>
				</div>
			</form>
		</div>
	<?php endforeach; ?>
</div>
