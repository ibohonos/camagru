<header class="page_header">
	<div class="container">
		<div class="row" id="menu">
			<div class="col-12 col-lg-4 text-md-center text-lg-left">
				<a href="/" class="pure-menu-heading custom-brand">
					<img src="/public/img/logo.png" height="64">
				</a>
				<a href="#" class="custom-toggle" id="toggle">
					<s class="bar"></s>
					<s class="bar"></s>
				</a>
			</div>
			<div class="col-12 col-md-6 col-lg-4">
				<div class="pure-menu pure-menu-horizontal custom-can-transform">
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
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-4">
				<div class="pure-menu pure-menu-horizontal custom-menu-3 custom-can-transform">
					<ul class="pure-menu-list">
						<?php if (isset($auth) && !empty($auth)) : ?>
							<li class="pure-menu-item">
								<a href="/profile/edit/" class="pure-menu-link">Edit</a>
							</li>
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
		</div>
	</div>
</header>