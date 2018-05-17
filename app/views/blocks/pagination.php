<div class="pagination align-items-center d-block">
	<?php foreach ($data['pages']->buttons as $button) : ?>
		<?php if ($button->isActive) : ?>
			<?php if (isset($_GET['id'])) : ?>
				<a href='/user?id=<?php echo $_GET['id']; ?>&page=<?php echo $button->page; ?>'><?php echo $button->text; ?></a>
			<?php else : ?>
				<a href='?page=<?php echo $button->page; ?>'><?php echo $button->text; ?></a>
			<?php endif; ?>
		<?php else : ?>
			<span><?php echo $button->text; ?></span>
		<?php endif; ?>
	<?php endforeach; ?>
	<div class="clearfix"></div>
</div>
