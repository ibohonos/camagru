<h1 class="title">Login</h1>
<form class="pure-form pure-form-aligned" method="post" onsubmit="login(this);return false;">
	<div class="error"></div>
	<fieldset>
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

		<div class="pure-controls">
			<button type="submit" class="pure-button button-secondary">Login</button>
			<br>
			<br>
			<a class="pure-button button-warning" href="#">Reset password</a>
			<a class="pure-button button-success" href="/register/">Register</a>
		</div>
	</fieldset>
</form>
