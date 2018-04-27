<h1 class="title">Upload photos</h1>
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