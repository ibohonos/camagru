<img src="<?php echo $data['user']['avatar']; ?>" class="title_ava">
<h1 class="title"><?php echo $data['user']['first_name'] . " " . $data['user']['last_name']; ?></h1>
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
