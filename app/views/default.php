<?php global $auth; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Camagru</title>
	<link rel='shortcut icon' type='image/png' href='/public/img/favicon.png' />
	<link rel="stylesheet" href="/public/css/pure.css">
	<link rel="stylesheet" href="/public/css/style.css">
	<script src="/public/js/ajax.js"></script>
</head>
<body>
	<?php include_once VIEW_PATH . "blocks" . DS . "header.php" ?>
	<div class="container">
		<div class="pure-g">
			<div class="pure-u-16-24">
				<?php include VIEW_PATH . $content_view; ?>
			</div>
			<div class="pure-u-8-24">
				<?php include_once VIEW_PATH . "blocks" . DS . "sidebar.php" ?>
			</div>
		</div>
	</div>
	<?php include_once VIEW_PATH . "blocks" . DS . "footer.php" ?>
	<script src="/public/js/scripts.js"></script>
</body>
</html>
