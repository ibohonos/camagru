<h1 class="title">Profile</h1>
<div class="pure-g buttons-uploads">
	<div class="pure-u-1-2">
		<a href="/profile/upload/">Upload photos</a>
	</div>
	<div class="pure-u-1-2">
		<a href="/profile/make/">Make a picture</a>
	</div>
</div>
<div class="pure-g gallery">
	<?php foreach ($data['gallery'] as $val) : ?>
		<div class="pure-u-1 image">
			<img class="pure-img" src="<?php echo $val['img']; ?>">
			<?php include VIEW_PATH . "blocks" . DS . "likes.php"; ?>
			<?php include VIEW_PATH . "blocks" . DS . "comments.php"; ?>
		</div>
	<?php endforeach; ?>
</div>
<?php include VIEW_PATH . "blocks" . DS . "pagination.php"; ?>
