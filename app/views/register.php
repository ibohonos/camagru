<h1 class="title">Registration</h1>
<form class="pure-form pure-form-aligned" onsubmit="register(this);return false;" method="post">
	<div class="error"></div>
	<fieldset>
		<div class="pure-control-group">
			<label for="first_name">First name</label>
			<input id="first_name" name="first_name" type="text" placeholder="First name" required>
			<span class="pure-form-message-inline">This is a required field.</span>
		</div>

		<div class="pure-control-group">
			<label for="last_name">Last name</label>
			<input id="last_name" name="last_name" type="text" placeholder="Last name" required>
			<span class="pure-form-message-inline">This is a required field.</span>
		</div>

		<div class="pure-control-group">
			<label for="email">Email Address</label>
			<input id="email" type="email" name="email" placeholder="Email Address" required>
			<span class="pure-form-message-inline">This is a required field.</span>
		</div>

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
			<button type="submit" class="pure-button button-secondary">Register</button>
			<span>OR</span>
			<a class="pure-button button-warning" href="/login/">Login</a>
		</div>
	</fieldset>
</form>