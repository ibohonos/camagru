<h1 class="title">Camagru</h1>
<div class="index">
	<div class="pure-g gallery">
		<?php foreach ($data['gallery'] as $val) : ?>
			<div class="pure-u-1 image">
				<img class="pure-img" src="<?php echo $val['img']; ?>">
				<?php include VIEW_PATH . "blocks" . DS . "likes.php"; ?>
				<?php include VIEW_PATH . "blocks" . DS . "comments.php"; ?>
			</div>
		<?php endforeach; ?>
	</div>
</div>
