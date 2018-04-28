<h1 class="title">Reset Password</h1>
<form class="pure-form pure-form-aligned" method="post" onsubmit="reset_pass(this);return false;">
	<div class="error"></div>
	<fieldset>
		<div class="pure-control-group">
			<label for="email">Email Address</label>
			<input id="email" type="email" name="email" placeholder="Email Address" required>
			<span class="pure-form-message-inline">This is a required field.</span>
		</div>

		<div class="pure-controls">
			<button type="submit" class="pure-button button-secondary">Reset password</button>
			<span>OR</span>
			<a class="pure-button button-success" href="/login/">Login</a>
		</div>
	</fieldset>
</form>
