<header class="page_header">
	<div class="container">
		<div class="pure-menu pure-menu-horizontal">
			<a href="/" class="pure-menu-heading pure-menu-link">Camagru</a>
			<ul class="pure-menu-list">
				<li class="pure-menu-item">
					<a href="/" class="pure-menu-link">Home</a>
				</li>
				<?php if (isset($auth) && !empty($auth)) : ?>
					<li class="pure-menu-item">
						<a href="/profile/" class="pure-menu-link">Profile</a>
					</li>
				<?php endif; ?>
			</ul>
			<ul class="pure-menu-list pull-right">
				<?php if (isset($auth) && !empty($auth)) : ?>
					<li class="pure-menu-item">
						<a href="/login/logout/" class="pure-menu-link">Logout</a>
					</li>
				<?php else : ?>
					<li class="pure-menu-item">
						<a href="/login/" class="pure-menu-link">Login</a>
					</li>
					<li class="pure-menu-item">
						<a href="/register/" class="pure-menu-link">Register</a>
					</li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</header>