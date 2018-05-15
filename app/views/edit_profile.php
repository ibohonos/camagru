<?php
	if ($auth['notify'] === "1") :
		$notify = 1;
	else :
		$notify = 0;
	endif;
?>
<h1 class="title">Edit profile</h1>
<form class="pure-form pure-form-aligned" method="post" onsubmit="edit_profile(this);return false;">
	<div class="error"></div>
	<fieldset>
		<div class="pure-control-group">
			<label for="first_name">First name</label>
			<input id="first_name" name="first_name" type="text" placeholder="First name">
			<span class="pure-form-message-inline">Current: <?php echo $auth['first_name']; ?></span>
		</div>

		<div class="pure-control-group">
			<label for="last_name">Last name</label>
			<input id="last_name" name="last_name" type="text" placeholder="Last name">
			<span class="pure-form-message-inline">Current: <?php echo $auth['last_name']; ?></span>
		</div>

		<div class="pure-control-group">
			<label for="email">Email Address</label>
			<input id="email" type="email" name="email" placeholder="Email Address">
			<span class="pure-form-message-inline">Current: <?php echo $auth['email']; ?></span>
		</div>

		<div class="pure-control-group">
			<label for="password">Password</label>
			<input id="password" name="password" type="password" placeholder="Password">
		</div>

		<div class="pure-control-group">
			<label for="conf_password">Confirm password</label>
			<input id="conf_password" name="conf_password" type="password" placeholder="Confirm password">
		</div>

		<label for="notify" class="pure-checkbox">
			<input id="notify" name="notify" type="checkbox" value="1"<?php if ($notify) : ?> checked<?php endif; ?>> Notify me
		</label>

		<div class="pure-controls">
			<input type="hidden" name="user_id" value="<?php echo $auth['id']; ?>">
			<button type="submit" class="pure-button button-secondary">Save</button>
		</div>
	</fieldset>
</form>
