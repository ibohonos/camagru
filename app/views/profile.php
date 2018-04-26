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
			<?php include VIEW_PATH . "blocks" . DS . "likes.php"; ?>
			<?php include VIEW_PATH . "blocks" . DS . "comments.php"; ?>
		</div>
	<?php endforeach; ?>
</div>
<script src="/public/js/cams.js"></script>
