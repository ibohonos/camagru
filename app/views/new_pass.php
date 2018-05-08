<h1 class="title">Save new password</h1>
<form class="pure-form pure-form-aligned" method="post" onsubmit="save_pass(this);return false;">
	<div class="error"></div>
	<fieldset>
		<div class="pure-control-group">
			<label for="password">Password</label>
			<input id="password" name="password" type="password" placeholder="Password" required>
			<span class="pure-form-message-inline">This is a required field.</span>
		</div>

		<div class="pure-control-group">
			<label for="conf_password">Confirm password</label>
			<input id="conf_password" name="conf_password" type="password" placeholder="Confirm password" required>
			<span class="pure-form-message-inline">This is a required field.</span>
		</div>

		<div class="pure-controls">
			<input type="hidden" name="email" value="<?php echo $data['email']; ?>">
			<button type="submit" class="pure-button button-secondary">Save password</button>
			<span>OR</span>
			<a class="pure-button button-success" href="/login/">Login</a>
		</div>
	</fieldset>
</form>
