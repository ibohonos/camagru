<div class="sidebar">
	<div class="login d-none d-md-block">
		<h2 class="title">Auth</h2>
		<?php if ($auth) : ?>
			<?php if ($auth['avatar']) : ?>
				<img class="ava" src="<?php echo $auth['avatar']; ?>" width="50%">
			<?php endif; ?>
			<p>Hello <?php echo $auth['first_name'] . " " . $auth['last_name']; ?></p>
		<?php else : ?>
			<form class="pure-form pure-form-stacked" onsubmit="login(this);return false;" method="post">
				<div class="error"></div>
				<fieldset>
					<div class="pure-control-group">
						<label for="auth_email">Email Address</label>
						<input id="auth_email" type="email" name="email" placeholder="Email Address" required>
					</div>

					<div class="pure-control-group">
						<label for="auth_password">Password</label>
						<input id="auth_password" name="password" type="password" placeholder="Password" required>
					</div>

					<div class="pure-controls">
						<button type="submit" class="pure-button button-secondary">Login</button>
						<br>
						<br>
						<a class="pure-button button-warning" href="/user/reset/">Reset password</a>
						<a class="pure-button button-success" href="/register/">Register</a>
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
				<div class="pure-u-1" style="text-align: center;">
					<p>No images.</p>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
