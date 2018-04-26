<div class="sidebar">
	<div class="login">
		<h2 class="title">Auth</h2>
		<?php if ($auth) : ?>
			<?php if ($auth['avatar']) : ?>
				<img class="ava" src="<?php echo $auth['avatar']; ?>" width="50%">
			<?php endif; ?>
			<p>Hello <?php echo $auth['first_name'] . " " . $auth['last_name']; ?></p>
		<?php else : ?>
			<form class="pure-form pure-form-stacked" action="/login/auth" method="post">
				<fieldset>
					<div class="pure-control-group">
						<label for="email">Email Address</label>
						<input id="email" type="email" name="email" placeholder="Email Address" required>
<!--						<span class="pure-form-message-inline">This is a required field.</span>-->
					</div>

					<div class="pure-control-group">
						<label for="password">Password</label>
						<input id="password" name="password" type="password" placeholder="Password" required>
<!--						<span class="pure-form-message-inline">This is a required field.</span>-->
					</div>

					<div class="pure-controls">
						<button type="submit" class="pure-button pure-button-primary">Login</button>
					</div>
				</fieldset>
			</form>
		<?php endif; ?>
	</div>
	<div class="last_photos">
		<h2 class="title">Last images</h2>
		<div class="pure-g">
			<?php $imgs = HomeModel::get_last(); ?>
			<?php if ($imgs) : ?>
				<?php foreach ($imgs as $img) : ?>
					<div class="pure-u-1-3">
						<img src="<?php echo $img['img']; ?>" height="100%" width="100%">
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<div class="pure-u-1">
					<p>No images.</p>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
