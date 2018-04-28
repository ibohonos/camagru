<h1 class="title">Camagru</h1>
<div class="index">
	<pre>
		<?php print_r($data['count'][0]['count']); ?>
	</pre>
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
<?php include VIEW_PATH . "blocks" . DS . "pagination.php"; ?>
