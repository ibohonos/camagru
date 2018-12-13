<?php global $auth; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo $data['title']; ?> - Camagru</title>
	<link rel='shortcut icon' type='image/png' href='/img/favicon.png' />
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/pure.css">
	<link rel="stylesheet" href="/css/style.css">
</head>
<body>
	<?php include_once VIEW_PATH . "blocks" . DS . "header.php" ?>
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-8">
				<?php include VIEW_PATH . $content_view; ?>
			</div>
			<div class="col-12 col-md-4">
				<?php include_once VIEW_PATH . "blocks" . DS . "sidebar.php" ?>
			</div>
		</div>
	</div>
	<?php include_once VIEW_PATH . "blocks" . DS . "footer.php" ?>
	<script src="/js/scripts.js"></script>
</body>
</html>
